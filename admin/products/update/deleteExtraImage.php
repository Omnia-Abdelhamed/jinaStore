<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("location: ../../../adminLogin.php");
}else{
    if(isset($_POST['image_id'])){
        include_once "../../../database_class.php";
        $db1=new Database();
        $image_name= $_POST['image_id'];
        if($db1->runDml("DElETE FROM product_images WHERE product_extra_image= '$image_name'")){
            $dir="../../../img/products/";
    	    $fdir= $dir.$image_name;
            unlink($fdir);
            echo "done";
        }
    }
}
?>