<?php

/**
 * 
 */
class Post
{
	private $db;

	private $getPostsStmt;
	private $getPostStmt;
	private $addPostStmt;
	private $updatePostStmt;
	private $deletePostStmt;

	function __construct($db)
	{
		$this->db = $db;
		$this->getPostsStmt = $db->prepare('SELECT * FROM Posts');
		$this->getPostStmt = $db->prepare('SELECT * FROM Posts WHERE id=?');
		$this->addPostStmt = $db->prepare('INSERT INTO Posts(title, body, publishDate, userID) VALUES(?,?,?,?)');
		$this->updatePostStmt = $db->prepare('UPDATE Posts SET title=?, body=? WHERE id=?');
		$this->deletePostStmt = $db->prepare('DELETE FROM Posts WHERE id=?');
	}

	public function getPosts() {
		$this->getPostsStmt->execute();
		return $this->getPostsStmt->fetchAll();
	}

	public function getPost($id) {
		$this->getPostStmt->execute(array($id));
		return $this->getPostStmt->fetch();
	}

	public function addPost($title, $body, $publishDate, $userID) {
		$this->addPostStmt->execute(array($title, $body, $publishDate, $userID));
	}

	public function updatePost($id, $title, $body) {
		$this->updatePostStmt->execute(array($title, $body, $id));
	}	

	public function deletePost($id) {
		$this->deletePostStmt->execute(array($id));
	}
}

?>