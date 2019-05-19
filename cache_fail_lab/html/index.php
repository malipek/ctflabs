<?php
/* 
if (!empty($_SERVER['PATH_INFO'])){
	header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found',404);
	echo 'Page not found';
	die();
}
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cache fail Lab</title>
</head>
<body onload="document.getElementById('date').innerHTML=new Date()">
	<p>Server-side date: <span><?php date_default_timezone_set('Europe/Warsaw');echo date('r');?></span></p>
	<p>Client-side date: <span id="date"></span></p>
</body>
</html>