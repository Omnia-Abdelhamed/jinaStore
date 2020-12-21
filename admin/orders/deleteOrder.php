<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("location: ../../adminLogin.php");
}else{
    $order_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
    include_once "../../database_class.php";
    $db=new Database();
    if($db->runDml("DElETE FROM order_details WHERE order_id= '$order_id'")){
    	if ($db->runDml("DElETE FROM orders WHERE order_id= '$order_id'")) {
    		header('location: ../orders/');
    	}
    			
    } 
}
?>