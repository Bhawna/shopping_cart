<?php
ob_start();
include './database/cart_db.php';
include './model/cartmodel.php.php';

if(isset($_REQUEST['cart_id'])){
    try{
	    $response=array();
	    $details=new Cartmodel();
	    $details->setCartid($_REQUEST['product_id']);
	    $dbcart=new Cartdb();
	    $data=$dbcart->DeleteCart($details);
	    if($data!=NULL){
 		$response['status']='Success';
	    }else{
		$response['status']='Fail';
	    }	
	}catch (Exception $e){  
		$response['status'] ='500';
		$response['message']='Server error, please try again.';
	}
}else{
	$response['status'] = '402';
    $response['message'] ='All parameters for the API are not passed.';
}
$encoded=json_encode($response);
header('Content-type:application/json');
exit($encoded);
?>