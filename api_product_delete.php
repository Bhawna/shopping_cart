<?php
ob_start();
include './database/product_db.php';
include './model/productmodel.php';

if(isset($_REQUEST['product_id'])){
    try{
	    $response=array();
	    $details=new Productmodel();
	    $details->setProductid($_REQUEST['product_id']);
	    $dbproduct=new Productdb();
	    $data=$dbproduct->DeleteProduct($details);
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