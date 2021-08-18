<?php 

/**
 * 
 Code written by Ayanda Temitayo
 Database constant class
 */
class Database
{
	
	define("HOST_NAME", "localhost");
	define("USERNAME", "root");
	define("PASSWORD", "");
	define("DATABASE", "test");

	private $conn;

	public function connect(){

		$this->conn = new msqli(HOST_NAME,USERNAME,PASSWORD,DATABASE);
		if ($this->conn) {
			return $this->conn;
		}else{
			return "Failed_to_connect";

		}

	}
}


?>