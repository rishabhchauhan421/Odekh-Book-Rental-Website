$(document).ready(function(){
	
	var hash = window.location.hash;
	if (hash != ""){
	   var tab=getElementById('"'+hash.slice(1)+'"');
	   tab.show();
	}else{
	   $('#tabs a:first').tab('show');
	}
	
	
	getOrderDetails();
	getAddressDetails();
	getDeliveredOrders();
	
	function getOrderDetails(){
		$.ajax({
			url		:	"../action_myaccount.php",
			method	:	"POST",
			data	: 	{get_order:1},
			success	:	function(data){
				$("#getOrders").html(data);
			}
		})
	}
	
	function getAddressDetails(){
		
	}
	function getDeliveredOrders(){
		$.ajax({
			url		:	"../action_myaccount.php",
			method	:	"POST",
			data	: 	{get_delivered_order:1},
			success	:	function(data){
				$("#getDeliveredOrders").html(data);
			}
		})
	}
	
	$("body").delegate("#returnProductButton","click",function(event){
		event.preventDefault();
		var orderId = $(this).attr('orderId');
		var orderItem = $(this).attr('orderItem');
		//alert(orderId);
		
		$.ajax({
			url		:	"../action_myaccount.php",
			method	:	"POST",
			data	: 	{returnProduct:1,orderId:orderId,orderItem:orderItem},
			success	:	function(data){
				$("#getDeliveredOrders").html(data);
			}
		})
	})
	
	
})