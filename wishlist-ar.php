<?php
ob_start();
include 'navbar.php';
if(!isset($_SESSION['user_id'])){
    header("location: login-ar.php");
}else{
  $user_id=$_SESSION['user_id'];
}
$db= new Database();
$wish_statement="SELECT * FROM wish_list INNER JOIN products ON wish_list.product_code = products.product_code WHERE wish_list.user_id = $user_id ORDER BY wish_id DESC";
$wish_result= $db->runDml($wish_statement);
$data= array();
while ($row=mysqli_fetch_assoc($wish_result)) {
  $data[]=$row;
}
?>
    <!--- --->
<div class="container-fluid arabic">
  <div class="container"><br>
    <div class="row ">
		  <h1 class="col-12 text-center">المفضلة </h1> 
      <?php foreach ($data as $value) { ?>          
      <div class=" col-12 col-sm-6 col-md-4 col-lg-3"  ><br>
        <div class="card text-center">
			    <a href="product-ar.php?code=<?php echo $value['product_code']; ?>">
            <img src="img/products/<?php echo $value['product_main_image']; ?>" class="card-img-top" alt="...">
          </a>
          <div class="card-body">
            <a href="product-ar.php?code=<?php echo $value['product_code']; ?>" class="card-text text-dark"><?php echo $value['product_title_ar']; ?> </a>
            <p class="card-title" href=""><b><?php echo $value['product_price']; ?> د.ك </b></p>
            <a class="  pad-10 "  href="cart-ar.html" title="add to bag">  
              <i class="fas fa-shopping-bag" style="font-size: 25px"></i> 
            </a>
            <a class=" heart pad-10" title="add to wishlist" href="delete_fav.php?code=<?php echo $value['product_code']; ?>"> <i class='fa fa-heart' aria-hidden='true' style='font-size: 25px'></i></a>
          </div>
        </div>
      </div>
    <?php } ?>
    </div>       	
  </div>
</div><br><br>
    
  
<?php
include 'footer_ar.php';
ob_end_flush();
?>