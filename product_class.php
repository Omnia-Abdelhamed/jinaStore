<?php
class Products extends Database{

	//properties
	var $product_code,$product_title_ar,$product_title_en,
	$product_main_image,$product_details_ar,$product_details_en,$product_price,
	$product_added_date,$product_updated_date,$product_quantity,$category_id,
	$subcategory_id,$best_seller,$new_arrival,$nickname,$summary,$review;

	//getters
	public function get_product_code(){
		return $this ->product_code;
	}
	public function get_product_title_ar(){
		return $this ->product_title_ar;
	}
	public function get_product_title_en(){
		return $this ->product_title_en;
	}
	public function get_product_main_image(){
		return $this ->product_main_image;
	}
	public function get_product_details_ar(){
		return $this ->product_details_ar;
	}
	public function get_product_details_en(){
		return $this ->product_details_en;
	}
	public function get_product_price(){
		return $this ->product_price;
	}
	public function get_product_added_date(){
		return $this ->product_added_date;
	}
	public function get_product_updated_date(){
		return $this ->product_updated_date;
	}
	public function get_product_quantity(){
		return $this ->product_quantity;
	}
	public function get_best_seller(){
		return $this ->best_seller;
	}
	public function get_new_arrival(){
		return $this ->new_arrival;
	}
	public function get_category_id(){
		return $this ->category_id;
	}
	public function get_subcategory_id(){
		return $this ->subcategory_id;
	}

	//review getters
	public function get_nickname(){
		return $this ->nickname;
	}
	public function get_summary(){
		return $this ->summary;
	}
	public function get_review(){
		return $this ->review;
	}

	//setters
	public function set_product_code($product_code){
		$this->product_code=trim(filter_var($product_code, FILTER_SANITIZE_STRING));
	}
	public function set_product_title_ar($product_title_ar){
		$this ->product_title_ar=trim(filter_var($product_title_ar, FILTER_SANITIZE_STRING));
	}
	public function set_product_title_en($product_title_en){
		$this ->product_title_en=trim(filter_var($product_title_en, FILTER_SANITIZE_STRING));
	}
	public function set_product_main_image($product_main_image){
		$this ->product_main_image=$product_main_image;
	}
	public function set_product_details_ar($product_details_ar){
		$this->product_details_ar=trim(filter_var($product_details_ar, FILTER_SANITIZE_STRING));
	}
	public function set_product_details_en($product_details_en){
		$this->product_details_en=trim(filter_var($product_details_en, FILTER_SANITIZE_STRING));
	}
	public function set_product_price($product_price){
		$this->product_price=trim(filter_var($product_price, FILTER_SANITIZE_STRING));
	}
	public function set_product_added_date($product_added_date){
		$this ->product_added_date=$product_added_date;
	}
	public function set_product_updated_date($product_updated_date){
		$this ->product_updated_date=$product_updated_date;
	}
	public function set_product_quantity($product_quantity){
		$this ->product_quantity=(int)$product_quantity;
	}
	public function set_best_seller($best_seller){
		$this ->best_seller=$best_seller;
	}
	public function set_new_arrival($new_arrival){
		$this ->new_arrival=$new_arrival;
	}
	public function set_category_id($category_id){
		$this ->category_id=$category_id;
	}
	public function set_subcategory_id($subcategory_id){
		$this ->subcategory_id=$subcategory_id;
	}

	//review setters
	public function set_nickname($nickname){
		$this->nickname=trim(filter_var($nickname, FILTER_SANITIZE_STRING));
	}
	public function set_summary($summary){
		$this->summary=trim(filter_var($summary, FILTER_SANITIZE_STRING));
	}
	public function set_review($review){
		$this->review=trim(filter_var($review, FILTER_SANITIZE_STRING));
	}

	

	//operations

