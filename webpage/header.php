<h1>My Blog</h1>
<h4>In this web site you can leave any post you want.</h4>
<hr />
		
<?php  
		if(isset($_SESSION['isAuth'])) {
			include('logout_page.php');
		} else {
			include('login_page.php');
		}
?>