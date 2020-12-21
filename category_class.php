<?php
class Categories extends Database{

	//properties
	var $category_name_en,$category_name_ar,$category_image;

	//getters
	public function get_category_name_en(){
		return $this->category_name_en;
	}
	public function get_category_name_ar(){
		return $this->category_name_ar;
	}
	public function get_category_image(){
		return $this->category_image;
	}

	//setters
	public function set_category_name_en($category_name_en){
		$this->category_name_en=trim(filter_var($category_name_en, FILTER_SANITIZE_STRING));
	}
	public function set_category_name_ar($category_name_ar){
		$this->category_name_ar=trim(filter_var($category_name_ar, FILTER_SANITIZE_STRING));
	}
	public function set_category_image($category_image){
		$this->category_image=$category_image;
	}

	//operations

	//select categories
	public function select_all($order="ASC",$category_id=0){
		if ($order=="ASC") {
			$statement="SELECT * FROM categories WHERE category_id != $category_id";
		}elseif ($order=="DESC") {
			$statement="SELECT * FROM categories WHERE category_id != $category_id ORDER BY category_id DESC";
		}else{
			$statement="SELECT * FROM categories";
		}
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}

	//select one by id
	public function select_by_one($category_id){
		$result = parent::runDml("SELECT * FROM categories WHERE category_id = $category_id");
		$row=mysqli_fetch_assoc($result);
		return $row;	
	}

	//select by name 
	public function select_by_name($lang,$category_id=0){
		$name_ar=$this->get_category_name_ar();
		$name_en=$this->get_category_name_en();
		if ($lang=="ar") {
			$statement="SELECT * FROM categories WHERE category_name_ar = '$name_ar' AND category_id != $category_id";
		}elseif ($lang=="en") {
			$statement="SELECT * FROM categories WHERE category_name_en = '$name_en'";
		}
		$result = parent::runDml($statement);
		$count=mysqli_num_rows($result);
		return $count;	
	}

	//insert
	public function insert(){
		$name_ar=$this->get_category_name_ar();
		$name_en=$this->get_category_name_en();
		$image=$this->get_category_image();
		$statement="INSERT INTO `categories` (`category_name_en`,`category_name_ar`,`category_image`) VALUES ('$name_en','$name_ar','$image')";
		$result = parent::runDml($statement);
		return $result;		
	}

	//update
	public function update($category_id){
		$name_ar=$this->get_category_name_ar();
		$name_en=$this->get_category_name_en();
		$image=$this->get_category_image();
		$statement="UPDATE `categories` SET `category_name_ar`='$name_ar',`category_name_en`='$name_en',`category_image`='$image' WHERE category_id=$category_id";
		$result = parent::runDml($statement);
		return $result;		
	}


}