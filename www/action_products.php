<?php 
	('../config/setup.php');
	include_once('../functions/book.php');
	include_once('../functions/email.php');
	include_once('../functions/collection.php');
	
	if(isset($_POST['page'])){
		$page=$_POST['page'];
	}else{
		$page=1;
	}
	
	//Display all Publishsers on sidebar
	if(isset($_POST['get_books_publishers'])){
		$book=new Book();
		$allPublisher=$book->getAllPublishers();
		echo'<div class="nav nav-pills nav-stacked"><li class="active"><a href="#"><h4>Publishers</h4></a></li>';
		
		foreach($allPublisher as $publisher){
			$id=$publisher['id'];
			$name=$publisher['name'];
			echo '<li><a class="sidebar_publisher" publisherId='.$id.' href="#">'.$name.'</li>';
		}
			echo '</div>';
	}
	
	//Display all Genre on sidebar
	if(isset($_POST['get_books_genre'])){
		$book=new Book();
		$allGenre=$book->getAllGenre();
		echo'<div class="nav nav-pills nav-stacked" ><li class="active"><a href="#"><h4>Genre</h4></a></li>';
		
		foreach($allGenre as $genre){
			$id=$genre['id'];
			$name=$genre['name'];
			echo '<li><a class="sidebar_genre" genreId='.$id.' href="#">'.ucwords($name).'</li>';
		}
			echo '</div>';
	}
	
	//Display all Authors on sidebar
	if(isset($_POST['getAuthors'])){
		$book=new Book();
		$allAuthors=$book->getAllAuthors();
		
		echo'<div class="nav nav-pills nav-stacked"><li class="active"><a href="#"><h4>Authors</h4></a></li></div>';
		echo'	<div class="input-group" id="searchform">
					<span class="input-group-btn" id="author_list_search">
						<button class="btn btn-default" id="search_button"><span class="glyphicon glyphicon-search"></span>
						</button>
					</span>
					<input id="authorSearchInput" size="30" type="text" onkeyup="authorSearchFunction()" class="form-control" placeholder="Select Authors...">
				</div>
			<ul id="authorsUl">';
		foreach($allAuthors as $author){
			$id=$author['id'];
			$name=$author['name'];
			echo '<li><a href="#" class="sidebar_authors" authorId="'.$id.'">'.ucwords($name).'</li>';
		}
		echo '</ul>';
	}
	
	
	//Display all Products as Main Content
	if(isset($_POST['getProducts'])){
		$categoryId=$_POST['categoryId'];
		$pageId=$_POST['pageId'];
		if($categoryId=='1'){
			
			$book=new Book();
			$allBooks=$book->getAllBooks();
			$book->displayBooks($allBooks,$pageId);
		}else if($categoryId='3'){
			$collection =new Collection();
			$allCollection =$collection->getAllCollection();
			$collection->displayCollection($allCollection,$pageId);
		}
	}
	
	//Display all Course on sidebar of collection
	if(isset($_POST['get_all_branch'])){
		$collection=new Collection();
		$Courses=$collection->getAllBranch();
		echo'<div class="nav nav-pills nav-stacked" ><li class="active"><a href="#"><h4>Branch</h4></a></li>';
		
		foreach($Courses as $course){
			$id=$course['id'];
			$name=$course['name'];
			echo '<li><a class="sidebar_branch" branchId='.$id.' href="#">'.ucwords($name).'</li>';
		}
			echo '</div>';
	}
	
	//Display all Books on particular Authors
	if(isset($_POST['getSelectedAuthors'])){
		$author_id=$_POST['authorId'];
		$book=new Book();
		$page_id=$_POST['pageId'];
		$allBooks=$book->getBooksOnSelectedAuthors($author_id);
		
		$book->displayBooks($allBooks,$page_id);
	}
	//Display all Books on particular Genre
	if(isset($_POST['getProductsOnSelectedGenre'])){
		$genreId=$_POST['genreId'];
		$book=new Book();
		$page_id=$_POST['pageId'];
		$allBooks=$book->getBooksOnSelectedGenre($genreId);
		
		$book->displayBooks($allBooks,$page_id);
	}
	//Display all Products on particular Branch
	if(isset($_POST['getProductsOnSelectedBranch'])){
		$genreId=$_POST['branchId'];
		$collection=new Collection();
		$page_id=$_POST['pageId'];
		$allBooks=$collection->getProductsOnSelectedBranch($branchId);
		
		$collection->displayBooks($allBooks,$page_id);
	}
	
	//Filter Products By
	if(isset($_POST['filterProduct'])){
		$filterKeyword=$_POST['filterKeyword'];
		$filterBy=$_POST['filterBy'];
		$productCategory=$_POST['productCategory'];
		$page_id=$_POST['pageId'];
		
		$product =new Product();
		
		$newProducts=$product->filterProductBy($productCategory,$filterBy,$filterKeyword,$page_id);
		$product->displayproducts($newProducts,$productCategory,$page_id);
	}
	
	//Display all Books on particular Search Result using keywords only
	if(isset($_POST['search'])){
		$keywords=$_POST['keywords'];
		$book=new Book();
		$allBooks=$book->getBooksOnKeywords($keywords);
		//var_dump($allBooks);
		if(empty($allBooks)){
			echo '<div class="alert alert-success">
						<div class="row">
							<div class="col-md-12">
								<div class="error-template">
									<h1>
										Oops!</h1>
									<h2>
										Product Not Found</h2>
									<div class="error-details">
										Sorry, we are continously adding products daily in our catalog, <br> Let us know the book you want!
									</div>
									<br>
									<form class="omb_loginForm" autocomplete="off" method="POST"action="">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-book"></i></span>
											<input id="request_book_input" type="text" class="form-control" name="request_book_input" placeholder="Enter Book, author, or ISBN">
											<button id="requestBook"class="btn btn-primary btn-block" type="submit">Request Book</button>
										</div>
										
									</form>
								</div>
							</div>
						</div>
					</div>';
			
		}else{
			$book->displayBooks($allBooks,$page);
		}
	}
	
	
	
	//Add product to Cart and display Alert
	if(isset($_POST['addToProduct'])){
		$product_id=$_POST['productId'];
		$product_category=$_POST['categoryId'];
		if(isset($_SESSION['id'])){
			$cart = new Cart();
			$added=$cart->addToCart($product_category,$product_id,$_SESSION['id']);
			if($added==-1){
				echo "Cannot add more than two products in cart";
			}
		}else{
			//TODO: Display No products Found
			echo("REDIRECT_TO_LOGIN");
		}
	}
	
	if(isset($_POST['requestBook'])){
		if(isset($_POST['bookName'])){
			$book_name=htmlspecialchars($_POST['bookName']);
			
			$email = new Email();
			$email->requestBook($book_name);
		}
	}
	
	
	
?>