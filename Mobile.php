<?php
require_once("DatabaseController.php");
/* 
A domain Class to demonstrate RESTful web services
*/
Class Mobile {
	private $mobiles = array();
	public function getAllMobile(){
		if(isset($_GET['name'])){
			$name = $_GET['name'];
			$query = 'SELECT * FROM tbl_mobile WHERE name LIKE "%' .$name. '%"';
		} else {
			$query = 'SELECT * FROM tbl_mobile';
		}
		$dbcontroller = new DBController();
		$this->mobiles = $dbcontroller->executeSelectQuery($query);
		return $this->mobiles;
	}

	public function addMobile(){
		if(isset($_POST['name'])){
			$name = $_POST['name'];
				$model = '';
				$color = '';
			if(isset($_POST['model'])){
				$model = $_POST['model'];
			}
			if(isset($_POST['color'])){
				$color = $_POST['color'];
			}	
			$query = "insert into tbl_mobile (name,model,color) values ('" . $name ."','". $model ."','" . $color ."')";
			$dbcontroller = new DBController();
			$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}
	
	public function deleteMobile(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$query = 'DELETE FROM tbl_mobile WHERE id = '.$id;
			$dbcontroller = new DBController();
			$result = $dbcontroller->executeQuery($query);
			if($result != 0){
				$result = array('success'=>1);
				return $result;
			}
		}
	}
	
	public function editMobile(){
		if(isset($_POST['name']) && isset($_GET['id'])){
			$name = $_POST['name'];
			$model = $_POST['model'];
			$color = $_POST['color'];
			$query = "UPDATE tbl_mobile SET name = '".$name."',model ='". $model ."',color = '". $color ."' WHERE id = ".$_GET['id'];
		}
		$dbcontroller = new DBController();
		$result= $dbcontroller->executeQuery($query);
		if($result != 0){
			$result = array('success'=>1);
			return $result;
		}
	}
	
}
?>
