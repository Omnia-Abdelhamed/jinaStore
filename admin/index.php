<?php

session_start();
if(!isset($_SESSION['admin_id'])){
    header("location: ../adminLogin.php");
}
else{
    $admin_id=$_SESSION['admin_id'];
}
include_once '../database_class.php';
$db=new Database();
$admin_result=$db->runDml("SELECT * FROM admin WHERE id= $admin_id");
$admin_row=mysqli_fetch_assoc($admin_result);
include_once '../settings_class.php';
$the_settings=new Mysettings();
$settings_data=$the_settings->select_all();
include_once '../users_class.php';
$users= new Users();
$users_data=$users->select_last_users();
$all_users_data=$users->select_all_users();
$users_count=count($all_users_data);
include_once '../category_class.php';
$categories= new Categories();
$categories_data=$categories->select_all();
$categories_count=count($categories_data);
include_once '../product_class.php';
$products= new Products();
$products_data=$products->select_all();
$products_count=count($products_data);
include_once '../orders_class.php';
$orders= new Orders();
$orders_data=$orders->select_last_orders();
$all_orders_data=$orders->select_all_orders();
$orders_count=count($all_orders_data);
include_once '../messages_class.php';
$messages= new Messages();
$messages_data=$messages->select_all_messages();
$messages_count=count($messages_data);
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $settings_data['name']; ?> | Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="../img/<?php echo $settings_data['logo']; ?>">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- adminpro icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/adminpro-custon-icon.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- summernote CSS
		============================================ -->
    <link rel="stylesheet" href="css/summernote.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- dropzone CSS
		============================================ -->
    <link rel="stylesheet" href="css/dropzone.css">
    <!-- charts CSS
		============================================ -->
    <link rel="stylesheet" href="css/c3.min.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
        <!-- forms CSS
        ============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <style type="text/css">
        .header-top-menu ul li a:hover{
            color: lightgray !important;
        }
        .btn-success {
            color: #d41c50;
            background-color: #d8d7d8;
            border-color: #d8d7d8;
        }
        .btn-success:hover {
            color: #fff;
            background-color: #d41c50;
            border-color: #d41c50;
        }
        .btn-success:active {
            color: #fff;
            background-color: #d41c50;
            border-color: #d41c50;
        }
        .btn-danger {
            color: #d41c50;
            background-color: #d8d7d8;
            border-color: #d8d7d8;
        }
        .btn-danger:hover {
            color: #fff;
            background-color: #d41c50;
            border-color: #d41c50;
        }
        .btn-danger:active {
            color: #fff;
            background-color: #d41c50;
            border-color: #d41c50;
        }
        th{
            background-color: #333;
            color: #fff;
            text-align: center;
            border-left: 1px solid #ddd !important;
        }
        td{
            //padding-left: 10px important;
            background-color: red important;
        }
        .breadcome-menu li a:hover{
            color: #d41c50 !important;
            color: #d41c50;font-weight: bold;
        }
        .breadcome-menu li span{
            color: #d41c50 !important;
            font-weight: bold !important;
        }
        .alert-success,.alert-danger{
            //background-color: #d41c50;
            //opacity: .6;
            //color: #fff;
            //height: 50px;
            //line-height: 50px;
            font-weight: bold;
            text-align: left;
            //padding-left: 35px;
           // margin-bottom: 20px;
            //display: none;
        }
        .ar-rtl{
            text-align: right !important;
            padding-right: 10px !important;
        }
        #td1{
            border-left: 1px solid lightgray !important;
        }
        #td2{
            border-left: 1px solid lightgray !important;
        }
       
    </style>
</head>

