<?php
	
	include_once('../config/setup.php');
	include_once('../functions/user.php');
	include_once('../functions/order.php');
	include_once('../functions/cart.php');
	include_once('../functions/product.php');
	
	$user=new User();
	if(!$user->isLoggedIn()){
		header("Location: login.php");
		exit;
	}if(!$user->isActivated()){
		header("Location: paymentStatus.php?status=email-not-active");
		exit;
	}if(!isset($_POST['payment-select'])){
		header("Location: cart.php");
		exit;
	}
	//var_dump('hello');
	
	
	$cart=new Cart();
	$order=new Order();
	$product=new Product();
	
	//COD is not available for membership Items
	if($cart->hasMembership($_SESSION['id'])&& $_POST['payment-select']=='2'){
		header("Location: paymentStatus.php?status=cod-not-available-membership");
		exit;
	}
	
	$delivery_status=$order->getDeliveryStatus($user->getLastOrderId());
	if(isset($_POST['membershipId'])){
		$membershipId=$_POST['membershipId'];
		$order_id=$order->generateIdForMembership($membershipId);
	}else if($cart->isEmpty()){
		header('Location: pricing.php');
		exit;
	}
	
	//var_dump($delivery_status);
	//var_dump($order_id);
	if(!is_null($delivery_status)&&$delivery_status=='delivered'&&$delivery_status=='canceled'){
		header('Location: paymentStatus.php?status=PL200');
		exit;
	}
	
	//Extract payment option
	if($_POST['payment-select']=='1'){
		$payment_option='None';
	}else if($_POST['payment-select']=='2'){
		$payment_option='COD';
	}else{
		header("Location: error.php");
	}
	
	$name=$user->getFullName();
	$address=$user->getAddress();
	$phone=$user->getPhone();
	$email=$user->getEmail();
	
	$address_line=$address['address_line'];
	$city=$address['city'];
	$pincode=$address['pincode'];
	
	if(!isset($_POST['membershipId'])){
		$order_id=$order->generateId();
		$orderList=$order->getOrder($order_id);
	}
	$amount=$order->getAmount($order_id);
	//var_dump($amount);
		
?>
<!DOCTYPE html>
<html>
	<head></head>
	<body>
			
	<?php include('../template/loading_payment.php');?>
		<?php
				
			if($amount==0 || $payment_option=='COD'){
				include('../template/zero_pay_form.php');
			}else{
				include("../template/pay_form.php");
			}
		?>
		<script language='javascript'>document.customerData.submit();</script>
		
	</body>
</html>