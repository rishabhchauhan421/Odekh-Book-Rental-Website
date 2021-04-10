<?php 
	include('../functions/ccav_Crypto.php');
	include('../config/ccavConfig.php');
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
<?php include('../template/loading_payment.php');?>

<?php
	error_reporting(0);
	
	$ccav=new CcavConfig();
	
	$workingKey=$ccav->working_key;		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}
	
	if($order_status==="Success")
	{
		//echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
		
	}
	else if($order_status==="Aborted")
	{
		//echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
	
	}
	else if($order_status==="Failure")
	{
		//echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
	}
	else
	{
		//echo "<br>Security Error. Illegal access detected";
	
	}

	echo "<br><br>";
	echo "<form id='redirect' name='redirect' action='orderredirect.php' method='POST'>";
	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
	    	echo '<input type="hidden" name="'.$information[0].'" value="'.$information[1].'"</input>';
	}
	echo "<input type='submit' style='visibility: hidden;'></input>";
	echo '</form>'
	
?>
<script language='javascript'>document.redirect.submit();</script>
</body>