	//select products
	//select all
	public function select_all($order="ASC"){
		if ($order=="DESC") {
			$statement="SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id ORDER BY product_added_date DESC";
		}else{
			$statement="SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id";
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
		$product_code=$this->get_product_code();		
		if ($order=="DESC") {
			$statement="SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id WHERE products.category_id = $category_id AND product_code != '$product_code' ORDER BY product_code DESC";
		}else{
			$statement="SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id WHERE products.category_id = $category_id";
		}
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}

	//select by subcategory
	public function select_by_subcategory($subcategory_id,$order="ASC"){
		if ($order=="DESC") {
			$statement="SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id WHERE products.subcategory_id = $subcategory_id ORDER BY product_id DESC";
		}else{
			$statement="SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id WHERE products.subcategory_id = $subcategory_id";
		}
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}

	//select by category and subcategory
	public function select_by_catSub($category_id,$subcategory_id,$order="ASC"){
		if($subcategory_id != 0){
			if ($order=="DESC") {
				$statement="SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id WHERE products.category_id = $category_id AND products.subcategory_id = $subcategory_id ORDER BY product_added_date DESC";
			}else{
				$statement="SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id WHERE products.category_id = $category_id AND products.subcategory_id = $subcategory_id";
			}
		}else{
			if ($order=="DESC") {
				$statement="SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id WHERE products.category_id = $category_id ORDER BY product_added_date DESC";
			}else{
				$statement="SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id WHERE products.category_id = $category_id";
			}
		}
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}

	//select by one product
	// public function select_by_one($product_id){
	// 	$result = parent::runDml("SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id WHERE product_id = $product_id");
	// 	$row=mysqli_fetch_assoc($result);
	// 	return $row;	
	// }

	//select by code
	public function select_by_code($id=0,$job="show"){
		$product_code=$this->get_product_code();
		$statement="SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id WHERE product_code = '$product_code' AND id != '$id'";
			
		$result = parent::runDml($statement);
		$row=mysqli_fetch_assoc($result);
		$count=mysqli_num_rows($result);
		if($job=="count"){
			return $count;
		}else{
			return $row;
		}	
	}

	//select by id
	public function select_by_id($id){
		$statement="SELECT * FROM products INNER JOIN categories ON categories.category_id = products.category_id INNER JOIN subcategories ON subcategories.subcategory_id = products.subcategory_id WHERE id = '$id'";
			
		$result = parent::runDml($statement);
		$row=mysqli_fetch_assoc($result);
		return $row;		
	}

	//search
	public function search($searchText){
		$statement="SELECT * FROM products WHERE product_title_ar like '%$searchText%' or product_title_en like '%$searchText%' or product_details_ar like '%$searchText%' or product_details_en like '%$searchText%'";
		$result = parent::runDml($statement);
		$count=mysqli_num_rows($result);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		$search_result=array($count,$data);
		return $search_result;		
	}

	// select size and quantity
	public function select_size_quantity($id){
		$product_code=$this->get_product_code();
		$statement="SELECT * FROM clothes_size WHERE product_code = '$product_code' AND size_id = '$id'";	
		$result = parent::runDml($statement);
		$row=mysqli_fetch_assoc($result);
		$count=mysqli_num_rows($result);
		$data=array($count,$row);
		return $data;	
	}

	//select added images
	public function select_added_images(){
		$product_code=$this->get_product_code();		
		$statement="SELECT product_extra_image FROM product_images WHERE product_code = '$product_code'";
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;		
	}

	//select review
	public function select_review(){
		$product_code=$this->get_product_code();		
		$statement="SELECT * FROM review WHERE product_code = '$product_code'";
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;		
	}

	//select size keys
	public function select_size_keys(){		
		$statement="SELECT * FROM sizes";
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;		
	}

	//select sizes
	public function select_sizes(){
		$product_code=$this->get_product_code();		
		$statement="SELECT * FROM clothes_size INNER JOIN sizes ON sizes.size_id = clothes_size.size_id WHERE product_code = '$product_code'";
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;		
	}

	//select new_arrival
	public function select_new_arrival(){		
		$statement="SELECT * FROM products WHERE new_arrival = 1";
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;		
	}

	//select categories best_seller
	public function select_categories_best_seller(){
		$category_id=$this->get_category_id();	
		$statement="SELECT * FROM products WHERE category_id='$category_id' AND best_seller = 1";
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;		
	}

	//insert
	public function insert($sizes,$added_images){
		$product_code=$this->get_product_code();
		$product_title_ar=$this->get_product_title_ar();
		$product_title_en=$this->get_product_title_en();
		$product_main_image=$this->get_product_main_image();
		$product_details_ar=$this->get_product_details_ar();
		$product_details_en=$this->get_product_details_en();
		$product_price=$this->get_product_price();
		$product_added_date=$this->get_product_added_date();
		$product_quantity=$this->get_product_quantity();
		$best_seller=$this->get_best_seller();
		$new_arrival=$this->get_new_arrival();
		$category_id=$this->get_category_id();
		$subcategory_id=$this->get_subcategory_id();
		$statement="INSERT INTO `products` (`product_code`,`product_title_ar`,`product_title_en`,`product_main_image`,`product_details_ar`,`product_details_en`,`product_price`,`product_added_date`,`product_last_updated_date`,`product_quantity`,`category_id`,`subcategory_id`,`best_seller`,`new_arrival`) VALUES ('$product_code','$product_title_ar','$product_title_en','$product_main_image','$product_details_ar','$product_details_en','$product_price','$product_added_date','$product_added_date','$product_quantity','$category_id','$subcategory_id','$best_seller','$new_arrival')";
		$result = parent::runDml($statement);
		if($result){
			if(!empty($sizes)){
				foreach($sizes as $key => $size){
					if($size != 0){
						$result2 = parent::runDml("INSERT INTO `clothes_size` (`product_code`,`size_id`,`quantity`) VALUES ('$product_code','$key','$size')");
					}
				}
			}
			
			if(!empty($added_images)){
				$added_count= count($added_images['tmp_name']);
				for ($i=0; $i < $added_count ; $i++) { 
					$added_image_name=$added_images['name'][$i];
					$added_image_type=$added_images['type'][$i];
					$added_image_tmp=$added_images['tmp_name'][$i];
					$added_image_size=$added_images['size'][$i];
					$allowed_extensions=array("jpeg","jpg","png","JPEG","JPG","PNG");
					$added_image_extension=explode('.', $added_image_name);
					$added_image_extension=strtolower(end($added_image_extension));
					if(in_array($added_image_extension, $allowed_extensions)){
						$added_image_name=$product_code.'_addionalImage'.$i.".".$added_image_extension;
						move_uploaded_file($added_image_tmp, "../../../img/products/".$added_image_name);
						$result3 = parent::runDml("INSERT INTO `product_images` (`product_code`,`product_extra_image`,`image_num`) VALUES ('$product_code','$added_image_name','$i')");
					}
				}
			}
			$msg="تمت الاضافة بنجاح";
			return $msg;
		}
	}

	//update
	public function update($size_holding,$added_images){
		$product_code=$this->get_product_code();
		$product_title_ar=$this->get_product_title_ar();
		$product_title_en=$this->get_product_title_en();
		$product_main_image=$this->get_product_main_image();
		$product_details_ar=$this->get_product_details_ar();
		$product_details_en=$this->get_product_details_en();
		$product_price=$this->get_product_price();
		$product_updated_date=$this->get_product_updated_date();
		$product_quantity=$this->get_product_quantity();
		$best_seller=$this->get_best_seller();
		$new_arrival=$this->get_new_arrival();
		$category_id=$this->get_category_id();
		$subcategory_id=$this->get_subcategory_id();
		$statement="UPDATE `products` SET `product_code`='$product_code',`product_title_ar`='$product_title_ar',`product_title_en`='$product_title_en',`product_main_image`='$product_main_image',`product_details_ar`='$product_details_ar',`product_details_en`='$product_details_en',`product_price`='$product_price',`product_last_updated_date`='$product_updated_date',`product_quantity`='$product_quantity',`category_id`='$category_id',`subcategory_id`='$subcategory_id',`best_seller`='$best_seller',`new_arrival`='$new_arrival' WHERE product_code='$product_code'";
		$result = parent::runDml($statement);
		// if($result){
		// 	if(!empty($sizes)){
		// 		foreach($sizes as $key => $size){
		// 			if($size != 0){
		// 				$result2 = parent::runDml("INSERT INTO `clothes_size` (`product_code`,`size_id`,`quantity`) VALUES ('$product_code','$key','$size')");
		// 			}
		// 		}
		// 	}
			
		// 	if(!empty($added_images)){
		// 		$added_count= count($added_images['tmp_name']);
		// 		for ($i=0; $i < $added_count ; $i++) { 
		// 			$added_image_name=$added_images['name'][$i];
		// 			$added_image_type=$added_images['type'][$i];
		// 			$added_image_tmp=$added_images['tmp_name'][$i];
		// 			$added_image_size=$added_images['size'][$i];
		// 			$allowed_extensions=array("jpeg","jpg","png","JPEG","JPG","PNG");
		// 			$added_image_extension=explode('.', $added_image_name);
		// 			$added_image_extension=strtolower(end($added_image_extension));
		// 			if(in_array($added_image_extension, $allowed_extensions)){
		// 				$added_image_name=$product_code.'_addionalImage'.$i.".".$added_image_extension;
		// 				move_uploaded_file($added_image_tmp, "..\..\..\img\products\\".$added_image_name);
		// 				$result3 = parent::runDml("INSERT INTO `product_images` (`product_code`,`product_extra_image`) VALUES ('$product_code','$added_image_name')");
		// 			}
		// 		}
		// 	}
		// }
		return $result;
	}

	//insert review
	public function insert_to_review($product_code){
		$nickname=$this->get_nickname();
		$summary=$this->get_summary();
		$review=$this->get_review();
		$statement="INSERT INTO `review`(`nickname`, `summary`, `review`, `product_code`) VALUES ('$nickname','$summary','$review','$product_code')";
		$result= parent::runDml($statement);
		return $result;
	}

}