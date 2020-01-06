<?php
require 'libs/Credis/Client.php';
class Cbclab_User{

    
    private const COOKIENAME='Auth'; 
    private const AESKEY="I'm 128-bit long";
    private const ALG="aes-128-cbc";
    private const SESSIONEXP=3600;
    private const PASSWDHASH="sha256";
    private const REDISSERVER="redis"; //hostname from docker-compose.yml
    private const IVLEN=16; //IV length for AES-128 CBC mode

    private $loggedUser = '';
    private $authToken = '';

    private $redis = null;

    public function __construct(){
        $this->redis = new Credis_Client (self::REDISSERVER);
    }

    public function init(){
        // clear redis
        $this->redis->flushall();
        // create user admin with some password value
        $this->redis->set("admin","This is not a password");
    }

    public function __destruct(){
        $this->redis->close();
    }

    private function userExists($username){
        // is user present in storage?
        return $this->redis->exists($username);
    }

    private function sanitizeLogin($login){
        // only url-valid chars
        return filter_var($login, FILTER_SANITIZE_URL);
    }

    private function calcPasswdHash($login,$password){
        //password sotred as SHA256 of salt+login+password
        return hash(self::PASSWDHASH,self::AESKEY.$login.$password);
    }

    public function login($login,$password){
        // sign in user in site
        $login=$this->sanitizeLogin($login);
        if ($this->userExists($login)){
            $pass = $this->redis->get($login);
            if ($pass && $password && $this->calcPasswdHash($login,$password)===$pass){
                $this->loggedUser=$login;
                $this->generateAuthToken();
                $this->setAuthCookie();
                return true;
            }
            return false;
        }
        return false;
    }

    public function registerUser($login,$password){
        // create user record in backend storage
        $login=$this->sanitizeLogin($login);
        if (!$this->userExists($login)){
            if ($this->redis->set($login,$this->calcPasswdHash($login,$password)))
                return true;
            else
                return false;
        }
        return false;
    }

    public function getLoggedUser(){
        //who's logged?
        return $this->loggedUser;
    }

    public function logOut(){
        // sign out, clear the mess
        $this->authToken="";
        $this->loggedUser="";
        $this->clearAuthCookie();
    }

    private function generateAuthToken(){
        // create token for COOKIE - AES-128 CBC from username
        // generate iv
        $iv = openssl_random_pseudo_bytes(self::IVLEN);
        $encrypted = openssl_encrypt($this->loggedUser, self::ALG, self::AESKEY, OPENSSL_RAW_DATA,$iv);
        $this->authToken=(base64_encode($iv.$encrypted));
    }


    public function regenerateSession(){
        // get logged user from cookie
        $authToken=$_COOKIE[self::COOKIENAME];
        if ($authToken){
            $authToken=base64_decode($authToken);
            $iv = substr($authToken,0,self::IVLEN);
            $crypted = substr($authToken,self::IVLEN);
            $username = openssl_decrypt($crypted, self::ALG, self::AESKEY,OPENSSL_RAW_DATA,$iv);
            // shoutout error if decryption failed
            if ($username===false){
                $this->__destruct();
                die('Decryption error');
            } 
            // if user exists in backend storage
            if ($this->userExists($username)){
                $this->loggedUser=$username;
                $this->authToken=$_COOKIE[self::COOKIENAME];
                // reset cookie (to set new expiration date)
                $this->setAuthCookie();
            }
            else
                // logout if user does not exists in backend storage
                $this->logOut();
        }
        // no cookie - logout
        else $this->logOut();
    }

    private function setAuthCookie(){
        $options = [
            'expires'=> time()+self::SESSIONEXP,
            'httponly'=> true
        ];
        setcookie ( self::COOKIENAME, $this->authToken, $options);
    }

    private function clearAuthCookie(){
        $options = [
            'expires'=> time()-self::SESSIONEXP,
            'httponly'=> true
        ];
        setcookie ( self::COOKIENAME, "", $options);
    }
}
?>