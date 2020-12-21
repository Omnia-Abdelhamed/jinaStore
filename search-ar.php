<?php

    include 'navbar.php';
    if(isset($_POST['searchText'])){
        $searchText=$_POST['searchText'];
        $search_data=$products->search($searchText);
        if ($search_data[0] > 0){
            $products_data=$search_data[1];
?>
<div class="container-fluid  arabic">
    <div class="container"><br>
        <div class="row ">
            <div class="col-md-12 col-12">
                <div class="row ">
                <?php foreach ($products_data as $key => $product) { ?>
                    <div class=" col-12 col-sm-6 col-md-4 col-lg-3"><br> 
                        <div class="card text-center">
				            <a href="product-ar.php?code=<?php echo $product['product_code']; ?>">
                                <img src="img/products/<?php echo $product['product_main_image'] ?>" class="card-img-top" alt="<?php echo $product['product_main_image'] ?>"> 
                            </a>
                            <div class="card-body">
                                <a href="product-ar.php?code=<?php echo $product['product_code'] ?>" class="card-text text-dark"><?php echo $product['product_title_ar'] ?></a>
                                <p class="card-title" href=""><b>KWD<?php echo $product['product_price'] ?></b></p>
                                <a class="  pad-10 "  href="cart-ar.html" title="add to bag">  <i class="fas fa-shopping-bag" style="font-size: 25px"></i> </a>
                                <a class=" heart pad-10" title="add to wishlist"> <i class="far fa-heart" style="font-size: 25px"></i></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
        		</div>
            </div>
        </div><br><br>
    </div>
</div>
<?php 
    }else{ ?>
        <div class="container-fluid  arabic">
        <div class="container"><br>
            <div class="row ">
                <div class="col-md-12 col-12" style="text-align:center">
                    <h2 style="color:red;margin-top: 5%;margin-bottom: 3%;"> لا يوجد نتائج </h2>   
                </div>
            </div><br><br>
        </div>
    </div> 
   <?php }
}else{ ?>
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
<?php } ?> 

<?php
    include_once "footer_ar.php";
?>