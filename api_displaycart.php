<?php
ob_start();
include './database/cart_itemsdb.php';
include './model/cartitemsmodel.php';

	try
	{
		$response=array();
		$details=new Cartitemsmodel();
		$cartlist=new Cartitemsdb();
		$aa=$cartlist->Displaycartitems();
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