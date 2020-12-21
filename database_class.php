<?php

class Database
{
	private $connect;
	function __construct(){
	$this->connect=mysqli_connect("localhost","janastore_janastore","Bluezone@2020","janastore_janastore");
	$this->connect->set_charset('utf8');
	}

	function runDml($statement){
		return mysqli_query($this->connect,$statement);
	}
}

?>