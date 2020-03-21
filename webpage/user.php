<?php 
/**
 * 
 */
class User 
{
	private $db;

	private $getUserStmt;
	private $addUserStmt;

	function __construct($db)
	{
		$this->db = $db;
		$this->getUserStmt = $db->prepare('SELECT * FROM Users WHERE username=?');
		$this->addUserStmt = $db->prepare('INSERT Users( username, email, password, fullname  ) VALUES(?,?,?,?)');
	}

	public function getUser($username) {
		$this->getUserStmt->execute(array($username));
		if($this->getUserStmt->rowCount()>0) {
			return $this->getUserStmt->fetch();
		}
		return NULL;
	}

	public function checkUser($username, $pwd) {
		$user=$this->getUser($username);
		return $user && $user['pwd']==$pwd;
	}

	public function addUser($username,$email, $pwd, $fullname) {
		if (!$this->getUser($username)) {
			$this->addUserStmt->execute(array(
				$username,
				$email,
				$pwd,
				$fullname,				
			));
			return true;
		}
		return false;
	}
}

?>