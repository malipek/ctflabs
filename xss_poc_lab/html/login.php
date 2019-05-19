<?php
$salt='87ZSdfgdghklADSfgsr46uyfdzktgyhds56dzxfghHGASDFeawrg';

//sha512 of salt.login.pass
$passHash='0259a7eca49f7219c10fe58b792d591e9013c8c5885179079c36d38cd8bfab4d867326bf2246c731ae7da52c0ba9efc331c401bae44a5711b2138227e20f3ed1';
//AES-128-CBC encrypted flag. Decryption key is pass.login, iv=first 16 chars of salt
$encrypted='9nJqX7F6IPgYukGtxf8GBhR6+xn+Z8M+alqI1A0MeYtPKfFDIVe4099CvqIjqBbdXNDAk/5oqNfq2IrghFzK5OATC+Mvt/nxVHJvRPJBd+w=';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Our panel</title>
</head>
<body>
	<?php 
		$login=urldecode($_POST['login']);
		$pass=urldecode($_POST['password']);
		//check login and password
		if ($login && hash('sha512',$salt.$login.$pass)===$passHash){

			//show decrypted flag
			echo openssl_decrypt ( $encrypted , 'AES-128-CBC' , $pass.$login,0,substr($salt,0,16));
		}
		else{
		?>
			<form method="POST">
				<label for="login">Login: </label><input type="text" value="" name="login" id="login"><br>
				<label for="password">Password: </label><input type="password" value="" name="password" id="pasword"><br>
				<input type="submit" value="Submit">
			</form>
			<?php
			// Reflected XSS goes here
			echo "<!-- Rendering: ".urldecode($_SERVER['REQUEST_URI'])."-->";
		}
	?>
</body>
</html>