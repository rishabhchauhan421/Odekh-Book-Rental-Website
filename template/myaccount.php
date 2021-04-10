<div class="row">
	<!-- Nav SideBar -->
	<div class="col-md-3">
		<nav class="nav-sidebar">
			<ul class="nav tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">My Orders</a></li>
				<li class=""><a href="#tab2" data-toggle="tab">Track Products</a></li>
				<li class=""><a href="#tab3" data-toggle="tab">Manage Address</a></li>
				<li class=""><a href="#tab4" data-toggle="tab">Settings</a></li>                               
			</ul>
		</nav>
	</div>
	
	<!-- Nav Content -->
	<div class="col-md-9">
		<div class="tab-content">
			<div class="tab-pane active text-style" style="overflow-y: auto" id="tab1">
				<h2>My Orders</h2>  
				<div id="getOrders"></div>
			</div>
			<div class="tab-pane text-style" id="tab2">
				<h2>Track Products</h2>  
				<div id="getDeliveredOrders" style="overflow-y: auto"></div>
			</div>
			<div class="tab-pane text-style" id="tab3">
				<h2>Manage Address</h2>
				<div id="manage-address">
					<div class="container-fluid">
						<div class="row">
							<?php include("../template/order_addressform.php"); ?>
						</div>
					</div>
				</div>
			   
			</div>
			<div class="tab-pane text-style" id="tab4">
				<h2>Settings</h2>
				<div id="Setting">
					<div class="jumbotron"><h2>Coming Soon...</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>