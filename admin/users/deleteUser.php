<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("location: ../../adminLogin.php");
}else{
    $user_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
    include_once "../../database_class.php";
    $db=new Database();
    if($db->runDml("DElETE FROM users WHERE id= $user_id")){
    	header('location: ../users/');		
    } 
}
?>