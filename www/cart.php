<?php
	$page_title="Cart";
	include('../template/header.php');
	include_once('../functions/user.php');
	$user=new User();
	$address=$user->getAddress();
	if(isset($_POST['coupon-submit'])){
		$_SESSION['odekh-coupon']=$_POST['coupon-submit'];
	}
?>


<link rel="stylesheet" href="/assets/cart.css">

<?php
	include('../template/cart.php');
?>


<!-- Custom Script -->
<script src="../assets/cart.js" type="text/javascript"></script>

<?php
	include('../template/footer.php');
?>