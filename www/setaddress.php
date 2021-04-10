<?php
	include('../functions/inputvalidation.php');
	include_once('../functions/user.php');
	
	$validate = new Validate();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$addressLine = $validate->test_input($_POST["addressLine"]);
		$pincode = $validate->test_input($_POST["pincode"]);
		$city = $validate->test_input($_POST["city"]);
		$state = $validate->test_input($_POST["state"]);
		$phone= $validate->test_input($_POST["state"]);
		
		$user=new User();
		$user->setAddress($addressLine,$city,$pincode,$state);
		$user->setPhone($phone);
		header('Location: myaccount.php');
		exit;
	}
?>