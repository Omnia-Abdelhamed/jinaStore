<?php

include_once 'nav.php';
function get_categories(){ 
    global $categories_data;
    global $subcategories;
    foreach ($categories_data as $category) { 
        $category_id=$category['category_id'];
        $subcategories_data=$subcategories->select_by_category($category_id); ?>
        <li class="nav-item li1 "> 
        <a class="nav-link  "  href="category-ar.php?cat_id=<?php echo $category_id; ?>" ><?php echo $category['category_name_ar']; ?></a>
        <div class=" li2">
            <ul class="navbar-nav pad-0">
            <?php foreach ($subcategories_data as $subcategory) { ?>
            <li class="nav-item "> 
                <a class="nav-link  "  href="category-ar.php?cat_id=<?php echo $category_id; ?>&subcat_id=<?php echo $subcategory['subcategory_id']; ?>" ><?php echo $subcategory['subcategory_name_ar']; ?></a>
            </li>
            <?php } ?>
            </ul>
        </div>
        </li>
<?php  } } ?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">        
    <link rel="stylesheet" href="css/main-style.css">
    <link rel="stylesheet" href="css/media.css">  
    <link rel="stylesheet" href="css/carousel.css">  
    <title><?php echo $settings_data['name']; ?></title>  
    <link rel="shortcut icon" type="image/x-icon" href="img/<?php echo $settings_data['logo']; ?>">
</head>
<body class="">
    <div class=" container-fluid  d-lg-block d-none  arabic">
        <header class=" container">
            <div class="float-right pad-10">
                <a  class="  logo  " href="index.php">
                    <img src="img/<?php echo $settings_data['logo']; ?>">
                </a>           
            </div>
            <ul class="nav  float-left pad-10" >
                <li class="nav-item li1 ">  
                    <a class="nav-link  "> <i class="fas fa-search" style="font-size: 20px"></i></a>	
                    <form  role="form" class=" search" method="post" action="search-ar.php">
                        <input placeholder="بحث " class="w-100 " type="search" name="searchText"> 
                    </form>
                </li>
                <li class="nav-item li1  "><a class="nav-link" href="account-ar.php">  <i class="fas fa-user-tie" style="font-size: 20px"></i>  </a>
   		            <div class=" li2">
                        <ul class="navbar-nav pad-0" >
                            <?php 
                            if (isset($_SESSION['user_id'])) { ?>
                            <li class="nav-item "> 
                                <a class="nav-link  "  href="logout.php" > تسجيل خروج</a>
                            </li>
                            <?php }else{ ?>
                            <li class="nav-item "> 
                                <a class="nav-link  "  href="login-ar.php" >دخول</a>
                            </li>
                            <li class="nav-item "> 
                                <a class="nav-link  "  href="register-ar.php" >  تسجيل </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li> 
                <li class="nav-item  ">  
                    <a class="nav-link   "  href="cart-ar.php" >  <i class="fas fa-shopping-bag" style="font-size: 20px"></i> </a>
                </li>  
                <li class="nav-item  ">  
                    <a class="nav-link   "  href="message-ar.php" > <i class="fas fa-phone-volume"  style="font-size: 20px"></i> </a>
                </li> 
                <li class="nav-item ">  
                    <!-- <a class="nav-link "  href="index.html" > english</a> -->
                </li>
            </ul>                 
<div style="clear: both"></div>
</header></div>
<!-- header categories -->
<header class=" container-fluid d-lg-block d-none bg-w border-bottom bg-light arabic">
    <div class=" container">      
        <ul class="nav" >
            <?php get_categories(); ?>
        </ul> 
    </div></header>
<!-----md-nav ---> 
<header class=" container-fluid d-lg-none d-block text-center border-bottom arabic">   
    <a  class="  logo " href="index.php">
        <img src="img/<?php echo $settings_data['logo']; ?>">
   </a> 
    <button class="navbar-toggler open float-left nav-item" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <a class="nav-link  "  ><i class="fas fa-align-justify" style="font-size: 25px"></i> </a>
    </button>
    
    <ul class="nav" >
        <li class="nav-item  ">  <a class="nav-link   "  href="cart-ar.php" >  <i class="fas fa-shopping-bag" style="font-size: 20px"></i> </a>
        </li> 
        <li class="nav-item li1  "><a class="nav-link" href="account-ar.php">  <i class="fas fa-user-tie" style="font-size: 20px"></i>  </a>
            <div class=" li2" style="left: auto;right: 0;">
                <ul class="navbar-nav pad-0" >
                    <li class="nav-item "> 
                        <a class="nav-link  "  href="login-ar.php" >  دخول </a>
                    </li>
                    <li class="nav-item "> 
                        <a class="nav-link  "  href="register-ar.php" >  تسجيل</a>
                    </li>               
                </ul>
            </div>
        </li> 
        <li class="nav-item li1 ">  
            <a class="nav-link  "  href="" > <i class="fas fa-search" style="font-size: 20px"></i></a>	
            <form  role="form" class=" search" method="post" action="search-ar.php">
                <input placeholder="بحث " class="w-100 " type="search"  name="searchText">		 
            </form>
        </li>
    </ul>
    </header>
     <!--- sidbar --->
         
<header class="sidbar col-md-6 col-sm-8 col-10 arabic"><br>
    <div class="close hide text-right col-12"> 
        <i class="fas fa-times "></i>
    </div><br><br>
    <ul class="navbar-nav  pad-0 " >
        <?php get_categories(); ?>
        <li class="nav-item ">  
            <!-- <a class="nav-link"  href="index-en.php" >english</a> -->
        </li>
    </ul>
</header> 