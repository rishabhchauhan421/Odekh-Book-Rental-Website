<div class="container" ng-app="advicePage" ng-controller="adviceController">
		<h2>Best Books on subjects</h2>  
					
		<div class="panel-group" id="adviceAccordion" ng-repeat="advice in advice_product">
			<div class="panel panel-default ">
				<div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#adviceAccordion" data-target="#{{advice.id}}">
					 <h4 class="panel-title">
						<a href="#" class="ing">{{advice.title}}</a>
				  </h4>

				</div>
				<div id="{{advice.id}}" class="panel-collapse collapse">
					<div class="panel-body" style="padding:0px">
						<table class="table table-responsive"style="margin-bottom:0px">
							<thead>
							  <tr>
								<th>Beginner</th>
								<th>Advanced</th>
								<th>Expert</th>
							  </tr>
							</thead>
							<tbody>
								<tr>
									<td>{{advice.beginner}}</td>
									<td>{{advice.advanced}}</td>
									<td>{{advice.expert}}</td>
								</tr>
							 </tbody>
						  </table>
						<p>{{advice.answer}}</p>
					</div>
				</div>
			</div>
		</div>
</div>