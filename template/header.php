<?php 
		include('../config/setup.php');
?>

<!DOCTYPE html>
<html>
	<head>
            <title><?php echo $page_title.' | '.$site_title?></title>
            <!-- Required meta tags -->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="google-signin-client_id" content="408585403119-p6qopkc5tqe176ia0mbs4l939u9l5qdr.apps.googleusercontent.com">
			
			<meta property="og:site_name" content="Odekh">
			<meta property="og:title" content="<?php echo $site_title; ?>" />
			<meta property="og:description" content="Rent Unlimited Books and get delivered at your doorstep" />
			<meta property="og:image" itemprop="image" content="http://www.odekh.com/assets/images/ccav-header.png">
			<meta property="og:type" content="website" />

			<link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
            <?php 
			include('../config/css.php'); ?>
			<!-- JQuery -->
			<script src="/assets/jquery-3.2.1.min.js"></script>
			
			Google Analysis
			<script>
				  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

				  ga('create', 'UA-102453101-1', 'auto');
				  ga('send', 'pageview');

			</script>
			
            
       </head>
			
	<body>
                <!--Navigation-->
                <?php include('../template/navigation.php');?>
                <!--Navigation Ends-->