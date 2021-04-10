<?php 
	$page_title="Pricing";
	include('../template/header.php'); 
?>
<link rel="stylesheet" href="/assets/pricing.css">
<div class="container-fluid" id="pricing">
	<section class="section">
			<div class="section-headlines text-center">
				<h2>Pricing Plan</h2>
				<p>We Provide a number of plans customised to your needs.</p>
			</div>

			<div class="pricing-table row-fluid text-center">
				<div class="row">
					<div class="col-sm-6">
						<div class="span4">
							<div class="plan">
								<div class="plan-name">
									<h2>Basic</h2>
									<p class="muted">Perfect for slow reader</p>
								</div>
								<div class="plan-price">
									<b>₹0</b> / month
								</div>
								<div class="plan-details">
									
									<div>
										<b>Individual</b> Rental
									</div>
									<div>
										<b>Unlimited</b> Books
									</div>
									<div>
										<b>₹30</b> Shipping
									</div>
									<div>
										<b>limited</b> Support
									</div>
									<div>
										<b>Per book</b> Security required
									</div>
								</div>
								<div class="plan-action">
									<a href="products.php" style="color:black"><Button productCategory="2" productId="" class="btn btn-block btn-large">Choose Plan</Button></a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="span4">
							<div class="plan prefered">
								<div class="plan-name">
									<h2>Fixed Rental</h2>
									<p class="muted">Perfect for avid-readers</p>
								</div>
								<div class="plan-price">
									₹<del>299</del> <b>₹199</b> / month
								</div>
								<div class="plan-details">
									
									<div>
										<b>No</b> Rental
									</div>
									<div>
										<b>Unlimited</b> Orders (2 books at once)
									</div>
									<div>
										<b>Free</b> Priority Shipping
									</div>
									<div>
										<b>24*7</b> Support
									</div>
									<div>
										<b>Per book</b> Security required
									</div>
								</div>
								<div class="plan-action">
									<Button id="plan" href="#" productCategory="2" productId="1" class="btn btn-block btn-large">Choose Plan</Button>
								</div>
									<!--<form method="POST" action="<?php echo htmlspecialchars("processorder.php")?>">
										<input type="hidden" name="membershipId" value="1">
										<input type="hidden" name="membershipTitle" value="PL200">
										<input type="submit" name="submit" value="Choose Plan" class="btn btn-success btn-block btn-large">
									</form>-->
								</div>
							</div>
						</div>
					</div>
					<!--
					<div class="col-sm-4">
						<div class="span4">
							<div class="plan">
								<div class="plan-name">
									<h2>Advance</h2>
									<p class="muted">Perfect for re-readers</p>
								</div>
								<div class="plan-price">
									<b>₹300</b> / month
								</div>
								<div class="plan-details">
									<div>
										<b>4</b> Books/Order Maximum
									</div>
									<div>
										<b>Unlimited</b> Orders
									</div>
									<div>
										<b>Free</b> Priority Shipping
									</div>
									<div>
										<b>24/7</b> Support
									</div>
									<div>
										<b>₹500</b> Refundable Security
									</div>
								</div>
								<div class="plan-action">
									<Button id="plan" href="#" productCategory="2" productId="2" class="btn btn-block btn-large">Choose Plan</Button>
								</div>
							</div>
						</div>
					</div>
					-->
				</div>
				
			</div>
				
			<p class="muted text-center">Note: You can cancel your plan at anytime in your account settings.</p>
			<p class="muted text-center">Note: Standard Members must add money to wallet if they require book which has refundable security more than available wallet balance.</p>
			
	</section>
</div>
<script src="assets/pricing.js"></script>

<?php include('../template/footer.php'); ?>