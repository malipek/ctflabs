<!DOCTYPE html>
<html>
<head>
	<title>Connection Exhaustion Lab</title>
</head>
<body>
<p><?php 
	if($_SERVER['REQUEST_URI']=="/"){
		//do process result
		echo "Our page!";
	}
	else{
		// try to process unexpected query
		sleep(310); echo "Generated in 310s";
	}
	 ?><p>
</body>
</html>