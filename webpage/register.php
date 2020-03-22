<?php  
	session_start();
	$isPost = $_SERVER['REQUEST_METHOD'] == 'POST';
	$action = isset($_REQUEST['action'])?$_REQUEST['action']:'';

	function redirect($path) {
		header('Location: ' . $path, true, 301);
		exit();
	}

	include('connection.php');

	if(isset($_SESSION['isAuth'])){
		$username = $_SESSION['user']['username'];
		$fullname = $_SESSION['user']['fullname'];
		$pwd = $_SESSION['user']['password'];;
		$confirm_pwd = $_SESSION['user']['password'];;
		$email = $_SESSION['user']['email'];
	}else{

		$username = '';
		$fullname = '';
		$pwd = '';
		$confirm_pwd = '';
		$email = '';
	}

	$usernamePattern='/^\w{4,}$/i';
	$pwdPattern='/^\w{4,}$/i';
	$namePattern='/^[a-z]+( [a-z]+)*$/i';
	$emailPattern='/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i';

	$isValid = TRUE;
	$isOk = TRUE;

	if($isPost) {
		$username=$_REQUEST["username"];
		$fullname=$_REQUEST["fullname"];
		$pwd =$_REQUEST["pwd"];
		$confirm_pwd =$_REQUEST["confirm_pwd"];
		$email = $_REQUEST["email"];
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Blog - Registration Form</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
		
		<h2>User Details Form</h2>
		<h4>Please, fill below fields correctly</h4>
		<form action="register.php" method="post">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" value="<?= $username ?>" required/>
						<?php if ($isPost && !preg_match($usernamePattern, $username)): $isValid=false; ?>
							<span class="error">Required field.</span>	
						<?php endif ?>
					</li>
					<li>
						<label for="fullname">Full Name</label>
						<input type="text" name="fullname" id="fullname" value="<?= $fullname ?>" required/>
					</li>
					<li>
						<label for="email">Email</label>
						<input type="email" name="email" id="email" value="<?= $email ?>" />
						<?php if ($isPost && !preg_match($emailPattern, $email)): $isValid=false; ?>
							<span class="error">Not a valid email.</span>	
						<?php endif ?>
					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="pwd" id="pwd" value="<?= $pwd ?>" required/>
						<?php if ($isPost && (!preg_match($pwdPattern, $pwd) || $pwd!=$confirm_pwd)): $isValid=false; ?>
							<span class="error">Required field.</span>	
						<?php endif ?>
					</li>
					<li>
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" name="confirm_pwd" id="confirm_pwd" value="<?= $confirm_pwd ?>" required />

					</li>
					<li>
						<input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
					</li>
				</ul>
		</form>
		<?php  
				if($isPost && $isValid && !isset($_SESSION['isAuth'])) {
					$isOk= $User->addUser($username, $email, $pwd, $fullname);
					if ($isOk) redirect('index.php');
				}elseif ($isPost && $isValid && isset($_SESSION['isAuth'])) {
					$isOk= $User->modifyUser($_SESSION['user']['username'],$username, $email, $pwd, $fullname);
					$_SESSION['user'] = $User->getUser($username);
					if ($isOk) redirect('index.php');
				}
			?>
			<?php if (!$isOk): ?>
				<span class="error">This user exists in database!</span>
			<?php endif ?>
	</body>
</html>