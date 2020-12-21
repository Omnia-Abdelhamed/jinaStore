<?php
ob_start();
include 'navbar.php';
$formErrors=array();
if(isset($_POST['login'])){
    include_once 'users_class.php';
    $users= new Users();

    $users->set_user_email($_POST['email']);
    $users->set_password($_POST['password']);
    $user_data=$users->select_all();
    if($user_data['count'] > 0){
        $_SESSION['user_id']=$user_data['row']['id'];
        header("location: account-ar.php");
        exit();
    }else{
        $formErrors[]="خطأ فى كلمة المرور / البريد الالكتروني";
    }
}
?>
<!--- --->
<div class="container arabic">
<div class="row"> 
    <?php
    foreach ($formErrors as $error) {
        echo "<div class='alert alert-danger'>".$error."</div>";
    }
?>
</div>
<div class="row">
<form class="col-md-6 col-11" method="post">
<h1>تسجيل دخول العملاء</h1>
<h6><b>العملاء المسجلين</b></h6>
<p>إذا كان لديك حساب ، فسجّل الدخول باستخدام عنوان بريدك الإلكتروني</p>
<input placeholder="البريد الإلكتروني " class="w-50 " type="email" name="email" required="">
<input placeholder="كلمة السر " class="w-50" minlength="6" type="password" name="password" required=""><br><br>
<button type="submit" class="btn w-50 btn-dark bg-main" name="login">دخول </button><br><br>
<a href="forget-ar.php" class="" >نسيت كلمة المرور ؟</a><br><br>
<p>ليس لديك حساب بعد <a href="register-ar.php" class="main-color">إنشاء حساب</a></p>
</form>


</div>

</div>
     
<?php
include 'footer_ar.php';
ob_end_flush();
?>