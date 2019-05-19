<?php
/*
if (!empty($_SERVER['PATH_INFO'])){
	header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found',404);
	echo 'Page not found';
	die();
}
*/
//session_cache_limiter('');
session_start();
$passHash='d8e739a036ba0ad77bfdb765e253668c64dd58018cccb9cc98dbe3bc91855128545f1e9d5aa494021b47972956913fc659e708b2946682e56b8e6a070be540d2';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cache fail Lab</title>
</head>
<body>
	<?php if ($_SESSION['logged']=="1" || ($_POST['login']=="ksawery" && hash('sha512',$_POST['password'])==$passHash)){
		$_SESSION['logged']="1";
		echo "Witaj Ksawery!<br>Oto twoje dane osobowe, ich wyciek może kosztować 1 mln zł.";
	}
	else{
	?>
	<form method="POST">
		<label for="login">Login: </label><input type="text" value="" name="login" id="login"><br>
		<label for="password">Password: </label><input type="password" value="" name="password" id="pasword"><br>
		<input type="submit" value="Submit">
	</form>
	<?
}
	?>
</body>
</html>