<!--$address variable has address if address exists-->
<div id="cart_container" class="container">
	<?php include('../template/membership_panel.php');?>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Note: One user can only order 2 products at once.</div>
		</div>
		<div id="cart" class="panel panel-primary">
			<div class="panel-heading">
				Cart Checkout
			</div>
			<div class="panel-body">
				
					<div id="cart_checkout">
						
					</div>
				</table>
			</div>
			<div class="panel-footer">
				<div class="row">
					<!--<div class="col-xs-6">
						<form class="form-inline" method="POST" action="cart.php">
							<input type="text" id="coupon-input" name="coupon-input" class="form-control btn" placeholder="Coupon Code" style="max-width:150px;min-width:150px" <?php if((new User())->isCartEmpty()){ echo "disabled";}?> >
							<input type="submit" id="coupon-submit" name="coupon-submit" class="btn btn-primary btn-footer-cart">
						</form>
					</div>
					<div class="col-xs-6">
					-->
					
					<input type="submit" hidden name="payment-select-button"  name="payment-select-button">
					
					<button data-toggle="modal" data-target="#address-dialog" id="confirm-address-popup-button" class="btn btn-primary btn-footer-cart pull-right" >Place Order</button>
					
				</div>
			</div>
		</div>
	</div>
	<p class="muted text-center">Note: Wallet balance if used will be credited to your account when product is returned.</p>
		
		<!--Delivery Address Modal-->
	<div class="modal fade" id="address-dialog" tabindex="-1" role="dialog" aria-labelledby="address-modal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Submit Address</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
					  <div class="row">
							  <form class="form-horizontal" id="addressForm" name="addressForm" role="form" >

								  <!-- Text input-->
								  <div class="form-group">
									<label class="col-sm-2 control-label" for="textinput">Line 1</label>
									<div class="col-sm-10">
									  <input type="text" placeholder="Address Line" name="address_line" class="form-control" value="<?php if(isset($address)){echo $address['address_line'];}?>">
									</div>
								  </div>
								  <!-- Text input-->
								  <div class="form-group">
									<label class="col-sm-2 control-label" for="textinput">City</label>
									<div class="col-sm-10">
									  <input type="text" placeholder="City" name="city" class="form-control" value="<?php if(isset($address)){echo $address['city'];}?>">
									</div>
								  </div>

								  <!-- Text input-->
								  <div class="form-group">
									<label class="col-sm-2 control-label" for="textinput">State</label>
									<div class="col-sm-4">
									  <input type="text" placeholder="State" name="state" class="form-control" value="<?php if(isset($address)){echo $address['state'];}?>">
									</div>

									<label class="col-sm-2 control-label" for="textinput">Pincode</label>
									<div class="col-sm-4">
									  <input type="text" placeholder="Post Code" name="pincode" class="form-control" value="<?php if(isset($address)){echo $address['pincode'];}?>">
									</div>
								  </div>



								  <!-- Text input-->
								  <div class="form-group">
									<label class="col-sm-2 control-label" for="textinput">Country</label>
									<div class="col-sm-10">
									  <input type="text" placeholder="Country" name="Country" class="form-control" value="India" disabled>
									</div>
								  </div>
								  
								  <!-- Text input-->
								  <div class="form-group">
									<label class="col-sm-2 control-label" for="textinput">Phone Number</label>
									<div class="col-sm-10">
									  <input type="text" placeholder="Phone Number" name="phone" class="form-control" value="<?php if(isset($address)){echo $address['phone'];}?>"">
									</div>
								  </div>

								  

							  </form><!-- /.col-lg-12 -->
								<form class="form-horizontal" id="payment" name="addressForm" role="form" >

									<div class="form-group">
									<label class="col-sm-2 control-label" for="textinput">Payment Options</label>
									<div class="col-sm-10">
										<select id="payment-select" name="payment-select" class="form-control" <?php if((new User())->isCartEmpty()){ echo "disabled";}?> >
											<option value="0" disabled selected>Payment Options</option>
											<option value="1">Online Payment</option>
											<option value="2">Cash on Delivery</option>
										</select>
									</div>
								  </div>
								  
									
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
										  <div class="pull-right">
											<button id="process_order_button" disabled class="btn btn-primary">Place Order</button>
										  </div>
										</div>
									</div>
								</form>
						</div><!-- /.row -->
				</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Modal Ends-->

	</div>
</div>