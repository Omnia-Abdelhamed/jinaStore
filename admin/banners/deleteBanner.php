<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("location: ../../adminLogin.php");
}else{
    $banner_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
    include_once "../../database_class.php";
    $db=new Database();
    include_once '../../banner_class.php';
    $banner= new Banners();
    $banner_data=$banner->select_by_one($banner_id);
    if($db->runDml("DElETE FROM banner WHERE banner_id= $banner_id")){
    	$dir="../../img/";
        $img=$banner_data['banner_image'];
    	$fdir= $dir.$img;
        unlink($fdir);
    	header('location: ../banners/');		
    }
}

?>