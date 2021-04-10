
  <div id="wrap">
        <!-- start PHP code -->
        <?php
         
            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
				//Verify data
				$user = new user();
			
				$email = $user->db->real_escape_string($_GET['email']); // Set email variable
				$hash = $user->db->real_escape_string($_GET['hash']); // Set hash variable
				
				$user->activate($email,$hash)
				
			}else{
				// Invalid approach
			}
        ?>
        <!-- stop PHP Code -->
 
       