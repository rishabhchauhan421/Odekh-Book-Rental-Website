<?php
	include_once('../config/setup.php');
	include_once('../functions/cart.php');
	
	
	if(isset($_POST['get_cart'])){
		$cart=new Cart();
		$cart->showProducts();
	}
	
	if(isset($_POST['deleteProduct'])){
		$productId=$_POST['productId'];
		$product_category=$_POST['productCategory'];
		$cart=new Cart();
		$cart->deleteProduct($productId,$product_category,$_SESSION['id']);
	}
	
	if(isset($_POST['updateProduct'])){
		$productId=$_POST['productId'];
		$productCategory=$_POST['productCategory'];
		$quantity=$_POST['quantity'];
		$cart=new Cart();
		if($quantity>0){
			$cart->updateCart($productId,$productCategory,$quantity,$_SESSION['id']);
		}else{
			$cart->deleteProduct($productId,$productCategory,$_SESSION['id']);
		}
	}
	
	if(isset($_POST['updateDuration'])){
		$productId=$_POST['productId'];
		$productCategory=$_POST['productCategory'];
		$duration=$_POST['duration'];
		$cart=new Cart();
		$cart->setDuration($productId,$productCategory,$duration,$_SESSION['id']);
	}
	
	
?>