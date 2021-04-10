<?php
	$page_title='Membership';
	include('../template/header.php');
	include_once('../functions/user.php');
	$user=new User();
	if(!$user->isLoggedIn()){
		header('login.php');
	}
?>
<div class="container">
	<div class="alert alert-success">
		<strong>Pay us online <span class="fa fa-bolt"> </span>.</strong>
	</div>
	<?php include('pay_form.php'); ?>
</div>




<?php
	include('../template/footer.php');
?>