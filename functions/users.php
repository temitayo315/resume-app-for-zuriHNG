<?php 

/**
 * This class manages user registration and login
 */
class users
{
	private $con;

	function __construct()
	{
		# code...
		include "./constant.php";

		$db = new Database();
		$this->con = $db->connect();

	}

	function emailExist($email){
		$stmt = $this->con->prepare("SELECT `email` FROM `register`");
		$stmt->bind_param("s",$email);
		$result = $stmt->execute();
		$result->get_result;
		$num_rows = $result->num_rows;
		if ($num_rows == 0) {
			return true;
		}else{
			return false;
		}
	}

	function userReg($firstName,$LastName,$email,$dept,$gender,$DOB){

		$stmt = $this->con->prepare("INSERT INTO `register` VALUES(?,?,?,?,?)");
		$stmt->bind_param("sssss",$firstName,$LastName,$email,$dept,$gender,$DOB);
		$register = $stmt->execute() or die($this->con->error);

		if ($this->emailExist($email)) {
			return "Your registration was successful";
		}else{
			return "Sorry, we couldn't register you this time";
		}
	}

	function userLogin($username, $password){
		$select = "SELECT `username`,`password` FROM `register`";
		$query = $this->con->query($select);
		$num_rows = $query->num_rows;
		while ($rows = $query->fetch_assoc()) {
			if ($num_rows > 0) {
				$_SESSION["username"] = $rows["username"];
				$_SESSION["password"] = $rows["password"];

				header("Location:index.html");
			}else{
				echo "You are not yet registered.";
			}
		}
	}

	function userDetails(){
		$select = "SELECT * FROM `register` WHERE `username` =".$_SESSION["username"];
		$query = $this->con->query($select);
		$num_rows = $query->num_rows;
		if ($num_rows > 0 ) {
			$firstName = $rows["firstName"];
			$LastName  = $rows["lastname"];
			$lastLogin = $rows["lastLogin"];
		}
		$dateTime = date("D/M/Y h:ia")
		$update = "UPDATE `users` SET `lastLogin` =".$dateTime;
		$query = $this->con->query($update);
	}
}

?>