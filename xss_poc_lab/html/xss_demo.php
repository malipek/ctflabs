<!DOCTYPE html>
<html>
<head>
	<title>Our panel</title>
	<script language="javascript" src="scripts.js"></script>
	<link rel="stylesheet" href="resources.css">
</head>
<body>
				<form method="GET">
				<label for="name">Enter your name: </label><input type="text" value="<?php echo urldecode($_GET['name']); ?>" name="name" id="name">
				<input type="submit" value="Submit">
			</form>
			Hello <?php echo htmlentities(urldecode($_GET['name'])); ?>, nice to meet you!
			</body>
</html>