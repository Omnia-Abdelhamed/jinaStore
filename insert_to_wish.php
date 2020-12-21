<?php
session_start();
if (isset($_SESSION['user_id'])) {
 	$user_id=$_SESSION['user_id'];
}else{
	$user_id=0;
}
include_once 'database_class.php';
$db= new Database();
if(isset($_POST['product_code'])){
	$product_code=$_POST['product_code'];
	$wish_statement="SELECT * FROM `wish_list` WHERE user_id='$user_id' AND product_code='$product_code'";
    $wish_result= $db->runDml($wish_statement);
    $wish_count=mysqli_num_rows($wish_result);
    if ($wish_count == 0) {
    	if($db->runDml("INSERT INTO `wish_list`(`user_id`, `product_code`) VALUES ('$user_id','$product_code')")){
			echo "<i class='fa fa-heart' aria-hidden='true' style='font-size: 25px'></i>";
		}
    }else{
    	if($db->runDml("DELETE FROM wish_list WHERE user_id = '$user_id' AND product_code='$product_code'")){
			echo "<i class='far fa-heart' style='font-size: 25px'></i>";
		}
    }	
}


