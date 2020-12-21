<?php
class Users extends Database{

	//properties
	var $user_id,$user_email,$user_fullname,$password,$user_phone,$user_gender,$regesteration_date;
	var $user_country,$user_city,$user_area,$user_block,$user_street,$user_house,$user_number,$user_notes;

	//getters
	public function get_user_id(){
		return $this->user_id;
	}
	public function get_user_email(){
		return $this->user_email;
	}
	public function get_user_fullname(){
		return $this->user_fullname;
	}
	public function get_password(){
		return $this->password;
	}
	public function get_user_phone(){
		return $this->user_phone;
	}
	public function get_user_gender(){
		return $this->user_gender;
	}
	public function get_regesteration_date(){
		return $this->regesteration_date;
	}

	//address data
	public function get_user_country(){
		return $this->user_country;
	}
	public function get_user_city(){
		return $this->user_city;
	}
	public function get_user_area(){
		return $this->user_area;
	}
	public function get_user_block(){
		return $this->user_block;
	}
	public function get_user_street(){
		return $this->user_street;
	}
	public function get_user_house(){
		return $this->user_house;
	}
	public function get_user_number(){
		return $this->user_number;
	}
	public function get_user_notes(){
		return $this->user_notes;
	}

	//setters
	public function set_user_id($user_id){
		$this->user_id=trim(filter_var($user_id, FILTER_SANITIZE_STRING));
	}
	public function set_user_email($user_email){
		$this->user_email=trim(filter_var($user_email, FILTER_SANITIZE_STRING));
	}
	public function set_user_fullname($user_fullname){
		$this->user_fullname=trim(filter_var($user_fullname, FILTER_SANITIZE_STRING));
	}
	public function set_password($password){
		$this->password=$password;
	}
	public function set_user_phone($user_phone){
		$this->user_phone=trim(filter_var($user_phone, FILTER_SANITIZE_STRING));
	}
	public function set_user_gender($user_gender){
		$this->user_gender=$user_gender;
	}
	public function set_regesteration_date($regesteration_date){
		$this->regesteration_date=$regesteration_date;
	}

	//address data
	public function set_user_country($user_country){
		$this->user_country=trim(filter_var($user_country, FILTER_SANITIZE_STRING));
	}
	public function set_user_city($user_city){
		$this->user_city=trim(filter_var($user_city, FILTER_SANITIZE_STRING));
	}
	public function set_user_area($user_area){
		$this->user_area=trim(filter_var($user_area, FILTER_SANITIZE_STRING));
	}
	public function set_user_block($user_block){
		$this->user_block=trim(filter_var($user_block, FILTER_SANITIZE_STRING));
	}
	public function set_user_street($user_street){
		$this->user_street=trim(filter_var($user_street, FILTER_SANITIZE_STRING));
	}
	public function set_user_house($user_house){
		$this->user_house=trim(filter_var($user_house, FILTER_SANITIZE_STRING));
	}
	public function set_user_number($user_number){
		$this->user_number=trim(filter_var($user_number, FILTER_SANITIZE_STRING));
	}
	public function set_user_notes($user_notes){
		$this->user_notes=trim(filter_var($user_notes, FILTER_SANITIZE_STRING));
	}

	//operations

	//select by email 
	public function select_by_email(){
		$user_email=$this->get_user_email();
		$statement="SELECT * FROM users WHERE user_email = '$user_email'";
		$result = parent::runDml($statement);
		$count=mysqli_num_rows($result);
		return $count;	
	}

	//select updated email 
	public function select_updated_email(){
		$user_id=$this->get_user_id();
		$user_email=$this->get_user_email();
		$statement="SELECT * FROM users WHERE user_email = '$user_email' AND id !='$user_id'";
		$result = parent::runDml($statement);
		$count=mysqli_num_rows($result);
		return $count;	
	}

	//select by phone 
	public function select_by_phone(){
		$user_phone=$this->get_user_phone();
		$statement="SELECT * FROM users WHERE user_phone = '$user_phone'";
		$result = parent::runDml($statement);
		$count=mysqli_num_rows($result);
		return $count;	
	}

	//select updated phone 
	public function select_updated_phone(){
		$user_id=$this->get_user_id();
		$user_phone=$this->get_user_phone();
		$statement="SELECT * FROM users WHERE user_phone = '$user_phone' AND id !='$user_id'";
		$result = parent::runDml($statement);
		$count=mysqli_num_rows($result);
		return $count;	
	}

