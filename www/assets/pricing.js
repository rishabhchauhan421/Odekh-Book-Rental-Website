$(document).ready(function(){
	
	var return_to_login='REDIRECT_TO_LOGIN';
	

	$("body").delegate("#plan","click",function(event){
		event.stopImmediatePropagation();
		event.preventDefault();
		var productId = $(this).attr("productId");
		var categoryId = $(this).attr("productCategory");
		
		$.ajax({
			url		:	"../action_products.php",
			method	:	"POST",
			data	:	{addToProduct:1,productId:productId,categoryId:categoryId},
			success	:	function(data){
				if(data==return_to_login){
					window.location.href = "login.php";
				}else{
					
					window.location.href = "cart.php";
				}
			}
		})
		
	})

})