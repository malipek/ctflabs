<?php
require 'libs/Credis/Client.php';
class Enumlab_User{

    
    private const PEPPER="I'm 128-bit long";
    private const REDISSERVER="redis"; //hostname from docker-compose.yml
    private const MAXUSERS = 5000;

    private $loggedUser = '';

    private $redis = null;

    public function __construct(){
        $this->redis = new Credis_Client (self::REDISSERVER);
    }

    public function init(){
        define('DEFAULTPASS','This is not a password');
        // clear redis
        if ($_GET['usersCount']){
            $usersCount = intval($_GET['usersCount']);
        }
        if ( ($usersCount < 0) || ($usersCount > self::MAXUSERS) ){
            $usersCount = self::MAXUSER;
        }
        $this->redis->flushall();
        // create user admin with some password value
        $this->redis->set("admin",DEFAULTPASS);
        for ($i=0; $i<$usersCount; $i++){
            $username='';
            for ($j=0;$j<rand(8,20);$j++){
                $username = $username.char( rand( ord('0'),ord('z') ) );
            }
            $this->redis->set($username,DEFAULTPASS);
        } 
        $this->redis->set("info",DEFAULTPASS);
        $this->redis->set("Manager",DEFAULTPASS);
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
        //password stored as BCrypt with recommended minimal cost of 12
        return password_hash(self::PEPPER.$login.$password,PASSWORD_BCRYPT,['cost' => 12]);
    }

    public function login($login,$password){
        // sign in user in site
        $login=$this->sanitizeLogin($login);
        if ($this->userExists($login)){
            $pass = $this->redis->get($login);

            //hash calculated only when user exists
            if ($pass && $password && $this->calcPasswdHash($login,$password)===$pass){
                $this->loggedUser=$login;
            }
            return false;
        }
        return false;
    }

    public function login2($login,$password){
        // sign in user in site
        $login=$this->sanitizeLogin($login);
        
        // hash calculated always!
        $hash=$this->calcPasswdHash($login,$password);
        if ($this->userExists($login)){
            $pass = $this->redis->get($login);
            if ($pass && $password && $hash===$pass){
                $this->loggedUser=$login;
                return true;
            }
            return false;
        }
        return false;
    }


    public function getLoggedUser(){
        //who's logged?
        return $this->loggedUser;
    }

}
?>
