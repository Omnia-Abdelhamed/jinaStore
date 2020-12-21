<?php
class Admins extends Database{
    //properties
    var $username,$password;
    
    //getters
	public function get_username(){
		return $this ->username;
	}
	public function get_password(){
		return $this ->password;
	}
    
    //setters
	public function set_username($username){
        if(ctype_alnum($username)){
		    $this->username=$username;
        }else{
            $this->username=0;
        }
	}
	public function set_password($password){
		$password=trim($password);
        $this->password=sha1($password);
	}
    
    //operations

	//select all
	public function select_all(){
        $username=$this->get_username();
        $password=$this->get_password();
		$statement="SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result = parent::runDml($statement);
        $data=array();
        $row=mysqli_fetch_assoc($result);
        $count=mysqli_num_rows($result);
        $data['row']=$row;
        $data['count']=$count;
		return $data;
	}

    //select all
    public function select_all_admins(){
        $username=$this->get_username();
        $password=$this->get_password();
        $statement="SELECT * FROM admin";
        $result = parent::runDml($statement);
        $data=array();
        while($row=mysqli_fetch_assoc($result)){
            $data[]=$row;
        }
        return $data;
    }

    //select all
    public function select_by_username(){
        $username=$this->get_username();
        $password=$this->get_password();
        $statement="SELECT * FROM admin WHERE username='$username'";
        $result = parent::runDml($statement);
        $row=mysqli_fetch_assoc($result);
        return $row;
    }

    //select all
    public function insert(){
        $username=$this->get_username();
        $password=$this->get_password();
        $statement="INSERT INTO `admin`(`username`, `password`) VALUES ('$username','$password')";
        $result = parent::runDml($statement);
        return $result;
    }

}
?>