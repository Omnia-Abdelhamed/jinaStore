<?php
    include "../../includes/innerHeader.php";
    $product_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
    if ($product_id == 0) {
        header('location: ../../products/');  
    }
    include_once '../../../product_class.php';
    $products= new Products();
    $product_data=$products->select_by_id($product_id);
    $product_code=$product_data['product_code'];
    $products->set_product_code($product_code);
    $sizes_data=$products->select_sizes();
    $product_images=$products->select_added_images();
?>
<style type="text/css">
    .total .one{
        width: 30%;
        text-align: center !important;
        background-color: #333;
        color: #fff;
        font-weight: bold;
    }
    .total .two{
        width: 70%;
        //font-weight: bold;
        padding-left: 40px !important;
        color: #d41c50;
    }
</style>
<?php if (!empty($product_data)) { ?>
<div class="breadcome-area mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcome-menu" style="float: right;">
                                <li style="color: #d41c50;">تفاصيل المنتج</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<form method="post">
    <div class="col-lg-12">
        <div class="tab-content">
            <div id="inbox" class="tab-pane fade in animated zoomInDown custom-inbox-message shadow-reset active">  

                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" style="direction:rtl;">
                    <tbody>
                        <tr class="new-email total">
                            <td class="one">كود المنتج</td>
                            <td class="two"><?php echo $product_data['product_code']; ?></td>
                        </tr> 
                        <tr class="new-email total">
                            <td class="one">الاسم بالعربى</td>
                            <td class="two"><?php echo $product_data['product_title_ar']; ?></td>
                        </tr> 
                        <tr class="new-email total">
                            <td class="one">الاسم بالانجليزى</td>
                            <td class="two"><?php echo $product_data['product_title_en']; ?></td>
                        </tr>
                        <tr class="new-email total">
                            <td class="one">السعر</td>
                            <td class="two"><?php echo $product_data['product_price']; ?></td>
                        </tr>
                        <tr class="new-email total">
                            <td class="one">الكمية</td>
                            <td class="two"><?php echo $product_data['product_quantity']; ?></td>
                        </tr>
                        <tr class="new-email total">
                            <td class="one">تاريخ الاضافة</td>
                            <td class="two"><?php echo $product_data['product_added_date']; ?></td>
                        </tr>
                        <tr class="new-email total">
                            <td class="one">اخر تعديل</td>
                            <td class="two"><?php echo $product_data['product_last_updated_date']; ?></td>
                        </tr>
                        <tr class="new-email total">
                            <td class="one">الوصف بالعربى</td>
                            <td class="two"><pre style="border: none;"><?php echo $product_data['product_details_ar']; ?></pre></td>
                        </tr>
                        <tr class="new-email total">
                            <td class="one">الوصف بالانجليزى</td>
                            <td class="two"><pre style="border: none;"><?php echo $product_data['product_details_en']; ?></pre></td>
                        </tr>
                        <tr class="new-email total">
                            <td class="one">القسم الرئيسى</td>
                            <td class="two"><?php echo $product_data['category_name_ar']; ?></td>
                        </tr>
                        <tr class="new-email total">
                            <td class="one">القسم الفرعى</td>
                            <td class="two"><?php echo $product_data['subcategory_name_ar']; ?></td>
                        </tr>
                        <tr class="new-email total">
                            <td class="one">الصورة</td>
                            <td class="two"><img src="../../../img/products/<?php echo $product_data['product_main_image']; ?>" style="width: 100px;height: 100px;"></td>
                        </tr>
                        <?php if (!empty($sizes_data)) { ?>
                        <tr class="new-email total">
                            <td class="one">المقاس</td>
                            <td class="two">
                                <?php foreach ($sizes_data as $size) { ?>
                                    <span style="margin-left: 10px;"><?php echo $size['size_title']; ?></span>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>

                        <?php if (!empty($product_images)) { ?>
                        <tr class="new-email total">
                            <td class="one">الصور الاضافية</td>
                            <td class="two">
                                <?php foreach ($product_images as $p_image) { ?>
                                    <img src="../../../img/products/<?php echo $p_image['product_extra_image']; ?>" style="width: 100px;height: 100px;margin-left: 10px;">
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                           
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</form>    



<?php }else{ header('location: ../products/'); } ?>

<?php
    include "../../includes/innerFooter.php";
?>  
</body>
</html>