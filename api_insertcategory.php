<?php
ob_start();
include './database/categorydb.php';
include './model/categorymodel.php';


if(isset($_REQUEST['category_name']) && isset($_REQUEST['category_desc']) && isset($_REQUEST['category_tax'])){
    try{
	    $response=array();
	    $details=new Categorymodel();
	    $details->setCategoryname($_REQUEST['category_name']);
	    $details->setCategorydesc($_REQUEST['category_desc']);
	    $details->setCategorytax($_REQUEST['category_tax']);
	    $dbcategory=new Categorydb();
	    $data=$dbcategory->InsertCategory($details);
	    if($data!=NULL)
	    {
 		$response['status']='Success';
		$response['data']=$details->CategoryArray();
		
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