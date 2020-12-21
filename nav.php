<?php
ob_start();
session_start();
include_once 'database_class.php';
include_once 'category_class.php';
include_once 'subcategory_class.php';
include_once 'product_class.php';
include_once 'settings_class.php';
$categories=new Categories();
global $categories_data;
$categories_data=$categories->select_all();
global $subcategories;
$subcategories=new Subcategories();
$products=new Products();
$the_settings=new Mysettings();
$settings_data=$the_settings->select_all();
?>