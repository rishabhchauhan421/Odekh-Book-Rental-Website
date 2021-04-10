<?php
	//Setup:
	
	include('../vendor/autoload.php');
	
	// Start the session
	
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$site_title="Odekh - Rent books, novels, academics etc";
	if(!isset($_SESSION['id'])){
		unset($_SESSION['userData']);
		unset($userData);
		unset($_SESSION['id']);
		unset($_SESSION['firstname']);
	}
	date_default_timezone_set('Asia/Kolkata');
?>