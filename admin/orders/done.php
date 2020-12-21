<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("location: ../../adminLogin.php");
}else{
    $order_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
    include_once "../../database_class.php";
    $db=new Database();
    if($db->runDml("UPDATE `orders` SET `done`=1 WHERE order_id= '$order_id'")){
    	header("location: viewOrder.php?id=$order_id");
    } 
}
?>