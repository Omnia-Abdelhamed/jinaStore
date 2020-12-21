<?php
ob_start();
include 'navbar.php';
if(!isset($_SESSION['user_id'])){
    header("location: login-ar.php");
}
include_once 'users_class.php';
$users= new Users();
$user_id=$_SESSION['user_id'];
$formErrors=array();
if (isset($_POST['update_password'])) {
  $users->set_user_id($user_id);
  $current_password=$_POST['current_password'];
  $new_password=$_POST['new_password'];
  $confirm_password=$_POST['confirm_password'];
  $users->set_password($current_password);
  $user_data=$users->select_all();
  $user_password=$user_data['password'];
  if ($user_password != $current_password) {
    $formErrors[]="كلمة المرور غير صحيحة ";
  }
  if ($new_password != $confirm_password) {
    $formErrors[]="كلمة المرور غير متطابقة ";
  }
  if (empty($formErrors)) {
    $result = $users->update_password($new_password);
  }
}

?>
      <!-----end nav ---> 
<div class="container account arabic" >            
  <div class="row pad  ">
    <h1  class="col-12 text-center"><br>تغيير كلمة المرور <hr></h1><br>
        <?php
    foreach ($formErrors as $error) {
        echo "<div class='alert alert-danger col-12 text-center'>".$error."</div>";
    }
    if (isset($result)) {
       if($result){
      echo "<div class='alert alert-success col-12 text-center'>تم تغيير كلمة المرور بنجاح 
      للعودة الى حسابك اضغط   <a href='account-ar.php' style='font-wieght:bold;'>هنا</a>
      </div>";
    }
    }
   
?>
    <form class="col-12  border" method="post">        
      <div class="row border-bottom pad-10">
        <label class="col-md-3 col-12  "><br> كلمة المرور الحالية :</label>
        <input type="password" class="col-9" name="current_password" required="" style="border: 1px solid lightgray !important;"><br>
      </div>
      <div class="row border-bottom pad-10 ">
        <label class="col-md-3 col-12 "> <br>كلمة المرور الجديدة :</label>
        <input type="password"  class="col-9" name="new_password" required="" style="border: 1px solid lightgray !important;" minlength="6"><br>   
      </div>
      <div class="row border-bottom pad-10">
        <label class="col-md-3 col-12 "> <br>تأكيد كلمة المرور  :</label>
        <input type="password" class="col-9" required="" style="border: 1px solid lightgray !important;" name="confirm_password">
      </div>
      <div class="  col-12 justify-content-between">
        <input type="submit" name="update_password" value="تعديل" style="border: 2px solid #d41c50 !important;color: #fff;background-color: #d41c50 !important;font-weight: bold;"><br><br>
      </div>
    </form>
  </div>
</div>
    
<?php
include 'footer_ar.php';
ob_end_flush();
?>