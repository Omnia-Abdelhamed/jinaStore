<?php
ob_start();
include 'header_ar.php';
if(isset($_POST['send'])){
    $email=$_POST['email'];
    $email=trim(filter_var($email, FILTER_SANITIZE_STRING));
    require_once 'src/PHPMailer.php';
    require_once 'src/Exception.php';
    require_once 'src/SMTP.php';
    require_once 'vendor/autoload.php';

    $mail= new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->Username = 'omnia.silmy@gmail.com';
    $mail->Password = '';
    $mail->SetFrom('omnia.silmy@gmail.com', 'jinaStore');
    $mail->AddAddress($email);
    $mail->Subject = ' استعادة كلمة المرور ';
    $mail->Body= 'hi from jinaStore';
    if (!$mail->send()) {
        echo "<div class='alert alert-danger' style='text-align:right;'>عفوا ! لبعض المشاكل التقنية لم نتمكن من ارسال كلمة المرور يمكنك طلبها مرة أخرى </div>";
    }else{
        echo "<div class='alert alert-success'>تم ارسال بيانات حسابك الخاص بالموقع الى بريدك الالكترونى من فضلك راجع الرسائل المرسلة او الرسائل المزعجة</div>";
    }

}
?>
<!--- --->
<div class="container arabic">
<div class="row"> 
</div>
<div class="row">
<form class="col-md-6 col-11" method="post">
<h1>استعادة كلمة المرور</h1>
<input placeholder="البريد الإلكتروني " class="w-50 " type="email" name="email" required=""><br><br>
<button type="submit" class="btn w-50 btn-dark bg-main" name="send">ارسال </button><br><br>
<p>ليس لديك حساب بعد <a href="register-ar.php" class="main-color">إنشاء حساب</a></p>
</form>


</div>

</div>
     
<?php
include 'footer_ar.php';
ob_end_flush();
?>