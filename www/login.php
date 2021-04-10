<?php 
	
	$login_status='style="visibility: hidden"'; 
	
	
	$page_title='Login';
	include_once('../config/setup.php');
	if(isset($_SESSION['id'])){	
		header('Location: myaccount.php');
		exit;
	}
	include('../template/header.php');
	include('../functions/fblogin.php');
	include('../functions/googlelogin.php');
	
	
	
	if(isset($_GET['error'])){
		if($_GET['error']=='login'||$_GET['error']=='email'){
			$login_status='style="visibility: visible"'; 
	
		}
	}
?>
<div class="container">
	<div class="omb_login">
		<h3 class="omb_authTitle">Login or <a href="signup.php">Sign up</a></h3>
		<div class="row omb_row-sm-offset-3 omb_socialButtons">
			<div class="col-xs-6  col-sm-3">
				<a href="<?php echo $fb_loginURL;?>" class="btn btn-lg btn-block omb_btn-facebook btn-primary">
					<i class="fa fa-facebook visible-xs"></i>
					<span class="hidden-xs">Login with Facebook</span>
				</a>
			</div>
			<!--
			<div class="col-xs-4 col-sm-2">
				<a href="login-with.php?provider=Twitter" class="btn btn-lg btn-block omb_btn-twitter btn-info">
					<i class="fa fa-twitter visible-xs"></i>
					<span class="hidden-xs">Twitter</span>
				</a>
			</div>	
			-->
			<div class="col-xs-6 col-sm-3">
				<a href="<?php echo $googleLoginURL;?>" class="btn btn-lg btn-block omb_btn-google btn-primary">
					<i class="fa fa-google visible-xs"></i>
					<span class="hidden-xs">Login with Google</span>
				</a>
			</div>
										
		</div>

		<div class="row omb_row-sm-offset-3 omb_loginOr">
			<div class="col-xs-12 col-sm-6">
				<hr class="omb_hrOr">
				<span class="omb_spanOr">or</span>
			</div>
		</div>
		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">
				<?php include ('../template/loginform.php'); ?>
			</div>
		</div>
		<!--<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-3">
				<label class="checkbox">
					<input type="checkbox" value="remember-me">Remember Me
				</label>
			</div>
			<div class="col-xs-12 col-sm-3">
				<p class="omb_forgotPwd">
					<a href="#">Forgot password?</a>
				</p>
			</div>
		</div>
		-->
	</div>
</div>
<br>
<!--Footer-->
	<?php include('../template/footer.php');?>
<!--Footer Ends-->
            














