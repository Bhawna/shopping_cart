<?php
ob_start();
include './database/categorydb.php';
include './model/categorymodel.php';

if(isset($_REQUEST['category_id'])){
    try{
	    $response=array();
	    $details=new Categorymodel();
	    $details->setCategoryid($_REQUEST['category_id']);
	    $dbcategory=new Categorydb();
	    $data=$dbcategory->Categorydelete($details);
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