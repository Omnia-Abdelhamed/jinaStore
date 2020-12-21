<?php
include 'navbar.php';
include_once 'banner.php';
$new_arrival_products=$products->select_new_arrival();
?>    
      <!-----end nav ---> 
       <!-----start carousel --->
     
       <!-----start picks --->
       <!-----start  --->
<div class="container-fluid ">
    <div class="container"><br>
        <div class="row text-center">
            <h4 class="col-12 " style="margin-bottom: 31px;">
                <b style="color:#d41c50">الأقسام </b> 
            </h4>
            <div id="carousel-category" class="carousel slide multi col-12" data-ride="carousel"  >
    	 	    <div class="carousel-inner  row w-100 mx-auto" role="listbox">
    	 	        <?php $catCount=1; if(!empty($categories_data)){ foreach ($categories_data as $category) { 
                        $category_id=$category['category_id'];   
                    ?>
        			<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 <?php if($catCount==1){ ?>active<?php } ?>"  ><br>   
        			    <div>
                            <a href="category-ar.php?cat_id=<?php echo $category_id; ?>" style="width:100%">  <img src="img/categories/<?php echo $category['category_image']; ?>" alt="<?php echo $category['category_image']; ?>" style="width:100%;height:250px;"></a>
                            <h6 style="background: #d41c50;height: 40px;line-height: 40px;font-size: 17px;"><b style="color:#fff;"><?php echo $category['category_name_ar']; ?></b></h6> 
                        </div>
                    </div>
                    <?php $catCount++; } } ?>
    			</div>
    	        <a class="carousel-control-prev left"  href="#carousel-category" role="button" data-slide="prev" >
                    <i class="fas fa-chevron-left" style="color:#333!important"></i>
                </a>
                <a class="carousel-control-next right" href="#carousel-category" role="button" data-slide="next">
                    <i class="fas fa-chevron-right" style="color:#333!important;"></i>
                </a>
            </div>
        </div><br><br>
    </div>
</div>
    <!-----start DISCOVER... JUST ARRIVED --->
