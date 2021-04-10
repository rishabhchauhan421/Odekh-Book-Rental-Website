<?php

include_once('../functions/database.php');
include_once('../functions/ip_address.php');
include_once('../functions/guest.php');
include_once('../functions/book.php');
include_once('../functions/user.php');
include_once('../functions/membership.php');
include_once('../functions/collection.php');


class Product{
	private $table='product';
	public $product_category_membership='2';
	public $product_category_collection='3';
	public $product_category_book='1';
	public $PL200_security=299;
	
	
	function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $database = new Database();
			$this->db=$database->getConnection();
        }
    }
	function getProductDetails($product_id,$product_category){
		if($product_category==$this->product_category_book){
			return (new Book())->getDetailsById($product_id);
		}else if($product_category==$this->product_category_membership){
			return (new Membership())->getDetailsById($product_id);
		}else if($product_category==$this->product_category_collection){
			return (new Collection())->getDetailsById($product_id);
		}
	}
	function getProducts($query){
		$book= new Book();
		return $book->getBooks($query);
	}
	
	function getAllProducts($product_category){
		$query="SELECT * FROM ".$this->table." where product_category='".$product_category."'";
		return $this->db->query($query);
	}
	function getPriceByName($name){
		$query="SELECT price from ".$this->table." WHERE title='".$name."'";
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			// Log In
			$row = mysqli_fetch_array($result);
			return $row['price'];
		}
	}
	
	function getPriceById($id,$product_category){
		if($product_category==$this->product_category_membership){
			return ((new Membership())->getPriceById($id));
		}else if($product_category==$this->product_category_book){
			return (new Book())->getPriceById($id);
		}else if($product_category==$this->product_category_collection){
			return (new Collection())->getPriceById($id);
		}
	}
	
	function getMembership($id){
		$query="SELECT * FROM membership WHERE id='".$id."'";
		$this->db->query($query);
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			return mysqli_fetch_assoc($result);
		}
	}
	
	function getRentalPrice($productId,$product_category,$days,$coupon){
		$product=new Product();
		if($days<=0){
			return "INVALID DAYS";
		}
			
		if($product_category==$this->product_category_membership){
			$price=$this->getPriceById($productId,$product->product_category_membership);
			if($days<=30){
				return ceil($price);
			}else if($days<=60){
				return ceil($price*1.5);
			}else if($days<=90){
				return ceil($price*2);
			}else{
				return ceil($price*3);
			}
		}
		if($product_category==$this->product_category_collection){
			$price=$this->getPriceById($productId,$this->product_category_collection);
			if($days<=30){
				return ceil($price*0.25);
			}else if($days<=60){
				return ceil($price*0.35);
			}else if($days<=90){
				return ceil($price*0.45);
			}else{
				return ceil($price*.5);
			}
		}
		else if($product_category=$this->product_category_book){
			$user=new User();
			if($user->isPremiumMember()){
				return 0;
			}
			$price=$this->getPriceById($productId,$this->product_category_book);
			if($days<=30){
				return ceil($price*0.3);
			}else if($days<=60){
				return ceil($price*0.4);
			}else if($days<=90){
				return ceil($price*0.5);
			}else{
				return ceil($price*.55);
			}
		}
	}
	function getAvailableStock($id,$product_category){
		$query='SELECT in_stock FROM product WHERE id="'.$id.'"';
		//var_dump($query);
		$this->db->query($query);
		$result=$this->db->query($query);
		if($result->num_rows > 0){
			$row= mysqli_fetch_assoc($result);
			return $row['in_stock'];
		}
	}
	function reduceAvailableStock($id,$product_category){
		$stock=$this->getAvailableStock($id,$product_category);
		$query="UPDATE ".$this->table." SET in_stock='".($stock-1)."' WHERE id='".$id."'";
		//var_dump($query);
		$this->db->query($query);
	}
	
	function filterProductBy($productCategoryId,$filterBy,$filterKeyword,$page_id){
		if($productCategoryId=='1'){
			$books=new Book();
			return $books->filterProductBy($filterBy,$filterKeyword,$page_id);
		}
		else if($productCategoryId=='1'){
			$collection=new Collection();
			return $collection->filterProductBy($filterBy,$filterKeyword,$page_id);
		}
	}
	
	function displayProducts($products,$productCategory,$page_id){
		//var_dump($products);
		if($productCategory==$this->product_category_book){
			$book=new Book();
			return $book->displayBooks($products,$page_id);
		}else if($productCategory==$this->product_category_collection){
			$collection = new Collection();
			return $collection->displayCollection($products,$page_id);
		}
	}
	
	function getTitle($id,$product_category){
		if($product_category==$this->product_category_membership){
			return ((new Membership())->getTitleById($id));
		}else if($product_category==$this->product_category_book){
			return (new Book())->getTitleById($id);
		}else if($product_category==$this->product_category_collection){
			return (new Collection())->getTitleById($id);
		}
	}
	
	function getSecurity($productId,$product_category,$duration,$coupon){
	
		if($product_category==$this->product_category_membership){
			$membership=new Membership();
			return $membership->getSecurityById($productId);
		}
		else if($product_category==$this->product_category_book){
			$cart=new Cart();
			return floor(($this->getPriceById($productId,$this->product_category_book))-($cart->getPrice($productId,$product_category,$duration,$coupon)));
			
		}else if($product_category==$this->product_category_collection){
			$cart=new Cart();
			return floor(($this->getPriceById($productId,$this->product_category_collection))-($cart->getPrice($productId,$product_category,$duration,$coupon)));
		}
	}

}