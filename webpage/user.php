<?php 
/**
 * 
 */
class User 
{
	private $db;

	private $getUserStmt;
	private $addUserStmt;
	private $modifyUserStmt;
	function __construct($db)
	{
		$this->db = $db;
		$this->getUserStmt = $db->prepare('SELECT * FROM Users WHERE username=?');
		$this->addUserStmt = $db->prepare('INSERT Users( username, email, password, fullname  ) VALUES(?,?,?,?)');
		$this->modifyUserStmt = $db->prepare('UPDATE Users SET username=?, email=?, password=?, fullname=? WHERE username=?');

	}

	public function getUser($username) {
		$this->getUserStmt->execute(array($username));
		if($this->getUserStmt->rowCount()>0) {
			$details = $this->getUserStmt->fetch();
			print_r($details);
			return $details;
		}
		return NULL;
	}

	public function checkUser($username, $pwd) {
		$user=$this->getUser($username);
		return $user && $user['password']==$pwd;
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

	public function modifyUser($prevusername,$username,$email, $pwd, $fullname){
		$this->modifyUserStmt->execute(array(
			$username,
			$email,
			$pwd,
			$fullname,
			$prevusername
		));
		return true;
	}

}

?>