<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "cc";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
	function executeUpdate($query) {
        $result = mysqli_query($this->conn,$query);        
		return $result;		
    }

     function deleteStudent($reg_id) {
        $query = "DELETE FROM regs WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $reg_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function newStdId(){
	$query = "SELECT * FROM student ORDER BY std_id desc limit 0,1";
	$result2 = $this->runQuery($query);

    	if (is_array($result2)){ // 1
	        foreach ($result2 as $key => $value) {
	            $newId = $result2[$key]["std_id"];
	            $newId = $newId + 1;
	            return $newId;
	        }
	    }else{
	    	return 1;
	    }
	}
	function newTeacherId(){
	$query = "SELECT * FROM teacher ORDER BY teacher_id desc limit 0,1";
	$result2 = $this->runQuery($query);

    	if (is_array($result2)){ // 1
	        foreach ($result2 as $key => $value) {
	            $newId = $result2[$key]["teacher_id"];
	            $newId = $newId + 1;
	            return $newId;
	        }
	    }else{
	    	return "error";
	    }
	}
}
?>