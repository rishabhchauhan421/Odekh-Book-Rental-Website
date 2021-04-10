<?php
require('../config/databaseConfig.php');
class Database extends DBConfig{
	
	
	function getHost(){
		return $Host;
	}
	function getUsername(){
		return $Username;
	}
	function getPassword(){
		return $Password;
	}
	function getName(){
		return $name;
	}
	
	function __construct(){
        if(!isset($this->conn)){
            $this->conn = new mysqli($this->Host, $this->Username, $this->Password, $this->Name);
			if($this->conn->connect_error){
				//var_dump($this->Username);
				die("Failed to connect with MySQL: " . $conn->connect_error);
			}
		} 
        
    }
	
	function getConnection(){
		return $this->conn;  
	}
}
?>