<?php

	include_once('../functions/user.php');

class Email{

	function activateUser($name,$email,$hash){
		$to      = $email; // Send email to our user
		$subject = 'Signup | Verification'; // Give the email a subject 
		$message = 'Thanks for signing up!
		Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
		 
		------------------------
		Username: '.ucwords($name).'
		------------------------
		 
		Please click this link to activate your account: http://www.odekh.com/verify.php?email='.$email.'&hash='.$hash.''; // Our message above including the link
							 
		$headers = 'From:noreply@odekh.com' . "\r\n"; // Set from headers
		mail($to, $subject, $message, $headers); // Send our email
	}
	
	function requestBook($book){
		$to      = "rshbhchauhan@gmail.com"; // Send email to our user
		$subject = 'Book | Requested'; // Give the email a subject 
		$message = 'Books Requested!
		THe following has been requested by the user.
		 
		------------------------
		Book: '.$book.'
		------------------------
		';
		
		$user=new User();
		if($user->isLoggedIn()){
			$headers = 'From:'.$user->getEmail().'' . "\r\n"; // Set from headers	
		}else{
			$headers = 'From:noreply@odekh.com' . "\r\n"; // Set from headers
		}
							 
		mail($to, $subject, $message, $headers); // Send our email
	}
	
	function sendOrderIdToAdmin($order_id){
		$to      = "rshbhchauhan@gmail.com"; // Send email to our user
		$subject = 'Book Placed'; // Give the email a subject 
		$message = 'New Books Placed!
		New Order has been followed.
		 
		------------------------
		Order Id: '.$order_id.'
		------------------------
		';
		
		$user=new User();
		if($user->isLoggedIn()){
			$headers = 'From:'.$user->getEmail().'' . "\r\n"; // Set from headers	
		}else{
			$headers = 'From:noreply@odekh.com' . "\r\n"; // Set from headers
		}
							 
		mail($to, $subject, $message, $headers); // Send our email

	}
	function returnProduct($order_item){
		$to      = 'rshbhchauhan@gmail.com'; // Send email to our user
		$subject = 'Return Requested'; // Give the email a subject 
		$message = 'New Return request placed.
		User has reqeusted return of the product with id:
		 
		------------------------
		Order Item Id: '.ucwords($order_item).'
		------------------------		 
		';					 
		$headers = 'From:noreply@odekh.com' . "\r\n"; // Set from headers
		mail($to, $subject, $message, $headers); // Send our email
	}
}
?>