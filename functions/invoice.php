<?php
	require_once('../functions/database.php');
	require_once('../functions/user.php');
	class Invoice{
		
		function __construct(){
			if(!isset($this->db)){
				// Connect to the database
				$database = new Database();
				$this->db=$database->getConnection();
			}
		}

		function printInvoice($firstname,$lastname,$address_line,$city,$pincode,$date,$price){
			include('../template/invoice.php');
		}
		
		function printMyInvoice($order_id){
			if((new User())->isLoggedIn()){
				$order=new Order();
				$orderList=$order->getOrder($order_id);
				
				
				$name=$user->getFullName();
				$phone=$user->getPhone();
				$email=$user->getEmail();
				
				$this->printInvoice($name,$address_line,$city,$pincode,date("Y-m-d H:i:s"),$price);
			}
		}
	}


?>