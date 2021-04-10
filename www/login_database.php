<?php 
	include('../config/setup.php');
	require_once '../functions/database.php';
	require_once('../functions/user.php');
	
	$database = new Database();
	$user = new User();
	$connection=$database->getConnection();
	
	if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['password']) && !empty($_POST['password'])){
    $email = $connection->real_escape_string($_POST['email']); // Set variable for the username
    $password = $connection->real_escape_string($_POST['password']); // Set variable for the password and convert it to an MD5 hash.
	}
	
	if($user->emailExists($email)){
		$login = $user->login($email,$password);
		if($login){
			header('Location: myaccount.php');
		}else{
			header('Location: login.php?error=login');
		}
	}else{
		header('Location: login.php?error=login');
	}
	
	
?>