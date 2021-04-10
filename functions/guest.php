<?php

	include_once('../functions/database.php');
	class Guest{
		function __construct(){
			if(!isset($this->db)){
				// Connect to the database
				$database = new Database();
				$this->db=$database->getConnection();
			}
		}
		
	function addToCart($product_id){
		//products is an array of product
		
		//checking if cartData does not exists
		if(!isset($_SESSION['cartData'])){
			$cartData=array();
			$product=array(
					'product_id'	=>	$product_id,
					'quantity'		=>	1);
			array_push($cartData,$product);
		}else{
			$cartData=$_SESSION['cartData'];
			foreach($cartData as &$product){
				if(!strcasecmp($product['product_id'],$product_id)){
					$product['quantity']=($product['quantity']+1);
					$found=true;
					break;
				}
			}
			if(!isset($found)){
				$product=array(
					'product_id'	=>	$product_id,
					'quantity'		=>	1);
				var_dump($cartData);
				array_push($cartData,$product);
				
				var_dump($cartData);
			}
		}
		//added cartData to session
		$_SESSION['cartData']=$cartData;
	}
	
	function getTotalItems(){
		if(isset($_SESSION['cartData'])){
			$cartData=$_SESSION['cartData'];
			$quantity=0;
			//var_dump($cartData);
			foreach($cartData as $product){
				$quantity=$quantity+$product['quantity'];
			}
			return $quantity;
		}else{
			return 0;
		}
		
	}	
}

?>