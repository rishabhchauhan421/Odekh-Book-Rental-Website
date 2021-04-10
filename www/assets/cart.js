$(document).ready(function(){
		
	
	getCart();
	
	
	function getCart(){
		$.ajax({
			url		:	"../action_cart.php",
			method	:	"POST",
			data	: 	{get_cart:1},
			success	:	function(data){
				$("#cart_checkout").html(data);
			}
		})
	}
	
	function disableSubmitButton(bool){
		document.getElementById("process_order_button").disabled = bool;
	}
	
	//Delete Product from delete button
	$("body").delegate("#deleteButton","click",function(event){
		event.preventDefault();
		var productId = $(this).attr("productId");
		var productCategory=$(this).attr("productCategory");
		
		$.ajax({
			url		:	"../action_cart.php",
			method	:	"POST",
			data	:	{deleteProduct:1,productId:productId,productCategory:productCategory},
			success	:	function(data){
					window.location.href = "cart.php";
			}
		})
	})
	
	//Final Submission for Order and address
	
	
	
	//Change Quantity
	$("body").delegate(".quantity","change",function(){
		var productId=$(this).attr("productId");
		var productCategory=$(this).attr("productCategory");
		var quantity=$("#quantity-"+productId).val();
		
			$.ajax({
				url		:	"../action_cart.php",
				method	:	"POST",
				data	:	{updateProduct:1,productId:productId,productCategory:productCategory,quantity:quantity},
				success	:	function(data){
					window.location.href = "cart.php";
				}
			})
		
	})
	
	//Change Duration
	$("body").delegate(".duration","change",function(){
		var productId=$(this).attr("productId");
		var productCategory=$(this).attr("productCategory");
		var duration = $('#duration-'+productId).find(":selected").val();
		//alert(duration);
		
			$.ajax({
				url		:	"../action_cart.php",
				method	:	"POST",
				data	:	{updateDuration:1,productId:productId,productCategory:productCategory,duration:duration},
				success	:	function(data){
					
					//$("#cart_checkout").html(data);
					window.location.href = "cart.php";
				}
			})
		
	})
	
	
	//Disable Submit Button on payment-Selection
	$('select').on('change', function (e) {
		//var selected = $("option:selected", this);
		var selected = this.value;
		if(selected=='0'){
			disableSubmitButton(true);
		}else if(selected=='1'){
			disableSubmitButton(false);
		}else if(selected=='2'){
			disableSubmitButton(false);
		}else{
			disableSubmitButton(true);
		}
	})
	
	//Confirm Address and place order
	$("body").delegate("#process_order_button","click",function(event){
		event.stopImmediatePropagation();
		event.preventDefault();
		
		var addressForm=$("#addressForm").serialize();
		$.ajax({
            url     : "../action_myaccount.php",
            type    : "POST",
            data    : {addressForm:addressForm,setAddress:1},
            success : function( data ) {
                        
            },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });    
		
	})
});