<?php if(!empty($new_arrival_products)){ ?>
<div class="container-fluid ">
    <div class="container"><br>
    <div class="row ">
        <div class="col-12 border-bottom pad-0">
            <h3 class="float-right">اكتشف ... وصل للتو</h3>
            <div class="float-left">
            <a href="" class="main-color">عرض الكل  </a>
            <div class="float-left" style="width: 50px;position: relative;margin: 10px;">              
                <a class="carousel-control-prev left"  href="#carousel-our" role="button" data-slide="prev" >
                    <i class="fas fa-chevron-left" style="color:#000!important"></i>
                </a>
            <a class="carousel-control-next right" href="#carousel-our" role="button" data-slide="next">
                <i class="fas fa-chevron-right" style="color:#000!important"></i>
            </a>
        </div>
    </div>
    <div style="clear: both"></div>
</div><br><br>
<div id="carousel-our" class="carousel slide multi col-12" data-ride="carousel"  >
    <div class="carousel-inner  row w-100 mx-auto" role="listbox">
        <?php $new_arrival_count=0;
        $id=1;
            foreach($new_arrival_products as $new_arrival){
              $product_code=$new_arrival['product_code'];
              $new_arrival_count++;
        ?>
        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 <?php if($new_arrival_count==1){ ?>active<?php } ?>"  ><br>
            <div class="card text-center">
                <a href="product-ar.php?code=<?php echo $new_arrival['product_code']; ?>">
                    <img src="img/products/<?php echo $new_arrival['product_main_image']; ?>" class="card-img-top" alt="<?php echo $new_arrival['product_main_image']; ?>"> 
                </a>
                <div class="card-body">
                    <a href="product-ar.php?code=<?php echo $new_arrival['product_code']; ?>" class="card-text text-dark"><?php echo $new_arrival['product_title_ar']; ?></a>
                    <p class="card-title" href=""><b><?php echo $new_arrival['product_price']; ?> <?php echo $settings_data['ar_currency']; ?></b></p>
                    <form method="post" action="cart-ar.php" style="display: inline-block;">
                      <input type="hidden" name="product_code" value="<?php echo $new_arrival['product_code'] ?>">
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
                    <a class=" heart pad-10 the_wish" title="add to wishlist" href="" id="arv<?php echo $new_arrival['product_code'] ?>"> <i class='fa fa-heart' aria-hidden='true' style='font-size: 25px'></i></a>
                    <?php }else{ ?>
                        <a class=" heart pad-10 the_wish" title="add to wishlist" href="" id="arv<?php echo $new_arrival['product_code'] ?>"> <i class="far fa-heart" style="font-size: 25px"></i></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php $id++ ; } ?>
    </div>
</div></div><br><br></div>

</div>
<?php } ?>
         <!-----start clothes BEST SELLERS --->
    <?php foreach ($categories_data as $category1) { 
      $category_id1=$category1['category_id'];
      $products->set_category_id($category_id1);   
      $best_seller_data=$products->select_categories_best_seller();
      if (!empty($best_seller_data)) {

    ?>
    <div class="container-fluid ">
           <div class="container"><br>
        <div class="row ">
           <div class="col-12 border-bottom pad-0">
               <h3 class="float-right">أفضل مبيعات   <?php echo $category1['category_name_ar']; ?></h3>
               <div class="float-left">
               <a href="" class="main-color">عرض الكل  </a>
                 <div class="float-left" style="width: 50px;position: relative;margin: 10px;">              
               	   <a class="carousel-control-prev left"  href="#carousel<?php echo $category1['category_id'] ?>" role="button" data-slide="prev" >
           <i class="fas fa-chevron-left" style="color:#000!important"></i>
          </a>
          <a class="carousel-control-next right" href="#carousel<?php echo $category1['category_id'] ?>" role="button" data-slide="next">
           <i class="fas fa-chevron-right" style="color:#000!important"></i>
                     </a></div></div>
               <div style="clear: both"></div>
            </div>
           <br><br>
               <div id="#carousel<?php echo $category1['category_id'] ?>" class="carousel slide multi col-12" data-ride="carousel"  >
        			<div class="carousel-inner  row w-100 mx-auto" role="listbox">
                <!-- start product looping -->
                <?php $best_id=1; $best_seller_count=1; foreach ($best_seller_data as $best) { 
                  $product_code1=$best['product_code'];
                  ?>
            			<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 <?php if($best_seller_count==1){ ?> active <?php } ?>"  >
                          <br> <div class="card text-center">
				 <a href="product-ar.php?code=<?php echo $best['product_code']; ?>">
                     <img src="img/products/<?php echo $best['product_main_image']; ?>" class="card-img-top" alt="<?php echo $best['product_main_image']; ?>"> </a>
                                <div class="card-body">
                  <a href="product-ar.php?code=<?php echo $best['product_code']; ?>" class="card-text text-dark"><?php echo $best['product_title_ar']; ?> </a>
             <p class="card-title" href=""><b><?php echo $best['product_price']; ?> <?php echo $settings_data['ar_currency']; ?></b></p>
              <form method="post" action="cart-ar.php" style="display: inline-block;">
                      <input type="hidden" name="product_code" value="<?php echo $best['product_code'] ?>">
                      <input type="hidden" name="quantity" value="1">
                      <button class="  pad-10 " title="add to bag" style="color: #d41c50;border: none;background-color: #fff;" name="add_to_cart" id="add_to_cart<?php echo $category_id1; ?><?php echo $best_id; ?>">  <i class="fas fa-shopping-bag" style="font-size: 25px"></i> 
                      </button>
              </form>
             <?php $products->set_product_code($product_code1);
                     $clothes_sizes=$products->select_sizes();
                     if (!empty($clothes_sizes)) { ?>
                       <script type="text/javascript">
                        document.getElementById('add_to_cart'+<?php echo $category_id; ?><?php echo $best_id; ?>).onclick=function(ev){
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
                                $wish_statement="SELECT * FROM `wish_list` WHERE user_id='$user_id' AND product_code='$product_code1'";
                                $wish_result= $db->runDml($wish_statement);
                                $wish_count=mysqli_num_rows($wish_result);
                                if ($wish_count > 0) {                             
                                ?>
                                <a class=" heart pad-10 the_wish" title="add to wishlist" href="" id="bst<?php echo $best['product_code'] ?>"> <i class='fa fa-heart' aria-hidden='true' style='font-size: 25px'></i></a>
                                <?php }else{ ?>
                                    <a class=" heart pad-10 the_wish" title="add to wishlist" href="" id="bst<?php echo $best['product_code'] ?>"> <i class="far fa-heart" style="font-size: 25px"></i></a>
                                <?php } ?>
                         </div> </div>	</div>
                         <?php $best_seller_count++;$best_id++; } ?>
                         <!-- end product looping -->
        			</div>
        	
        		
            </div></div><br><br></div>
    
    </div>
  <?php } } ?>
      

        <!--- --->
    <div class="container text-center"> <hr>
    <div class="row">
        <div class="col-md-4 col-6">
            <a href="category-ar.html"> <img class="bg-main w-100" src="img/hair.jpg"></a>
            <h3 class="main-color">الشعر</h3>
        </div>
          <div class="col-md-4 col-6">
            <a href="category-ar.html"> <img class="bg-main w-100" src="img/hair.jpg"></a>
            <h3 class="main-color">الشعر</h3>
        </div>
          <div class="col-md-4 col-6">
            <a href="category-ar.html"> <img class="bg-main w-100" src="img/hair.jpg"></a>
            <h3 class="main-color">الشعر</h3>
        </div>
          <div class="col-md-4 col-6">
            <a href="category-ar.html"> <img class="bg-main w-100" src="img/hair.jpg"></a>
            <h3 class="main-color">الشعر</h3>
        </div>
          <div class="col-md-4 col-6">
            <a href="category-ar.html"> <img class="bg-main w-100" src="img/hair.jpg"></a>
            <h3 class="main-color">الشعر</h3>
        </div>
          <div class="col-md-4 col-6">
            <a href="category-ar.html"> <img class="bg-main w-100" src="img/hair.jpg"></a>
            <h3 class="main-color">الشعر</h3>
        </div>
        </div>
    
    </div>
   
<?php
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
                var res = id.slice(3);
                if(id){
                    $.ajax({
                        url: "insert_to_wish.php",
                        type: "POST",
                        data:{product_code:res},
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