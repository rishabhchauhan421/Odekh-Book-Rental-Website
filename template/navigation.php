<?php 
	include_once('../functions/cart.php');
	include_once('../functions/user.php');	
?>
<div class="container" id="contact-us-header">
	<div class="row">
		<div class="col-sm-8"></div>
		<div class="col-sm-4">
			<p>Support: help@odekh.com, ph: 8802742214</p>
		</div>
	</div>
</div>
<div class="navbar-wrapper">
	<div class="container nav-container">
		<nav class="navbar navbar-default">
			<div class="navbar-inner">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>
				<a class="navbar-brand" id="site-title" href="/">Odekh</a>
				<form  method="get" action="products.php" class="navbar-form navbar-brand navbar-left" id="nav-form">
					<div id="nav_search_form" class="input-group" >
						<input id="search" size="30" type="text" name="search" class="form-control" placeholder="Search Books, Authors" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
						<span class="input-group-btn">
							<button  type="submit" class="btn btn-default" onclick="document.getElementById('nav-form').submit();" id="search_button"><span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</form>
				
			</div>
			
			<div class="collapse navbar-collapse" id="myNavbar">
				
				<ul class="nav navbar-nav navbar-right">
					
					<li <?php if($page_title=="Books") echo "class='active'"?>><a href="products.php?category=1"><span class=" nav-icon fa fa-book fa-2x"><span class="hidden-sm hidden-md hidden-lg"> Books</span></span></a></li>
					<li <?php if($page_title=="Collection") echo "class='active'"?>><a href="products.php?category=3"><span class=" nav-icon fa fa-gift fa-2x"><span class="hidden-sm hidden-md hidden-lg"> Collection<span></span></a></li>
					<li><a href="pricing.php"><i class="fa fa-money fa-2x" aria-hidden="true"><span class="hidden-sm hidden-md hidden-lg"> Membership<span></i></a></li>
					
					
					<li ><a href="cart.php"><span class="nav-icon glyphicon glyphicon-shopping-cart fa-2x"></span> <span class="badge" id="cart"><?php echo (new Cart())->getTotalItems();?></span><span class="fa-2x hidden-sm hidden-md hidden-lg"> Cart</span></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class=" nav-icon fa fa-user-circle-o fa-2x"></span></a>
						<ul class="dropdown-menu">
							<?php
								$user=new User();
								if(isset($_SESSION['firstname'])){
									echo '<li><a href="myaccount.php"><span class="glyphicon glyphicon-user"></span> '.ucfirst($_SESSION["firstname"]).'</a></li>';
									echo '<li><a href="#"><span class="fa fa-credit-card-alt"></span> Balance: '.(new User())->getWalletBalance().'</a></li>';
									echo '<li><a href="logout.php"><span class="fa fa-sign-out"></span> Log Out</a></li>';
								}else{
									echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
									echo '<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
								}
							?>
						</ul>
					</li>
				</ul>
		  </div>
		</nav>      
	</div>  
</div>