<?php
ob_start();
include './database/cart_itemsdb.php';
include './model/cartitemsmodel.php';


if(isset($_REQUEST['product_id']) && isset($_REQUEST['product_qty']) && isset($_REQUEST['product_price'])){
    try{
	    $response=array();
	    $details=new Cartitemsmodel();
	    $details->setProductid($_REQUEST['product_id']);
	    $details->setProductqty($_REQUEST['product_qty']);
	    $details->setProductprice($_REQUEST['product_price']);
	    $dbcartitems=new Cartitemsdb();
	    $data=$dbcartitems->InsertCartItems($details);
	    if($data!=NULL)
	    {
 		$response['status']='Success';
		$response['data']=$details->CartitemsArray();
		
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