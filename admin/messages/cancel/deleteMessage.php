<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("location: ../../../adminLogin.php");
}else{
    $message_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
    include_once "../../../database_class.php";
    $db=new Database();
    if($db->runDml("DElETE FROM messages WHERE message_id= $message_id")){
    	header('location: ../cancel/');		
    }  
}
?>