<body class="materialdesign">
    <div class="wrapper-pro">
        <div class="left-sidebar-pro">
            <nav id="sidebar">
                
                <div class="left-custom-menu-adp-wrap">
                    <ul class="nav navbar-nav left-sidebar-menu-pro">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link dropdown-toggle"><i class="fa big-icon fa-home"></i> <span class="mini-dn">الرئيسية</a>  
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-picture-o" aria-hidden="true"></i><span class="mini-dn"> البانر</span><span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="banners/" class="dropdown-item">عرض الصور</a>
                                <a href="banners/create/" class="dropdown-item">اضافة صورة</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-bars"></i><span class="mini-dn"> الاقسام الرئيسية</span><span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="categories/" class="dropdown-item">عرض الاقسام</a>
                                <a href="categories/create/" class="dropdown-item">اضافة قسم</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-bars"></i><span class="mini-dn"> الاقسام الفرعية</span><span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="subcategories/" class="dropdown-item">عرض الاقسام</a>
                                <a href="subcategories/create/" class="dropdown-item">اضافة قسم</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-globe" aria-hidden="true"></i><span class="mini-dn"> الدول </span><span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="countries/" class="dropdown-item"> عرض الكل </a>
                                <a href="countries/create/" class="dropdown-item">اضافة دولة</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-barcode" aria-hidden="true"></i><span class="mini-dn"> المنتجات</span><span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="products/" class="dropdown-item">عرض المنتجات</a>
                                <a href="products/create/" class="dropdown-item">اضافة منتج</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-cog" aria-hidden="true"></i><span class="mini-dn"> المقاسات</span><span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="sizes/" class="dropdown-item">عرض الكل</a>
                                <a href="sizes/create/" class="dropdown-item">اضافة مقاس</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="mini-dn"> الطلبات</span><span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="orders/" class="dropdown-item">كل الطلبات</a>
                                <a href="orders/current/" class="dropdown-item">الطلبات الحالية</a>
                                <a href="orders/finished/" class="dropdown-item">الطلبات المنتهية</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-smile-o" aria-hidden="true"></i><span class="mini-dn"> اكواد الخصم</span><span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="discoundCodes/" class="dropdown-item">عرض الكل</a>
                                <a href="discoundCodes/create/" class="dropdown-item">اضافة كود</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-commenting-o" aria-hidden="true"></i><span class="mini-dn"> الرسائل</span><span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="messages/" class="dropdown-item">كل الرسائل</a>
                                <a href="messages/cancel/" class="dropdown-item">الغاء طلب</a>
                                <a href="messages/other/" class="dropdown-item">اخرى</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="users/" class="nav-link dropdown-toggle"><i class="fa fa-user" aria-hidden="true"></i> <span class="mini-dn"> المستخدمين </a>  
                        </li>
                        <li class="nav-item">
                            <a href="about/" class="nav-link dropdown-toggle"><i class="fa fa-question-circle" aria-hidden="true"></i> <span class="mini-dn">من نحن</a>  
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Header top area start-->
        <div class="content-inner-all">
            <div class="header-top-area">
                <div class="fixed-header-top"  style="background-color: #d41c50 !important">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12">
                                <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn" style="background-color: #d41c50 !important;border-color: #d41c50 !important">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <div class="admin-logo logo-wrap-pro">
                                    <a href="../admin"><h2><span style="color: #fff"><?php echo $settings_data['name']; ?></span></h2>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-1 col-sm-1 col-xs-12">
                                <div class="header-top-menu tabl-d-n">
                                    <ul class="nav navbar-nav mai-top-nav">
                                        <li class="nav-item"><a href="settings/" class="nav-link"><i class="fa fa-wrench" aria-hidden="true"></i> الاعدادات</a>
                                        </li>
                                        <li class="nav-item"><a href="admins/" class="nav-link"><i class="fa fa-users" aria-hidden="true"></i> الادارة</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                <div class="header-right-info">
                                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                        <li class="nav-item">
                                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                                <span class="admin-name"><?php echo $admin_row['username']; ?></span>
                                                <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX" style="background-color: #d41c50 !important">
                                                <!-- <li><a href="#"><span class="adminpro-icon adminpro-home-admin author-log-ic"></span>My Account</a>
                                                </li>
                                                <li><a href="#"><span class="adminpro-icon adminpro-user-rounded author-log-ic"></span>My Profile</a>
                                                </li>
                                                <li><a href="#"><span class="adminpro-icon adminpro-money author-log-ic"></span>User Billing</a>
                                                </li>
                                                <li><a href="#"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Settings</a>
                                                </li> -->
                                                <li><a href="logout.php"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Log Out</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header top area end-->
            <!-- Breadcome start-->
      
            <!-- Breadcome End-->
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <li><a href="index.php">الرئيسية</a></li>
                                        <li><a data-toggle="collapse" data-target="#demo" href="#">البانر <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="banners/">صور البانر </a>
                                                </li>
                                                <li><a href="banners/create/">اضافة صورة</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demo" href="#">الأقسام الرئيسية <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="categories/">عرض الاقسام الرئيسية</a>
                                                </li>
                                                <li><a href="categories/create/">اضافة قسم رئيسى</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demo" href="#">الأقسام الفرعية <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="subcategories/">عرض الأقسام الفرعية</a>
                                                </li>
                                                <li><a href="categories/create/">اضافة قسم فرعى</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demo" href="#"> الدول <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="countries/">عرض الكل</a>
                                                </li>
                                                <li><a href="countries/create/">اضافة دولة </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demo" href="#">المنتجات <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="products/">عرض المنتجات</a>
                                                </li>
                                                <li><a href="products/create/">اضافة منتج</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demo" href="#">المقاسات <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="sizes/">عرض الكل</a>
                                                </li>
                                                <li><a href="sizes/create/">اضافة مقاس</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demo" href="#">الطلبات <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="orders/">كل الطلبات</a>
                                                </li>
                                                <li><a href="orders/current/">الطلبات الحالية</a>
                                                </li>
                                                <li><a href="orders/finished/">الطلبات المنتهية</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demo" href="#">اكواد الخصم <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="discoundCodes/">عرض الكل</a>
                                                </li>
                                                <li><a href="discoundCodes/create/">اضافة كود</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demo" href="#">الرسائل <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="messages/">كل الرسائل</a>
                                                </li>
                                                <li><a href="messages/cancel/">الغاء طلب</a>
                                                </li>
                                                <li><a href="messages/other/">اخرى</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="users/">المستخدمين</a></li>
                                        <li><a href="about/">من نحن</a></li>
                                        <li><a href="admins/">الادارة</a></li>
                                        <li><a href="settings/">الاعدادات</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
            <!-- Breadcome start-->
            <div class="breadcome-area mg-b-30 des-none">
            </div>
            <!-- Breadcome End-->
            <div class="inbox-mailbox-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcome-area mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list shadow-reset">
                    <div class="row">
						<div class="col-lg-2 col-sm-12" style="background-color: #d41c50;color: #ebebeb;margin-left: 30px;height: 110px;line-height: 110px;text-align: center;position: relative;">
							<div>
								<i class="fa fa-barcode" aria-hidden="true" style="font-size: 45px;"></i> <span style="font-size: 15px;"> ( <?php echo $products_count; ?> )</span>
							</div>
							<div>
								<a href="products/" style="font-size: 15px;position: absolute;bottom: -37px;left: 13px;color: #ebebeb;text-decoration: none;">المنتجات</a>
							</div>
						</div>
						<div class="col-lg-2 col-sm-12" style="background-color: #ebebeb;color: #d41c50;margin-left: 30px;height: 110px;line-height: 110px;text-align: center;position: relative;">
							<div>
								<i class="fa fa-user" aria-hidden="true" style="font-size: 45px;"></i> <span style="font-size: 15px;"> ( <?php echo $users_count; ?> )</span>
							</div>
							<div>
								<a href="users/" style="font-size: 15px;position: absolute;bottom: -37px;left: 13px;color: #d41c50;text-decoration: none;">المستخدمين</a>
							</div>
						</div>
						<div class="col-lg-2 col-sm-12" style="background-color: #d41c50;color: #ebebeb;margin-left: 30px;height: 110px;line-height: 110px;text-align: center;position: relative;">
							<div>
								<i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 45px;"></i> <span style="font-size: 15px;"> ( <?php echo $orders_count; ?> )</span>
							</div>
							<div>
								<a href="orders/" style="font-size: 15px;position: absolute;bottom: -37px;left: 13px;color: #ebebeb;text-decoration: none;">الطلبات</a>
							</div>
						</div>
						<div class="col-lg-2 col-sm-12" style="background-color: #ebebeb;color: #d41c50;margin-left: 30px;height: 110px;line-height: 110px;text-align: center;position: relative;">
							<div>
								<i class="fa fa-bars" style="font-size: 45px;"></i> <span style="font-size: 15px;"> ( <?php echo $categories_count; ?> )</span>
							</div>
							<div>
								<a href="categories/" style="font-size: 15px;position: absolute;bottom: -37px;left: 13px;color: #d41c50;text-decoration: none;">الاقسام</a>
							</div>
						</div>
						<div class="col-lg-2 col-sm-12" style="background-color: #d41c50;color: #ebebeb;margin-left: 30px;height: 110px;line-height: 110px;text-align: center;position: relative;">
							<div>
								<i class="fa fa-commenting-o" aria-hidden="true" style="font-size: 45px;"></i> <span style="font-size: 15px;"> ( <?php echo $messages_count; ?> )</span>
							</div>
							<div>
								<a href="messages/" style="font-size: 15px;position: absolute;bottom: -37px;left: 13px;color: #ebebeb;text-decoration: none;">الرسائل</a>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="post">
    <div class="col-lg-12" style="margin-bottom: 30px;">
        <div class="tab-content">
            <div id="inbox" class="tab-pane fade in animated zoomInDown custom-inbox-message shadow-reset active">  
            	<h4 style="color: #d41c50;text-align: right;">احدث الطلبات (اخر 10 طلبات)</h4>
                <table id="table" data-toggle="table" style="direction:rtl;">
                    <thead>
                        <tr>                                    
                            <th>الاسم بالكامل</th>
                            <th>الميل</th>
                            <th>الهاتف</th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($orders_data as $order) {
                        ?>
                        <tr class="new-email">
                            <td id="td1"><?php echo $order['fullname']; ?></td>
                            <td><?php echo $order['email']; ?></td>
                            <td><?php echo $order['phone']; ?></td>
                            <td><?php echo $order['order_date']; ?></td>
                        </tr> 
                        <?php } ?>     
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</form>

