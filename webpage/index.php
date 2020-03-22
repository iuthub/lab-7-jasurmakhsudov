<?php
	session_start();

	$isPost = $_SERVER['REQUEST_METHOD'] == 'POST';
	$action = isset($_REQUEST['action'])?$_REQUEST['action']:'';
	function redirect($path) {
		header('Location: ' . $path, true, 301);
		exit();
	}

	include('connection.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Personal Page</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
		<?php include('header.php'); ?>
	</body>
</html>