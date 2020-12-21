<?php
ob_start();
include 'navbar.php';
if(!isset($_SESSION['user_id'])){
    header("location: login-ar.php");
}else{
  $user_id=$_SESSION['user_id'];
}
include_once 'orders_class.php';
$orders=new Orders();
$orders->set_user_id($user_id);
$result=$orders->select_all();
$current_orders=array();
$finished_orders=array();
foreach ($result as $value) {
  $order_time=$value['order_time'];
  $finished_time=$order_time+864000;
  if (time() > $finished_time) {
    $finished_orders[]=$value;
  }else{
    $current_orders[]=$value;
  }
}
?>
   <!--- --->
<div class="container arabic">
<div class="row">
<h1 class="text-center  col-12">طلباتي</h1>
<h3 class="col-12">الطلبات الحالية</h3>
<?php 
if (!empty($current_orders)) {
  $id=1;
foreach ($current_orders as $value) { 
$product_code=$value['product_code'];

?>
<div class=" col-12 col-sm-6 col-md-4 col-lg-3"  ><br>
  <div class="card text-center">
		<a href="product-ar.php?code=<?php echo $value['product_code'] ?>">
      <img src="img/products/<?php echo $value['product_main_image']; ?>" class="card-img-top" alt="..."> 
    </a>
    <div class="card-body">
      <a href="product-ar.php?code=<?php echo $value['product_code'] ?>" class="card-text text-dark"><?php echo $value['product_title_ar']; ?> 
      </a>
      <p class="card-title" href=""><b><?php echo $value['product_price']; ?> <?php echo $settings_data['ar_currency']; ?></b>
      </p>
      <form method="post" action="cart-ar.php" style="display: inline-block;">
        <input type="hidden" name="product_code" value="<?php echo $value['product_code'] ?>">
        <input type="hidden" name="quantity" value="1">
        <button class="  pad-10 " title="add to bag" style="color: #d41c50;border: none;background-color: #fff;" name="add_to_cart" id="add_to_cart<?php echo $id; ?>">  <i class="fas fa-shopping-bag" style="font-size: 25px"></i> 
        </button>
      </form>
       <?php 
       $products->set_product_code($product_code);
       $clothes_sizes=$products->select_sizes();
       if (!empty($clothes_sizes)) { ?>
         <script type="text/javascript">
          document.getElementById('add_to_cart'+<?php echo $id; ?>).onclick=function(ev){
            ev.preventDefault();
            alert("يجب تحديد المقاس");
          }
         </script>

       <?php } ?>
      
      <?php
        if (isset($_SESSION['user_id'])) {
            $user_id=$_SESSION['user_id'];
        }else{
            $user_id=0;
        }
        $db= new Database();
        $wish_statement="SELECT * FROM `wish_list` WHERE user_id='$user_id' AND product_code='$product_code'";
        $wish_result= $db->runDml($wish_statement);
        $wish_count=mysqli_num_rows($wish_result);
        if ($wish_count > 0) {                             
        ?>
        <a class=" heart pad-10 the_wish" title="delete from wishlist" href="" id="<?php echo $value['product_code'] ?>"> <i class='fa fa-heart' aria-hidden='true' style='font-size: 25px'></i></a>
        <?php }else{ ?>
            <a class=" heart pad-10 the_wish" title="add to wishlist" href="" id="<?php echo $value['product_code'] ?>"> <i class="far fa-heart" style="font-size: 25px"></i></a>
      <?php } ?>
    </div>
  </div>
</div>
<?php $id++ ; } }else{ ?>
<div class="col-md-12 col-12" style="text-align:center">
  <div class="alert alert-danger col-12" style="text-align: center;margin-top: 5%;margin-bottom: 3%;font-size: 20px;">لا يوجد طلبات حالية </div> 
</div>
<?php } ?>
					
