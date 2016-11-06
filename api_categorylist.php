<?php
ob_start();
include './database/categorydb.php';
include './model/categorymodel.php';

	try
	{
		$response=array();
		$details=new Categorymodel();
		$category=new Categorydb();
		$aa=$category->Categorylist();
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