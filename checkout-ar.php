<?php
ob_start();
include 'navbar.php';
if(!isset($_SESSION['user_id'])){
    header("location: login-cart-ar.php");
}else{
  $user_id=$_SESSION['user_id'];
}
if (!empty($_SESSION['cart'])) {
    $total_price=0;
    foreach ($_SESSION['cart'] as $key => $value) { 
        $products->set_product_code($value['product_code']);
        $product_row1=$products->select_by_code();
        if (!empty($product_row1)) {
            $new_total_price=($product_row1['product_price']*$value['quantity']);
            $total_price=$total_price+$new_total_price;
        }
    }

include_once 'users_class.php';
$users= new Users();
include_once 'discound_class.php';
$discounds= new Discound();
$discounds_data=$discounds->select_all();
$discound_code_count=count($discounds_data);
$users->set_user_id($user_id);
$user_address_data=$users->select_user_address();
if (!empty($user_address_data)) {
  $country=$user_address_data['user_country'];
  $city=$user_address_data['user_city'];
  $street=$user_address_data['user_street'];
  $notes=$user_address_data['user_notes'];
}else{
  $country="";
  $city="";
  $street="";
  $notes="";
}
$user_data=$users->select_all();
if (!empty($user_data)) {
  $fullname=$user_data['user_fullname'];
  $email=$user_data['user_email'];
  $phone=$user_data['user_phone'];
}else{
  $fullname="";
  $email="";
  $phone="";
}
if (isset($_POST['checkout'])) {
    include_once 'orders_class.php';
    $orders= new Orders();
    if(isset($_POST['discound_code'])){
        if(!empty($_POST['discound_code'])){
            $user_discound_code=$_POST['discound_code'];
            $discounds->set_discound_code($user_discound_code);
            $the_discound=$discounds->select_discound();
            $the_discound_count=count($the_discound);
            if($the_discound_count > 0){
                $final_discound=$the_discound['value'];
            }else{
                $final_discound=0;
            }
        }else{
            $final_discound=0;
        }
    }else{
        $final_discound=0;
    }
    $my_date=getdate();
    $order_date=$my_date['year']."-".$my_date['mon']."-".$my_date['mday']." ".$my_date['hours'].":".$my_date['minutes'].":".$my_date['seconds'];
    $order_time=time();
    $orders->set_user_id($user_id);
    $orders->set_user_email($_POST['email']);
    $orders->set_user_fullname($_POST['fullname']);
    $orders->set_user_phone($_POST['phone']);
    $orders->set_user_country($_POST['country']);
    $orders->set_user_city($_POST['city']);
    $orders->set_user_street($_POST['street']);
    $orders->set_discound($final_discound);
    $orders->set_user_notes($_POST['notes']);  
    $orders->set_order_date($order_date);
    $orders->set_order_time($order_time);
    $orders->set_cart($_SESSION['cart']);

    $result= $orders->insert();
}
?>
<!--- --->
<div class="container arabic" id="checkout_content">  <br><br>          
  <div class="row pad  ">
    <div class="col-8 ">
      <div class="col-12 border">
        <div class="btn-dark row">
          <h3 class=" col-12">  تفاصيل الشحن</h3>
        </div><br>     
        <form method="post">
          <input type="text" class="form-control " name="fullname" value="<?php echo $fullname; ?>" placeholder="الأسم" required><br>
          <input type="text" class="form-control " name="phone" value="<?php echo $phone; ?>" placeholder="موبيل" required> <br>
          <input type="text" name="email" value="<?php echo $email; ?>" placeholder="البريد الإلكتروني" class="form-control" required> <br>
          <select class="form-control " name="country" id="theCountry" required>
              <?php 
                include_once 'country_class.php';
                $countries= new Countries();
                $all_countries=$countries->select_all();
                $other_countries=$countries->select_all1($country);
                $the_country=$countries->select_by_one($country);
                if(empty($country)){ ?>
              <option value="">اختر الدولة..</option>
              <?php foreach($all_countries as $all){ ?>
              <option value="<?php echo $all['country_id']; ?>"><?php echo $all['country_name_ar']; ?></option>
              <?php } ?>
              <?php }else{ ?>
              <option value="<?php echo $the_country['country_id']; ?>"><?php echo $the_country['country_name_ar']; ?></option>
              <?php foreach($other_countries as $the_other){ ?>
              <option value="<?php echo $the_other['country_id']; ?>"><?php echo $the_other['country_name_ar']; ?></option>
              <?php } ?>
              <?php } ?>
          </select><br>
          <input type="text" class="form-control " name="city" value="<?php echo $city; ?>" placeholder="المدينة" required> <br>
          <input type="text" class="form-control " name="street" value="<?php echo $street; ?>" placeholder="الشارع" required> <br>
          <?php if(isset($discound_code_count)){ if( $discound_code_count > 0){ ?>
          <input type="text" class="form-control " name="discound_code" placeholder="كود الخصم (فى حالة وجوده)" > <br>
          <?php } } ?>
          <textarea class="col-12"  placeholder="ملاحظاتك " rows="6" name="notes"><?php echo $notes; ?></textarea><br><br>
          <button type="submit" class="btn btn-sm btn-third-col bg-main" name="checkout"> استكمال الدفع </button><br><br>
        </form>
      </div>
    </div>
    <div class="col-4 ">
      <div class="col-12 border">
        <div class="btn-dark row">
          <h3 class=" col-12">  ملخص الطلب</h3>
        </div><br>
        <!-- start looping -->
        <?php foreach ($_SESSION['cart'] as $key => $value) { 
              $products->set_product_code($value['product_code']);
              $product_row=$products->select_by_code();
              if (!empty($product_row)) { ?>
        <div class="row ">
          <a href="product-ar.php?code=<?php echo $product_row['product_code']; ?>" class=" col-lg-3 col-sm-12">
            <img alt=" T-shirts" src="img/products/<?php echo $product_row['product_main_image'] ?>" width="80px;">
          </a>
          <div class="col-lg-6 col-sm-12">
            <a href="product-ar.php?code=<?php echo $product_row['product_code']; ?>" ><?php echo $product_row['product_title_ar']; ?></a> 
            <p class="">الكمية : <?php echo $value['quantity']; ?></p>
          </div>
          <p class="col-lg-3 col-sm-12"> <?php echo ($product_row['product_price']*$value['quantity']) ?> <?php echo $settings_data['ar_currency']; ?> </p>
        </div><br>
        <?php } } ?>
        <!-- end looping -->
            <div id="shipping_taxes">
                <div class="row">
                    <label class=" col-lg-3 col-sm-12" style="font-weight:bold">الشحن : </label>
                    <label class=" col-lg-9 col-sm-12" id="shipping_value"><?php if(empty($country)){ ?> اختر الدولة اولا <?php }else{ echo $the_country['shipping']." ".$settings_data['ar_currency']; } ?></label>
                </div>
                <div class="row">
                    <label class=" col-lg-3 col-sm-12" style="font-weight:bold">الضريبة : </label>
                    <label class=" col-lg-9 col-sm-12" id="taxes_value"><?php if(empty($country)){ ?> اختر الدولة  اولا <?php }else{ echo "%".$the_country['taxes']; } ?></label>
                </div>
            </div>
      </div>
    </div>
  </div><br><br>
</div>
   
<?php
}else{ ?>
<div class="container-fluid  arabic">
    <div class="container"><br>
        <div class="row ">
            <div class="col-md-12 col-12" style="text-align:center">
                <div class="alert alert-danger col-12" style="text-align: center;margin-top: 5%;margin-bottom: 3%;font-size: 20px;"> لا يوجد منتجات فى السلة  </div> 
            </div>
        </div><br><br>
    </div>
</div>
<?php } ?>
<div class="container arabic" id="checkout_success" style="display: none;">          
    <div class="row pad  ">
        <div class="col-md-12 col-12" style="text-align:center">
            <div class="alert alert-success col-12" style="text-align: center;margin-top: 5%;margin-bottom: 3%;font-size: 20px;"> تم تسجيل طلبك بنجاح  </div>
        </div><br><br>
        <div class="col-12 ">
            <div class="col-12 border">
                <div class="btn-dark row">
                    <h3 class=" col-12">  ملخص الطلب</h3>
                </div><br>
                <!-- start looping -->
                <?php 
                $last_cart=$_SESSION['cart'];
                foreach ($last_cart as $key => $last) { 
                  $products->set_product_code($last['product_code']);
                  $the_product_row=$products->select_by_code();
                  if (!empty($the_product_row)) { ?>
                <div class="row ">
                  <a href="product-ar.php?code=<?php echo $the_product_row['product_code']; ?>" class=" col-lg-3 col-sm-12">
                    <img alt=" T-shirts" src="img/products/<?php echo $the_product_row['product_main_image'] ?>" width="80px;">
                  </a>
                  <div class="col-lg-6 col-sm-12">
                    <a href="product-ar.php?code=<?php echo $the_product_row['product_code']; ?>" ><?php echo $the_product_row['product_title_ar']; ?></a> 
                    <p class="">الكمية : <?php echo $last['quantity']; ?></p>
                  </div>
                    <p class="col-lg-3 col-sm-12"> <?php echo ($the_product_row['product_price']*$last['quantity']) ?> <?php echo $settings_data['ar_currency']; ?> </p>
                </div><br>
                <?php } } ?>
                <!-- end looping -->
                <div class="row">
                    <label class=" col-lg-3 col-sm-12" style="font-weight:bold">صافى : </label>
                    <label class=" col-lg-9 col-sm-12"><?php echo $total_price." ".$settings_data['ar_currency']; ?></label>
                </div>
                <div class="row">
                    <label class=" col-lg-3 col-sm-12" style="font-weight:bold">خصم : </label>
                    <label class=" col-lg-9 col-sm-12"><?php echo $final_discound." %"; ?></label>
                </div>
                <div class="row">
                    <label class=" col-lg-3 col-sm-12" style="font-weight:bold">بعد الخصم : </label>
                    <label class=" col-lg-9 col-sm-12"><?php echo $total_price-(($final_discound/100)*$total_price)." ".$settings_data['ar_currency']; ?></label>
                </div>
                <?php $last_country=$_POST['country']; 
                include_once 'country_class.php';
                $countries2= new Countries();
                $the_country2=$countries2->select_by_one($last_country);
                $last_shipping=$the_country2['shipping'];
                $last_taxes=$the_country2['taxes'];
                ?>
                <div class="row">
                    <label class=" col-lg-3 col-sm-12" style="font-weight:bold">ضريبة : </label>
                    <label class=" col-lg-9 col-sm-12"><?php echo $last_taxes." %"; ?></label>
                </div>
                <div class="row">
                    <label class=" col-lg-3 col-sm-12" style="font-weight:bold">بعد الضريبة : </label>
                    <label class=" col-lg-9 col-sm-12"><?php echo (($last_taxes/100)*($total_price-(($final_discound/100)*$total_price)))+($total_price-(($final_discound/100)*$total_price))." ".$settings_data['ar_currency']; ?></label>
                </div>
                <div class="row">
                    <label class=" col-lg-3 col-sm-12" style="font-weight:bold">شحن : </label>
                    <label class=" col-lg-9 col-sm-12"><?php echo $last_shipping." ".$settings_data['ar_currency']; ?></label>
                </div>
                <div class="row">
                    <label class=" col-lg-3 col-sm-12" style="font-weight:bold">بعد الشحن : </label>
                    <label class=" col-lg-9 col-sm-12"><?php echo (($last_taxes/100)*($total_price-(($final_discound/100)*$total_price)))+($total_price-(($final_discound/100)*$total_price))+$last_shipping." ".$settings_data['ar_currency']; ?></label>
                </div>
               
            </div>
        </div><br><br>
    </div>
</div>



<?php
if (isset($result)) {
  if ($result) { 
    unset($_SESSION['cart']);
    ?>
    <script type="text/javascript">
      document.getElementById('checkout_content').style.display="none";
      document.getElementById('checkout_success').style.display="block";
    </script>
    <?php
  } 
}

include_once 'footer_ar.php';
?>
<script>
    $("#theCountry").change(function() {
		var theCountry=$("#theCountry").val();
		if(theCountry){
			$.ajax({
				url: "select_shipping.php",
				type: "POST",
				data:{country_id:$("#theCountry").val()},
				success: function(msg) { 
					$("#shipping_taxes").html(msg);
				},
				error: function(msg) {
					alert("error");
				}
			});
		}
	});
</script>
<?php
ob_end_flush();
?>