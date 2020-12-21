<?php
include 'navbar.php';
$category_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
$subcategory_id = (isset($_GET['subcat_id'])) ? $_GET['subcat_id'] : 0;
$category_row=$categories->select_by_one($category_id);
$subcategories_data=$subcategories->select_by_category($category_id);
include 'product_class.php';
$products=new Products();
$products_data=$products->select_by_catSub($category_id,$subcategory_id);
?>

<!-----end nav --->
     <header class="container-fluid  border-bottom">
     <div class="container">
         <ul class="nav product" >
       <li class="nav-item  ">  <a class="nav-link  "  href="index.php" > home </a>	
        </li>
              <li class="nav-item  ">  <a class="nav-link  "  href="" >  <i class="fas fa-arrow-right " style="font-size: 20px"></i></a>	
        </li>
    <li class="nav-item">  <a class="nav-link"  href="category.php?cat_id=<?php echo $category_id ?>" ><?php echo $category_row['category_name_en']; ?></a>
    </li>    
    </ul>
     
     </div>
    </header>
<div class="container-fluid ">
    <div class="container"><br>
        <div class="row ">
            <div class="col-md-3 col-12">
              <h3><?php echo $category_row['category_name_en']; ?><hr></h3>
              <?php foreach ($subcategories_data as $subcategory) { ?>
                <a href="category.php?cat_id=<?php echo $category_id; ?>&subcat_id=<?php echo $subcategory['subcategory_id']; ?>"><?php echo $subcategory['subcategory_name_en']; ?></a><br><br>
              <?php } ?>
            </div>
        	<div class="col-md-9 col-12">
            	<div class="row ">
            	<?php foreach ($products_data as $key => $product) { ?>
	            	<div class=" col-12 col-sm-6 col-md-4 col-lg-3"  ><br> 
	            		<div class="card text-center">
					 		<a href="product.html">
	                     		<img src="img/<?php echo $product['product_image'] ?>" class="card-img-top" alt="..."> 
	                     	</a>
	                        <div class="card-body">
	                  			<a href="product.html" class="card-text text-dark"><?php echo $product['product_name_en'] ?></a>
	             				<p class="card-title" href=""><b><?php echo $product['product_price'] ?></b></p>
	      						<a class="  pad-10 "  href="cart.html" title="add to bag">  <i class="fas fa-shopping-bag" style="font-size: 25px"></i> </a>
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
<?php include 'footer.php'; ?>