<?php
include 'navbar.php';
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart']=array();
}
if (isset($_POST['add_to_cart'])) {
  if (empty($_SESSION['cart'])) {
    $item=array();
    $item['product_code']=$_POST['product_code'];
    $item['quantity']=$_POST['quantity'];
    if (isset($_POST['size'])) {
      $item['size']=$_POST['size']; 
    }
    $_SESSION['cart'][]=$item;
  }else{
    $the_cart=$_SESSION['cart'];
    $new_product=$_POST['product_code'];
    $new_quantity=$_POST['quantity'];
    if (isset($_POST['size'])) {
      $new_size=$_POST['size'];
    }
    $check_equal=0;
    foreach ($the_cart as $key1 => $value1) {
      $cart_product=$value1['product_code'];
      $cart_quantity=$value1['quantity'];
      if (isset($value1['size'])) {
        $cart_size=$value1['size'];
      }
      if ($new_product == $cart_product) {
        if ( !isset($new_size) & !isset($cart_size) ) {
          $last_quantity=$new_quantity+$cart_quantity;
          $_SESSION['cart'][$key1]['quantity']=$last_quantity;
          $check_equal++;
        }else{
          if ($new_size == $cart_size) {
            $last_quantity=$new_quantity+$cart_quantity;
            $_SESSION['cart'][$key1]['quantity']=$last_quantity;
            $check_equal++;
          }
        }
      }
    }
    if ($check_equal == 0) {
      $item=array();
      $item['product_code']=$_POST['product_code'];
      $item['quantity']=$_POST['quantity'];
      if (isset($_POST['size'])) {
        $item['size']=$_POST['size']; 
      }
      $_SESSION['cart'][]=$item;
    }
  }
}
?>
       <!---  --->
       <?php if (!empty($_SESSION['cart'])) { ?>
<div class="container arabic" > <br><br>           
  <div class="row pad text-center ">
    <h1  class="col-12 text-center">السلة</h1><br><br>
    <div class="col-lg-8 col-md-12 d-md-block d-none">
      <div class="table_block table-responsive " >
        <table class="table table-bordered">
          <thead class="btn-dark">
            <tr>
             <th colspan="2" >أسم المنتج</th>
             <th >السعر</th>
             <th >الكمية</th>
             <th >المجموع</th>
            </tr>
          </thead>
          <tbody >
            <!-- start large looping  -->
            <?php $total_price=0;foreach ($_SESSION['cart'] as $key => $value) { 
              $products->set_product_code($value['product_code']);
              $product_row=$products->select_by_code();
              if (!empty($product_row)) {
                $new_total_price=($product_row['product_price']*$value['quantity']);
                $total_price=$total_price+$new_total_price;

            ?>
            <tr >
              <td >
                <a href="product-ar.php?code=<?php echo $product_row['product_code'] ?>">
                   <img alt="<?php echo $product_row['product_main_image'] ?>" src="img/products/<?php echo $product_row['product_main_image'] ?>" width="100px;">
                </a>
              </td>
              <td >
                <p class="">
                   <a href="product-ar.php?code=<?php echo $product_row['product_code'] ?> " class="active"><?php echo $product_row['product_title_ar'] ?></a>
                </p>
                <small>كود المنتج: <span> <?php echo $value['product_code']; ?> </span></small>
                <?php if (isset($value['size'])) {
                  $size=$value['size']; 
                  $db= new Database();
                  $size_result=$db->runDml("SELECT * FROM sizes WHERE size_id='$size'");
                  $size_row=mysqli_fetch_assoc($size_result);
                ?>
                  <p style="margin-top: 10px;"><small>المقاس  : <span> <?php echo $size_row['size_title']; ?> </span></small></p>
                <?php } ?>
              </td>
              <td >
                <span><?php echo $product_row['product_price'] ?> <?php echo $settings_data['ar_currency']; ?></span>
              </td>
              <td class=" text-center">
                <form class=" product-count col-12 ">
                  <a rel="nofollow" class="btn btn-default" href="quantity_minus.php?cart_row=<?php echo $key; ?>" title="Subtract">&ndash;</a>
                  <input type="text" disabled="" size="2" autocomplete="off" class="cart_quantity_input form-control grey count" value="<?php echo $value['quantity'] ?>" name="quantity">
                  <a rel="nofollow" class="btn btn-default" href="quantity_plus.php?cart_row=<?php echo $key; ?>" title="Add">+</a>
                </form>
              </td>
              <td class="subtotal text-center" data-title="SUBTOTAL">
                <p><?php echo ($product_row['product_price']*$value['quantity']) ?> د.ك </p> <a class="active" href="delete_cart_row.php?cart_row=<?php echo $key; ?>"><i class="fas fa-archive" ></i></a>
              </td>
            </tr> 
          <?php } } ?>
            <!-- end large looping  -->  
          </tbody>
        </table>
      </div>
    </div>
    <!-- start mid,small -->
    <?php foreach ($_SESSION['cart'] as $key => $value) { 
      $products->set_product_code($value['product_code']);
      $product_row=$products->select_by_code();
      if (!empty($product_row)) {
    ?>
    <div class="col-sm-12 d-md-none d-block">
      <div class="row border  text-center"><br>
        <a href="product-ar.php?code=<?php echo $product_row['product_code'] ?> " class="col-12 "><br>
           <img alt=" T-shirts" src="img/products/<?php echo $product_row['product_main_image'] ?>" width="100px;">
        </a><br>
        <a href="product-ar.php?code=<?php echo $product_row['product_code'] ?>  " class="active col-12"> <?php echo $product_row['product_title_ar'] ?> </a><br>                    
        <p class="col-12">كود المنتج: <?php echo $value['product_code'] ?> </p>
         <?php if (isset($value['size'])) {
            $size=$value['size']; 
            $db= new Database();
            $size_result=$db->runDml("SELECT * FROM sizes WHERE size_id='$size'");
            $size_row=mysqli_fetch_assoc($size_result);
          ?>
            <p class="col-12">المقاس :  <?php echo $size_row['size_title']; ?></p> 
          <?php } ?>
        <p class="col-12">السعر: <?php echo $product_row['product_price'] ?> <?php echo $settings_data['ar_currency']; ?></p>                    
        <form class=" product-count col-12">
          <a rel="nofollow" class="btn btn-default" href="quantity_minus.php?cart_row=<?php echo $key; ?>" title="Subtract">&ndash;</a>
          <input type="text" disabled="" size="2" autocomplete="off" class="cart_quantity_input form-control grey count" value="<?php echo $value['quantity'] ?>" name="quantity">
          <a rel="nofollow" class="btn btn-default" href="quantity_plus.php?cart_row=<?php echo $key; ?>" title="Add">+</a>
        </form>
        <p class="col-12">المجموع: <?php echo ($product_row['product_price']*$value['quantity']) ?>  <?php echo $settings_data['ar_currency']; ?></p>
        <p class="col-12 text-right">
          <a   class="active" href="delete_cart_row.php?cart_row=<?php echo $key; ?>"><i class="fas fa-archive"  ></i></a>
        </p>                  
      </div>
    </div>
    <?php } } ?>
    <!-- end mid,small -->

    <!-- start details -->
    <div class="col-lg-4   col-xs-12  text-right">
      <div class="row">
        <div class="container col-xs-12  border">
          <div class="btn-dark row">
            <h3 class=" col-12">   تفاصيل السلة</h3>
          </div><br>
          <p >المجموع:<span class="float-left"><?php echo $total_price; ?> <?php echo $settings_data['ar_currency']; ?></span></p><br>
          <!--<p >الشحن:<span class="float-left">الشحن مجانا </span></p><br>-->
          <!-- <p >المجموع الكلي: <span class="float-left">$2100.00</span></p><br> -->
          <p class="active"> الدفع عند الأستلام</p>
          <a  href="checkout-ar.php" class="btn w-100 bg-main ">الدفع</a>  <br><br>
          <a  href="index.php" class="btn w-100 btn-light border">مواصلة التسوق</a> <br><br>                
        </div>
      </div>        
    </div>
    <!-- end details -->
  </div>
</div>
<?php }else{ ?>
<div class="container-fluid  arabic">
    <div class="container"><br>
        <div class="row ">
            <div class="col-md-12 col-12" style="text-align:center">
                <div class="alert alert-danger col-12" style="text-align: center;margin-top: 5%;margin-bottom: 3%;font-size: 20px;"> لا يوجد منتجات فى السلة  </div> 
            </div>
        </div><br><br>
    </div>
</div>
<?php }
include 'footer_ar.php';
?>