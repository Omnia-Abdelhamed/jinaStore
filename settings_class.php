<?php
class Mysettings extends Database{
    //properties
    var $id,$name,$logo,$about_title,$about,$about_title_en,$about_en,$email,$phone,$whatsapp,$ar_currency,$en_currency,$facebook,$instagram;
    
    //getters
    public function get_id(){
		return $this ->id;
	}
    public function get_name(){
		return $this ->name;
	}
	public function get_logo(){
		return $this ->logo;
	}
	public function get_about_title(){
		return $this ->about_title;
	}
	public function get_about(){
		return $this ->about;
	}
	public function get_about_title_en(){
		return $this ->about_title_en;
	}
	public function get_about_en(){
		return $this ->about_en;
	}
	public function get_email(){
		return $this ->email;
	}
	public function get_phone(){
		return $this ->phone;
    }
    public function get_whatsapp(){
		return $this ->whatsapp;
    }
    public function get_ar_currency(){
		return $this ->ar_currency;
	}
	public function get_en_currency(){
		return $this ->en_currency;
	}
	public function get_facebook(){
		return $this ->facebook;
    }
    public function get_instagram(){
		return $this ->instagram;
    }
    
    //setters
    public function set_id($id){
		$this->id=$id;
	}
	public function set_logo($logo){
		$this->logo=$logo;
	}
	public function set_name($name){
		$this->name=trim(filter_var($name, FILTER_SANITIZE_STRING));
	}
	public function set_about_title($about_title){
		$this->about_title=trim(filter_var($about_title, FILTER_SANITIZE_STRING));
	}
	public function set_about($about){
		$this->about=trim(filter_var($about, FILTER_SANITIZE_STRING));
	}
	public function set_about_title_en($about_title_en){
		$this->about_title_en=trim(filter_var($about_title_en, FILTER_SANITIZE_STRING));
	}
	public function set_about_en($about_en){
		$this->about_en=trim(filter_var($about_en, FILTER_SANITIZE_STRING));
	}
	public function set_email($email){
		$this->email=trim(filter_var($email, FILTER_SANITIZE_STRING));
	}
	public function set_phone($phone){
		$this->phone=trim(filter_var($phone, FILTER_SANITIZE_STRING));
    }
    public function set_whatsapp($whatsapp){
		$this->whatsapp=trim(filter_var($whatsapp, FILTER_SANITIZE_STRING));
	}
	public function set_ar_currency($ar_currency){
		$this->ar_currency=trim(filter_var($ar_currency, FILTER_SANITIZE_STRING));
    }
    public function set_en_currency($en_currency){
		$this->en_currency=trim(filter_var($en_currency, FILTER_SANITIZE_STRING));
    }
	public function set_facebook($facebook){
		$this->facebook=$facebook;
	}
	public function set_instagram($instagram){
		$this->instagram=$instagram;
	}
    //operations

	//select all
	public function select_all(){
		$statement="SELECT * FROM settings";
		$result = parent::runDml($statement);
		$row=mysqli_fetch_assoc($result);
		return $row;
	}

	//update about
	public function update_about(){
		$id=$this->get_id();
		$about_title=$this->get_about_title();
		$about=$this->get_about();
		$about_title_en=$this->get_about_title_en();
		$about_en=$this->get_about_en();
		$statement="UPDATE `settings` SET `about_title`='$about_title',`about`='$about',`about_title_en`='$about_title_en',`about_en`='$about_en' WHERE id='$id'";
		$result = parent::runDml($statement);
		return $result;
	}
	
	//update settings
	public function update_settings(){
		$id=$this->get_id();
		$name=$this->get_name();
		$logo=$this->get_logo();
		$email=$this->get_email();
		$phone=$this->get_phone();
		$whatsapp=$this->get_whatsapp();
		$ar_currency=$this->get_ar_currency();
		$en_currency=$this->get_en_currency();
		$facebook=$this->get_facebook();
		$instagram=$this->get_instagram();
		$statement="UPDATE `settings` SET `name`='$name',`logo`='$logo',`email`='$email',`phone`='$phone',`whatsapp`='$whatsapp',`ar_currency`='$ar_currency',`en_currency`='$en_currency',`facebook`='$facebook',`instagram`='$instagram' WHERE id='$id'";
		$result = parent::runDml($statement);
		return $result;
	}

}
?>