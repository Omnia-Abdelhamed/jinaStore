<?php
class Subcategories extends Database{

	//properties
	var $subcategory_name_en,$subcategory_name_ar,$category_id;

	//getters
	public function get_subcategory_name_en(){
		return $this ->subcategory_name_en;
	}
	public function get_subcategory_name_ar(){
		return $this ->subcategory_name_ar;
	}
	public function get_category_id(){
		return $this ->category_id;
	}

	//setters
	public function set_subcategory_name_en($subcategory_name_en){
		$this->subcategory_name_en=trim(filter_var($subcategory_name_en, FILTER_SANITIZE_STRING));
	}
	public function set_subcategory_name_ar($subcategory_name_ar){
		$this->subcategory_name_ar=trim(filter_var($subcategory_name_ar, FILTER_SANITIZE_STRING));
	}
	public function set_category_id($category_id){
		$this->category_id=$category_id;
	}

	//operations

	//select subcategories
	//select all
	public function select_all($order="ASC"){
		if ($order=="DESC") {
			$statement="SELECT * FROM subcategories INNER JOIN categories ON categories.category_id = subcategories.category_id ORDER BY subcategory_id DESC";
		}else{
			$statement="SELECT * FROM subcategories INNER JOIN categories ON categories.category_id = subcategories.category_id";
		}
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}

	//select by category
	public function select_by_category($category_id,$order="ASC"){
		if ($order=="DESC") {
			$statement="SELECT * FROM subcategories INNER JOIN categories ON categories.category_id = subcategories.category_id WHERE subcategories.category_id = $category_id ORDER BY subcategory_id DESC";
		}else{
			$statement="SELECT * FROM subcategories INNER JOIN categories ON categories.category_id = subcategories.category_id WHERE subcategories.category_id = $category_id";
		}
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}

	//select one by subcategory id
	public function select_by_one($subcategory_id){
		$result = parent::runDml("SELECT * FROM subcategories INNER JOIN categories ON categories.category_id = subcategories.category_id WHERE subcategory_id = $subcategory_id");
		$row=mysqli_fetch_assoc($result);
		return $row;	
	}

	//select by name 
	public function select_by_name($lang,$subcategory_id=0){
		$name_ar=$this->get_subcategory_name_ar();
		$name_en=$this->get_subcategory_name_en();
		if ($lang=="ar") {
			$statement="SELECT * FROM subcategories WHERE subcategory_name_ar = '$name_ar' AND subcategory_id != $subcategory_id";
		}elseif ($lang=="en") {
			$statement="SELECT * FROM subcategories WHERE subcategory_name_en = '$name_en'";
		}
		$result = parent::runDml($statement);
		$count=mysqli_num_rows($result);
		return $count;	
	}

	//insert
	public function insert(){
		$name_ar=$this->get_subcategory_name_ar();
		$name_en=$this->get_subcategory_name_en();
		$category_id=$this->get_category_id();
		$statement="INSERT INTO `subcategories` (`subcategory_name_ar`,`subcategory_name_en`,`category_id`) VALUES ('$name_ar','$name_en','$category_id')";
		$result = parent::runDml($statement);
		return $result;		
	}
	//update
	public function update($subcategory_id){
		$name_ar=$this->get_subcategory_name_ar();
		$name_en=$this->get_subcategory_name_en();
		$category_id=$this->get_category_id();
		$statement="UPDATE `subcategories` SET `subcategory_name_ar`='$name_ar',`subcategory_name_en`='$name_en',`category_id`='$category_id' WHERE subcategory_id=$subcategory_id";
		$result = parent::runDml($statement);
		return $result;		
	}
}