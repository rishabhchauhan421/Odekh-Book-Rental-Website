<?php
	include_once("../functions/user.php");
	
	$user=new User();
	if($user->isLoggedIn()){
		if(!$user->isPremiumMember()){
			echo '<div class="row">
						<div class="alert alert-success">
							<strong>Be Our premium Member by clicking <a href="pricing.php">here </a> <span class="fa fa-bolt"> </span></strong>
						</div>
					</div>';
		}
	}
?>