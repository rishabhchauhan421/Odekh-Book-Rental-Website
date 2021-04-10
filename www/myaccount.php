<?php 
	$page_title='My Account';
	
	include('../config/setup.php');
	
	
	if(!isset($_SESSION['id'])){	
		header('Location: login.php');
		exit;
	}
	include('../template/header.php');
	
	
	$user=new User();
?>

	<div class="container">
		<?php
			include('../template/membership_panel.php');
			include('../template/address_panel.php');
			
			if($user->isActivated()){
				include('../template/myaccount.php');
			}else{
				include('../template/activation_panel.html');
			}
		
		?>	
	</div>


<script src="assets/myaccount.js" type="text/javascript"></script>
	
<?php 
	include('../template/footer.php');
?>