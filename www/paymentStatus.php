<?php
	$page_title="Payment";
	include('../template/header.php');
	
	echo '<div class="container">';
	//var_dump($order_status);
	if(isset($_GET['status'])){
		$order_status=$_GET['status'];
		if($order_status==="Success")
		{
			echo "<br>Thank you for shopping with us. Your transaction is successful.";
			
		}
		else if($order_status==="Aborted")
		{
			echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
		
		}
		else if($order_status==="Failure")
		{
			echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
		}
		else if($order_status==="PL200")
		{
			echo "<br>Dear Customer<br>Kindly wait till we deliver your previous order.";
		}
		else if($order_status==="email-not-active")
		{
			include('../template/activation_panel.html');
			echo "<br>Dear Customer<br>Kindly activate your email to place an order.";
			
		}else if($order_status==="cod-not-available-membership")
		{
			echo "<br>Dear Customer<br>You cannot place membership on Cash on Delivery order. Kindly remove membership from your cart or do online payment.<br><a href='cart.php'>Visit Cart here</a>";
		}
		
		else
		{
			echo "<br>Security Error. Illegal access detected";
		}
	}
	echo '</div>';

	include('../template/footer.php');
?>