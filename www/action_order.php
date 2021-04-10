<?php
	include('../functions/order.php');
	
	if(isset($_POST['setAddress'])){
		$address_line=$_POST['address_line'];
		$pincode=$_POST['pincode'];
		$city=$_POST['city'];
		
		$order=new Order();
		$order->setAddress($address_line,$city,$pincode);
	}
?>