<?php
ob_start();
include 'navbar.php';
if(!isset($_SESSION['user_id'])){
    header("location: login-ar.php");
}
include_once 'users_class.php';
$users= new Users();
$user_id=$_SESSION['user_id'];
$users->set_user_id($user_id);
$formErrors=array();
if (isset($_POST['update_user'])) {
  $users->set_user_country($_POST['country']);
  $users->set_user_city($_POST['city']);
  $users->set_user_street($_POST['street']);
  $users->set_user_email($_POST['email']);
  $users->set_user_fullname($_POST['fullname']);
  $users->set_user_phone($_POST['phone']);
  $users->set_user_gender($_POST['gender']);
  $email_count=$users->select_updated_email();
  if($email_count > 0){
    $formErrors[]="البريد الالكترونى الذى ادخلته مستخدم من قبل..ادخل بريد اخر";
  }
  $phone_count=$users->select_updated_phone();
  if($phone_count > 0){
    $formErrors[]=" رقم الهاتف  الذى ادخلته مستخدم من قبل..ادخل رقم  اخر";
  }
  if (empty($formErrors)) {
    $updated_result=$users->update_user();
  }
}
$user_data=$users->select_all();
$user_address_data=$users->select_user_address();
?>
      <!-----end nav ---> 
<div class="container account arabic" >            
  <div class="row pad  ">
    <h1  class="col-12 text-center"><br>حسابي<hr></h1><br>
    <?php
      foreach ($formErrors as $error) {
        echo "<div class='alert alert-danger col-12 text-center'>".$error."</div>";
      }
      if (isset($updated_result)) {
        if ($updated_result) {
          echo "<div class='alert alert-success col-12 text-center'> تم تعديل  بياناتك بنجاح  </div>";
        }
      }
    ?>
    <form class="col-12  border" method="post">        
      <div class="row border-bottom pad-10">
        <label class="col-md-3 col-12  "><br> الأسم:</label>
        <input type="text" required=""  value="<?php echo $user_data['user_fullname']; ?>"  class="col-9" name="fullname"><br>
      </div>
      <div class="row border-bottom pad-10">
        <label class="col-md-3 col-12 "> <br>النوع:</label>
        <?php if ($user_data['user_gender'] == "female") { ?>
        <div class="size-blocks  col-9 ">
          <div class="radio-inline size float-right">
            <input type="radio" name="gender" value="female" id="radio-size-1" class="check_sizes" checked="">
            <label for="radio-size-1" style="width: 60px;">female</label>
          </div>
          <div class="radio-inline size float-right">
            <input type="radio" name="gender" value="male" id="radio-size-2" class="check_sizes">
            <label for="radio-size-2">male</label>
          </div>
          <div style="clear: both"></div> 
        </div>
        <?php }else{ ?>
        <div class="size-blocks  col-9 ">
          <div class="radio-inline size float-right">
            <input type="radio" name="gender" value="female" id="radio-size-1" class="check_sizes">
            <label for="radio-size-1" style="width: 60px;">female</label>
          </div>
          <div class="radio-inline size float-right">
            <input type="radio" name="gender" value="male" id="radio-size-2" class="check_sizes" checked="">
            <label for="radio-size-2">male</label>
          </div>
          <div style="clear: both"></div> 
        </div>
        <?php } ?>
      </div>
      <div class="row border-bottom pad-10 ">
        <label class="col-md-3 col-12 "> <br>  البريد الإليكتروني:</label>
        <input type="email" required="" value="<?php echo $user_data['user_email']; ?>" class=" col-9" name="email"><br>   
      </div>
      <div class="row border-bottom pad-10 ">
        <label class="col-md-3 col-12 "> <br>كلمة السر :</label>
        <div class=" col-9" style="margin-top: 19px;">
          <a href="change-password.php" style="color: gray;">تغيير  كلمة  السر </a>
        </div>
      </div>
      <div class="row border-bottom pad-10">
        <label class="col-md-3 col-12 "> <br>الدولة :</label>
        <select class=" col-9" name="country" style="border:none !important;">
            <?php include_once 'country_class.php';
            $countries1= new Countries();
            $user_country=$countries1->select_user_country($user_id);
            $country_id1=$user_country['country_id'];
            ?>
            <option value="<?php echo $user_country['country_id']; ?>"><?php echo $user_country['country_name_ar']; ?></option>
             <?php
                $countries_data1=$countries1->select_all1($country_id1);
                foreach ($countries_data1 as $country1) {
                ?>
                <option value="<?php echo $country1['country_id']; ?>"><?php echo $country1['country_name_ar']; ?></option>
            <?php } ?>
        </select>
      </div>
      <div class="row border-bottom pad-10">
        <label class="col-md-3 col-12 "><br>المدينه:</label>
        <input type="text "  value="<?php echo $user_address_data['user_city'] ?>" class=" col-9" name="city">
      </div> 
      <div class="row border-bottom pad-10">
        <label class="col-md-3 col-12 "><br>الشارع:</label>
        <input type="text"  value="<?php echo $user_address_data['user_street'] ?>" class=" col-9" name="street">  
      </div>
      <div class="row  border-bottom pad-10">
        <label class="col-md-3 col-12 "> <br>رقم الهاتف :</label>
        <input type="tel" required="" value="<?php echo $user_data['user_phone']; ?>" class=" col-9" name="phone"><br>   
      </div>
      <div class="  col-12 justify-content-between">
        <button class="btn btn-dark mr-10" type="submit" name="update_user">تعديل</button><br><br>
        <a href=" order-ar.php" class="btn bg-main mr-10 float-left">طلباتي</a>   
        <a href=" wishlist-ar.php" class="btn bg-main mr-10  float-left"> المفضلة </a>
        <?php if (empty($user_address_data)) { ?>     
        <a href="address-ar.php" class="btn bg-main mr-10  float-left"> أضف عنوان</a><br><br>   
        <?php }else{ ?>
        <a href="address-ar.php" class="btn bg-main mr-10  float-left"> تعديل العنوان </a><br><br>   
        <?php } ?>
      </div>
    </form>
  </div>
</div>
    
<?php
include 'footer_ar.php';
ob_end_flush();
?>