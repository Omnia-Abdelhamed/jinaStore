<?php 
include 'navbar.php';
$formErrors=array();
if (isset($_POST['register'])) {
    include_once 'users_class.php';
    $users= new Users();
    $my_date=getdate();
    $regesteration_date=$my_date['year']."-".$my_date['mon']."-".$my_date['mday']." ".$my_date['hours'].":".$my_date['minutes'].":".$my_date['seconds'];

    $users->set_user_email($_POST['email']);
    $users->set_user_fullname($_POST['fullname']);
    $users->set_password($_POST['password']);
    $users->set_user_phone($_POST['phone']);
    $users->set_regesteration_date($regesteration_date);
    if(isset($_POST['gender'])){
        $users->set_user_gender($_POST['gender']);
    }
    $email_count=$users->select_by_email();
    if($email_count > 0){
        $formErrors[]="البريد الالكترونى الذى ادخلته مستخدم من قبل..ادخل بريد اخر";
    }
    $phone_count=$users->select_by_phone();
    if($phone_count > 0){
      $formErrors[]=" رقم الهاتف  الذى ادخلته مستخدم من قبل..ادخل رقم  اخر";
    }

    if (empty($formErrors)) {
        $result=$users->insert();	
    }
}

?>
    <!--- --->
       <div class="container arabic">
           <div class="row">
           <?php if (isset($result)) { 
                    if ($result) { ?>
                <div class="alert alert-success">تم اشتراكك بنجاح يمكنك الان تسجيل الدخول من 
                <a href="login-ar.php" sytle="font-weight:bold"> هنا </a>
                </div>

                <?php
                }}foreach ($formErrors as $error) {
                    echo "<div class='alert alert-danger'>".$error."</div>";
                }
            ?>
            </div>
            <div class="row">
               <form class="col-md-6 col-12" method="post">
                <h1>إنشاء حساب عميل جديد</h1>
                   <h6><b>معلومات شخصية</b></h6>
                   <input placeholder="الإيميل " class="w-50 " type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required="">
                <input placeholder="كلمة السر " class="w-50" minlength="6" type="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" required="">
                    <input placeholder="الأسم بالكامل  " class="w-50 " type="text" name="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : '' ?>" required="">
                    <input placeholder="رقم الهاتف " class="w-50 " type="text" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>"><br>
                           <div class="size-blocks ">
                  <div class="radio-inline size float-right"><input type="radio" name="gender" value="male" id="male"><label style="width: 100px;"  for="male">ذكر</label></div>
                  <div class="radio-inline size float-right"><input type="radio" name="gender" value="female" id="female"><label style="width: 100px;" 
                for="female">أنثي</label></div>
                               <div style="clear: both"></div>
                   </div>
                <button type="submit" class="btn w-50 btn-dark bg-main" name="register">تسجيل </button><br><br>
                <p>لديك بالفعل حساب <a href="login-ar.php" class="main-color">تسجيل دخول</a></p>
               </form>
           </div>
    
           </div>
    
<?php include 'footer_ar.php'; ?>
