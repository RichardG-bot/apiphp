<?php
include("DBConnection.php");
class Student 
{
    protected $db;
    public $_id;
    public $_name;
    public $_surname;
    public $_sidiCode;
    public $_taxCode;
 
    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }
 
    //insert
    public function insert() {
		try {
    		$sql = 'INSERT INTO student (name, surname, sidiCode, taxCode)  VALUES (:name, :surname, :sidiCode, :taxCode)';
    		$data = [
			    'name' => $this->_name,
			    'surname' => $this->_surname,
			    'sidiCode' => $this->_sidiCode,
			    'taxCode' => $this->_taxCode,
			];
	    	$stmt = $this->db->prepare($sql);
	    	$stmt->execute($data);
			$status = $stmt->rowCount();
            return $status;
 
		} catch (Exception $e) {
    		die("Oh noes! There's an error in the query!");
		}
 
    }
   
    //22getAll 
    public function list() {
    	try {
    		$sql = "SELECT * FROM student";
		    $stmt = $this->db->prepare($sql);
 
		    $stmt->execute();
		    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
    }

    //getOne
    public function one() {
    	try {
    		$sql = "SELECT * FROM student WHERE id=:id";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id' => $this->_id
			];
		    $stmt->execute($data);
		    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
    }
 
    //delete 
    public function delete() 
	{
		try {
    		$sql = "DELETE FROM student WHERE id=:id";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id' => $this->_id
			];
		    $stmt->execute($data);
            return "Eliminazione avvenuta";
		} catch (Exception $e) {
			die("Oh noes! There's an error in the query!");
			
		}
    }

    //put 
    public function put() 
	{
		try {
    		$sql = "UPDATE student SET name=:name, surname=:surname, sidiCode=:sidiCode, taxCode=:taxCode WHERE id=:id";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id' => $this->_id,
				'name' => $this->_name,
				'surname' => $this->_surname,
				'sidiCode' => $this->_sidiCode,
				'taxCode' => $this->_taxCode
			];
		    $stmt->execute($data);
            return "Aggiornamento effettuato";
		} catch (Exception $e) {
		    
			die("Oh noes! There's an error in the query!");
			
		}
    }
 
    //patch
    public function patch() 
	{
		try {
    		$sql = "UPDATE student SET ";
			if($this->_name)
				$sql .= " name=:name,";
			if($this->_surname)
				$sql .= " surname=:surname,";
			if($this->_sidiCode)
				$sql .=" sidiCode=:sidiCode,";
			if($this->_taxCode)
				$sql .=" taxCode=:taxCode,";
			
			$lenght= strlen($sql);
			$sql[$lenght-1]=" ";
			
			$sql .= " WHERE id=:id";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id' => $this->_id
			];
			if($this->_name)
				$data["name"] = $this->_name;
			if($this->_surname)
				$data["surname"] = $this->_surname;
			if($this->_sidiCode)
				$data["sidiCode"] = $this->_sidiCode;
			if($this->_taxCode)
				$data["taxCode"] = $this->_taxCode;
		    $stmt->execute($data);
            return "Aggiornamento effettuato";
		} catch (Exception $e) {
		    
			die("Oh noes! There's an error in the query!");
			
		}
    }
 
}
?>