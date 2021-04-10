<?php 
	if(isset($_GET['category'])){
		if($_GET['category']=='3'){
			$page_title='Collection';
			$categoryId=3;
		}else{
			$page_title='Books';
			$categoryId=1;
		}
	}else{
		$categoryId=1;
		$page_title='Books';
			
	}
	
	include('../template/header.php');
?>

<link rel="stylesheet" href="/assets/products.css">


<div class="container-fluid">
	<div class="container">
		<?php include('../template/membership_panel.php');?>
	</div>
	<div class="row">
		<div class="col-md-1 hidden-xs"></div>
		
			<div class=" hidden-xs col-sm-4 col-md-2" id="sidebar">
				<?php include('../template/sidebar.php'); ?>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-8">
					<div class="panel panel-info">
						<div class="panel-heading">Products</div>
						<div class="panel-body">
							
							<?php 
								if($categoryId=='1'){
									echo '<div id="getProducts" filter="" categoryId="'.$categoryId.'" genreId="';
									echo (!empty($_GET['genre']) ? $_GET['genre'] : '');
									echo '" authorId=""></div>';
								}else if($categoryId=='3'){
									echo '<div id="getProducts" categoryId="'.$categoryId.'" branchId="';
									echo (!empty($_GET['branch']) ? $_GET['branch'] : '');
									echo '" collegeId=""></div>';
								}
							?>
							
							
						</div>
						<div class="panel-footer">&copy; 2016</div>
					</div>
			</div>
				
		<div class="col-md-1 hidden-xs"></div>
	</div>
</div>

<script type="text/javascript" src="../assets/products.js"></script>
<?php include('../template/footer.php');?>
