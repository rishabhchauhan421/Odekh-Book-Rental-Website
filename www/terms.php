<?php 
	$page_title="Terms and Conditions";
	include('../template/header.php'); ?>


<div class="container">
	<?php 
		if(isset($_GET['terms'])){
			
		}
		include('../template/terms.php');?>
</div>
<script>
$(function(){
	var url = window.location.href;
	var activeTab = url.substring(url.indexOf("#") + 1);
	
	$(".tab-pane").removeClass("active in");
	
	$("#" + activeTab).addClass("active in");
	
	$('a[href="#'+ activeTab +'"]').tab('show')
});
</script>

<?php include('../template/footer.php');?>