<?php

	include_once('../functions/user.php');

	if(isset($_POST['get_order'])){
		$user = new User();
		$orderList=$user->getOrders();
		
		echo '<table class="table table-striped">
					<thead>
					  <tr>
						<th>Date</th>
						<th>Order Id</th>
						<th>Amount</th>
						<th>status</th>
					  </tr>
					</thead>
					<tbody>';
		
		
		if($orderList==null){
			echo"<tr><td>No Orders Placed..<td></tr>";
		}else{
			foreach($orderList as $order){
				$dt = new DateTime($order['date']);
				$date = $dt->format('m/d/Y');
				echo '<tr>
							<td>'.$date.'</td>
							<td>'.$order["id"].'</td>
							<td>'.$order["total_amount"].'</td>
							<td>'.$order["status"].'</td>
						  </tr>';	
			}
		}
		echo '</tbody>
				  </table>';
	}
	
	if(isset($_POST['get_delivered_order'])){
		$user = new User();
		$orderList=$user->getDeliveredOrders();
		
		echo '<table class="table">
					<thead>
					  <tr>
						<th>Date</th>
						<th>Order Id</th>
						<th>Title</th>
						<th>Delivery Status</th>
						<th></th>
					  </tr>
					</thead>
					<tbody>';
		
		
		if($orderList==null){
			echo"<tr><td>No Orders to be returned..<td></tr>";
		}else{
			$product=new Product();
			foreach($orderList as $order){
				if($order['delivery_status']!='returned'){
					$dt = new DateTime($order['date']);
					$date = $dt->format('m/d/Y');
					$title=$product->getTitle($order['product_id'],$order['product_category']);
					if($order['delivery_status']=='delivered'){
						$buttonText='Click to return';
						$buttonId='returnProductButton';
						$buttonStyle='';
					}else{
						$buttonText='';
						$buttonId='';
						$buttonStyle='style="display:none"';
					}
					echo '<tr>
								<td>'.$date.'</td>
								<td>'.$order["id"].'</td>
								<td>'.$title.'</td>
								<td>'.ucwords($order["delivery_status"]).'</td>
								<td><button href="#" '.$buttonStyle.' class="btn btn-primary" id="'.$buttonId.'" orderItem="'.$order["order_item"].'" OrderId="'.$order["id"].'">'.$buttonText.'</button></td>
						</tr>';	
				}
			}
		}
		echo '</tbody>
				  </table>';
	}
	
	if(isset($_POST['returnProduct'])){
		$order_item=$_POST['orderItem'];
		
		$order=new Order();
		$user=new User();
		$user->returnProduct($order_item);
		
		if($order->getDeliveryStatus($order_item)=='return_requested'){
			echo"<h4>Return Requested</h4>";
		}else{
			echo"<h4>Book Return Error</h4>";
		}
	}
	//Set Address
	if(isset($_POST['setAddress'])){
		$addressForm = array();
		parse_str($_POST['addressForm'], $addressForm);
		$user=new User();
		$user->setAddress($addressForm['address_line'],$addressForm['city'],$addressForm['pincode'],$addressForm['state']);
		$user->setPhone($addressForm['phone']);
	}
	
?>