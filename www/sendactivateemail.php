<?php

	include('../functions/user.php');
	
	$user=new User();
	//var_dump($user->isLoggedIn());
	if($user->isLoggedIn()){
		$user->sendActivationMail($_SESSION['id']);
		header('Location: myaccount.php');
	}else{
		header('Location: login.php');
	}
?>