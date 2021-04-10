<?php
	include('../functions/user.php');
	
	if(isset($_GET['email'])){
		if(isset($_GET['hash'])){
			$email=htmlspecialchars($_GET['email']);
			$hash=htmlspecialchars($_GET['hash']);
			
			$user=new User();
			$user->activate($email,$hash);
		}
	}
	header('Location: myaccount.php');
	exit;
?>