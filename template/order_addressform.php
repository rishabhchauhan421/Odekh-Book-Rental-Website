<?php

	include_once('../functions/user.php');
	$user=new User();
	$address=$user->getAddress();
	
?>
<form autocomplete="off" method="POST" action="<?php echo htmlspecialchars("setaddress.php")?>">
	<div class="input-group" >
		<label for="addressLine">Address Line:</label>
		<input type="text" required class="form-control" name="addressLine" id="address_line" placeholder="Address Line" value="<?php if(isset($address)){echo $address['address_line'];}?>">
	</div>
	<span class="help-block"></span>
	<div class="input-group" >
		<label for="pincode">Pincode:</label>
		<input type="number" required class="form-control" maxlength="6" name="pincode" id="pincode" placeholder="pincode" value="<?php if(isset($address)){echo $address['pincode'];}?>">
	</div>					
	<span class="help-block"></span>
	<div class="input-group" >
		<label for="city">City:</label>
		<input type="text" required class="form-control" name="city" id="city" placeholder="city" value="<?php if(isset($address)){echo $address['city'];}?>">
	</div>	
	<span class="help-block"></span>
	<div class="input-group" >
		<label for="state">State:</label>
		<input type="text" required class="form-control" name="state" id="state" placeholder="city" value="<?php if(isset($address)){echo $address['state'];}?>">
	</div>		

	<span class="help-block"></span>
	<button class="btn btn-lg btn-primary" style="" id="setAddress" type="submit">Set Address</button>
</form>