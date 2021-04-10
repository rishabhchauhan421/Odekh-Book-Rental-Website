<script>
	window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>

<form method="post" id="customerData" name="customerData" action="orderredirect.php">
	<input type="hidden" name="tid" id="tid" readonly />
	<input type="hidden" name="merchant_id" value="137135"/>
	<input type="hidden" name="order_id" value="<?php echo $order_id;?>"/>
	<input type="hidden" name="tracking_id" value="0"/>
	<input type="hidden" name="bank_ref_no" value=""/>
	<input type="hidden" name="order_status" value="Success"/>
	<input type="hidden" name="failure_message" value=""/>
	<input type="hidden" name="payment_mode" value="<?php echo $payment_option;?>"/>
	<input type="hidden" name="card_name" value="<?php echo $name;?>"/>
	<input type="hidden" name="status_code" value=""/>
	<input type="hidden" name="status_message" value="success"/>
	<input type="hidden" name="amount" value="<?php echo $amount; ?>"/>
	<input type="hidden" name="currency" value="INR"/>
	<input type="hidden" name="language" value="EN"/>
	<input type="hidden" name="billing_name" value="<?php echo $name;?>"/>
	<input type="hidden" name="billing_address" value="<?php echo $address['address_line']; ?>"/>
	<input type="hidden" name="billing_city" value="<?php echo $address['city']; ?>"/>
	<input type="hidden" name="billing_state" value="<?php echo $address['state']; ?>"/>
	<input type="hidden" name="billing_zip" value="<?php echo $address['pincode']; ?>"/>
	<input type="hidden" name="billing_country" value="India"/>
	<input type="hidden" name="billing_tel" value="<?php if($phone!=null){echo $phone;} ?>"/>
	<input type="hidden" name="billing_email" value="<?php echo $email; ?>"/>
	<input type="hidden" name="delivery_name" value="<?php echo $name;?>"/>
	<input type="hidden" name="delivery_address" value="<?php echo $address['address_line'];?>"/>
	<input type="hidden" name="delivery_city" value="<?php echo $address['city'];?>"/>
	<input type="hidden" name="delivery_state" value="<?php echo $address['state'];?>"/>
	<input type="hidden" name="delivery_zip" value="<?php echo $address['pincode'];?>"/>
	<input type="hidden" name="delivery_country" value="India"/>
	<input type="hidden" name="delivery_tel" value="<?php if($phone!=null){echo $phone;} ?>"/>
	<input type="hidden" name="merchant_param1" value="additional Info."/>
	<input type="hidden" name="promo_code" value=""/>
	<input type="hidden" name="offer_type" value=""/>
	<input type="hidden" name="offer_code" value=""/>
	<input type="hidden" name="discount_value" value="0"/>
	<input type="hidden" name="mer_amount" value="<?php echo $amount; ?>"/>
	<input type="hidden" name="customer_identifier" value="<?php echo $_SESSION['id'];?>"/>
		
	<INPUT TYPE="submit" style="visibility: hidden;" value="CheckOut">
	
	
	<?php /*		
		<table width="40%" height="100" border='1' align="center"><caption><font size="4" color="blue"><b></b></font></caption></table>
			<table width="40%" height="100" border='1' align="center">
				<tr>
					<td>Parameter Name:</td><td>Parameter Value:</td>
				</tr>
				<tr>
					<td colspan="2"> Compulsory information</td>
				</tr>
				
				<tr>
					<td>TID	:</td><td><input type="text" name="tid" id="tid" readonly /></td>
				</tr>
				<tr>
					<td>Merchant Id	:</td><td><input type="text" name="merchant_id" value="137135"/>137135</td>
				</tr>
				<tr>
					<td>Order Id	:</td><td><input type="text" name="order_id" value="<?php echo $order_id;?>"/><?php echo $order_id;?></td>
				</tr>
				<tr>
					<td>Amount	:</td><td><input type="text" name="amount" value="<?php echo $amount; ?>"/><?php echo $amount; ?></td>
				</tr>
				<tr>
					<td>Currency	:</td><td><input type="text" name="currency" value="INR"/></td>
				</tr>
				<tr>
					<td>Redirect URL	:</td><td><input type="text" name="redirect_url" value="http://odekh.com/ccavResponseHandler.php"/></td>
				</tr>
			 	<tr>
			 		<td>Cancel URL	:</td><td><input type="text" name="cancel_url" value="http://odekh.com/ccavResponseHandler.php"/></td>
			 	</tr>
			 	<tr>
					<td>Language	:</td><td><input type="text" name="language" value="EN"/></td>
				</tr>
		     	<tr>
		     		<td colspan="2">Billing information(optional):</td>
		     	</tr>
		        <tr>
		        	<td>Billing Name	:</td><td><input type="text" name="billing_name" value="<?php echo $name;?>"/><?php echo $name;?></td>
		        </tr>
		        <tr>
		        	<td>Billing Address	:</td><td><input type="text" name="billing_address" value="<?php echo $address['address_line'];?>"/></td>
		        </tr>
		        <tr>
		        	<td>Billing City	:</td><td><input type="text" name="billing_city" value="<?php echo $address['city'];?>"/></td>
		        </tr>
		        <tr>
		        	<td>Billing State	:</td><td><input type="text" name="billing_state" value="<?php echo $address['state'];?>"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Zip	:</td><td><input type="text" name="billing_zip" value="<?php echo $address['pincode'];?>"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Country	:</td><td><input type="text" name="billing_country" value="India"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Tel	:</td><td><input type="text" name="billing_tel" value="<?php if($phone!=null){echo $phone;} ?>"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Email	:</td><td><input type="text" name="billing_email" value="<?php echo $email; ?>"/></td>
		        </tr>
		        <tr>
		        	<td colspan="2">Shipping information(optional)</td>
		        </tr>
		        <tr>
		        	<td>Shipping Name	:</td><td><input type="text" name="delivery_name" value="<?php echo $name;?>"/></td>
		        </tr>
		        <tr>
		        	<td>Shipping Address	:</td><td><input type="text" name="delivery_address" value="<?php echo $address['address_line'];?>"/></td>
		        </tr>
		        <tr>
		        	<td>shipping City	:</td><td><input type="text" name="delivery_city" value="<?php echo $address['city'];?>"/></td>
		        </tr>
		        <tr>
		        	<td>shipping State	:</td><td><input type="text" name="delivery_state" value="<?php echo $address['state'];?>"/></td>
		        </tr>
		        <tr>
		        	<td>shipping Zip	:</td><td><input type="text" name="delivery_zip" value="<?php echo $address['pincode'];?>"/></td>
		        </tr>
		        <tr>
		        	<td>shipping Country	:</td><td><input type="text" name="delivery_country" value="India"/></td>
		        </tr>
		        <tr>
		        	<td>Shipping Tel	:</td><td><input type="text" name="delivery_tel" value="<?php if($phone!=null){echo $phone;} ?>"/></td>
		        </tr>
		        <tr>
		        	<td>Merchant Param1	:</td><td><input type="text" name="merchant_param1" value="additional Info."/></td>
		        </tr>
				<tr>
					<td>Promo Code	:</td><td><input type="text" name="promo_code" value=""/></td>
				</tr>
				<tr>
					<td>Vault Info.	:</td><td><input type="text" name="customer_identifier" value="<?php echo $_SESSION['id'];?>"/></td>
				</tr>
		        <tr>
		        	<td></td><td><INPUT TYPE="submit" value="CheckOut"></td>
		        </tr>
	      	</table>
			
			*/?>
			
</form>


