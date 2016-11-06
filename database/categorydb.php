<?php
class Categorydb{
	private $db;

	public function __construct(){
 		$this->db = new mysqli('localhost', 'root', '', 'shopping_api');
		if($this->db->connect_errno > 0){
			Throw new Exception;
		}
	} 

	//category list
	public function Categorylist(){
		$select="select * from categories";
		$detailsarray=array();
		if(!$result=$this->db->query($select)){
			die('There was an error running the query ['.$this->db->error.'] ');	
		}
		else{
			while($row=$result->fetch_object()){
				$details=new Categorymodel();
				$details->setCategoryid($row->category_id);
				$details->setCategoryname($row->category_name);
				$details->setCategorydesc($row->category_desc);
				$details->setCategorytax($row->category_tax);
				$detailsarray[]=$details->CategoryArray();
			}
		}
		
		return $detailsarray;
	}

		
	//Insert Category
	public function InsertCategory($details){
		$insert="insert into categories(category_name,category_desc,category_tax) values('".$details->getCategoryname()."','".$details->getCategorydesc()."','".$details->getCategorytax()."')";
		$result=$this->db->query($insert);//die;
		$category_id=$this->db->insert_id;
		if($result && $category_id > 0){
			$details->setCategoryid($category_id);
		}
		return $details;
	}

	//update category 
	public function UpdateCategory($details){
		$update="update categories set category_name='".$details->getCategoryname()."',category_desc='".$details->getCategorydesc()."',category_tax='".$details->getCategorytax()."' where category_id='".$details->getCategoryid()."'";//exit;
		$resultupdate=$this->db->query($update);
		if($resultupdate > 0){
			return $details;
		}
	}
	
	//delete Category 
	public function Categorydelete($details){
		$delete="delete from categories where category_id='".$details->getCategoryid()."'";
		$result=$this->db->query($delete);
		if($result > 0){
			return $details;
		}
	}
	
}
?>