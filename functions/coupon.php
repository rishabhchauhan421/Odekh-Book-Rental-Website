<?php
class Coupon{
	
	function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $database = new Database();
			$this->db=$database->getConnection();
        }
    }
	
	function isCouponExists(){
		if(isset($_SESSION['odekh-coupon'])){
			return true;
		}else{
			return false;
		}
	}
	function getCoupon(){
		if(isset($_SESSION['odekh-coupon'])){
			return $_SESSION['odekh-coupon'];
		}else{
			return null;
		}
	}
	
	function applyCoupon($code,$user_id){
		$this->setCoupon($code,$user_id);
	}
	
}

?>