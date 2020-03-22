<?php
	$isFailedLogin = false;
	$username= isset($_COOKIE["username"])?$_COOKIE["username"]:'';
	$pwd = isset($_COOKIE["pwd"])?$_COOKIE["pwd"]:'';
	
	if($isPost && $action=='login') {
		$username = $_REQUEST['username'];
		$pwd = $_REQUEST['pwd'];
		$remember = isset($_REQUEST['remember'])?1:0;

		if ($User->checkUser($username, $pwd)) {
			$_SESSION['user'] = $User->getUser($username);
			$_SESSION['isAuth'] = TRUE;
			if($remember){
				setcookie("username", $username, time()+60*60*24*365);
				setcookie("pwd", $pwd, time()+60*60*24*365);
			}else{
				setcookie("username", $username, time()-1);
				setcookie("pwd", $pwd, time()-1);
			}
			header('Location: index.php', true, 301);
			exit();		
		} else {
			$isFailedLogin = true;
		}
	}

?>

<div class="twocols">
			<form action="index.php?action=login" method="post" class="twocols_col">
				<ul class="form">
					<?php 
					if ($isFailedLogin): ?>
						<h1 class="error">Incorrect login or password.</h1>
					<?php endif ?>
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" value="<?= $username ?>" id="username" />
					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="pwd" value="<?= $pwd ?>" id="pwd" />
					</li>
					<li>
						<label for="remember">Remember Me</label>
						<input type="checkbox" name="remember" id="remember" checked />
					</li>
					<li>
						<input type="submit" value="Submit" /> &nbsp; Not registered? <a href="register.php">Register</a>
					</li>
				</ul>
			</form>
			<div class="twocols_col">
				<h2>About Us</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur libero nostrum consequatur dolor. Nesciunt eos dolorem enim accusantium libero impedit ipsa perspiciatis vel dolore reiciendis ratione quam, non sequi sit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nobis vero ullam quae. Repellendus dolores quis tenetur enim distinctio, optio vero, cupiditate commodi eligendi similique laboriosam maxime corporis quasi labore!</p>
			</div>
		</div>