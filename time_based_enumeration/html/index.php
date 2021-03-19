<?php
require 'libs/Enumlab/User.php';
$user=new Enumlab_User();
$action=$_POST['act']?$_POST['act']:$_GET['act'];
$message='<div><h2>Sign in</h2></div><form method="POST" action="/index.php"><input type="hidden" name="act" value="login" /><div>Username: <input type="text" name="login" /></div><div>Password: <input type="password" name="password"></div><div><input type="submit" value="Sign in"></div></form>';
switch ($action){
	case 'login':
		if ($user->login($_POST['login'],$_POST['password']))
			$message='<h2>Welcome '.$user->getLoggedUser().'</h2>';
		else {
			$message='<h3>Something went wrong.</h3>'.$message;
		}
		break;
	case 'login2':
		if ($user->login2($_POST['login'],$_POST['password']))
			$message='<h2>Welcome '.$user->getLoggedUser().'</h2>';
		else {
			$message='<h3>Something went wrong.</h3>'.$message;
		}
		break;
	case 'init':
		$user->init();
		header('Location: /index.php',302);
		break;
	default: 
		if ($user->getLoggedUser()) $message='<h2>Welcome '.$user->getLoggedUser().'</h2>';
}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8" />
		<title>Time based user enumeration</title>
	</head>
	<body>
		<main>
			<header>
				<h1>Time based user enumeration</h1>
			</header>
			<nav>
				<li><a href="/index.php">Sign in</a></li>
			</nav>
			<div>
				<?php echo $message; ?>
			</div>
		</main>
	</body>
</html>