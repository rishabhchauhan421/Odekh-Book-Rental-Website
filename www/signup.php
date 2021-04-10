<?php 

$page_title='Login';
include('../template/header.php');
if(isset($_SESSION['id'])){	
	header('Location: index.php');
}
include('../functions/fblogin.php');
include('../functions/googlelogin.php');
include('../functions/inputvalidation.php');
	
?>

<?php require_once '../functions/user.php';
	
    if(isset($_POST['firstname']) && !empty($_POST['firstname']) AND isset($_POST['lastname']) && !empty($_POST['lastname']) AND isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['password']) && !empty($_POST['password'])){
        // Form Submited
		$user= new User();
		
		$validate = new Validate();
		
		$firstname = $validate->test_input($user->db->real_escape_string($_POST['firstname'])); // Turn our post into a local variable
		$lastname = $validate->test_input($user->db->real_escape_string($_POST['lastname'])); // Turn our post into a local variable
		$password = $validate->test_input($user->db->real_escape_string($_POST['password'])); // Turn our post into a local variable
		$email = $validate->test_input($user->db->real_escape_string($_POST['email'])); // Turn our post into a local variable
		
		$pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
            
		if(!preg_match($pattern, $email)){
			// Return Error - Invalid Email
			$msg = 'The email you have entered is invalid, please try again.';
		}else{
			// Return Success - Valid Email
			$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
			$user->addUser($firstname,$lastname,$email,$password);
		}
             
	}

		
?>
<div class="container">
	

	<div class="omb_login">
		<h3 class="omb_authTitle"><a href="login.php">Login</a> or Sign up</h3>
		<div class="row omb_row-sm-offset-3 omb_socialButtons">
			<div class="col-xs-6  col-sm-3">
				<a href="<?php echo $fb_loginURL;?>" class="btn btn-lg btn-block omb_btn-facebook btn-primary">
					<i class="fa fa-facebook visible-xs"></i>
					<span class="hidden-xs">Signup with Facebook</span>
				</a>
			</div>
			<!--
			<div class="col-xs-6">
				<a href="login-with.php?provider=Twitter" class="btn btn-lg btn-block omb_btn-twitter btn-info">
					<i class="fa fa-twitter visible-xs"></i>
					<span class="hidden-xs">Twitter</span>
				</a>
			</div>	
			-->
			<div class="col-xs-6 col-sm-3">
				<a href="<?php echo $googleLoginURL;?>" class="btn btn-lg btn-block omb_btn-google btn-primary">
					<i class="fa fa-google visible-xs"></i>
					<span class="hidden-xs">Signup with Google</span>
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
				
				<?php include('../template/signupform.php'); ?>

			</div>
		</div>
					
	</div>
</div>

<!--Footer-->
	<?php include('../template/footer.php');?>
<!--Footer Ends-->