$(document).ready(function(){

var return_to_login='REDIRECT_TO_LOGIN';
	
	
	$("body").delegate("#book","click",function(event){
		event.stopImmediatePropagation();
		event.preventDefault();
		var productId = $(this).attr("productId");
		var productCategory = $(this).attr("productCategory");

		$.ajax({
			url		:	"../action_products.php",
			method	:	"POST",
			data	:	{addToProduct:1,productId:productId,categoryId:productCategory},
			success	:	function(data){
				//alert(data);
				if(data==return_to_login){
					//alert("Login First");
					window.location.href = "login.php";
				}else{
					window.location.href = "login.php";
				}
			}
		})
		
	})

})