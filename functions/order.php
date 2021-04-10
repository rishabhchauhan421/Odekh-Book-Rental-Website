<?php 

include_once('../functions/user.php');
require_once('../functions/database.php');
require_once('../functions/cart.php');
require_once('../functions/membership.php');

class Order{
	function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $database = new Database();
			$this->db=$database->getConnection();
        }
    }
	
	function setAddress($order_id,$address_line,$city,$pincode,$state){
		$query="UPDATE orders SET address_line='".$address_line."',city='".$city."', pincode='".$pincode."',state='".$state."' WHERE id='".$order_id."'";
		$result=$this->db->query($query);
	}
	
	function generateId(){
		$cart=new Cart();
		$user=new User();
		
		$totalItems=$cart->getTotalItems();
		$products=$cart->getAllProducts();
		//var_dump($products);
		$user_id=$_SESSION['id'];
		$address=$user->getAddress();
		$amount=$cart->getNetAmount();
		$wallet_amount=$cart->getWalletAmountToBeUsed();
		
		$query="INSERT INTO orders(user_id,quantity,tracking_id,status,date,address_line,city,pincode,amount,total_amount,wallet_amount) VALUES('".$user_id."','".$totalItems."',NULL,'pending','".date("Y-m-d H:i:s")."','".$address['address_line']."','".$address['city']."','".$address['pincode']."','".$amount."','".$amount."','".$wallet_amount."')";
		//var_dump($query);
		$this->db->query($query);
		$order_id=mysqli_insert_id($this->db);
		
		
		foreach($products as $product){
			$quantity=$cart->getQuantity($product['id'],$product['product_category'],$_SESSION['id']);
			$duration=$cart->getDuration($product['id'],$product['product_category'],$_SESSION['id']);
			$security=$cart->getSecurity($product['id'],$product['product_category'],$duration);
			$price=$cart->getPrice($product['id'],$product['product_category'],$duration);
			$query="INSERT into order_item(order_id,product_id,product_category,quantity,delivery_status,duration,security,price) VALUES('".$order_id."','".$product['id']."','".$product['product_category']."','".$quantity."','NULL','".$product['duration']."','".$security."','".$price."')";
			//var_dump($query);
			$this->db->query($query);
		}
		return $order_id;
	}
	
	function generateIdForMembership($productId){
		$user=new User();
		$product=new Product();
		
		$totalItems='1';
		$membership=$product->getMembership($productId);
		//var_dump($products);
		$user_id=$_SESSION['id'];
		$address=$user->getAddress();
		$membership=new Membership();
		$amount=$membership->getPriceById()+$membership->getSecurityById();
		
		$query="INSERT INTO orders(user_id,quantity,tracking_id,status,date,address_line,city,pincode,amount,total_amount,wallet_amount) VALUES('".$user_id."','".$totalItems."',NULL,'pending','".date("Y-m-d H:i:s")."','".$address['address_line']."','".$address['city']."','".$address['pincode']."','".$amount."','".$amount."','0')";
		//var_dump($query);
		$this->db->query($query);
		$order_id=mysqli_insert_id($this->db);
		
		$quantity=$totalItems;
		$query="INSERT into order_item(order_id,product_id,product_category,quantity,delivery_status) VALUES('".$order_id."','".$membership['id']."','".$product->product_category_membership."','".$quantity."','NULL')";
		//var_dump($query);
		$this->db->query($query);

		return $order_id;
	}
	
	function getOrderList($query){
		$result=$this->db->query($query);
		$orderList=array();
		if($result->num_rows>0){
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				array_push($orderList,$row);
			}
		return ($orderList);
		}
		return null;
	}
	
	function getOrder($order_id){
		$query="SELECT * from orders
					INNER JOIN order_item
					ON orders.id=order_item.order_id
					INNER JOIN product
					ON order_item.product_id=product.id
					WHERE orders.id='".$order_id."'";
		return $this->getOrderList($query);
	}
	function getMyOrders(){
		$query="SELECT orders.* from orders
					WHERE orders.user_id='".$_SESSION['id']."' and (orders.status!='pending' AND orders.status!='invalid')";
		return ($this->getOrderList($query));
	}
	function getAllOrders($order_id){
		$query="SELECT * from 
							order_item oi
								INNER JOIN 
							orders o 
								ON oi.order_id=o.id 
								INNER JOIN 
							product p 
								ON oi.product_id=p.id";
		return $this->getOrderList($query);
	}
	function getDeliveredOrders(){
		$query="SELECT o.id,oi.id AS order_item,date,product_category,delivery_status,product_id from orders o
					INNER JOIN order_item oi
					ON o.id=oi.order_id
					WHERE o.user_id='".$_SESSION['id']."' and o.status='success' and oi.delivery_status!='returned' and oi.product_category!='2'";
		//var_dump($query);
		return $this->getOrderList($query);
	}
	
	function getAmount($id){
		$query="Select amount from orders WHERE id='".$id."'";
		//var_dump($query);
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			// Log In
			$row = mysqli_fetch_assoc($result);
			$amount = $row['amount'];
			
		}
		return $amount;
	}
	
	function setPhone($order_id,$phone){
		$query="UPDATE orders SET phone_no='".$phone."' WHERE id='".$order_id."'";
		$result=$this->db->query($query);
		return;
	}
	
	function setTransactionStatus($order_id,$tracking_id,$bank_ref_no,$order_status,$delivery_status,$payment_mode,$offer_code,$discount_value,$total_amount){
		$query="UPDATE orders SET tracking_id='".$tracking_id."',bank_ref_no='".$bank_ref_no."', status='".$order_status."',payment_mode='".$payment_mode."',offer_code='".$offer_code."', discount_value='".$discount_value."',total_amount='".$total_amount."' WHERE user_id='".$_SESSION['id']."' AND id='".$order_id."'";
		//var_dump($query);
		$result=$this->db->query($query);
		$query="UPDATE order_item SET delivery_status='".$delivery_status."' WHERE order_id='".$order_id."'";
		$result=$this->db->query($query);
	}
	
	function isTransactionSuccessful($order_id){
		$query="SELECT status from orders where id='".$order_id."'";
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			// Log In
			$row = mysqli_fetch_assoc($result);
			$status = $row['status'];
			if($status=='Success'){
				return true;
			}
		}
		return false;
	}
	
	function hasProduct($order_id,$product_category){
		$query="SELECT product_category FROM order_item WHERE order_item.order_id='".$order_id."' and order_item.product_category='".$product_category."'";
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			return true;
		}
		return false;
	}
	
	function hasMembership($order_id){
		return $this->hasProduct($order_id,'2');
	}
	
	function hasBooks($order_id){
		return $this->hasProduct($order_id,'1');
	}
	
	function getMembershipId($order_id){
		$query="SELECT product_id FROM order_item 
					INNER JOIN orders
					ON orders.id=order_item.order_id
					WHERE orders.id='".$order_id."' and product_category='2'";
		//var_dump($query);
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			// Log In
			while($row = mysqli_fetch_assoc($result)){
				return $row['product_id'];
			}
		}
	}
	
	function getDeliveryStatus($order_item){
		$query="Select delivery_status from order_item where id='".$order_item."'";
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			$row=mysqli_fetch_assoc($result);
			return $row['delivery_status'];
		}
	}
	
	function returnProduct($order_item){
		$query='UPDATE order_item SET delivery_status="return_requested" WHERE id="'.$order_item.'" and delivery_status="delivered"';
		//var_dump($query);
		$result=$this->db->query($query);
	}
	
	function getWalletAmount($order_id){
		$query="Select wallet_amount from orders where id='".$order_id."'";
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			$row = mysqli_fetch_assoc($result);
			return $row['wallet_amount'];
		}
	}
	
	function getAllBooks($order_id){
		$product_category='1';
		return $this->getIdsOfOrder($order_id,$product_category);
	}
	function getIdsOfOrder($order_id,$product_category){
		$query="SELECT order_item.product_id AS id, order_item.product_category from orders
					INNER JOIN order_item
					ON orders.id=order_item.order_id
					INNER JOIN product
					ON order_item.product_id=product.id
					WHERE orders.user_id='".$_SESSION['id']."' and orders.id='".$order_id."' and order_item.product_category='".$product_category."'";
		$products=array();
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			while($row = mysqli_fetch_assoc($result)){
				$product = array(
					'id'		  		=> $row['id'],
					'product_category' 	=> $row['product_category']);
				array_push($products,$product);
			}
			//var_dump($products);
		}
		return $products;
	}
	
	function getOrderItemId($orderId,$productId,$productCategory){
		$query="SELECT id from order_item WHERE order_id='$orderId' AND product_id='$productId' AND product_category='$productCategory'";
		$$result=$this->db->query($query);
		if($result->num_rows > 0){
			while($row = mysqli_fetch_assoc($result)){
				return $row['id'];
			}
		}
	}
	
	function getDuration($orderId,$productId,$productCategory){
		$query="SELECT duration from order_item WHERE order_id='$orderId' AND product_id='$productId' AND product_category='$productCategory'";
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			while($row = mysqli_fetch_assoc($result)){
				return $row['duration'];
			}
		}
	}
	
	
}

?>