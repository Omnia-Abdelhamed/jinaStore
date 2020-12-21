<?php
class Banners extends Database{

	//properties
	var $banner_image;

	//getters
	public function get_banner_image(){
		return $this ->banner_image;
	}

	//setters
	public function set_banner_image($banner_image){
		$this->banner_image=$banner_image;
	}

	//operations

	//select bannners
	//select all
	public function select_all($order="ASC"){
		if ($order=="DESC") {
			$statement="SELECT * FROM banner DESC";
		}else{
			$statement="SELECT * FROM banner";
		}
		$result = parent::runDml($statement);
		$data= array();
		while ($row=mysqli_fetch_assoc($result)) {
			$data[]=$row;
		}
		return $data;
	}

	//select one by banner id
	public function select_by_one($banner_id){
		$result = parent::runDml("SELECT * FROM banner WHERE banner_id = $banner_id");
		$row=mysqli_fetch_assoc($result);
		return $row;	
	}


	//insert
	public function insert(){
		$image=$this->get_banner_image();
		$statement="INSERT INTO `banner` (`banner_image`) VALUES ('$image')";
		$result = parent::runDml($statement);
		return $result;		
	}

	//update
	public function update($banner_id){
		$image=$this->get_banner_image();
		$statement="UPDATE `banner` SET `banner_image`='$image' WHERE banner_id=$banner_id";
		$result = parent::runDml($statement);
		return $result;		
	}
}