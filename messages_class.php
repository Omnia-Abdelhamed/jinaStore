<?php
class Messages extends Database{

	//properties
	var $first_name,$last_name,$email,$phone,$message_order,$subject,$message,$send_date;

	//getters
	public function get_first_name(){
		return $this->first_name;
	}
	public function get_last_name(){
		return $this->last_name;
	}
	public function get_email(){
		return $this->email;
	}
	public function get_phone(){
		return $this->phone;
	}
	public function get_message_order(){
		return $this->message_order;
	}
	public function get_subject(){
		return $this->subject;
	}
	public function get_message(){
		return $this->message;
	}
	public function get_send_date(){
		return $this->send_date;
	}

	//setters
	public function set_first_name($first_name){
		$this->first_name=trim(filter_var($first_name, FILTER_SANITIZE_STRING));
	}
	public function set_last_name($last_name){
		$this->last_name=trim(filter_var($last_name, FILTER_SANITIZE_STRING));
	}
	public function set_email($email){
		$this->email=trim(filter_var($email, FILTER_SANITIZE_STRING));
	}
	public function set_phone($phone){
		$this->phone=$phone;
	}
	public function set_message_order($message_order){
		$this->message_order=trim(filter_var($message_order, FILTER_SANITIZE_STRING));
	}
	public function set_subject($subject){
		$this->subject=$subject;
	}
	public function set_message($message){
		$this->message=trim(filter_var($message, FILTER_SANITIZE_STRING));
	}
	public function set_send_date($send_date){
		$this->send_date=$send_date;
	}

	//operations

	//select by subject 
	public function select_by_subject(){
		$statement="SELECT * FROM messages WHERE subject = 'cancel'";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
		
	}

	//select other messages 
	public function select_other_messages(){
		$statement="SELECT * FROM messages WHERE subject != 'cancel'";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}

	//select all messages 
	public function select_all_messages(){
		$statement="SELECT * FROM messages";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}

	//select last messages 
	public function select_last_messages(){
		$statement="SELECT * FROM messages ORDER BY message_id DESC limit 10";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}


	//insert
	public function insert(){
		$first_name=$this->get_first_name();
		$last_name=$this->get_last_name();
		$email=$this->get_email();
		$phone=$this->get_phone();
		$message_order=$this->get_message_order();
		$subject=$this->get_subject();
		$message=$this->get_message();
		$send_date=$this->get_send_date();
		$statement="INSERT INTO `messages` (`first_name`,`last_name`,`email`,`phone`,`message_order`,`subject`,`message`,`send_date`) VALUES ('$first_name','$last_name','$email','$phone','$message_order','$subject','$message','$send_date')";
		$result = parent::runDml($statement);
		return $result;		
	}
}