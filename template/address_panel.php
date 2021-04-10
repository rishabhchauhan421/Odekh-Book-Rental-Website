<?php
	include_once("../functions/user.php");
	
	$user=new User();
	if($user->isLoggedIn()){
		if(!$user->addressExists()){
			echo '<div class="row">
						<div class="alert alert-success">
							<strong>Set your delivery  address from the manage address tab...</strong>
						</div>
					</div>';
		}
	}
?>