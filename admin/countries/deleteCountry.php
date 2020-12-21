<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("location: ../../adminLogin.php");
}else{
    $subcategory_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
    include_once "../../database_class.php";
    $db=new Database();
    include_once '../../subcategory_class.php';
    $subcategories= new Subcategories();
    $subcategory_data=$subcategories->select_by_one($subcategory_id);
    if($db->runDml("DElETE FROM products WHERE subcategory_id= $subcategory_id")){
    	if($db->runDml("DElETE FROM subcategories WHERE subcategory_id= $subcategory_id")){
    		$dir="../../img/subcategories/";
        	$img=$subcategory_data['subcategory_image'];
    		$fdir= $dir.$img;
        	unlink($fdir);
    		header('location: ../subcategories/');
    	}	
    }
}

?>