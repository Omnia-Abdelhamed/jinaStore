<?php
ob_start();  
    include 'navbar.php';
    $category_id = (isset($_GET['cat_id'])) ? (int)$_GET['cat_id'] : 0;
    $subcategory_id = (isset($_GET['subcat_id'])) ? (int)$_GET['subcat_id'] : 0;
    $category_row=$categories->select_by_one($category_id);
    if (!empty($category_row)) {
        $subcategories_data=$subcategories->select_by_category($category_id);
        $products_data=$products->select_by_catSub($category_id,$subcategory_id,$order="DESC");
?> 
<div class="container-fluid  arabic">
    <div class="container"><br>
        <div class="row ">
            <div class="col-md-3 col-12">
                <h3><?php echo $category_row['category_name_ar']; ?><hr></h3>
                <?php foreach ($subcategories_data as $subcategory) { ?>
                    <a href="category-ar.php?cat_id=<?php echo $category_id; ?>&subcat_id=<?php echo $subcategory['subcategory_id']; ?>"><?php echo $subcategory['subcategory_name_ar']; ?></a><br><br>
                <?php } ?>
            </div>
            <div class="col-md-9 col-12">
                <div class="row ">
                <?php $id=1; foreach ($products_data as $key => $product) { 
                    $product_code=$product['product_code'];
                ?>
                    <div class=" col-12 col-sm-6 col-md-4 col-lg-3"><br> 
                        <div class="card text-center">
				            <a href="product-ar.php?code=<?php echo $product['product_code']; ?>">
                                <img src="img/products/<?php echo $product['product_main_image'] ?>" class="card-img-top" alt="<?php echo $product['product_main_image'] ?>"> 
                            </a>
                            <div class="card-body">
                                <a href="product-ar.php?code=<?php echo $product['product_code'] ?>" class="card-text text-dark"><?php echo $product['product_title_ar'] ?></a>
                                <p class="card-title" href=""><b><?php echo $product['product_price'] ?> <?php echo $settings_data['ar_currency']; ?></b></p>
                                  <form method="post" action="cart-ar.php" style="display: inline-block;">
                      <input type="hidden" name="product_code" value="<?php echo $product['product_code'] ?>">
                      <input type="hidden" name="quantity" value="1">
                      <button class="  pad-10 " title="add to bag" style="color: #d41c50;border: none;background-color: #fff;" name="add_to_cart" id="add_to_cart<?php echo $id; ?>">  <i class="fas fa-shopping-bag" style="font-size: 25px"></i> 
                      </button>
                    </form>
                    <?php 
                     $products->set_product_code($product_code);
                     $clothes_sizes=$products->select_sizes();
                     if (!empty($clothes_sizes)) { ?>
                       <script type="text/javascript">
                        document.getElementById('add_to_cart'+<?php echo $id; ?>).onclick=function(ev){
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
                                <a class=" heart pad-10 the_wish" title="delete from wishlist" href="" id="<?php echo $product['product_code'] ?>"> <i class='fa fa-heart' aria-hidden='true' style='font-size: 25px'></i></a>
                                <?php }else{ ?>
                                    <a class=" heart pad-10 the_wish" title="add to wishlist" href="" id="<?php echo $product['product_code'] ?>"> <i class="far fa-heart" style="font-size: 25px"></i></a>
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

<?php
}else{?>
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
<?php }
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
    <?php
    ob_end_flush();
?>