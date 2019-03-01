<?php
// Configuration of database
require_once("quizConfig.php");  

class init extends quizConfig
{
	function __construct()
	{
		$this->conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);
		if ($this->conn->connect_error) 
		{
			die("Connection failed: " . $this->conn->connect_error);
		} 
	}
}

?>