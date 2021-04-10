<?php

include_once('../functions/email.php');
include_once('../config/setup.php');
include_once('../functions/database.php');
include_once('../functions/cart.php');
include_once('../functions/order.php');
include_once('../functions/membership.php');

class User {
    private $userTbl    = 'users';
	public $delivery_charges = '30';
    
    function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $database = new Database();
			$this->db=$database->getConnection();
        }
    }
    
    function checkUser($userData = array()){
        if(!empty($userData)){
            //Merge with email login
			$MergeQuery = "SELECT * FROM ".$this->userTbl." WHERE email = '".$userData['email']."'";
			$MergeResult = $this->db->query($MergeQuery);
            if($MergeResult->num_rows > 0){
                // User exists
				$query = "UPDATE ".$this->userTbl." SET first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', active='1', link = '".$userData['link']."', modified = '".date("Y-m-d H:i:s")."', oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."' WHERE email = '".$userData['email']."'";
                //var_dump($query);
				$update = $this->db->query($query);
			}else{
                // Insert user data
				$this->addUserOauth($userData,$default_password);
            }
			
			//Set id in Session
			$idQuery= "SELECT * from ".$this->userTbl." WHERE oauth_provider = '".$userData['oauth_provider']."' and oauth_uid = '".$userData['oauth_uid']."'";
            //var_dump($idQuery);
			$result = $this->db->query($idQuery);
			if($result->num_rows > 0){
				// Get user data if already exists
				$row = mysqli_fetch_array($result);
				$_SESSION['id']=$row['id'];
				$_SESSION['firstname']=$row['first_name'];
			}
			//var_dump($_SESSION['firstname']);
        }
        
        return $userData;
    }
	
	function setName($name){
		$query="update ".$this->userTbl." SET name='".$name."' WHERE id='".$_SESSION['id']."'";
		$this->db->query($query);
	}
	
	function getFullName(){
		$query="Select first_name,last_name from ".$this->userTbl." WHERE id='".$_SESSION['id']."'";
		$result=$this->db->query($query);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		return $row['first_name'].' '.$row['last_name'];
	}
	
	function setSession($id){
		$query= "SELECT * from ".$this->userTbl." WHERE id = '".$id."'";
		$result = $this->db->query($query);
		if($result->num_rows > 0){
			// Get user data if already exists
			$row = mysqli_fetch_array($result);
			$_SESSION['id']=$id;
			$_SESSION['firstname']=$row['first_name'];
		}
	}
	
	function login($email,$password){
		$query = "SELECT * FROM ".$this->userTbl." WHERE email = '".$email."' and password = '".md5($password)."'";
		$result = $this->db->query($query);
		//var_dump($query);
		if($result->num_rows > 0){
			// Log In
			$row = mysqli_fetch_array($result);
			$id = $row['id'];
			$_SESSION['id']=$id;
			$_SESSION['firstname']=$row['first_name'];
			return true;
		}
		return false;
	}
	
	function addUser($firstname,$lastname,$email,$password){
		if(!empty($email)){
			if($this->emailExists($email)){
				return 0;
			}
			$hash = md5( rand(0,1000) );
			$date_created = date_create()->format('Y-m-d H:i:s');
			$query = "INSERT INTO ".$this->userTbl."(first_name,last_name,email,password,hash,created,modified,oauth_provider,oauth_uid) VALUES('".$firstname."','".$lastname."','".$email."','".md5($password)."','".$hash."','".$date_created."','".$date_created."','','".$hash."')";
			$result = $this->db->query($query);
			
			$this->login($firstname,$password);
			
			$emailObj = new Email();
			$emailObj->activateUser($firstname.' '.$lastname,$email,$hash);
		}
	}
	
	function sendActivationMail($id){
		$query="Select * from ".$this->userTbl." where id='".$id."'";
		$result = $this->db->query($query);
		
		if($result->num_rows > 0){
			// Log In
			$row = mysqli_fetch_assoc($result);
			$email = new Email();
			$email->activateUser($row['first_name'].' '.$row['last_name'],$row['email'],$row['hash']);
		}
	}
	
	function addUserOauth($userData, $default_password){
		$hash = md5( rand(0,1000) );
		$query = "INSERT INTO ".$this->userTbl." SET oauth_provider = '".$userData['oauth_provider']."', oauth_uid = '".$userData['oauth_uid']."', first_name = '".$userData['first_name']."', last_name = '".$userData['last_name']."', email = '".$userData['email']."', gender = '".$userData['gender']."', locale = '".$userData['locale']."', picture = '".$userData['picture']."', link = '".$userData['link']."', created = '".date("Y-m-d H:i:s")."', modified = '".date("Y-m-d H:i:s")."', active='1', password='".$default_password."', hash='".$hash."'";
		$result = $this->db->query($query);
		
		
		$this->login($firstname,$lastname);
	}
	
	function emailExists($email){
		$query = "SELECT * FROM ".$this->userTbl." WHERE email='".$email."'";
		$result = $this->db->query($query);
		$match  = mysqli_num_rows($result);
		if($match > 0){
			return true;
		}
		return false;
	}
	
	function activate($email, $hash){
		$query="SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
		$result=$this->db->query($query) or die(mysql_error()); 
		$match  = mysqli_num_rows($result);
		if($match > 0){
			// We have a match, activate the account
			$activation="UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
			$this->db->query($activation) or die(mysqli_error());
			echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
		}
	}
	
	function addToCart($productId){
		$cart=new Cart();
		$cart->addToCart($productId, $_SESSION['id']);
		
	}
	
	function getTotalItems(){
		$query="Select * from cart where user_id='".$_SESSION['id']."'";
		
		$quantity=0;
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			// Get user data if already exists
			while($row = $result->fetch_assoc())
				$quantity=$quantity+$row['quantity'];
		}
		return $quantity;
	}
	function isCartEmpty(){
		if(isset($_SESSION['id'])){
			$cart=new Cart();
			return $cart->isCartEmpty($_SESSION['id']);
		}else{
			return true;
		}
	}
	
	function isLoggedIn(){
		if(isset($_SESSION['id'])){
			return true;
		}
		return false;
	}
	
	function setAddress($address_line,$city,$pincode,$state){
			$pincode=preg_replace( '/[^0-9]/', '', $pincode );
			if(strlen($pincode)>6){
				$pincode=0000000;
			}
			$query="UPDATE ".$this->userTbl." SET address_line='".$address_line."',city='".$city."', pincode='".$pincode."',state='".$state."' WHERE id='".$_SESSION['id']."'";
			//var_dump($query);
			$this->db->query($query);
			return 1;
	}
	
	function getAddress(){
		if($this->isLoggedIn()){
			$query = "SELECT id,address_line,city,pincode,state,phone_no FROM ".$this->userTbl." WHERE id='".$_SESSION['id']."'";
			$result = $this->db->query($query);
			if($result->num_rows > 0){
				// Log In
				$row = mysqli_fetch_array($result);
				$address = array(
					'id'		  	=> $row['id'],
					'address_line'  => $row['address_line'],
					'city'   		=> $row['city'],
					'state'   		=> $row['state'],
					'pincode' 		=> $row['pincode'],
					'phone'			=> $row['phone_no']);
				return $address;
			}
		}
		return 0;
	}
	
	function addressExists(){
		$query = "SELECT * FROM ".$this->userTbl." WHERE id='".$_SESSION['id']."' AND city IS NOT NULL";
		//var_dump($query);
		$result = $this->db->query($query);
		if($result->num_rows>0){
			return true;
		}else{
			return false;
		}	
	}
	
	function getEmail(){
		$query="SELECT email FROM ".$this->userTbl." WHERE id='".$_SESSION['id']."'";
		$result = $this->db->query($query);
		if($result->num_rows>0){
			$row = mysqli_fetch_array($result);
			return $row['email'];
		}
	}
	
	function getphone(){
		$query="SELECT phone_no FROM ".$this->userTbl." WHERE id='".$_SESSION['id']."'";
		$result = $this->db->query($query);
		if($result->num_rows>0){
			$row = $result->fetch_array(MYSQLI_ASSOC);
			return $row['phone_no'];
		}
	}
	
	function setPhone($phone_no){
			$query="UPDATE ".$this->userTbl." SET phone_no='".$phone_no."' WHERE id='".$_SESSION['id']."'";
			//var_dump($query);
			$this->db->query($query);
			return 1;
	}
	
	function getUserId(){
		return $_SESSION['id'];
	}
	
	function getOrders(){
		$order= new Order();
		return $order->getMyOrders();
	}
	
	function isActivated(){
		$query="SELECT id FROM ".$this->userTbl." where id='".$_SESSION['id']."' and active = '1'";
		$result=$this->db->query($query);
		if($result->num_rows>0){
			return true;
		}
		return false;
	}
	
	function isPremiumMember(){
		if($this->isLoggedIn()){
			$query="SELECT plan,plan_expiry_date FROM ".$this->userTbl." where id='".$_SESSION['id']."' and active='1'";
			$result=$this->db->query($query);
			if($result->num_rows>0){
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$plan_expiry_date=new DateTime($row['plan_expiry_date']);
				
				$date = new DateTime(date("Y-m-d H:i:s"));
				
				$interval = $plan_expiry_date->diff($date);
				if($interval->format('%R%a')<0){
					return true;
				} 
			}
			return false;
		}
		return false;
	}
	
	function completeActions($order_id){
		$product=new Product();
		$cart=new Cart();
		$order=new Order();
		//var_dump($order->getWalletAmount($order_id));
		if($order->hasMembership($order_id)){
			$membership_id=$order->getMembershipId($order_id);
			$duration=$order->getDuration($order_id,$membership_id,$product->product_category_membership);
			$this->updateMembership($membership_id,$duration);
		}if($order->hasBooks($order_id)){
			$books=$order->getAllBooks($order_id);
			//var_dump($books);
			foreach($books as $book){
				$product->reduceAvailableStock($book['id'],'1');
			}
		}
		if($order->getWalletAmount($order_id)>0){
			$this->removeWalletBalance($order->getWalletAmount($order_id));
		}
		$cart->deleteAllProducts($this->getUserId());
		
		
	}
	
	function updateMembership($membership_id,$duration){
		if($this->isPremiumMember()){
			$query="SELECT plan_expiry_date,id FROM ".$this->userTbl." where id='".$_SESSION['id']."'";
			$result=$this->db->query($query);
			if($result->num_rows>0){
				$row = $result->fetch_array(MYSQLI_ASSOC);
				
				$id=$row['id'];
				$date=new DateTime($row['plan_expiry_date']);
			}
		}else{				
			$date=new DateTime(date("Y-m-d H:i:s"));
		}
			$date->modify("+$duration day");
			
			$query="update ".$this->userTbl." SET plan_expiry_date='".$date->format('Y-m-d H:i:s')."' WHERE id='".$_SESSION['id']."'";
			//var_dump($query);
			$this->db->query($query);
			
			$membership=new Membership();
			$this->addWalletBalance($membership->getSecurityById($membership_id));
	}
	
	function getLastOrderId(){
		$query="Select MAX(id) AS max_id from orders where user_id='".$_SESSION['id']."'";
		$result=$this->db->query($query);
		if($result->num_rows>0){
			$row = $result->fetch_array(MYSQLI_ASSOC);
			return $row['max_id'];
		}
	}
	
	function returnProduct($order_item){
		if($this->isLoggedIn()){
			$order=new Order();
			$order->returnProduct($order_item);
		}
	}
	function getDeliveredOrders(){
		if($this->isLoggedIn()){
			return (new Order())->getDeliveredOrders();
		}
	}
	function getWalletBalance(){
		$query="Select wallet_balance from users where id='".$_SESSION['id']."'";
		//var_dump($query);
		$result=$this->db->query($query);
		if($result->num_rows>0){
			$row = $result->fetch_array(MYSQLI_ASSOC);
			return $row['wallet_balance'];
		}
	}
	function addWalletBalance($amount){
		$wallet_amount=$this->getWalletBalance()+$amount;
		$query="update ".$this->userTbl." SET wallet_balance='".$wallet_amount."' WHERE id='".$_SESSION['id']."'";
		//var_dump($query);
		$this->db->query($query);
	}
	function removeWalletBalance($amount){
		$wallet_amount=$this->getWalletBalance()-$amount;
		$query="update ".$this->userTbl." SET wallet_balance='".$wallet_amount."' WHERE id='".$_SESSION['id']."'";
		//var_dump($query);
		$this->db->query($query);
	}
	
}
?>