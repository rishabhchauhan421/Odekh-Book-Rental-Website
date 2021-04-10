<html>
<head>
<title> Processing|Odekh</title>
</head>
<body>
<center>

<?php 
	include('../template/loading_payment.php');
	include('../functions/ccav_Crypto.php');
	include('../config/ccavConfig.php');
?>
<?php 

	error_reporting(0);
	
	$ccav=new CcavConfig();
	$merchant_data=$ccav->merchant_data;
	$working_key=$ccav->working_key;//Shared by CCAVENUES
	$access_code=$ccav->access_code;//Shared by CCAVENUES
	
	foreach ($_POST as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>

</body>
</html>

