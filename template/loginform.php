<form class="omb_loginForm" autocomplete="off" method="POST"action="login_database.php">
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-user"></i></span>
		<input type="text" class="form-control" name="email" placeholder="email address" onchange="email_validate(this.value)";>
	</div>
	<span class="help-block"  id="email_error"></span>
						
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-lock"></i></span>
		<input  type="password" class="form-control" name="password" placeholder="Password">
	</div>
	<span class="help-block" <?php echo $login_status;?>>Incorrect email or password</span>
	
	<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
</form>