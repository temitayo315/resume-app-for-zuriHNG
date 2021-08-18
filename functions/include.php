<?php 

/**
 * This class is used to control all the items
 */
class controller
{
		private $conn;
	
	function __construct()
	{
		include "./constant.php";
		$db = new Database();
		$this->conn = $db->connect();
	}

	function getCategory(){
		$select = "SELECT `id`,`name` FROM `category`";
		$query = $this->conn->query($select);
		while ($row = $query->fetch_assoc()) {
			$id = $row["id"];
			$name = $row["name"];

			echo "<option value='$id'>".$name."</option>";
		}
	}
}

?>