<?php
include_once 'database_class.php';
include_once 'product_class.php';
$products = new Products();
$products_data=$products->select_all();
foreach($products_data as $value){ ?>
<pre><?php echo $value['product_description_en']; ?></pre>   
<?php }

?>

