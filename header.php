<?php
include 'database_class.php';
include 'category_class.php';
$categories=new Categories();
global $categories_data;
$categories_data=$categories->select_all();
include 'subcategory_class.php';
global $subcategories;
$subcategories=new Subcategories();

function get_categories(){ 
  global $categories_data;
  global $subcategories;
  foreach ($categories_data as $category) { 
    $category_id=$category['category_id'];
    $subcategories_data=$subcategories->select_by_category($category_id); ?>
    <li class="nav-item li1 "> 
      <a class="nav-link  "  href="category.php?cat_id=<?php echo $category_id ?>&subcat_id=1" ><?php echo $category['category_name_en']; ?></a>
      <div class=" li2">
        <ul class="navbar-nav" >
        <?php foreach ($subcategories_data as $subcategory) { ?>
          <li class="nav-item "> 
            <a class="nav-link  "  href="category.html" ><?php echo $subcategory['subcategory_name_en']; ?></a>
          </li>
        <?php } ?>
        </ul>
      </div>
    </li>
  <?php  } 
} ?>
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
</head>
<body >
<div class=" container-fluid  d-lg-block d-none ">
  <header class=" container">
    <div class="float-left pad-10">
      <a  class="  logo  " href="index.php">
        <img src="img/logo.png">
      </a>           
    </div>

    <ul class="nav  float-right pad-10" >
      <li class="nav-item li1 ">  
        <a class="nav-link"  href="" > 
          <i class="fas fa-search" style="font-size: 20px"></i>
        </a>	
        <form  role="form" class=" search">
          <input placeholder="search " class="w-100 " type="search">		 
        </form>
      </li>

      <li class="nav-item li1  ">
        <a class="nav-link" href="account.html">  
          <i class="fas fa-user-tie" style="font-size: 20px"></i>
        </a>
   		  <div class=" li2">
          <ul class="navbar-nav" >
            <li class="nav-item "> 
              <a class="nav-link  "  href="login.html" >sign in</a>
            </li>
            <li class="nav-item "> 
              <a class="nav-link  "  href="register.html" >sign up</a>
            </li>
          </ul>
        </div>
      </li> 

      <li class="nav-item  ">  
        <a class="nav-link"  href="cart.html" ><i class="fas fa-shopping-bag" style="font-size: 20px"></i> 
        </a>
      </li> 

      <li class="nav-item  ">  
        <a class="nav-link"  href="message.html" ><i class="fas fa-phone-volume"  style="font-size: 20px"></i> 
        </a>
      </li> 

      <li class="nav-item ">  
        <a class="nav-link" href="index-ar.html" >  العربية</a>
      </li>
    </ul>   
  <div style="clear: both"></div>
  </header>
</div>
<header class="container-fluid d-lg-block d-none bg-w border-bottom bg-light">
  <div class=" container">      
    <ul class="nav" >
    <?php get_categories(); ?>
    </ul> 
  </div>
</header>
<!-----md-nav ---> 
<header class=" container-fluid d-lg-none d-block text-center border-bottom">
      
    <a  class="  logo " href="index.php">
<img src="img/logo.png">
</a> 
      <button class="navbar-toggler open float-left nav-item" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <a class="nav-link  "  > 
              <i class="fas fa-align-justify" style="font-size: 25px"></i> </a>
        </button>
    
     <ul class="nav  float-right" >
               <li class="nav-item  ">  <a class="nav-link   "  href="cart.html" >  <i class="fas fa-shopping-bag" style="font-size: 20px"></i> </a>
    </li> 
     <li class="nav-item li1  "><a class="nav-link" href="account.html">  <i class="fas fa-user-tie" style="font-size: 20px"></i>  </a>
   		 <div class=" li2" style="left: auto;right: 0;">
              <ul class="navbar-nav" >
      <li class="nav-item "> 
        <a class="nav-link  "  href="login.html" >  sign in</a>
    </li>
    <li class="nav-item "> 
        <a class="nav-link  "  href="register.html" >  sign up</a>
    </li>               
             </ul>
</div>
</li> 
                   <li class="nav-item li1 ">  <a class="nav-link  "  href="" > <i class="fas fa-search" style="font-size: 20px"></i></a>	
    <form  role="form" class=" search">
    <input placeholder="search " class="w-100 " type="search">		 
    </form>
    </li>
    </ul>
    </header>
     <!--- sidbar --->
         
  <header class="sidbar col-md-6 col-sm-8 col-10"><br>
    <div class="close hide text-right col-12"> 
      <i class="fas fa-times "></i>
    </div>
    <br><br>
    <ul class="navbar-nav  pad-0 " >
      <?php get_categories(); ?>
      <li class="nav-item ">  <a class="nav-link   "  href="index.php" >عربي </a>
      </li>
    </ul>
  </header>
        
    
      <!-----end nav ---> 