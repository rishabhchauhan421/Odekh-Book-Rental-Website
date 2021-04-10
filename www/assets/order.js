$(document).ready(function(){
	
	$("body").delegate("#setAddress","click",function(event){
		event.preventDefault();
		var address_line = $('#address_line').val();
		var pincode = $("#pincode").val();
		var city = $("#city").val();
		
		$.ajax({
			url		:	"../action_order.php",
			method	:	"POST",
			data	:	{setAddress:1,address_line:address_line,pincode:pincode,city:city},
			success	:	function(data){
				$("#order_content").html(data);
			}
		})
		
		
	})
	
});