<hr class="col-12"><br>
    
    
<h3 class="col-12">الطلبات المنتهية</h3>
 <?php   if (!empty($finished_orders)) {
$id1=1; foreach ($finished_orders as $value1) { 
$product_code=$value1['product_code'];
?>

            		<div class=" col-12 col-sm-6 col-md-4 col-lg-3"  >
                              <br> <div class="card text-center">
				 <a href="product-ar.php?code=<?php echo $value1['product_code'] ?>">
                     <img src="img/products/<?php echo $value1['product_main_image']; ?>" class="card-img-top" alt="..."> </a>
                                <div class="card-body">
                  <a href="product-ar.php?code=<?php echo $value1['product_code'] ?>" class="card-text text-dark"><?php $value1['product_title_ar']; ?> </a>
             <p class="card-title" href=""><b><?php echo $value1['product_price']; ?> <?php echo $settings_data['ar_currency']; ?></b></p>
                  <form method="post" action="cart-ar.php" style="display: inline-block;">
                      <input type="hidden" name="product_code" value="<?php echo $value1['product_code'] ?>">
                      <input type="hidden" name="quantity" value="1">
                      <button class="  pad-10 " title="add to bag" style="color: #d41c50;border: none;background-color: #fff;" name="add_to_cart" id="add_to_cart<?php echo $id1; ?>">  <i class="fas fa-shopping-bag" style="font-size: 25px"></i> 
                      </button>
                    </form>
                    <?php 
                     $products->set_product_code($product_code);
                     $clothes_sizes=$products->select_sizes();
                     if (!empty($clothes_sizes)) { ?>
                       <script type="text/javascript">
                        document.getElementById('add_to_cart'+<?php echo $id1; ?>).onclick=function(ev){
                          ev.preventDefault();
                          alert("يجب تحديد المقاس");
                        }
                       </script>

                     <?php } ?>
                          <?php
                                if (isset($_SESSION['user_id'])) {
                                    $user_id=$_SESSION['user_id'];
                                }else{
                                    $user_id=0;
                                }
                                $db= new Database();
                                $wish_statement="SELECT * FROM `wish_list` WHERE user_id='$user_id' AND product_code='$product_code'";
                                $wish_result= $db->runDml($wish_statement);
                                $wish_count=mysqli_num_rows($wish_result);
                                if ($wish_count > 0) {                             
                                ?>
                                <a class=" heart pad-10 the_wish" title="delete from wishlist" href="" id="<?php echo $value1['product_code'] ?>"> <i class='fa fa-heart' aria-hidden='true' style='font-size: 25px'></i></a>
                                <?php }else{ ?>
                                    <a class=" heart pad-10 the_wish" title="add to wishlist" href="" id="<?php echo $value1['product_code'] ?>"> <i class="far fa-heart" style="font-size: 25px"></i></a>
                                <?php } ?>
                         </div>
                             </div></div>
                <?php $id1++; } }else{ ?>
                            <div class="col-md-12 col-12" style="text-align:center">
                <div class="alert alert-danger col-12" style="text-align: center;margin-top: 5%;margin-bottom: 3%;font-size: 20px;">لا يوجد طلبات منتهية </div> 
            </div>
                           <?php } ?>
    
    </div></div><br><br>
<?php
include_once 'footer_ar.php';
ob_end_flush();
?>
<script type="text/javascript">
$(document).ready(function(){
    var the_values=document.getElementsByClassName('the_wish');
    var i;
    for (i = 0; i < the_values.length; i++) {
        the_values[i].onclick=function(e){
            e.preventDefault();
            <?php if (!isset($_SESSION['user_id'])) { ?>
            alert("من فضلك سجل دخولك أولا .."); 
            <?php }else{ ?>
                var id=this.id;
                if(id){
                    $.ajax({
                        url: "insert_to_wish.php",
                        type: "POST",
                        data:{product_code:id},
                        success: function(msg) { 
                            $("#"+id).html(msg);
                        },
                        error: function(msg) {
                            alert("error");
                        }
                    });
                }
            <?php } ?>
        }  
    }
});
</script>