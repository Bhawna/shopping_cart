<?php
ob_start();
include './database/cart_db.php';
include './model/cartmodel.php.php';

if(isset($_REQUEST['cart_name']) && isset($_REQUEST['cart_products']) && isset($_REQUEST['cart_total']) && isset($_REQUEST['cart_total_discount']) && isset($_REQUEST['cart_with_total_discount']) && isset($_REQUEST['cart_total_tax']) && isset($_REQUEST['cart_with_total_tax']) && isset($_REQUEST['cart_grand_total']) && isset($_REQUEST['cart_id'])){
    try{
	    $response=array();
	    $details=new Cartmodel();
	    $details->setCartid($_REQUEST['cart_id']);
	    $details->setCartname($_REQUEST['cart_name']);
	    $details->setCartproducts($_REQUEST['cart_products']);
	    $details->setCarttotal($_REQUEST['cart_total']);
	    $details->setCarttotaldiscount($_REQUEST['cart_total_discount']);
	    $details->setCartwithtotaldiscount($_REQUEST['cart_with_total_discount']);
	    $details->setCarttotaltax($_REQUEST['cart_total_tax']);
	    $details->setCartwithtotaltax($_REQUEST['cart_with_total_tax']);
	    $details->setCartgrandtotal($_REQUEST['cart_grand_total']);
	    $dbcart=new Cartdb();
	    $data=$dbcart->UpdateCart($details);
	    if($data!=NULL){
 		$response['status']='Updated Successfuly.';
		}else{
		$response['status']='Fail';
	    }	
	}
	catch (Exception $e){  
		$response['status'] ='500';
		$response['message']='Server error, please try again.';
	}
} 
else{
	$response['status'] = '402';
        $response['message'] ='All parameters for the API are not passed.';
}
$encoded=json_encode($response);
header('Content-type:application/json');
exit($encoded);
?>