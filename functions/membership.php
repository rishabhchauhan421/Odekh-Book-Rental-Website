<?php


class Membership{
	function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $database = new Database();
			$this->db=$database->getConnection();
        }
    }
	
	function getPriceById($id){
		$query="SELECT price, security FROM membership WHERE id='".$id."'";
		$result=$this->db->query($query);
		
		if($result->num_rows > 0){
			// Log In
			$row = mysqli_fetch_assoc($result);
			$price=$row['price'];
			return $price;
		}
	}
	function getSecurityById($id){
		$query="SELECT security FROM membership WHERE id='".$id."'";
		$result=$this->db->query($query);
		
		if($result->num_rows > 0){
			// Log In
			$row = mysqli_fetch_assoc($result);
			$security=$row['security'];
			return $security;
		}
	}
	
	function getDetailsById($id){
		$query="SELECT * FROM membership where id='".$id."'";
		$result=$this->db->query($query);
		
		$membershipData=array();
		if($result->num_rows>0){
			$row=$result->fetch_assoc();
			$membership = array(
				'id'		  		=> $row['id'],
				'title'       		=> $row['title'],
				'price'       		=> $row['price'],
				'security'    		=> $row['security'],
				'image'    			=> $row['image'],
				'product_category'  => '2',
				'duration' 			=> $row['duration']);
			return $membership;
		
		}
	}
}



?>