<form method="post">
    <div class="col-lg-12">
        <div class="tab-content">
            <div id="inbox" class="tab-pane fade in animated zoomInDown custom-inbox-message shadow-reset active">  
            	<h4 style="color: #d41c50;text-align: right;">احدث الأعضاء (اخر 10 تسجيلات)</h4>
                <table id="table" data-toggle="table" style="direction:rtl;">
                    <thead>
                        <tr>                                    
                            <th>الاسم بالكامل</th>
                            <th>الميل</th>
                            <th>الهاتف</th>
                            <th>النوع</th>
                            <th>تاريخ التسجيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($users_data as $user) {
                        ?>
                        <tr class="new-email">
                            <td id="td2"><?php echo $user['user_fullname']; ?></td>
                            <td><?php echo $user['user_email']; ?></td>
                            <td><?php echo $user['user_phone']; ?></td>
                            <td><?php echo $user['user_gender']; ?></td>
                            <td><?php echo $user['regesteration_date']; ?></td>
                        </tr> 
                        <?php } ?>     
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <!-- map JS
		============================================ -->
    <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <!--  dropzone JS
		============================================ -->
    <script src="js/dropzone.js"></script>
    <!-- multiple email JS
		============================================ -->
    <script src="js/multiple-email/multiple-email-active.js"></script>
    <!-- summernote JS
		============================================ -->
    <script src="js/summernote.min.js"></script>
    <script src="js/summernote-active.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
    <script type="text/javascript">
    $(function(){
        //confirm delete message
        $('.confirm').click(function(){
            return confirm('are you sure you want to delete this item?');
        });
    })
    </script>
</body>

</html>