	//select address
	public function select_user_address(){
		$user_id=$this->get_user_id();
		$statement="SELECT * FROM user_address WHERE user_id = '$user_id'";
		$result = parent::runDml($statement);
		$row=mysqli_fetch_assoc($result);
		return $row;	
	}

	//insert
	public function insert(){
		$user_email=$this->get_user_email();
		$user_fullname=$this->get_user_fullname();
		$password=$this->get_password();
		$user_phone=$this->get_user_phone();
		$user_gender=$this->get_user_gender();
		$regesteration_date=$this->get_regesteration_date();
		$statement="INSERT INTO `users` (`user_email`,`user_fullname`,`password`,`user_phone`,`user_gender`,`regesteration_date`) VALUES ('$user_email','$user_fullname','$password','$user_phone','$user_gender','$regesteration_date')";
		$result = parent::runDml($statement);
		return $result;		
	}

	//insert address
	public function insert_address(){
		$user_id=$this->get_user_id();
		$user_country=$this->get_user_country();
		$user_city=$this->get_user_city();
		$user_area=$this->get_user_area();
		$user_block=$this->get_user_block();
		$user_street=$this->get_user_street();
		$user_house=$this->get_user_house();
		$user_number=$this->get_user_number();
		$user_notes=$this->get_user_notes();
		$statement="INSERT INTO `user_address` (`user_id`,`user_country`,`user_city`,`user_area`,`user_block`,`user_street`,`user_house`,`user_number`,`user_notes`) VALUES ('$user_id','$user_country','$user_city','$user_area','$user_block','$user_street','$user_house','$user_number','$user_notes')";
		//return $statement;
		$result = parent::runDml($statement);
		return $result;		
	}

	//select all
	public function select_all($user_id=0){
        $user_email=$this->get_user_email();
        $user_id=$this->get_user_id();
		$password=$this->get_password();
		if($user_id==0){
			$statement="SELECT * FROM users WHERE user_email='$user_email' AND password='$password'";
			$result = parent::runDml($statement);
			$data=array();
			$row=mysqli_fetch_assoc($result);
			$count=mysqli_num_rows($result);
			$data['row']=$row;
			$data['count']=$count;
			return $data;
		}else{
			$statement="SELECT * FROM users WHERE id='$user_id'";
			$result = parent::runDml($statement);
			$row=mysqli_fetch_assoc($result);
			return $row;
		}
		
	}

	//select all
	public function select_all_users(){
		$statement="SELECT * FROM users";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;	
	}

	//select last 10
	public function select_last_users(){
		$statement="SELECT * FROM users ORDER BY id DESC LIMIT 10";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;	
	}

	public function update_password($new_password){
		if ($new_password != "") {
			$user_id=$this->get_user_id();
			$result =parent::runDml("UPDATE `users` SET `password`='$new_password' WHERE id='$user_id'");
			return $result;
		}
	}

	public function update_address(){
		$user_id=$this->get_user_id();
		$user_country=$this->get_user_country();
		$user_city=$this->get_user_city();
		$user_area=$this->get_user_area();
		$user_block=$this->get_user_block();
		$user_street=$this->get_user_street();
		$user_house=$this->get_user_house();
		$user_number=$this->get_user_number();
		$user_notes=$this->get_user_notes();
		$statement="UPDATE `user_address` SET `user_country`='$user_country',`user_city`='$user_city',`user_area`='$user_area',`user_block`='$user_block',`user_street`='$user_street',`user_house`='$user_house',`user_number`='$user_number',`user_notes`='$user_notes' WHERE `user_id`= '$user_id'";
		$result = parent::runDml($statement);
		return $result;
	}

	public function update_user(){
		$user_id=$this->get_user_id();
		$user_email=$this->get_user_email();
		$user_fullname=$this->get_user_fullname();
		$user_phone=$this->get_user_phone();
		$user_gender=$this->get_user_gender();
		$user_country=$this->get_user_country();
		$user_city=$this->get_user_city();
		$user_street=$this->get_user_street();
		$statement1="UPDATE `users` SET `user_fullname`='$user_fullname',`user_email`='$user_email',`user_phone`='$user_phone',`user_gender`='$user_gender' WHERE id='$user_id'";
		$result1=parent::runDml($statement1);

		if ($result1) {
			$statement="UPDATE `user_address` SET `user_country`='$user_country',`user_city`='$user_city', `user_street`='$user_street' WHERE `user_id`= '$user_id'";
			$result = parent::runDml($statement);
			return $result;
		}
	}
}