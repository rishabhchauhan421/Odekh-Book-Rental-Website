<?php 
include_once('../functions/database.php');
include_once('../functions/user.php');
class Collection{
	
	function __construct(){
        $database=new Database;
		$this->connection=$database->getConnection();
    }
	
	function getCollection($query){
		//var_dump($query);
		$result=$this->connection->query($query);
		$collectionData=array();
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				//var_dump($row['id']);
				$collection = array(
					'id'		  		=> $row['id'],
					'title'       		=> $row['title'],
					'college_id'   		=> $row['college_id'],
					'quantity'    		=> $row['quantity'],
					'in_stock'   		=> $row['in_stock'],
					'image'       		=> $row['image'],
					'college_id'   		=> $row['college_id'],
					'product_category' 	=> '3',
					'date_added' 	 	=> $row['date_added']);
				array_push($collectionData,$collection);
				//var_dump($collectionData);
				
			}
		}
		//var_dump($booksData);
		return $collectionData;
	}
	
	function getAllCollection(){
		$query="SELECT * from collection";
		return $this->getCollection($query);
	}
	
	function getAllBranch(){
		$query="SELECT * FROM branch";
		$result=$this->connection->query($query);
		$courses=array();
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$course = array(
					'id'		 => $row['id'],
					'name'       => $row['name']);
				array_push($courses,$course);
				//var_dump($booksData);
				
			}
		}
		//var_dump($booksData);
		return $courses;
	}
	
	function getDetailsById($id){
		$query="SELECT * FROM collection where id='".$id."'" ;
		//var_dump($query);
		$result=$this->connection->query($query);
		if($result->num_rows>0){
			$row=$result->fetch_assoc();
			$collection = array(
				'id'		  		=> $row['id'],
				'title'       		=> $row['title'],
				'college_id'   		=> $row['college_id'],
				'quantity'    		=> $row['quantity'],
				'in_stock'   		=> $row['in_stock'],
				'image'       		=> $row['image'],
				'college_id'   		=> $row['college_id'],
				'product_category' 	=> '3',
				'date_added' 	 	=> $row['date_added']);
			//var_dump($book);
			return $collection;
		}
	}
	
	function displayCollection($collection,$page){
		//var_dump($page);
		$record_per_page=9;
		$total_page=ceil(sizeof($collection)/($record_per_page));
		
		$product=new Product();
		$cart=new Cart();
		
		$startFrom=($page-1)*$record_per_page;
		$endTo=($page)*$record_per_page;
		if($endTo>sizeof($collection)){
			$endTo=sizeof($collection);
		}
		//var_dump($startFrom);
		//var_dump($endTo);
		for($i=$startFrom;$i<$endTo;$i++){
				$item=$collection[$i];
				//var_dump($collection);
				$price=$this->getPriceById($item['id']);
				$RentalPrice=$product->getRentalPrice($item['id'],$item['product_category'],$cart->days,null);
				echo '<div class="col-sm-12">
							<div class="panel panel-info">
								<div class="panel-heading" style="max-height:41px"> '.ucwords($item['title']).'</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-4">
											<img class="img-thumbnail" src="/assets/images/'.$item['image'].'" style="height:250px; width:100%"/>
										</div>
										<div class="col-xs-12 col-sm-6 col-md-8">
											<div class="row">
												<b>List of Books</b><br>'.$this->displayItemsList($item["id"]).'
											</div>
											<div class="row">
												MRP: <del>₹'.$price.'</del><br>
											</div>
											<div class="row">
												<div class="hidden-xs hidden-sm">
													Rental: ₹'.$RentalPrice.'<br>
												</div>
											</div>
									</div>
									</div>
								</div>
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-6 visible-xs">Rental: ₹'.$RentalPrice.'</div>
										<div class="col-xs-6"><button productId='.$item['id'].' productCategory="3" id="product" class="btn btn-danger">Add to Cart</button></div>
									</div>
								</div>
							</div>
						</div>';	
		}
		if(sizeof($collection)>$record_per_page){
			echo '<div class="col-xs-12">';
			for($i=1;$i<=$total_page;$i++){
				echo "<Button class='btn btn-default' id='pagination' pageId='$i'>   ".$i."</Button>";
			}
			echo "<div>";
		}
	}
	function displayItemsList($collectionId){
		$items=$this->getAllItems($collectionId);
		$content= '<ul>';
		foreach($items as $item){
			$content.=('<li>'.ucwords($item["title"]).' by '.$item["name"].'</li>');
		}
		$content.=('</ul>');
		//var_dump($content);
		return $content;
	}
	
	function getPriceById($collectionId){
		$query="SELECT product_id,product_category FROM collection_item WHERE collection_id='".$collectionId."'";
		$result=$this->connection->query($query);
		$totalPrice=0;
		
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				//var_dump($row['id']);
				//Product Exists
				$product_id=$row['product_id'];
				$product_category=$row['product_category'];
				$product=new Product();
				$price=$product->getPriceById($product_id,$product_category);
				$totalPrice+=$price;
			}
		}
		return $totalPrice;
	}
	
	function getTitleById($id){
		$query="SELECT title FROM collection WHERE id='".$id."'";
		$result=$this->connection->query($query);
		if($result->num_rows>0){
			//Product Exists
			$row=$result->fetch_assoc();
			return $row['title'];
		}
	}
	
	function getAllItems($collection_id){
		$query="SELECT product.id,title,author.name from collection_item 
						INNER JOIN product
						ON collection_item.product_id=product.id
						INNER JOIN author
						ON product.author_id=author.id
						WHERE collection_id='".$collection_id."'";
		$result=$this->connection->query($query);
		$itemsData=array();
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				//var_dump($row['id']);
				$item = array(
					'id'		  		=> $row['id'],
					'title'       		=> $row['title'],
					'name'				=>$row['name']);
				array_push($itemsData,$item);
			}
		}
		//var_dump($itemsData);
		return $itemsData;
	}
	
	function getRecentlyAdded(){
		$query="SELECT * FROM product WHERE product_category='1' ORDER BY date_added DESC LIMIT 10";
		return $this->getBooks($query);
	}
	function getMostPopular(){
		$query="SELECT * FROM product where popularity='1' AND product_category='1'";
		return $this->getBooks($query);
	}
}

?>