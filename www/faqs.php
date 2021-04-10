<?php 
	$page_title="FAQs";
	include('../template/header.php'); 
?>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="../assets/faqs.js"></script>

<div class="container" ng-app="faqsPage" ng-controller="faqsController">
	<div class="row">
		<!-- Nav SideBar -->
		
		<nav class="nav-sidebar">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">My Orders</a></li>
				<li class=""><a href="#tab2" data-toggle="tab">Membership</a></li>
				<li class=""><a href="#tab3" data-toggle="tab">My Account</a></li>
				<li class=""><a href="#tab4" data-toggle="tab">Delivery</a></li>
				<li class=""><a href="#tab5" data-toggle="tab">Payment</a></li>                               
			</ul>
		</nav>
	
		
		<!-- Nav Content -->
			<div class="tab-content">
				<div class="tab-pane active text-style" id="tab1">
					<h2>My Orders</h2>  
					<div id="faqs_general">
						<div class="panel-group" id="faqAccordion" ng-repeat="faq in faqs_general">
							<div class="panel panel-default ">
								<div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#{{faq.id}}">
									 <h4 class="panel-title">
										<a href="#" class="ing">{{faq.question}}</a>
								  </h4>

								</div>
								<div id="{{faq.id}}" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
										 <h5><span class="label label-primary">Answer</span></h5>

										<p>{{faq.answer}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane text-style" id="tab2">
					<h2>Membership</h2>  
					<div id="faqs_membership">
						<div class="panel-group" id="faqAccordion" ng-repeat="faq in faqs_membership">
							<div class="panel panel-default ">
								<div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#{{faq.id}}">
									 <h4 class="panel-title">
										<a href="#" class="ing">{{faq.question}}</a>
								  </h4>

								</div>
								<div id="{{faq.id}}" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
										 <h5><span class="label label-primary">Answer</span></h5>

										<p>{{faq.answer}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane text-style" id="tab3">
					<h2>My Account</h2>
					<div id="faqs_myaccount">
						<div class="panel-group" id="faqAccordion" ng-repeat="faq in faqs_myaccount">
							<div class="panel panel-default ">
								<div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#{{faq.id}}">
									 <h4 class="panel-title">
										<a href="#" class="ing">{{faq.question}}</a>
								  </h4>

								</div>
								<div id="{{faq.id}}" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
										 <h5><span class="label label-primary">Answer</span></h5>

										<p>{{faq.answer}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				   
				</div>
				
				<div class="tab-pane text-style" id="tab4">
					<h2>Delivery</h2>
					<div id="faq_delivery">
						<div class="panel-group" id="faqAccordion" ng-repeat="faq in faqs_delivery">
							<div class="panel panel-default ">
								<div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#{{faq.id}}">
									 <h4 class="panel-title">
										<a href="#" class="ing">{{faq.question}}</a>
								  </h4>

								</div>
								<div id="{{faq.id}}" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
										 <h5><span class="label label-primary">Answer</span></h5>

										<p>{{faq.answer}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane text-style" id="tab5">
					<h2>Payment</h2>
					<div id="faq_payment">
						<div class="panel-group" id="faqAccordion" ng-repeat="faq in faqs_payment">
							<div class="panel panel-default ">
								<div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#{{faq.id}}">
									 <h4 class="panel-title">
										<a href="#" class="ing">{{faq.question}}</a>
								  </h4>

								</div>
								<div id="{{faq.id}}" class="panel-collapse collapse" style="height: 0px;">
									<div class="panel-body">
										 <h5><span class="label label-primary">Answer</span></h5>

										<p>{{faq.answer}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
    
    <!--/panel-group-->
</div>

<?php include('../template/footer.php'); ?>