<pre><?php
$salt='87ZSdfgdghklADSfgsr46uyfdzktgyhds56dzxfghHGASDFeawrg';
$flaga="Congratulations! Flag is: 'CSP+SRI is the must have for e-commerce. Peroid.'";
$login='Username can contain space, why not?';
$pass='Password can have it too!';
echo "\n"."Hash";
echo "\n".hash('sha512',$salt.$login.$pass);
echo "\n"."Zaszyfrowana flaga";
echo "\n".openssl_encrypt ( $flaga , 'AES-128-CBC' , $pass.$login,0,substr($salt,0,16));
?></pre>
