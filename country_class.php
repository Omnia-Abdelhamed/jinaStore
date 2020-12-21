<?php
class Countries extends Database{

	//properties
	var $country_name_en,$country_name_ar,$shipping,$taxes;

	//getters
	public function get_country_name_en(){
		return $this ->country_name_en;
	}
	public function get_country_name_ar(){
		return $this ->country_name_ar;
	}
	public function get_shipping(){
		return $this ->shipping;
	}
	public function get_taxes(){
		return $this ->taxes;
	}

	//setters
	public function set_country_name_en($country_name_en){
		$this->country_name_en=trim(filter_var($country_name_en, FILTER_SANITIZE_STRING));
	}
	public function set_country_name_ar($country_name_ar){
		$this->country_name_ar=trim(filter_var($country_name_ar, FILTER_SANITIZE_STRING));
	}
	public function set_shipping($shipping){
		$this->shipping=(float)$shipping;
	}
	public function set_taxes($taxes){
		$this->taxes=(float)$taxes;
	}

	//operations

	//select subcategories
	//select all
	public function select_all(){
		$statement="SELECT * FROM countries ORDER BY country_name_ar ASC";
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}
	
	public function select_all1($country_id){
		$statement="SELECT * FROM countries WHERE country_id != $country_id ORDER BY country_name_ar ASC";
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}


	//select one by subcategory id
	public function select_by_one($country_id){
		$result = parent::runDml("SELECT * FROM countries WHERE country_id = $country_id");
		$row=mysqli_fetch_assoc($result);
		return $row;	
	}

	//select by name 
	public function select_by_name($lang,$country_id=0){
		$name_ar=$this->get_country_name_ar();
		$name_en=$this->get_country_name_en();
		if ($lang=="ar") {
			$statement="SELECT * FROM countries WHERE country_name_ar = '$name_ar' AND country_id != $country_id";
		}elseif ($lang=="en") {
			$statement="SELECT * FROM countries WHERE country_name_en = '$name_en'";
		}
		$result = parent::runDml($statement);
		$count=mysqli_num_rows($result);
		return $count;	
	}
	
	//select user country
	public function select_user_country($user_id){
		$result = parent::runDml("SELECT * FROM user_address INNER JOIN countries ON user_address.user_country=countries.country_id WHERE user_id = $user_id");
		$row=mysqli_fetch_assoc($result);
		return $row;	
	}

	//insert
	public function insert(){
		$name_ar=$this->get_country_name_ar();
		$name_en=$this->get_country_name_en();
		$shipping=$this->get_shipping();
		$taxes=$this->get_taxes();
		$statement="INSERT INTO `countries` (`country_name_ar`,`country_name_en`,`shipping`,`taxes`) VALUES ('$name_ar','$name_en','$shipping','$taxes')";
		$result = parent::runDml($statement);
		return $result;		
	}
	//update
	public function update($country_id){
		$name_ar=$this->get_country_name_ar();
		$name_en=$this->get_country_name_en();
		$shipping=$this->get_shipping();
		$taxes=$this->get_taxes();
		$statement="UPDATE `countries` SET `country_name_ar`='$name_ar',`country_name_en`='$name_en',`shipping`='$shipping',`taxes`='$taxes' WHERE country_id=$country_id";
		$result = parent::runDml($statement);
		return $result;		
	}
}