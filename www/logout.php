<?php
// Include FB config file
require_once '../config/setup.php';

// Remove access token from session
if(isset($_SESSION['facebook_access_token'])){
	unset($_SESSION['facebook_access_token']);
}
// Remove user data from session
unset($_SESSION['userData']);
unset($userData);
unset($_SESSION['id']);
unset($_SESSION['firstname']);

	session_destroy();


session_start();



// Redirect to the homepage
header('Location: index.php');
die();
?>