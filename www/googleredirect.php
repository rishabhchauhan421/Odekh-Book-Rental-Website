<?php

	// Start the session
	
	include('../config/setup.php');
	
	
	include_once('../config/googleConfig.php');
	include_once('../functions/user.php');
	
	//var_dump($_GET['code']);
			
	if(isset($_GET['code'])){
		$gClient->authenticate($_GET['code']);
		$_SESSION['token'] = $gClient->getAccessToken();
		header('Location: ' . filter_var($gredirectURL, FILTER_SANITIZE_URL));
	}else{
		echo 'NO GET Code sent';
	}
	
	if (isset($_SESSION['token'])) {
		$gClient->setAccessToken($_SESSION['token']);
	}

	if ($gClient->getAccessToken()) {
		//Get user profile data from google
		$gpUserProfile = $google_oauthV2->userinfo->get();
		
		//Initialize User class
		$user = new User();
		
		//Insert or update user data to the database
		$gpUserData = array(
			'oauth_provider'=> 'google',
			'oauth_uid'     => $gpUserProfile['id'],
			'first_name'    => $gpUserProfile['given_name'],
			'last_name'     => $gpUserProfile['family_name'],
			'email'         => $gpUserProfile['email'],
			'gender'        => $gpUserProfile['gender'],
			'locale'        => $gpUserProfile['locale'],
			'picture'       => $gpUserProfile['picture'],
			'link'          => $gpUserProfile['link']
		);
		$userData = $user->checkUser($gpUserData);
		
		//Storing user data into session
		$_SESSION['userData'] = $userData;
		
		//var_dump($userData);
		
		header('Location: ../myaccount.php');
	}else{
		header('Location: login.php');
	}
?>