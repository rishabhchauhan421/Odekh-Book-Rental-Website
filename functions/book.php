<?php 
include_once('../functions/database.php');
include_once('../functions/user.php');
class Book{
	
	function __construct(){
        $database=new Database;
		$this->connection=$database->getConnection();
    }
	
	function getBooks($query){
		//var_dump($query);
		$result=$this->connection->query($query);
		$booksData=array();
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				//var_dump($row['id']);
				$book = array(
					'id'		  		=> $row['id'],
					'title'       		=> $row['title'],
					'author_id'   		=> $row['author_id'],
					'description' 		=> $row['description'],
					'image'       		=> $row['image'],
					'ISBN'        		=> $row['ISBN'],
					'price'       		=> $row['price'],
					'keywords'    		=> $row['keywords'],
					'genre_id' 			=> $row['genre_id'],
					'product_category' 	=> '1',
					'date_added' 	 	=> $row['date_added']);
				array_push($booksData,$book);
				//var_dump($booksData);
				
			}
		}
		//var_dump($booksData);
		return $booksData;
	}
	
	function getAllBooks(){
		$query="SELECT * FROM product where product_category='1'";
		return $this->getBooks($query);
	}
	
	function getDetailsbyId($id){
		$query="SELECT * FROM product where id='".$id."' AND product_category='1'" ;
		//var_dump($query);
		$result=$this->connection->query($query);
		if($result->num_rows>0){
			$row=$result->fetch_assoc();
			$book = array(
				'id'		  		=> $row['id'],
				'title'       		=> $row['title'],
				'author_id'   		=> $row['author_id'],
				'description' 		=> $row['description'],
				'image'       		=> $row['image'],
				'ISBN'        		=> $row['ISBN'],
				'price'       		=> $row['price'],
				'keywords'    		=> $row['keywords'],
				'genre_id' 			=> $row['genre_id'],
				'product_category' 	=> '1',
				'date_added' 	 	=> $row['date_added']);
			//var_dump($book);
			return $book;
		}
	}
	
	function getBooksOnSelectedAuthors($id){
		$query="SELECT * FROM product where author_id='".$id."' AND product_category='1'";
		return $this->getBooks($query);
	}
	function getBooksOnSelectedGenre($id){
		$query="SELECT * FROM product where genre_id='".$id."' AND product_category='1'";
		return $this->getBooks($query);
	}
	
	function getBooksOnKeywords($keywords){
		$query="SELECT product.* FROM product
				INNER JOIN author
				ON product.author_id=author.id
				WHERE product.keywords LIKE '%".$keywords."%' OR author.name LIKE '%".$keywords."%'
				AND product_category='1'";
		//var_dump($query);
		$product= $this->getBooks($query);
		//var_dump($product);
		return $product;
	}
	
	function getAllAuthors(){
		$query="SELECT * FROM author";
		$result=$this->connection->query($query);
		$authorData=array();
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$author = array(
					'id'		  => $row['id'],
					'name'        => $row['name']);
				array_push($authorData,$author);
			}
		}
		return $authorData;
	}
	
	function getAllPublishers(){
		$query="SELECT * FROM books_publisher";
		$result=$this->connection->query($query);
		$publisherData=array();
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$publisher = array(
					'id'		  => $row['id'],
					'name'        => $row['name']);
				array_push($publisherData,$publisher);
			}
		}
		return $publisherData;
	}
	function getAllGenre(){
		$query="SELECT * FROM genre";
		$result=$this->connection->query($query);
		$publisherData=array();
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$publisher = array(
					'id'		  => $row['id'],
					'name'        => $row['title']);
				array_push($publisherData,$publisher);
			}
		}
		return $publisherData;
	}
	
	function displayBooks($allBooks,$page){
		//var_dump($page);
		$record_per_page=9;
		$total_page=ceil(sizeof($allBooks)/($record_per_page));
		
		$product=new Product();
		$cart=new Cart();
		
		$startFrom=($page-1)*$record_per_page;
		$endTo=($page)*$record_per_page;
		if($endTo>sizeof($allBooks)){
			$endTo=sizeof($allBooks);
		}
		//var_dump($startFrom);
		//var_dump($endTo);
		for($i=$startFrom;$i<$endTo;$i++){
				$book=$allBooks[$i];
				//var_dump($book);
				$price=$product->getRentalPrice($book['id'],$book['product_category'],$cart->days,null);
				echo '<div class="col-sm-6 col-md-4">
							<div class="panel panel-info" style="max-width:300px">
								<div class="panel-heading" style="max-height:41px"> '.ucwords($book['title']).'</div>
								<div class="panel-body">
									<img class="img-thumbnail" src="/assets/images/'.$book['image'].'" style="height:250px; width:100%"/>
								</div>
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-6"></div>
										<div class="col-xs-6">MRP: <del>₹'.$book["price"].'</del></div>
									</div>
								</div>
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-6"><button productId='.$book['id'].' productGenre="1" id="product" class="btn btn-danger btn-xs">Add to Cart</button></div>
										<div class="col-xs-6">Rental: ₹'.$price.'</div>
									</div>
								</div>
							</div>
						</div>';	
		}
		if(sizeof($allBooks)>$record_per_page){
			echo '<div class="col-xs-12">';
			for($i=1;$i<=$total_page;$i++){
				echo "<Button class='btn btn-default' id='pagination' categoryId='1' pageId='$i'>   ".$i."</Button>";
			}
			echo "<div>";
		}
	}
	
	function getPriceById($id){
		$query="SELECT price FROM product WHERE id='".$id."'";
		$result=$this->connection->query($query);
		if($result->num_rows>0){
			//Product Exists
			$row=$result->fetch_assoc();
			return $row['price'];
		}
	}
	
	function getTitleById($id){
		$query="SELECT title FROM product WHERE id='".$id."'";
		$result=$this->connection->query($query);
		if($result->num_rows>0){
			//Product Exists
			$row=$result->fetch_assoc();
			return $row['title'];
		}
	}
	
	function getRecentlyAdded(){
		$query="SELECT * FROM product WHERE product_category='1' ORDER BY date_added DESC LIMIT 10";
		return $this->getBooks($query);
	}
	function getMostPopular(){
		$query="SELECT * FROM home_display
					INNER JOIN product
					ON home_display.product_id=product.id where popular='1' and home_display.product_category='1'";
		return $this->getBooks($query);
	}

	function filterProductBy($filterBy,$filterKeyword,$page_id){
		if($filterBy=='genre'){
			return $this->getBooksOnSelectedGenre($filterKeyword);
		}else if($filterBy=='author'){
			return $this->getBooksOnSelectedAuthors($filterKeyword);
		}
	}
	function getNewArrivals(){
		$query="SELECT * FROM home_display
					INNER JOIN product
					ON home_display.product_id=product.id where new_arrivals='1' and home_display.product_category='1'";
		return $this->getBooks($query);
		
	}
}

?>