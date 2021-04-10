<?php
	
	if(isset($newArrivals)){
		$products=$books->getnewArrivals();
		$slider_title="New Arrivals";
	}elseif(isset($added)){
		$products=$books->getRecentlyAdded();
		$slider_title="Recently Added";
	}elseif(isset($popular)){
		$products=$books->getMostPopular();
		$slider_title="Most Popular";
	}
?>
<link rel="stylesheet" href="assets/carousel.css" media="all"></link>

<!--*-*-*-*-*-*-*-*-*-*- BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->
<div id="adv_gp_products_6_columns_carousel" class="carousel slide six_shows_one_move gp_products_carousel_wrapper" data-ride="carousel" data-interval="3000">

	
	<!--<div class="gp_products_carousel_header">
		<span><?php echo $slider_title;?></span>
		<a href="books" class="pull-right">See more</a>
	</div>
	-->
	

	<!--========= Wrapper for slides =========-->
	<div class="carousel-inner" role="listbox">

		<?php
			$active='active';
			$i=0;
			$product=new Product();
			$cart=new Cart();
			foreach($products as $book){
				$price=$product->getRentalPrice($book['id'],$book['product_category'],$cart->days,null);
				if($i==0){echo '<div class="item active">';}
				else{echo '<div class="item">';}
				echo '<div class="col-xs-12 col-sm-4 col-md-2 gp_products_item">
						<div class="gp_products_inner">
							<div class="gp_products_item_image">
								<a href="#">
									<img src="assets/images/'.$book["image"].'" alt="'.ucwords($book["title"]).'" />
								</a>
							</div>
							<div class="gp_products_item_caption">
								<ul class="gp_products_caption_name">
									<li><a href="#">'.ucwords($book["title"]).'</a></li>
								</ul>
								<ul class="gp_products_caption_rating" style="margin-bottom:50px">
									<!--<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star"></i></li>
									<li><i class="fa fa-star-half-o"></i></li>
									--><li class=""><button productId='.$book['id'].' productCategory="1" id="book" style="float:right;" class="btn btn-danger btn-xs">Add to Cart</button></li><li class="pull-right"><a href="#"> ₹'.$price.'</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>';
			
				$i=$i+1;
			}
		?>
		
	</div>
	<!--======= Navigation Buttons =========-->

	<!--======= Left Button =========-->
	<a class="left carousel-control gp_products_carousel_control_left" href="#adv_gp_products_6_columns_carousel" role="button" data-slide="prev">
		<span class="fa fa-angle-left gp_products_carousel_control_icons" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>

	<!--======= Right Button =========-->
	<a class="right carousel-control gp_products_carousel_control_right" href="#adv_gp_products_6_columns_carousel" role="button" data-slide="next">
		<span class="fa fa-angle-right gp_products_carousel_control_icons" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>

</div> <!--*-*-*-*-*-*-*-*-*-*- END BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->