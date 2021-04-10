<?php

	include_once('../config/googleConfig.php');
	include_once('../functions/user.php');
	
	$googleLoginURL = $gClient->createAuthUrl();
?>