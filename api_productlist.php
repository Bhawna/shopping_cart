<?php
ob_start();
include './database/product_db.php';
include './model/productmodel.php';

	try
	{
		$response=array();
		$details=new Productmodel();
		$product=new Productdb();
		$aa=$product->Productlist();
		if($aa!=NULL)
		{
			$response['status']='Success';
			$response['data']=$aa;
		}
		else
		{
			$response['status']='Fail.';
		}
	}
	catch (Exception $e)  
        {  
        		$response['status'] ='500';
                	$response['message']='Server error, please try again.';
        } 


$encoded=json_encode($response);
header('Content-type:application/json');
exit($encoded);
?>