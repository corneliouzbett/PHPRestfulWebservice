<?php
class DBController {
	private $conn = "";
	private $host = "your host here";
	private $user = "user";
	private $password = "password";
	private $database = "database name";

	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->conn = $conn;			
		}
	}

	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}

	function executeQuery($query) {
        $conn = $this->connectDB();    
        $result = mysqli_query($conn, $query);
        if (!$result) {
            //check for duplicate entry
            if($conn->errno == 1062) {
                return false;
            } else {
                trigger_error (mysqli_error($conn),E_USER_NOTICE);
				
            }
        }		
        $affectedRows = mysqli_affected_rows($conn);
		return $affectedRows;
		
    }
	function executeSelectQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if(!empty($resultset))
			return $resultset;
	}
}
?>
