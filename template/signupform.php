<form class="omb_loginForm" autocomplete="off" method="POST"action="">
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-user"></i></span>
		<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" onkeyup = "Validate(this)">
		<div id="errFirst"></div> 
		<input type="text" class="form-control" id="lastname" name="lastname"  placeholder="Last Name" onkeyup = "Validate(this)">
		<div id="errlast"></div> 
	</div><span class="help-block"></span>
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
		<input type="text" class="form-control" id="email" name="email" placeholder="Email address" onchange="email_validate(this.value);">
	</div>
	<span class="help-block" id="email_error"></span>
						
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-lock"></i></span>										
		<input  type="password" class="form-control" id="password" name="password" maxlength="16" placeholder="Password">
		<input  type="password" class="form-control" id="confirm_password" maxlength="16"  name="confirm_password" placeholder="Confirm Password" onkeyup="checkPass();">
		
	</div>
	<div class="input-group">
		By Signing Up you are agreeing to out <a href="terms.php">Terms & conditions</a>.</label>
	</div>
	<div class="input-group">
		<span class="help-block">
			<?php 
				if(isset($msg)){  // Check if $msg is not empty
					echo $msg; // Display our message and wrap it with a div with the class "statusmsg".
				}
			?>
		</span>
	</div>
	
	<button id="register" class="btn btn-lg btn-primary btn-block" disabled type="submit">Sign Up</button>
</form>













