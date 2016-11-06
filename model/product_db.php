<?php
class Productdb{
	private $db;

	public function __construct(){
 		$this->db = new mysqli('localhost', 'root', '', 'shopping_api');
		if($this->db->connect_errno > 0){
			Throw new Exception;
		}
	} 

	//product list
	public function Productlist(){
		$select="select * from products";
		$detailsarray=array();
		if(!$result=$this->db->query($select)){
			die('There was an error running the query ['.$this->db->error.'] ');	
		}
		else{
			while($row=$result->fetch_object()){
				$details=new Productmodel();
				$details->setProductid($row->product_id);
				$details->setProductname($row->product_name);
				$details->setProductdesc($row->product_desc);
				$details->setProductprice($row->product_price);
				$details->setProductdiscount($row->product_discount);
				$details->setCategoryid($row->category_id);
				$detailsarray[]=$details->ProductArray();
			}
		}
		
		return $detailsarray;
	}
	
	//Insert Product
	public function InsertProduct($details){
		$insert="insert into products(product_name,product_desc,product_price,product_discount,category_id) values('".$details->getProductname()."','".$details->getProductdesc()."','".$details->getProductprice()."','".$details->getProductdiscount()."','".$details->getCategoryid()."')";
		$result=$this->db->query($insert);//die;
		$product_id=$this->db->insert_id;
		if($result && $product_id > 0){
			$details->setProductid($product_id);
		}
		return $details;
	}

	//update Product 
	public function UpdateProduct($details){
		$update="update products set product_name='".$details->getProductname()."',product_desc='".$details->getProductdesc()."',product_price='".$details->getProductprice()."',product_discount='".$details->getProductdiscount()."',category_id='".$details->getCategoryid()."' where product_id='".$details->getProductid()."'";
		$resultupdate=$this->db->query($update);
		if($resultupdate > 0){
			return $details;
		}
	}
	
	//delete product 
	public function DeleteProduct($details){
		$delete="delete from products where product_id='".$details->getProductid()."'";
		$result=$this->db->query($delete);
		if($result > 0){
			return $details;
		}
	}
	
}
?>