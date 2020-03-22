<?php
	$username = $_SESSION['user']; 
	if($action=='1') {
		$_SESSION['isAuth'] = false;
		session_destroy();
		redirect('index.php');
		}

	$isPosts = $_SERVER['REQUEST_METHOD'] == 'POST';
	
?>

<div class="logout_panel"><a href="register.php">My Profile</a>&nbsp;|&nbsp;<a href="index.php?action=1">Log Out</a></div>
		<h2>New Post</h2>
		<form action="index.php" method="post">
			<ul class="form">
				<li>
					<label for="title">Title</label>
					<input type="text" name="title" id="title" />
				</li>
				<li>
					<label for="body">Body</label>
					<textarea name="body" id="body" cols="30" rows="10"></textarea>
				</li>
				<li>
					<input type="submit" value="Post" />
				</li>
			</ul>
		</form>
		<?php  
				if($isPost) {
					$Post->addPost($_REQUEST['title'],$_REQUEST['body'],date("Y-m-d"),$_SESSION['user']['id']);
					
				}
			?>
		<div class="onecol">
			<?php 
				foreach ($Post->getPosts() as $post) { ?>		
					<div class="card">
						<h2><?= $post['title'] ?></h2>
						<h5>Author:<?= $Post->getPostAuthor($post['userID']) ?> Edit: <?= $post['publishDate'] ?></h5>
						<p>Some text..</p>
						<p><?= $post['body'] ?><</p>
					</div>
			<?php } ?>

		</div>