<?php
    include 'navbar.php';
    $product_code = (isset($_GET['code'])) ? $_GET['code'] : 0;
    if(!ctype_alnum($product_code)){
        $product_code=0;
    }
    $products->set_product_code($product_code);
    if (isset($_POST['send'])) {
        $products->set_nickname($_POST['nickname']);
        $products->set_summary($_POST['summary']);
        $products->set_review($_POST['review']);
        $review_result=$products->insert_to_review($product_code);
    }
    $product_row=$products->select_by_code();
    if (!empty($product_row)) {
        $products_added_images=$products->select_added_images();
        $clothes_sizes=$products->select_sizes();
        $category_id=$product_row['category_id'];
        $other_products=$products->select_by_category($category_id,$order="DESC");
?>
<header class="container-fluid bg-light border-bottom arabic">
    <div class="container">
        <ul class="nav product" >
            <li class="nav-item"><a class="nav-link" href="index.php" > الرئيسة </a></li>
            <li class="nav-item"><a class="nav-link"  href="" ><i class="fas fa-arrow-left " style="font-size: 20px"></i></a></li>
            <li class="nav-item"><a class="nav-link" href="product-ar.php?code=<?php echo $product_row['product_code']; ?>" ><?php echo $product_row['product_title_ar'] ?></a></li>    
        </ul>
    </div>
</header>
<!--- --->
<div class="container arabic"><br><br>
    <div class="row">
        <div class="col-md-6 col-12 pad-0">
        <?php if(!empty($products_added_images)){ 
            $active_image=array_shift($products_added_images);
        ?>
            <div id="carouselExampleIndicators" class="carousel slide carousel1" data-ride="carousel" >
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/products/<?php echo $active_image['product_extra_image']; ?>" class="d-block w-100 h-img" alt="<?php echo $active_image['product_extra_image'] ?>" data-toggle="modal" data-target="#staticBackdrop">
                    </div>
                    <?php foreach ($products_added_images as $extra_image){ ?>
                    <div class="carousel-item">
                        <img src="img/products/<?php echo $extra_image['product_extra_image']; ?>" class="d-block w-100 h-img" alt="<?php echo $extra_image['product_extra_image']; ?>" data-toggle="modal" data-target="#staticBackdrop">
                    </div>
                    <?php } ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <a href="img.php?code=<?php echo $product_code; ?>" class="abs"><i class="fas fa-expand" style="font-size: 30px;"></i></a>
            </div>
                
            <ol class=" position-relative navbar" style="width:100%;margin-top:10x;z-index: 10;list-style: none;justify-content:space-between" ><br>
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"  >
                    <img src="img/products/<?php echo $active_image['product_extra_image']; ?>"  style="height: 90px;width: 90px;margin: 10px">
                </li><br>
                <?php foreach ($products_added_images as $extra_image_icon){ ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="1">
                    <img src="img/products/<?php echo $extra_image_icon['product_extra_image']; ?>"  style="height: 90px;width: 90px;margin: 10px">
                </li><br> 
                <?php } ?>             
            </ol>  
            <?php }else{ ?>
            <div id="carouselExampleIndicators" class="carousel slide carousel1" data-ride="carousel" >
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/products/<?php echo $product_row['product_main_image'] ?>" class="d-block w-100 h-img" alt="..." data-toggle="modal" data-target="#staticBackdrop">
                    </div>
                </div>
                <div class="col-md-6 col-12"></div>
            </div>
            <?php } ?>        
        </div>
        <div class="col-md-6 col-12">
            <h2 ><?php echo $product_row['product_title_ar']; ?></h2>
            <h5><?php echo $product_row['product_code']; ?></h5>
            
            <form class=" row " action="cart-ar.php" method="post">
                <?php if(!empty($clothes_sizes)){ 
                    $size_count=0;
                ?>
                <h6 style="margin-right: 14px;">المقاس</h6>
                <div class="size-blocks  col-12 ">
                    <?php foreach($clothes_sizes as $size){ 
                        if (!empty($size)) {
                            $size_count++;
                    ?>
                    <div class="radio-inline size float-right"><input type="radio" name="size" value="<?php echo $size['size_id']; ?>" id="radio-size-<?php echo $size_count; ?>" class="check_sizes"><label for="radio-size-<?php echo $size_count; ?>"><?php echo $size['size_title']; ?></label></div>
                    <?php } } ?>
                    <div style="clear: both"></div>
                </div><br>
                <?php } ?>
                <h6 style="margin-right: 14px;">الكمية</h6>
                <div class=" product-count col-12">
                    <a rel="nofollow" class="btn btn-default btn-minus" href="#" title="Subtract">&ndash;</a>
                    <input type="text" readonly="" size="2" autocomplete="off" class="cart_quantity_input form-control grey count" value="1" name="quantity" style="margin-top: 1px;">
                    <a rel="nofollow" class="btn btn-default btn-plus" href="#" title="Add">+</a>
                </div>  
                <input type="hidden" name="product_code" value="<?php echo $product_row['product_code']; ?>">
                <div class="col-md-6 col-12">
                    <input type="submit" class="btn btn-dark bg-main w-100 " value="أضف الي السلة" name="add_to_cart" id="add_to_cart">
                </div>
                <div class="col-md-6 col-12">
                    <?php
                        if (isset($_SESSION['user_id'])) {
                            $user_id=$_SESSION['user_id'];
                        }else{
                            $user_id=0;
                        }
                        $db= new Database();
                        $wish_statement="SELECT * FROM `wish_list` WHERE user_id='$user_id' AND product_code='$product_code'";
                        $wish_result= $db->runDml($wish_statement);
                        $wish_count=mysqli_num_rows($wish_result);
                        if ($wish_count > 0) {                             
                    ?>
                    <a href="" class="btn btn-light w-100 the_wish" style="margin-top: 8px;" id="<?php echo $product_code; ?>"> حذف من المفضلة  <i class="fa fa-heart " style="font-size: 18px;"></i>  </a>	
                    <?php }else{ ?>
                        <a href="" class="btn btn-light w-100 the_wish" style="margin-top: 8px;" id="<?php echo $product_code; ?>">أضف الي المفضلة  <i class="fas fa-heart " style="font-size: 18px;"></i>  </a>
                    <?php } ?>
                </div><br><br> 
            </form>
            <h5> شارك في   <a href="" class="mr-10"><i class="fab fa-facebook-f"  style="font-size: 25px;"></i></a>  <a  href="#" class="mr-10"> <i class="fab fa-twitter" style="font-size: 25px;"></i> </a>
            <a  href="#" class="mr-10"> <i class="fab fa-whatsapp" style="font-size: 25px;"></i> </a> </h5>
                      
            <h5>الوصف</h5>
            <p><?php echo $product_row['product_details_ar']; ?></p>    
        </div>
    </div>
</div>
       <div class="container-fluid arabic">
           <div class="container border"><br>
        <div class="row ">
           <h4 class="col-12 ">مراجعة
            </h4>  
            <p class="col-12 ">أنت تراجع</p>
            <p class="col-12 "><b><?php echo $product_row['product_title_ar']; ?> </b></p>
              <form class="col-sm-6 col-10" method="post" id="review_form">
  <div class="form-group">
      <label >كنية  <sup><i class="fas fa-star main-color" style="font-size: 5px"></i></sup></label>
    <input type="text" class="form-control" name="nickname" required="">
  </div>
  <div class="form-group">
      <label >ملخص  <sup> <i class="fas fa-star main-color" style="font-size: 5px"></i></sup></label>
    <input type="text" class="form-control" name="summary" required="">
  </div>
  <div class="form-group">
    <label >مراجعة  <sup><i class="fas fa-star main-color" style="font-size: 5px"></i></sup></label>
     <textarea class="form-control" row="6" name="review" required=""></textarea>
  </div>

  <button type="submit" class="btn bg-main" name="send">إرسال المراجعة</button>
</form> 
<div id="review_div" style="background-color: #d41c50;color: #fff;margin-bottom: 15px;margin-right: 15px;display: none;" class="col-sm-6 col-10"><?php if (isset($_POST['review'])) {
    echo $_POST['review'];
} ?></div>
               
            </div></div></div>
     
  
<div class="container-fluid ">
    <div class="container"><br>
        <div class="row text-right">
            <div class="col-12 border-bottom pad-0">
                <h3 class="float-right"> ربما يعجبك أيضا</h3>
                <div class="float-left">
                    <a href="category-ar.php?cat_id=<?php echo $category_id; ?>" class="main-color">عرض الكل  </a>
                    <div class="float-left" style="width: 50px;position: relative;margin: 10px;">              
                        <a class="carousel-control-prev left"  href="#carousel2" role="button" data-slide="prev" >
                            <i class="fas fa-chevron-left" style="color:#000!important"></i>
                        </a>
                        <a class="carousel-control-next right" href="#carousel2" role="button" data-slide="next">
                            <i class="fas fa-chevron-right" style="color:#000!important"></i>
                        </a>
                    </div>
                </div>
                <div style="clear: both"></div>
            </div><br><br>
            <!-- products -->
            <div id="carousel2" class="carousel slide multi col-12" data-ride="carousel"  >
        		<div class="carousel-inner  row w-100 mx-auto" role="listbox">
                    <!-- one product -->
                    <?php $id=1; $like_count=0;foreach($other_products as $other_product){ $like_count++; 
                        $product_code1=$other_product['product_code'];
                    ?>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 <?php if($like_count==1){ ?>active<?php } ?>"  ><br> 
                        <div class="card text-center">
				            <a href="product-ar.php?code=<?php echo $other_product['product_code']; ?>">
                                <img src="img/products/<?php echo $other_product['product_main_image']; ?>" class="card-img-top" alt="<?php echo $other_product['product_main_image']; ?>">
                             </a>
                            <div class="card-body">
                                <a href="product-ar.php?code=<?php echo $other_product['product_code']; ?>" class="card-text text-dark"><?php echo $other_product['product_title_ar']; ?></a>
                                <p class="card-title" href=""><b><?php echo $other_product['product_price']; ?> <?php echo $settings_data['ar_currency']; ?></b></p>
                                <form method="post" action="cart-ar.php" style="display: inline-block;">
                                    <input type="hidden" name="product_code" value="<?php echo $other_product['product_code'] ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="  pad-10 " title="add to bag" style="color: #d41c50;border: none;background-color: #fff;" name="add_to_cart" id="add_to_cart<?php echo $id; ?>">  <i class="fas fa-shopping-bag" style="font-size: 25px"></i> 
                                    </button>
                                </form>
                            <?php 
                     $products->set_product_code($product_code1);
                     $other_clothes_sizes=$products->select_sizes();
                     if (!empty($other_clothes_sizes)) { ?>
                       <script type="text/javascript">
                        document.getElementById('add_to_cart'+<?php echo $id ?>).onclick=function(ev){
                          ev.preventDefault();
                          alert("يجب تحديد المقاس");
                        }
                       </script>

                     <?php } ?>
                                <?php
                                if (isset($_SESSION['user_id'])) {
                                    $user_id=$_SESSION['user_id'];
                                }else{
                                    $user_id=0;
                                }
                                $db= new Database();
                                $wish_statement="SELECT * FROM `wish_list` WHERE user_id='$user_id' AND product_code='$product_code'";
                                $wish_result= $db->runDml($wish_statement);
                                $wish_count=mysqli_num_rows($wish_result);
                                if ($wish_count > 0) {                             
                                ?>
                                <a class=" heart pad-10 the_wish" title="add to wishlist" href="" id="<?php echo $other_product['product_code'] ?>"> <i class='fa fa-heart' aria-hidden='true' style='font-size: 25px'></i></a>
                                <?php }else{ ?>
                                    <a class=" heart pad-10 the_wish" title="add to wishlist" href="" id="<?php echo $other_product['product_code'] ?>"> <i class="far fa-heart" style="font-size: 25px"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php $id++ ; } ?>
        		</div>	
            </div>
        </div><br><br>
    </div>
</div>
<?php }else{ ?>
<div class="container-fluid  arabic">
    <div class="container"><br>
        <div class="row ">
            <div class="col-md-12 col-12" style="text-align:center">
                <h2 style="color:#d41c50;margin-top: 5%;margin-bottom: 3%;"> الرابط الذى تحاول الوصول إليه غير صحيح </h2>
                <a href="index.php" style="color: #0008ff;text-decoration:none;font-size: 17px;"> العودة إلى الصفحة الرئيسية </a> 
            </div>
        </div><br><br>
    </div>
</div>
<?php
}
if (isset($review_result)) {
    if ($review_result) { ?>
        <script type="text/javascript">
            document.getElementById('review_form').style.display="none";
            document.getElementById('review_div').style.display="block";
        </script>
        
   <?php }
}
    include_once "footer_ar.php";
?>
<script type="text/javascript">
$(document).ready(function(){
    var the_values=document.getElementsByClassName('the_wish');
    var i;
    for (i = 0; i < the_values.length; i++) {
        the_values[i].onclick=function(e){
            e.preventDefault();
            <?php if (!isset($_SESSION['user_id'])) { ?>
            alert("من فضلك سجل دخولك أولا .."); 
            <?php }else{ ?>
                var id=this.id;
                if(id){
                    $.ajax({
                        url: "insert_to_wish.php",
                        type: "POST",
                        data:{product_code:id},
                        success: function(msg) {
                            $("#"+id).html(msg);
                        },
                        error: function(msg) {
                            alert("error");
                        }
                    });
                }
            <?php } ?>
        }  
    }
});
</script>

<?php if (!empty($clothes_sizes)) { ?>
  <script type="text/javascript">
    document.getElementById('add_to_cart').onclick=function (event) {
        var sizes_values=document.getElementsByClassName('check_sizes');
        var j;
        var check_sizes_count=0;
        for (j = 0; j < sizes_values.length; j++) {
            if (sizes_values[j].checked) {
                check_sizes_count++;
            }
        }
        if (check_sizes_count == 0) {
            event.preventDefault();
            alert("يجب تحديد المقاس");
        }
    }
</script>
<?php } ?>