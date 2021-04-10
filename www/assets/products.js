$(document).ready(function(){
	var categoryId=document.getElementById('getProducts').getAttribute("categoryId");
	if(categoryId=='1'){
		getGenre();
		getAuthors();
		
	}else if(categoryId=='3'){
		getAllBranch();
	}
	getProducts('1',categoryId);
	var return_to_login='REDIRECT_TO_LOGIN';
	
	
	function getGenre(){
		$.ajax({
			url		:	"../action_products.php",
			method	:	"POST",
			data	: 	{get_books_genre:1},
			success	:	function(data){
				$("#get_genre").html(data);
			}
		})
	}
	
	function getAuthors(){
		$.ajax({
			url		:	"../action_products.php",
			method	:	"POST",
			data	: 	{getAuthors:1},
			success	:	function(data){
				$("#get_authors").html(data);
			}
		})
	}
	
	function getProducts(pageId,categoryId){
		var genreId='';
		var branchId='';
		var keywords = $("#search").val();
		if(keywords!= ""){
			//alert(keywords);
		
			search(keywords,pageId);
		}
		else if(categoryId=='1'){
			//alert("inside else again: 1");
			genreId=document.getElementById('getProducts').getAttribute("genreId");
			if(genreId!=''){
				var pageId='1';
				getProductsOnSelectedGenre(genreId,pageId);
			}
			else{
				//alert("inside else again: 2");
				$.ajax({
					url		:	"../action_products.php",
					method	:	"POST",
					data	: 	{getProducts:1,pageId:pageId,categoryId,categoryId},
					success	:	function(data){
									$("#getProducts").html(data);
								},
					error: function (request, status, error) {}
				})
			}
		
		}else if(categoryId=='3'){
			branchId=document.getElementById('getProducts').getAttribute("branchId");
			//alert(branchId);
			if(branchId!=''){
				var pageId='1';
				getProductsOnSelectedGenre(branchId,pageId);
			}
			else{
				//alert("inside else again: 2");
				$.ajax({
					url		:	"../action_products.php",
					method	:	"POST",
					data	: 	{getProducts:1,pageId:pageId,categoryId,categoryId},
					success	:	function(data){
									$("#getProducts").html(data);
								},
					error: function (request, status, error) {}
				})
			}
		}
		scroll(0,0);
	}
	
	function getAllBranch(){
		$.ajax({
			url		:	"../action_products.php",
			method	:	"POST",
			data	: 	{get_all_branch:1},
			success	:	function(data){
				$("#get_all_branch").html(data);
			}
		})
	}
	
	$("body").on("click",".sidebar_genre",function(event){
		event.preventDefault();
		var genreId = $(this).attr('genreId');
		var pageId='1';
		filterBy(categoryId,'genre',genreId,pageId);
	})
	
	
	$("body").delegate(".sidebar_authors","click",function(event){
		event.preventDefault();
		var authorId = $(this).attr('authorId');
		var pageId='1';
		getSelectedAuthors(authorId,pageId);
	})
	
	$("#search_button").click(function(){
		event.preventDefault();
		var keywords = $("#search").val();
		search(keywords);
	})
	
	//Add to cart
	$("body").delegate("#product","click",function(event){
		event.stopImmediatePropagation();
		event.preventDefault();
		var productId = $(this).attr("productId");
		var productGenre = $(this).attr("productGenre");
	
		$.ajax({
			url		:	"../action_products.php",
			method	:	"POST",
			data	:	{addToProduct:1,productId:productId,categoryId:categoryId},
			success	:	function(data){
				if(data==return_to_login){
					//alert("Login First");
					window.location.href = "login.php";
				}else{
					window.location.href = "cart.php";
					//$("#getProducts").html(data);					
				}
			}
		})
		
	})
	
	//Pagination
	$("body").delegate("#pagination","click",function(event){
		event.stopImmediatePropagation();
		event.preventDefault();
		var pageId = $(this).attr("pageId");
		var authorId=document.getElementById('getProducts').getAttribute("authorId");
		var filterBy=document.getElementById('getProducts').getAttribute("filter");
		var filterKeyword=document.getElementById('getProducts').getAttribute(filterBy);
		
		//alert(pageId);
		//alert(authorId);
		
		if(authorId!=''){
			getSelectedAuthors(authorId,pageId);
		}else if(filterKeyword){
			//alert("inside elif");
			getProductsOnSelectedGenre(filterKeyword,pageId);
		}else{
			//alert("inside else");
			getProducts(pageId,categoryId);
		}
	})
	
	function search(keywords,pageId){
		if(keywords!= ""){
			$.ajax({
				url		:	"../action_products.php",
				method	:	"POST",
				data	:	{search:1,keywords:keywords,pageId:pageId},
				success	:	function(data){
							$("#getProducts").html(data);
				}
			})
		}
	}
	
	function getSelectedAuthors(authorId,pageId){
		$.ajax({
			url		:	"../action_products.php",
			method	:	"POST",
			data	: 	{getSelectedAuthors:1,authorId:authorId,pageId:pageId},
			success	:	function(data){
				$("#getProducts").html(data);
				document.getElementById("getProducts").setAttribute("authorId",authorId);
			}
		})
	}
	
	
	function getProductsOnSelectedGenre(genreId,pageId){
		//alert("else");
			$.ajax({
			url		:	"../action_products.php",
			method	:	"POST",
			data	: 	{getProductsOnSelectedGenre:1,genreId:genreId,pageId:pageId},
			success	:	function(data){
				$("#getProducts").html(data);
				document.getElementById("getProducts").setAttribute("genreId",genreId);
			}
		})
	}
	
	function getProductsOnSelectedBranch(branchId,pageId){
		//alert("else");
			$.ajax({
			url		:	"../action_products.php",
			method	:	"POST",
			data	: 	{getProductsOnSelectedBranch:1,branchId:branchId,pageId:pageId},
			success	:	function(data){
				$("#getProducts").html(data);
				document.getElementById("getProducts").setAttribute("branchId",genreId);
			}
		})
	}
	
	$("body").delegate("#requestBook","click",function(event){
		event.stopImmediatePropagation();
		event.preventDefault();
		
		var bookName=document.getElementById("request_book_input").value;
		
		if(bookName!=''){
			$.ajax({
				url		:	"../action_products.php",
				method	:	"POST",
				data	:	{requestBook:1,bookName:bookName},
				success	:	function(data){
					$("#getProducts").html("<div class='alert alert-success'><div>Books Requested...</div></div>");
				}
			})
		}
	})
	
	function filterBy(productCategory,filterBy,filterKeyword,pageId){
		$.ajax({
			url		:	"../action_products.php",
			method	:	"POST",
			data	: 	{filterProduct:1,productCategory:productCategory,filterBy:filterBy,filterKeyword:filterKeyword,pageId:pageId},
			success	:	function(data){
				$("#getProducts").html(data);
				document.getElementById("getProducts").setAttribute("filter",filterBy);
				document.getElementById("getProducts").setAttribute(filterBy,filterKeyword);
			}
		})
	}
		
})

function authorSearchFunction(){
	// Declare variables
	var input, filter, ul, li, a, i;
	input = document.getElementById('authorSearchInput');
	filter = input.value.toUpperCase();
	ul = document.getElementById("authorsUl");
	li = ul.getElementsByTagName('li');

	// Loop through all list items, and hide those who don't match the search query
	for (i = 0; i < li.length; i++) {
		a = li[i].getElementsByTagName("a")[0];
		if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
			li[i].style.display = "";
		} else {
			li[i].style.display = "none";
		}
	}
}