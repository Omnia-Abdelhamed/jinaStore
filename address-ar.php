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
$user_address_data=$users->select_user_address();
if (empty($user_address_data)) {
  if (isset($_POST['add'])) {
    $users->set_user_country($_POST['country']);
    $users->set_user_city($_POST['city']);
    $users->set_user_area($_POST['area']);
    $users->set_user_block($_POST['block']);
    $users->set_user_street($_POST['street']);
    $users->set_user_house($_POST['house']);
    $users->set_user_number($_POST['number']);
    $users->set_user_notes($_POST['notes']);
    $result= $users->insert_address();
    if ($result) {
      header("location: account-ar.php");
    }
  }
?>
 <!--- --->
<div class="container arabic" >            
  <div class="row pad  ">
    <h1  class="col-12 "><br>دليل العنوان</h1>
                   <form  class=" col-md-6 col-12 text-center" method="post">
                       <select name="country" class="form-control" required="">
                            <option value="">اختر الدولة...</option>
                            <?php
                            include_once 'country_class.php';
                            $countries= new Countries();
                            $countries_data=$countries->select_all();
                            foreach ($countries_data as $country) {
                            ?>
                            <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name_ar']; ?></option>
                        <?php } ?>
                       </select> <br>
                  <input type="text" class="form-control "  placeholder="المدينة"  name="city" required=""> <br>
                  <input type="text" class="form-control "  placeholder="المنطقة"  name="area" required=""> <br>
                  <input type="text" class="form-control "  placeholder="القطعة"  name="block"> <br>
                 <input type="text" class="form-control "  placeholder="الشارع"  name="street"> <br>
                 <input type="text" class="form-control "  placeholder="منزل"  name="house"> <br>
                 <input type="text" class="form-control "  placeholder="رقم"  name="number"> <br>
                                      <br>
                               <textarea class="col-12"  placeholder="ملاحظاتك " rows="6" name="notes" ></textarea>
				<br><br>
                                       <button type="submit" class="btn btn-sm btn-third-col bg-main" name="add">أضف عنوان جديد</button><br><br>

                                 </form>
      
    
                  </div></div>
 
<?php
}else{
  if (isset($_POST['update'])) {
    $users->set_user_country($_POST['country']);
    $users->set_user_city($_POST['city']);
    $users->set_user_area($_POST['area']);
    $users->set_user_block($_POST['block']);
    $users->set_user_street($_POST['street']);
    $users->set_user_house($_POST['house']);
    $users->set_user_number($_POST['number']);
    $users->set_user_notes($_POST['notes']);
    $result= $users->update_address();

  } ?>
  <div class="container arabic" >            
  <div class="row pad  ">
    <h1  class="col-12 "><br>دليل العنوان</h1>
     <?php if (isset($result)) {
       if($result){
$user_address_data=$users->select_user_address();

      echo "<div class='alert alert-success col-12 text-center'> تم تعديل العنوان بنجاح للذهاب الى حسابك اضغط  <a href='account-ar.php' style='font-wieght:bold;'>هنا</a>
      </div>";
    }
    } ?>
                   <form  class=" col-md-6 col-12 text-center" method="post">
                       <select name="country" class="form-control" required="">
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
                       </select> <br>
                       
                  <input type="text" class="form-control "  placeholder="المدينة"  name="city" value="<?php echo $user_address_data['user_city'] ?>" required=""> <br>
                  <input type="text" class="form-control "  placeholder="المنطقة"  name="area" value="<?php echo $user_address_data['user_area'] ?>" required=""> <br>
                  <input type="text" class="form-control "  placeholder="القطعة"  name="block" value="<?php echo $user_address_data['user_block'] ?>"> <br>
                 <input type="text" class="form-control "  placeholder="الشارع"  name="street" value="<?php echo $user_address_data['user_street'] ?>"> <br>
                 <input type="text" class="form-control "  placeholder="منزل"  name="house" value="<?php echo $user_address_data['user_house'] ?>"> <br>
                 <input type="text" class="form-control "  placeholder="رقم"  name="number" value="<?php echo $user_address_data['user_number'] ?>"> <br>
                                      <br>
                               <textarea class="col-12"  placeholder="ملاحظاتك " rows="6" name="notes" ><?php echo $user_address_data['user_notes'] ?></textarea>
        <br><br>
                                       <button type="submit" class="btn btn-sm btn-third-col bg-main" name="update"> تعديل العنوان </button><br><br>

                                 </form>
      
    
                  </div></div>

<?php }
  include 'footer_ar.php';
  ob_end_flush();
?>