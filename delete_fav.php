<?php
ob_start();
if (empty($_SERVER['HTTP_REFERER'])) {
	include 'navbar.php';
?>
<div class="container-fluid  arabic">
    <div class="container"><br>
        <div class="row ">
            <div class="col-md-12 col-12" style="text-align:center">
                <h2 style="color:red;margin-top: 5%;margin-bottom: 3%;"> الرابط الذى تحاول الوصول إليه غير صحيح </h2>
                <a href="index.php" style="color: #0008ff;text-decoration:none;font-size: 17px;"> العودة إلى الصفحة الرئيسية </a> 
            </div>
        </div><br><br>
    </div>
</div>
<?php 
include 'footer_ar.php';
}else{
	$product_code = (isset($_GET['code'])) ? $_GET['code'] : 0;
    if(!ctype_alnum($product_code)){
        $product_code=0;
    }
	session_start();
	if(isset($_SESSION['user_id'])){
		$user_id=$_SESSION['user_id'];
	}else{
		header("location: login-ar.php");
	}
	include 'database_class.php';
	$db= new Database();
	$wish_statement="DELETE FROM wish_list WHERE user_id = '$user_id' AND product_code='$product_code'";
	$wish_result= $db->runDml($wish_statement);
	if ($wish_result) {
		header("location: wishlist-ar.php");
	}
}
ob_end_flush();
?>