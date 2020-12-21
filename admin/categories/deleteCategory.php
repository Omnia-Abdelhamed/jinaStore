<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("location: ../../adminLogin.php");
}else{
    $category_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
    include_once "../../database_class.php";
    $db=new Database();
    include_once '../../category_class.php';
    $categories= new Categories();
    $category_data=$categories->select_by_one($category_id);
    if($db->runDml("DElETE FROM products WHERE category_id= $category_id")){
    	if($db->runDml("DElETE FROM subcategories WHERE category_id= $category_id")){
    		if($db->runDml("DElETE FROM categories WHERE category_id= $category_id")){
    			$dir="../../img/categories/";
        		$img=$category_data['category_image'];
    			$fdir= $dir.$img;
        		unlink($fdir);
    			header('location: ../categories/');
    		}
    	}	
    }
}

?>