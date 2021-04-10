<link rel="stylesheet" href="assets/homepage.css"><link rel="stylesheet" href="assets/offer.css">
<?php 

	include_once('../template/carousel.php');
	include_once('../functions/book.php');
	$books = new Book();
	
?>
<div class="container-fluid">
	<div class="row">
		<div class="container-fluid theme_columns_carousel">
			<h1>New Arrivals <span class="pull-right"><a href="products.php" class=" btn btn-success">more</a></span></h1>
		</div>
		<?php 
			$newArrivals=true;
			include('../template/cart_slider.php');
			unset($newArrivals);
		?>
    </div>
	<div class="row">
		<div class="container-fluid theme_columns_carousel">
			<h1>Complete Collection of Books <span class="pull-right"><a href="products.php" class=" btn btn-success">more</a></span></h1>
		</div>
		<div id="adv_gp_products_6_columns_carousel" class="carousel slide six_shows_one_move gp_products_carousel_wrapper">
	
			<!--========= Wrapper for slides =========-->
			<div class="carousel-inner" role="listbox">
				<div class="row">

					<div class="col-sm-3">
						<a href="products.php?search=chetan+bhagat">
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										full								
									</div>
								</div>
								<div class="offer-content">
									<h3 class="lead">
										Chetan Bhagat
									</h3>
									<p class="hidden">
										Chetan Bhagat is an Indian author, columnist and motivational speaker, known for his English-language dramedy novels about young urban middle-class Indians.
									</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-3">
						<a href="products.php?search=dan+brown">
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										full								
									</div>
								</div>
								<div class="offer-content">
									<h3 class="lead">
										Dan Brown
									</h3>
									<p class="hidden">
										Daniel Gerhard "Dan" Brown is an American author of thriller fiction, most notably the novels Angels & Demons, The Da Vinci Code, and Inferno.
									</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-3">
						<a href="products.php?search=e+l+james">
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										full								
									</div>
								</div>
								<div class="offer-content">
									<h3 class="lead">
										E L James
									</h3>
									<p class="hidden">
										Erika Mitchell, known by her pen name E. L. James, is an English author. She wrote the bestselling erotic romance trilogy Fifty Shades of Grey, Fifty Shades Darker, and Fifty Shades Freed.
									</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-3">
						<a href="products.php?search=amish+tripathi">
							<div class="offer offer-success">
								<div class="shape">
									<div class="shape-text">
										full								
									</div>
								</div>
								<div class="offer-content">
									<h3 class="lead">
										Amish Tripathi
									</h3>
									<p class="hidden">
										Amish Tripathi, is an Indian author, known for his novels The Immortals of Meluha, The Secret of the Nagas, The Oath of the Vayuputras, Scion of Ikshvaku and Sita: Warrior of Mithila.
									</p>
								</div>
							</div>
						</a>
					</div>
				</div>

			</div>
				
		</div>
	<div class="row">
		<div class="container-fluid theme_columns_carousel">
			<h1>Most Popular <span class="pull-right"><a href="products.php" class=" btn btn-success">more</a></span></h1>
		</div>
		<?php 
			$popular=true;
			include('../template/cart_slider.php');
			unset($popular);
		?>
    </div>
	<div class="row">
			<img class="img img-responsive" src="assets/images/banner-02.jpg">
		
	</div>
	<div class="row">
		<div class="container-fluid theme_columns_carousel">
			<h1>Recently Added <span class="pull-right"><a href="products.php" class=" btn btn-success">more</a></span></h1>
		</div>
		<?php 
			$added=true;
			include("../template/cart_slider.php");
			unset($added);
		?>
	</div>
	<div class="row">
		<img class="img img-responsive" src="assets/images/banner-01.jpg">
	</div>
</div>

<script type="text/javascript" src="../assets/cart_slider.js"></script>