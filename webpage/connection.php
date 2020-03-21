<?php
	include('user.php');
	include('post.php');
    
    $db = new PDO("mysql:dbname=blog;host=localhost","root","");

	$User = new User($db);
	$Post = new Post($db);

?>
