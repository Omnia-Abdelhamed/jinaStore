<?php
class Orders extends Database{

	//properties
	var $user_id,$user_email,$user_fullname,$user_phone,$user_country,$user_city,$user_street,$user_notes,$order_date,$order_time,$cart,$discound;

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
	public function get_user_phone(){
		return $this->user_phone;
	}

	//address data
	public function get_user_country(){
		return $this->user_country;
	}
	public function get_user_city(){
		return $this->user_city;
	}
	public function get_user_street(){
		return $this->user_street;
	}
	public function get_user_notes(){
		return $this->user_notes;
	}
	public function get_discound(){
		return $this->discound;
	}

	//date and time
	public function get_order_date(){
		return $this->order_date;
	}
	public function get_order_time(){
		return $this->order_time;
	}

	//order details
	public function get_cart(){
		return $this->cart;
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
	public function set_user_phone($user_phone){
		$this->user_phone=trim(filter_var($user_phone, FILTER_SANITIZE_STRING));
	}

	//address data
	public function set_user_country($user_country){
		$this->user_country=trim(filter_var($user_country, FILTER_SANITIZE_STRING));
	}
	public function set_user_city($user_city){
		$this->user_city=trim(filter_var($user_city, FILTER_SANITIZE_STRING));
	}
	public function set_user_street($user_street){
		$this->user_street=trim(filter_var($user_street, FILTER_SANITIZE_STRING));
	}
	public function set_user_notes($user_notes){
		$this->user_notes=trim(filter_var($user_notes, FILTER_SANITIZE_STRING));
	}
	public function set_discound($discound){
		$this->discound=trim(filter_var($discound, FILTER_SANITIZE_STRING));
	}

	//date and time
	public function set_order_date($order_date){
		$this->order_date=$order_date;
	}
	public function set_order_time($order_time){
		$this->order_time=$order_time;
	}

	//order details
	public function set_cart($cart){
		$this->cart=$cart;
	}
	

	//operations

		//insert
	public function insert(){
		$user_id=$this->get_user_id();
		$user_email=$this->get_user_email();
		$user_fullname=$this->get_user_fullname();
		$user_phone=$this->get_user_phone();
		$user_country=$this->get_user_country();
		$user_city=$this->get_user_city();
		$user_street=$this->get_user_street();
		$user_notes=$this->get_user_notes();
		$order_date=$this->get_order_date();
		$order_time=$this->get_order_time();
		$discound=$this->get_discound();
		$cart=$this->get_cart();

		$statement="INSERT INTO `orders` (`user_id`,`order_date`,`order_time`,`fullname`,`email`,`phone`,`country`,`city`,`street`,`notes`,`discound`) VALUES ('$user_id','$order_date','$order_time','$user_fullname','$user_email','$user_phone','$user_country','$user_city','$user_street','$user_notes','$discound')";
		$result = parent::runDml($statement);
		if ($result) {
			$statement1="SELECT * FROM orders WHERE user_id ='$user_id' ORDER BY order_id DESC LIMIT 1";
			$result1 = parent::runDml($statement1);
			$row=mysqli_fetch_assoc($result1);
			if (!empty($row)) {
				$order_id=$row['order_id'];
				foreach ($cart as $value) {
					$product_code=$value['product_code'];
					$order_quantity=$value['quantity'];
					if (isset($value['size'])) {
						$size_id=$value['size'];
					}else{
						$size_id="";
					}
					if ($size_id=="") {
						$statement2="INSERT INTO `order_details` (`order_id`,`product_code`,`order_quantity`) VALUES ('$order_id','$product_code','$order_quantity')";
					}else{
						$statement2="INSERT INTO `order_details` (`order_id`,`product_code`,`order_quantity`,`size_id`) VALUES ('$order_id','$product_code','$order_quantity','$size_id')";
					}
					$result2= parent::runDml($statement2);
				}
			}
		}	
		return $result2;	
	}

	//select all
	public function select_all(){
		$user_id=$this->get_user_id();
		$statement="SELECT * FROM orders INNER JOIN order_details ON orders.order_id = order_details.order_id INNER JOIN products ON order_details.product_code=products.product_code WHERE user_id ='$user_id' ORDER BY orders.order_id DESC";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;	
	}

	public function select_all_orders(){
		$statement="SELECT * FROM orders ORDER BY order_id DESC";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;	
	}
	
	public function select_the_current(){
		$statement="SELECT * FROM orders WHERE done=0 ORDER BY order_id DESC";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;	
	}
	
	public function select_the_finished(){
		$statement="SELECT * FROM orders WHERE done=1 ORDER BY order_id DESC";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;	
	}
	
	//select by order
	public function select_by_order($order_id){
		$statement="SELECT * FROM orders WHERE order_id=$order_id";
		$result = parent::runDml($statement);
		$row=mysqli_fetch_assoc($result);
		return $row;	
	}

	public function select_last_orders(){
		$statement="SELECT * FROM orders ORDER BY order_id DESC LIMIT 10";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;	
	}

	//select from order details
	public function select_from_order_details($order_id){
		$statement="SELECT * FROM order_details INNER JOIN products ON order_details.product_code=products.product_code WHERE order_id ='$order_id'";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;	
	}
	
	//select from order details
	public function select_products_from_order_details($product_code){
		$statement="SELECT * FROM order_details WHERE product_code ='$product_code'";
		$result = parent::runDml($statement);
		$data=array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;	
	}

	//select by email 
	// public function select_by_email(){
	// 	$user_email=$this->get_user_email();
	// 	$statement="SELECT * FROM users WHERE user_email = '$user_email'";
	// 	$result = parent::runDml($statement);
	// 	$count=mysqli_num_rows($result);
	// 	return $count;	
	// }

	// //select updated email 
	// public function select_updated_email(){
	// 	$user_id=$this->get_user_id();
	// 	$user_email=$this->get_user_email();
	// 	$statement="SELECT * FROM users WHERE user_email = '$user_email' AND id !='$user_id'";
	// 	$result = parent::runDml($statement);
	// 	$count=mysqli_num_rows($result);
	// 	return $count;	
	// }

	// //select by phone 
	// public function select_by_phone(){
	// 	$user_phone=$this->get_user_phone();
	// 	$statement="SELECT * FROM users WHERE user_phone = '$user_phone'";
	// 	$result = parent::runDml($statement);
	// 	$count=mysqli_num_rows($result);
	// 	return $count;	
	// }

	// //select updated phone 
	// public function select_updated_phone(){
	// 	$user_id=$this->get_user_id();
	// 	$user_phone=$this->get_user_phone();
	// 	$statement="SELECT * FROM users WHERE user_phone = '$user_phone' AND id !='$user_id'";
	// 	$result = parent::runDml($statement);
	// 	$count=mysqli_num_rows($result);
	// 	return $count;	
	// }

	// //select address
	// public function select_user_address(){
	// 	$user_id=$this->get_user_id();
	// 	$statement="SELECT * FROM user_address WHERE user_id = '$user_id'";
	// 	$result = parent::runDml($statement);
	// 	$row=mysqli_fetch_assoc($result);
	// 	return $row;	
	// }



	




	//select last 10
	// public function select_last_users(){
	// 	$statement="SELECT * FROM users ORDER BY id DESC LIMIT 10";
	// 	$result = parent::runDml($statement);
	// 	$data=array();
	// 	while ($row=mysqli_fetch_assoc($result)) {
	// 		$data[]=$row;
	// 	}
	// 	return $data;	
	// }

}