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
<?php
  include_once 'database_class.php';
  include_once 'product_class.php';
  $products=new Products();
  $product_code = (isset($_GET['code'])) ? $_GET['code'] : 0;
  if(!ctype_alnum($product_code)){
    $product_code=0;
  }
  $products->set_product_code($product_code);
  $product_row=$products->select_by_code();
  if (!empty($product_row)) {
    $products_added_images=$products->select_added_images();
    if (!empty($products_added_images)) { 
      $active_image=array_shift($products_added_images);
?>
<body class=" container-fluid bg-light ">
  <div class="container">
    <div id="carouselExampleIndicators" class="carousel slide carousel1 " data-ride="carousel"    >
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/products/<?php echo $active_image['product_extra_image']; ?>" class="d-block w-100  h-img" alt="<?php echo $active_image['product_extra_image'] ?>" data-toggle="modal" data-target="#staticBackdrop">
        </div>
        <?php foreach ($products_added_images as $extra_image){ ?>
        <div class="carousel-item">
          <img src="img/products/<?php echo $extra_image['product_extra_image']; ?>" class="d-block w-100 h-img" alt="<?php echo $extra_image['product_extra_image']; ?>" data-toggle="modal" data-target="#staticBackdrop">
        </div>
        <?php } ?>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <a href="product-ar.php?code=<?php echo $product_code; ?>" class="abs"><i class="fas fa-compress" style="font-size: 30px;"></i></a>
    </div>
                
    <ol class=" position-relative navbar text-center" style="width:100%;margin-top:10x;z-index: 10;list-style: none;justify-content:space-between" ><br> 
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"  >
        <img src="img/products/<?php echo $active_image['product_extra_image']; ?>"  style="height: 90px;width: 90px;margin: 10px">
      </li><br>
      <?php foreach ($products_added_images as $extra_image_icon){ ?>
      <li data-target="#carouselExampleIndicators" data-slide-to="1">
        <img src="img/products/<?php echo $extra_image_icon['product_extra_image']; ?>"  style="height: 90px;width: 90px;margin: 10px">
      </li><br>
      <?php } ?>
    </ol>  
  </div>
  <script src="js/jquery-3.3.1.min.js"></script>  
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/all.min.js"></script> 
  <script src="js/wow.min.js"></script>
  <script>
    new WOW().init();
  </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script src="js/main-js.js"></script>
</body>   
</html>
<?php }else{ 
include_once 'header_ar.php';
?>
<div class="container-fluid  arabic">
    <div class="container"><br>
        <div class="row ">
            <div class="col-md-12 col-12" style="text-align:center">
                <h2 style="color:#d41c50;margin-top: 5%;margin-bottom: 3%;"> الرابط الذى تحاول الوصول إليه غير صحيح </h2>
                <a href="index.php" style="color: #0008ff;text-decoration:none;font-size: 17px;"> العودة إلى الصفحة الرئيسية </a> 
            </div>
        </div><br><br>
    </div>
</div>
<?php
  include_once "footer_ar.php"; }
?>
<?php }else{ 
include_once 'header_ar.php';
?>
<div class="container-fluid  arabic">
    <div class="container"><br>
        <div class="row ">
            <div class="col-md-12 col-12" style="text-align:center">
                <h2 style="color:#d41c50;margin-top: 5%;margin-bottom: 3%;"> الرابط الذى تحاول الوصول إليه غير صحيح </h2>
                <a href="index.php" style="color: #0008ff;text-decoration:none;font-size: 17px;"> العودة إلى الصفحة الرئيسية </a> 
            </div>
        </div><br><br>
    </div>
</div>
<?php
  include_once "footer_ar.php"; }
?>