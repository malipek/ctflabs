<?php
require 'libs/Cbclab/User.php';
$user=new Cbclab_User();
$action=$_POST['act']?$_POST['act']:$_GET['act'];
$message='<div><h2>Sign in</h2></div><form method="POST" action="/index.php"><input type="hidden" name="act" value="login" /><div>Username: <input type="text" name="login" /></div><div>Password: <input type="password" name="password"></div><div><input type="submit" value="Sign in"></div></form>';
switch ($action){
	case 'register': 
		$message='<div><h2>Register new user</h2></div><form method="POST" action="/index.php"><input type="hidden" name="act" value="registerPost" /><div>Username: <input type="text" name="login" /></div><div>Password: <input type="password" name="password"></div><div><input type="submit" value="Register user"></div></form>'; 
			if ($user->getLoggedUser()) $message='Welcome '.$user->getLoggedUser();
		break;
	case 'registerPost': 
		$res=$user->registerUser($_POST['login'],$_POST['password']);
		if ($res && $user->login($_POST['login'],$_POST['password']))
			$message='<h2>Welcome '.$user->getLoggedUser().'</h2>';
		else {
			$message='<h3>Something went wrong</h3>'.$message;
			$user->regenerateSession();
		}
		break;
	case 'login':
		if ($user->login($_POST['login'],$_POST['password']))
			$message='<h2>Welcome '.$user->getLoggedUser().'</h2>';
		else {
			$message='<h3>Something went wrong.</h3>'.$message;
			$user->regenerateSession();
		}
		break;
	case 'logout': 
		$user->logOut();
		break;
	case 'init':
		$user->logOut();
		$user->init();
		header('Location: /index.php',302);
		break;
	default: 
		$user->regenerateSession();
		if ($user->getLoggedUser()) $message='<h2>Welcome '.$user->getLoggedUser().'</h2>';
}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8" />
		<title>CBC Oracle Padding PoC</title>
		<?php if ($user->getLoggedUser()==='admin') echo '<style>html,body {background-color:#f00;}</style>'; ?>
	</head>
	<body>
		<main>
			<header>
				<h1>CBC Oracle Padding PoC</h1>
				<h3>Try to log in as admin</h3>
			</header>
			<nav>
				<li><a href="/index.php">Sign in</a></li>
				<li><a href="/index.php?act=register">Register new user</a></li>
				<?php
					if ($user->getLoggedUser()) echo '<li><a href="/index.php?act=logout">Logout</a></li>';
				?>
			</nav>
			<div>
				<?php echo $message; ?>
			</div>
		</main>
	</body>
</html>