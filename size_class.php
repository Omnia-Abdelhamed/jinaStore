<?php
class Sizes extends Database{

	//properties
	var $size_id,$size_title;

	//getters
	public function get_size_id(){
		return $this ->size_id;
	}
	public function get_size_title(){
		return $this ->size_title;
	}

	//setters
	public function set_size_id($size_id){
		$this->size_id=$size_id;
	}
	public function set_size_title($size_title){
		$this->size_title=trim(filter_var($size_title, FILTER_SANITIZE_STRING));
	}

	//operations

	//select one by subcategory id
	public function select_by_one($size_id){
		$result = parent::runDml("SELECT * FROM sizes WHERE size_id = $size_id");
		$row=mysqli_fetch_assoc($result);
		return $row;	
	}

	//select by name 
	public function select_by_the_size($size_id=0){
		$size_title=$this->get_size_title();
		$statement="SELECT * FROM sizes WHERE size_title = '$size_title' AND size_id != $size_id";
		$result = parent::runDml($statement);
		$count=mysqli_num_rows($result);
		return $count;	
	}

	//insert
	public function insert(){
		$size_title=$this->get_size_title();
		$statement="INSERT INTO `sizes` (`size_title`) VALUES ('$size_title')";
		$result = parent::runDml($statement);
		return $result;		
	}
	//update
	public function update($size_id){
		$size_title=$this->get_size_title();
		$statement="UPDATE `sizes` SET `size_title`='$size_title' WHERE size_id=$size_id";
		$result = parent::runDml($statement);
		return $result;		
	}
}