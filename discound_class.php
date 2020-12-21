<?php
class Discound extends Database{

	//properties
	var $discound_code,$value;

	//getters
	public function get_discound_code(){
		return $this ->discound_code;
	}
	public function get_value(){
		return $this ->value;
	}

	//setters
	public function set_discound_code($discound_code){
		$this->discound_code=trim(filter_var($discound_code, FILTER_SANITIZE_STRING));
	}
	public function set_value($value){
		$this->value=(float)$value;
	}

	//operations

	//select subcategories
	//select all
	public function select_all(){
		$statement="SELECT * FROM discound_codes ORDER BY code_id DESC";
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}


	//select one by discound_code id
	public function select_by_one($code_id){
		$result = parent::runDml("SELECT * FROM discound_codes WHERE code_id = $code_id");
		$row=mysqli_fetch_assoc($result);
		return $row;	
	}
	
	//select discound
	public function select_discound(){
	    $discound_code=$this->get_discound_code();
	    $statement="SELECT * FROM discound_codes WHERE discound_code = $discound_code";
		$result = parent::runDml($statement);
		$row=mysqli_fetch_assoc($result);
		return $row;	
	}
	
	//select by name 
	public function select_by_name($code_id=0){
		$discound_code=$this->get_discound_code();
		$statement="SELECT * FROM discound_codes WHERE discound_code = '$discound_code' AND code_id != $code_id";
		$result = parent::runDml($statement);
		$count=mysqli_num_rows($result);
		return $count;	
	}

	//insert
	public function insert(){
		$discound_code=$this->get_discound_code();
		$value=$this->get_value();
		$statement="INSERT INTO `discound_codes` (`discound_code`,`value`) VALUES ('$discound_code','$value')";
		$result = parent::runDml($statement);
		return $result;		
	}
	//update
	public function update($code_id){
		$discound_code=$this->get_discound_code();
		$value=$this->get_value();
		$statement="UPDATE `discound_codes` SET `discound_code`='$discound_code',`value`='$value' WHERE code_id=$code_id";
		$result = parent::runDml($statement);
		return $result;		
	}
}