<?php
session_start();
if(isset($_SESSION['admin_id'])){
    header("location: admin/");
}
include_once 'database_class.php';
include_once 'admin_class.php';
if(isset($_POST['login'])){
    $admin=new Admins();
    $admin->set_username($_POST['username']);
    $admin->set_password($_POST['password']);
    $admin_data=$admin->select_all();
    if($admin_data['count'] > 0){
    	$admin_id=$admin_data['row']['id'];
    	// if (isset($_POST['remember'])) {
    	// 	setcookie("admincookie",$admin_id,time()+60*60*24*365);
    	// }
        $_SESSION['admin_id']=$admin_id;
        header("location: admin/");
        exit();
    }
}

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>janaStore | Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="admin/img/logo.png">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/font-awesome.min.css">
    <!-- adminpro icon CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/adminpro-custon-icon.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/meanmenu.min.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/jquery.mCustomScrollbar.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/animate.css">
    <!-- summernote CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/summernote.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="admin/css/data-table/bootstrap-editable.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/normalize.css">
    <!-- dropzone CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/dropzone.css">
    <!-- charts CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/c3.min.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="admin/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="admin/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
        <!-- forms CSS
        ============================================ -->
    <link rel="stylesheet" href="admin/css/form/all-type-forms.css">
    <script src="admin/js/vendor/modernizr-2.8.3.min.js"></script>
    <style>
        html, body {
           background: linear-gradient(90deg, rgba(2,0,36,1) 8%, rgba(212, 28, 80,1) 45%, rgba(2,0,36,1) 100%); 
        }
    </style>
</head>
<body>

<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5" style="top: 150px;left: 29%;">
                <div class="sparkline9-list shadow-reset">
                    <div class="sparkline9-hd">
                        <div class="main-sparkline9-hd">
                            <h1 style="color:#d41c50;">Admin Login</h1>    
                        </div>
                    </div>
                    <div class="sparkline9-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="basic-login-inner">
                                        <form method="post">
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label class="login2">Username</label>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="username" class="form-control" placeholder="Enter Username" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label class="login2">Password</label>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <input type="password" name="password" class="form-control" placeholder="password" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="login-btn-inner">
                                                <div class="row">
                                                    <div class="col-lg-4"></div>
                                                    <div class="col-lg-8">
                                                        <div class="i-checks">
                                                            <label>
                                                                <input type="checkbox" name="remember" value="1"><i></i> Remember me </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5"></div>
                                                    <div class="col-lg-7">
                                                        <div class="login-horizental">
                                                            <button class="btn btn-sm btn-primary login-submit-cs" type="submit" style="background-color:#d41c50;border-color:#d41c50;font-weight:bold;" name="login">Sign In</button>
                                                        </div>
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
            </div>
        </div>          
    </div>
</div> 
</body>
</html>
