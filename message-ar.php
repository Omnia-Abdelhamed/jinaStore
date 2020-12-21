<?php
include 'navbar.php';
if (isset($_POST['send'])) {
	include_once 'messages_class.php';
	$messages=new Messages();
	$my_date=getdate();
  	$send_date=$my_date['year']."-".$my_date['mon']."-".$my_date['mday']." ".$my_date['hours'].":".$my_date['minutes'].":".$my_date['seconds'];
  	$messages->set_first_name($_POST['first_name']);
  	$messages->set_last_name($_POST['last_name']);
  	$messages->set_email($_POST['email']);
  	$messages->set_phone($_POST['phone']);
  	$messages->set_message_order($_POST['message_order']);
  	$messages->set_subject($_POST['subject']);
  	$messages->set_message($_POST['message']);
  	$messages->set_send_date($send_date);
  	$result= $messages->insert();
}

?>
<!--- --->
   <div class="container arabic" id="message_content">  <br><br> 
   <?php
   if (isset($result)) {
   	if (!$result) { ?>
   	<div class="container"><br>
        <div class="row ">
            <div class="col-md-12 col-12" style="text-align:center">
                <div class="alert alert-danger col-12" style="text-align: center;margin-top: 5%;margin-bottom: 3%;font-size: 20px;"> حدث خطأ اثناء  ارسال رسالتك من فضلك حاول مرة اخرى </div> 
            </div>
        </div><br><br>
    </div>
   <?php } } ?>         
<form class="row " method="post">
<div class="col-sm-4 col-12">  <input type="text" class="form-control " name="first_name" placeholder=" الأسم الأول" required></div>
<div class="col-sm-4 col-12">  <input type="text" class="form-control " name="last_name" placeholder=" الأسم الأخير" required></div>
<div class="col-sm-4 col-12">   <input type="email" class="form-control " name="email" placeholder="  بريدك الألكتروني"  required>
        <small >نفس البريد الذي أستخدمته في طلبك</small><br>
</div>
<div class="col-sm-4 col-12">  <input type="text" class="form-control " name="phone" placeholder=" تلفونك" required></div>
<div class="col-sm-4 col-12">    <input type="text" class="form-control " name="message_order" placeholder=" طلب " required>
     <small>ساعدنا في الرد بسرعة</small><br></div>
<div class="col-sm-4 col-12">         
    <select class="form-control" name="subject">
<option value="">أختر الموضوع</option>
<option value="cancel">إلغاء الطلب</option>
    </select></div>
<textarea class="col-12"  placeholder="ملاحظاتك" rows="6" name="message" required=""></textarea>
<br><br>
    <div class="col-12 text-center">
 <p>إذا كنت قد قدمت بالفعل حالة تتعلق بطلبك ، فيرجى عدم إرسال حالة أخرى ؛ لأنه قد يؤخر عملية الرد عليك. يمكنك ببساطة الرد على البريد الإلكتروني الذي تلقيته بخصوص قضيتك وسوف نتلقى تعليقاتك الجديدة.
</p>
        <button type="submit" class="btn  bg-main " name="send">إرسال</button><br><br></div>
</form>
</div>
   <div class="container-fluid  arabic" id="message_success" style="display: none;">
    <div class="container"><br>
        <div class="row ">
            <div class="col-md-12 col-12" style="text-align:center">
                <div class="alert alert-success col-12" style="text-align: center;margin-top: 5%;margin-bottom: 3%;font-size: 20px;"> تم ارسال رسالتك بنجاح  </div> 
            </div>
        </div><br><br>
    </div>
</div>   
<?php
if (isset($result)) {
  if ($result) {
    ?>
    <script type="text/javascript">
      document.getElementById('message_content').style.display="none";
      document.getElementById('message_success').style.display="block";
    </script>
    <?php
  } 
}
include_once "footer_ar.php";

?>