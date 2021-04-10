$(document).ready(function(){
	
	var return_to_login='REDIRECT_TO_LOGIN';

	
	$("body").delegate("#plan","click",function(event){
		event.stopImmediatePropagation();
		event.preventDefault();
		var planId = $(this).attr("planId");
	
		$.ajax({
			url		:	"../action_plan.php",
			method	:	"POST",
			data	:	{buyMembership:1,planId:planId},
			success	:	function(data){
				if(data==return_to_login){
					window.location.href = "login.php";
				}else{
					$("body").html(data)
				}
			}
		})
		
	})
		
})