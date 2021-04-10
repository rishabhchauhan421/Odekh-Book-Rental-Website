<!DOCTYPE html><html><head></head><body>
<?php
	include_once('../functions/user.php');
	include_once('../functions/cart.php');
	include_once('../functions/order.php');
	include_once('../functions/email.php');
	
	if(isset($_POST['order_id'])){
		$order_id=$_POST['order_id'];
		//var_dump($order_id);
		$tracking_id=$_POST['tracking_id'];
		//var_dump($tracking_id);
		$bank_ref_no=$_POST['bank_ref_no'];
		//var_dump($bank_ref_no);
		$order_status=$_POST['order_status'];
		//var_dump($order_status);
		$failure_message=$_POST['failure_message'];
		$payment_mode=$_POST['payment_mode'];
		$card_name=$_POST['card_name'];
		$status_code=$_POST['status_code'];
		$status_message=$_POST['status_message'];
		$currency=$_POST['currency'];
		$amount=$_POST['amount'];
		$billing_name=$_POST['billing_name'];
		$billing_address=$_POST['billing_address'];
		$billing_city=$_POST['billing_city'];
		$billing_state=$_POST['billing_state'];
		$billing_zip=$_POST['billing_zip'];
		$billing_country=$_POST['billing_country'];
		$billing_tel=$_POST['billing_tel'];
		$billing_email=$_POST['billing_email'];
		$delivery_name=$_POST['delivery_name'];
		$delivery_address=$_POST['delivery_address'];
		$delivery_city=$_POST['delivery_city'];
		$delivery_state=$_POST['delivery_state'];
		$delivery_zip=$_POST['delivery_zip'];
		$delivery_country=$_POST['delivery_country'];
		$delivery_tel=$_POST['delivery_tel'];
		$merchant_param1=$_POST['merchant_param1'];
		$offer_type=$_POST['offer_type'];
		$offer_code=$_POST['offer_code'];
		$discount_value=$_POST['discount_value'];
		$mer_amount=$_POST['mer_amount'];
		if($order_status=='Success'){
			$delivery_status='processing';
		}else{
			$delivery_status='invalid';
		}
		//var_dump('value saved');
		$user=new User();
		$cart=new Cart();
		$order=new Order();
		
		//var_dump('object created');
		$user->setAddress($billing_address,$billing_city,$billing_zip,$billing_state);
		$user->setPhone($billing_tel);
		$order->setAddress($order_id,$delivery_address,$delivery_city,$delivery_zip,$delivery_state);
		$order->setPhone($order_id,$delivery_tel);
		
		$order->setTransactionStatus($order_id,$tracking_id,$bank_ref_no,$order_status,$delivery_status,$payment_mode,$offer_code,$discount_value,$mer_amount);
		
		if($order->isTransactionSuccessful($order_id)){
			$user->completeActions($order_id);
			$email=new Email();
			$email->sendOrderIdToAdmin($order_id);
		}
		
		header('Location: paymentStatus.php?status='.$order_status);
		exit;
		
	}
?>
</body></html>