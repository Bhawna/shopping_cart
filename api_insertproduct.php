<?php
ob_start();
include './database/product_db.php';
include './model/productmodel.php';


if(isset($_REQUEST['product_name']) && isset($_REQUEST['product_desc']) && isset($_REQUEST['product_price']) && isset($_REQUEST['product_discount']) &&isset($_REQUEST['category_id'])){
    try{
	    $response=array();
	    $details=new Productmodel();
	    $details->setProductname($_REQUEST['product_name']);
	    $details->setProductdesc($_REQUEST['product_desc']);
	    $details->setProductprice($_REQUEST['product_price']);
	    $details->setProductdiscount($_REQUEST['product_discount']);
	    $details->setCategoryid($_REQUEST['category_id']);
	    $dbproduct=new Productdb();
	    $data=$dbproduct->InsertProduct($details);
	    if($data!=NULL)
	    {
 		$response['status']='Success';
		$response['data']=$details->ProductArray();
		
	    }	
	    else
	    {
		$response['status']='Fail';
	    }	
	}	
	catch (Exception $e)  
	{  
		$response['status'] ='500';
		$response['message']='Server error, please try again.';
	}
} 
else
{
	$response['status'] = '402';
        $response['message'] ='All parameters for the API are not passed.';
}
$encoded=json_encode($response);
header('Content-type:application/json');
exit($encoded);
?>