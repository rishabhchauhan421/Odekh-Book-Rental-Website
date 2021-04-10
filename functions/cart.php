<?php

include_once('../functions/database.php');
include_once('../functions/ip_address.php');
include_once('../functions/guest.php');
include_once('../functions/product.php');
include_once('../functions/user.php');
include_once('../functions/coupon.php');


class Cart{
	private $table='cart';
	public $days='30';
	
	function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $database = new Database();
			$this->db=$database->getConnection();
        }
    }
	
	function addToCart($product_category,$product_id,$user_id){
		
		if($this->getTotalItems()==2){
			return -1;
		}
		
		$query="Select * from ".$this->table." where product_category='".$product_category."'AND user_id='".$user_id."' AND product_id='".$product_id."' ";
		$result=$this->db->query($query);
		//var_dump($result);
		$quantity=0;
		if($result->num_rows > 0){
			// Product Exits already
			$row = mysqli_fetch_array($result);
			$quantity = $row['quantity'];
			//var_dump($row);
		}
		$ip=new IP();
		$duration=$this->days;
		if($quantity==0){
			//TODO: Add to Cart
			$updateCartQuery="INSERT INTO ".$this->table."(product_id,ip_address,user_id,quantity,product_category,duration) VALUES('".$product_id."','".$ip->get_ip_address()."','".$user_id."','1','".$product_category."','".$duration."')";
			
		}else if($quantity>0){
			//TODO: Increment product count
			$updateCartQuery="UPDATE ".$this->table." SET quantity='".($quantity+1)."', ip_address='".$ip->get_ip_address()."' where product_id='".$product_id."', user_id='".$user_id."' and product_category='".$product_category."'";
		}
		//var_dump($updateCartQuery);
		$updatedResult=$this->db->query($updateCartQuery);
	}
	
	function getTotalItems(){
		if(isset($_SESSION['id'])){
			//TODO: get items of user from database
			$user = new User();
			return $user->getTotalItems();
		}else if(isset($_SESSION['cartData'])){
			$guest = new Guest();
			return $guest->getTotalItems();
		}else{
			return 0;
		}
	}
	
	function getAllProducts(){
		$user=new User();
		$product=new Product();
		$coupon=$this->getCouponCode();
		if($user->isLoggedIn()){
			$query="SELECT product_id,product_category,duration from cart where user_id='".$_SESSION['id']."'";
			//var_dump($query);
			$result=$this->db->query($query);
			$detailData=array();
			if($result->num_rows > 0){
				//var_dump($result->num_rows);
				while($row=$result->fetch_assoc()){
					$id = $row['product_id'];
					$category = $row['product_category'];
					$detail=$product->getProductDetails($id,$category);
					$rental_price=$product->getRentalPrice($id,$category,$row['duration'],$coupon);
					$price=$product->getPriceById($id,$category,$row['duration']);
					$tempArray=array(
									'duration'=>$row['duration'],
									'rental_price'=>$rental_price,
									'price'=>$price);
					$detail = array_merge($detail, $tempArray);
					//var_dump($detail);
					array_push($detailData,$detail);
				}
				//var_dump($detailData);
				return $detailData;
			}
		}else{
			return null;
		}
	}
	
	function getQuantity($productId,$productCategory, $user_id){
		$query="Select quantity from cart WHERE product_id='".$productId."' AND product_category='".$productCategory."' AND user_id='".$user_id."'";
		//var_dump($query);
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			$row = mysqli_fetch_array($result);
			$quantity = $row['quantity'];
			
		}
		return $quantity;
		
	}
	function deleteProduct($productId,$product_category,$user_id){
		$query="DELETE FROM ".$this->table." WHERE user_id='".$user_id."' AND product_category='".$product_category."' AND product_id='".$productId."'";
		var_dump($query);
		$this->db->query($query);
	}
	
	function showProducts(){
		$products=$this->getAllProducts();
		$coupon=$this->getCouponCode();

		if(empty($products)){
			echo "<h4>No Product Found!..<h4>";
		}else{
			//var_dump($products);
			foreach($products as $product){
				$productId=$product['id'];
				$productCategory=$product['product_category']; 
				$duration=$this->getDuration($productId,$productCategory,$_SESSION['id']);
				$price=$this->getPrice($productId,$productCategory,$duration,$coupon);
				$security=$this->getSecurity($productId,$productCategory,$duration,$coupon);
				$total=$this->getTotal($price,$security,$this->getQuantity($productId,$productCategory,$_SESSION['id']),$product['product_category']);
				$quantity=$this->getQuantity($productId,$productCategory,$_SESSION['id']);
				
				$user=new User();
				//var_dump($product);
				echo '
					<div class="row">
						<div class="col-xs-2"><img class="img-responsive" src="assets/images/'.$product["image"].'"></div>
						<div class="col-xs-5 col-sm-7">
							<h4 class="product-name"><strong>'.$product["title"].'</strong></h4><h4><small>Rental:₹'.$price.'<br>Security:₹'.$security.'</small></h4>
						</div>
						<div class="col-xs-5 col-sm-3">
							<div class="row">
								<div class="text-left">
									<h6 class="text-centre">Item Total: '.$total.'</h6>
								</div>
							</div>
							<div class="row">
								<div class="control-group">
									<div class="col-sm-10 control-label"  style="padding-left:0px">
										<select class="form-control input-sm duration" name="duration" productId="'.$productId.'" productCategory="'.$productCategory.'" id="duration-'.$productId.'" style="max-width:100px;">
											<option value="0" '.($duration==0 				 ? "selected" :"").'>0 Month(Delete)</option>
											<option value="1" '.($duration<31 				 ? "selected" :"").'>1 Month</option>
											<option value="2" '.($duration<61&&$duration>30  ? "selected" :"").'>2 Month</option>
											<option value="3" '.($duration<91&&$duration>60  ? "selected" :"").'>3 Months</option>
											<option value="6" '.($duration<181&&$duration>90 ? "selected" :"").'>6 Months</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<hr>';
			}
			echo '<div class="row">
					<div class="text-center">
						<div class="col-xs-9">
							<h6 class="text-right">Subtotal</h6>
						</div>
						<div class="col-xs-3">
							<h6>₹'.$this->getSubTotal().'</h6>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="text-center">
						<div class="col-xs-9">
							<h6 class="text-right">Shipping Charges</h6>
						</div>
						<div class="col-xs-3">
							<h6>₹'.$this->getDeliveryCharges().'</h6>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="text-center">
						<div class="col-xs-9">
							<h6 class="text-right">Wallet Amount to be used</h6>
						</div>
						<div class="col-xs-3">
							<h6">₹'.$this->getWalletAmountToBeUsed().'</h6>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="text-center">
						<div class="col-xs-9">
							<h4 class="text-right">Total Amount</h4>
						</div>
						<div class="col-xs-3">
							<h4">₹'.$this->getNetAmount().'</h4>
						</div>
					</div>
				</div>';
				
		}
	}
	
	function showProducts_old(){
		$products=$this->getAllProducts();
		$coupon=$this->getCouponCode();

		if(empty($products)){
			echo "<h4>No Product Found!..<h4>";
		}else{
			//var_dump($products);
			foreach($products as $product){
				$price=$this->getPrice($product['id'],$product['product_category'],$this->days,$coupon);
				$security=$this->getSecurity($product['id'],$product['product_category'],$coupon);
				$total=$this->getTotal($price,$security,$this->getQuantity($product['id'],$product['product_category'],$_SESSION['id']),$product['product_category']);
				$quantity=$this->getQuantity($product['id'],$product['product_category'],$_SESSION['id']);
				$productId=$product['id'];
				$productCategory=$product['product_category']; 
				$user=new User();
				//var_dump($product);
				echo '<tr>
						<td>
							<div class="btn-group">
								<a href="#" id="deleteButton"class="btn btn-danger" productCategory="'.$productCategory.'" productId="'.$productId.'" id="deleteButton-'.$productId.'"><span class="glyphicon glyphicon-trash"></span></a>
							</div>
						</td>
						<td id="cart_hidden_small_screen"><img src="assets/images/'.$product["image"].'" width="60px" height="60px"></td>
						<td class="product_name">'.$product["title"].'(1 Month Rental)</td>
						<td class="product_item"><input type="button" class="form-control price" value="'.$price.'" productId="'.$productId.'" id="price-'.$productId.'" disabled style="margin:auto"></td>
						<td class="product_item"><input type="button" class="form-control security" value="'.$security.'" productId="'.$productId.'" id="security-'.$productId.'" disabled style="margin:auto"></td>
						<!--<td class="product_item">
							<div class="form-group">
								<select class="form-control quantity" name="quantity" productId="'.$productId.'" productCategory="'.$productCategory.'" id="quantity-'.$productId.'">
									<option value="0" '.($quantity==0 ? "selected" :"").'>0</option>
									<option value="1" '.($quantity==1 ? "selected" :"").'>1</option>
								</select>
							</div>
						</td>-->
						<td class="product_item"><input type="button" productId="'.$productId.'" productCategory="'.$productCategory.'" id="totalprice-'.$productId.'" class="form-control totalprice" style="margin:auto" value="'.$total.'" disabled></td>
					</tr>';
			}
			echo '<tr>
                        <td>   </td>
                        <td id="cart_hidden_small_screen">   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>₹'.$this->getSubTotal().'</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td id="cart_hidden_small_screen">   </td>
                        <td>   </td>
						<td>   </td>
                        <td><h5>Shipping Charges</h5></td>
                        <td class="text-right"><h5><strong>₹'.$this->getDeliveryCharges().'</strong></h5></td>
                    </tr>
					<tr>
                        <td>   </td>
                        <td id="cart_hidden_small_screen">   </td>
                        <td>   </td>
						<td>   </td>
                        <td><h5>Wallet Amount to be used</h5></td>
                        <td class="text-right"><h5><strong>₹'.$this->getWalletAmountToBeUsed().'</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td id="cart_hidden_small_screen">   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong>₹'.$this->getNetAmount().'</strong></h3></td>
                    </tr>';
		}
	}
	
	function isCartEmpty($user_id){
		$quantity=$this->getTotalItems();
		if($quantity>0){
			return false;
		}else{
			return true;
		}
	}
	
	function updateCart($productId,$product_category,$quantity,$id){
		$query="UPDATE ".$this->table." SET quantity='".$quantity."' WHERE user_id='".$id."',product_category='".$product_category."' AND product_id='".$productId."'";
		$this->db->query($query);
		
	}
	function getTotal($price,$security,$quantity,$product_category){
		$product=new Product();
		
		if($product_category==$product->product_category_membership){
			return ($price+$security);
		}
		else if($product_category=$product->product_category_book){
				return (($price+$security)*$quantity);
		}
	}
	
	function getSubTotal(){
		$products=$this->getAllProducts();
		$coupon=$this->getCouponCode();
		$totalAmount=0;
		foreach($products as $product){
			$duration=$this->getDuration($product['id'],$product['product_category'],$_SESSION['id']);
			$price=$this->getPrice($product['id'],$product['product_category'],$duration,$coupon);
			$security=$this->getSecurity($product['id'],$product['product_category'],$duration,$coupon);
			$amount=$this->getTotal($price,$security,$this->getQuantity($product['id'],$product['product_category'],$_SESSION['id']),$product['product_category']);
			$totalAmount=$totalAmount+$amount;
		}
		return $totalAmount;
	}
	
	function getTotalSecurity(){
		$products=$this->getAllProducts();
		$coupon=$this->getCouponCode();
		$totalSecurity=0;
		foreach($products as $product){
			$duration=$this->getDuration($product['id'],$product['product_category'],$_SESSION['id']);
			$security=$this->getSecurity($product['id'],$product['product_category'],$duration,$coupon);
			$totalSecurity=$totalSecurity+$security;
		}
		return $totalSecurity;
	}
	
	function deleteAllProducts($user_id){
		$query="DELETE FROM cart where user_id='".$user_id."'";
		$this->db->query($query);
	}
	
	function getPrice($productId,$product_category,$days,$coupon){
		$product=new Product();
		return $product->getRentalPrice($productId,$product_category,$days,$coupon);
	}
	
	function getSecurity($productId,$product_category,$duration,$coupon){
		$product=new Product();
		return $product->getSecurity($productId,$product_category,$duration,$coupon);
	}
	
	function getDeliveryCharges(){
		$user=new User();
		if($user->isLoggedIn()){
			if($user->isPremiumMember()){
				return '0';
			}else if($this->hasProducts($_SESSION['id'])){
				return $user->delivery_charges;
			}else{
				return 0;
			}
		}
	}
	
	function getNetAmount(){
		$user=new User();
		return (($this->getSubTotal())+($this->getDeliveryCharges())-($this->getWalletAmountToBeUsed()));
	}
	
	function isEmpty(){
		$query="SELECT id FROM cart where user_id='".$_SESSION['id']."'";
		//var_dump($query);
		$result=$this->db->query($query);
		if($result->num_rows > 0){
				return false;
		}
		return true;
	}
	function getWalletAmountToBeUsed(){
		$user=new User();
		$walletBalance=(new User())->getWalletBalance();
		if(($this->getTotalSecurity())>$walletBalance){
			return $walletBalance;
		}else{
			return $this->getTotalSecurity();
		}
	}
	function hasMembership($user_id){
		$product=new Product();
		$query="SELECT id FROM cart where user_id='".$user_id."' AND product_category='".$product->product_category_membership."'";
		$result=$this->db->query($query);
		if($result->num_rows > 0){
				return true;
		}
		return false;
	}
	function hasProducts($user_id){
		$query="SELECT id FROM cart where user_id='".$user_id."' AND product_category='".(new Product())->product_category_book."'";
		$result=$this->db->query($query);
		if($result->num_rows > 0){
				return true;
		}
		return false;
	}
	function getDuration($productId,$product_category,$user_id){
		$query="Select duration from cart WHERE product_id='".$productId."' AND product_category='".$product_category."' AND user_id='".$user_id."'";
		//var_dump($query);
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			$row = mysqli_fetch_array($result);
			$duration = $row['duration'];
		}
		return $duration;
	}
	function setDuration($productId,$productCategory,$duration,$user_id){
		$duration=30*$duration;
		if($duration>0){
			$query="UPDATE cart SET duration = $duration WHERE product_id='".$productId."' AND product_category='".$productCategory."' AND user_id='".$user_id."'";
			$result=$this->db->query($query);
		}else{
			$this->deleteProduct($productId,$productCategory,$user_id);
		}
	}
	function getCouponCode(){
		$coupon=new Coupon();
		return $coupon->getCoupon();
	}
}

?>