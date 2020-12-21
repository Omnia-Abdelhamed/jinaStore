<?php
    include "../includes/innerHeader1.php";
?>
<div class="breadcome-area mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcome-menu" style="float: right;">
                                 <li>
                                    <a href="../products/create">اضافة منتج</a>
                                </li>
                                <li>
                                    <span class="bread-slash">/</span><span class="bread-blod"><a href="../products/">المنتجات</a></span> 
                                </li>
                               
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
        <?php if(isset($_GET['result'])){  if($_GET['result'] == 1){ ?>
            <div class="alert alert-success" style="text-align:right;">تم حذف المنتج بنجاح</div>
        <?php }else{ ?> 
            <div class="alert alert-danger" style="text-align:right;">لا يمكن حذف المنتج نظرا لوجوده فى الطلبات الحالية</div>
        <?php } } ?>
        <div class="tab-content">
            <div id="inbox" class="tab-pane fade in animated zoomInDown custom-inbox-message shadow-reset active">                    
                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" style="direction:rtl;">
                    <thead>
                        <tr>                                    
                            <th>الكود</th>
                            <th>الاسم بالعربى</th>
                            <th>الصورة</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../../product_class.php';
                            $products= new Products();
                            $products_data=$products->select_all("DESC");
                            foreach ($products_data as $product) {
                        ?>
                        <tr class="new-email">
                            <td id="td1"><?php echo $product['product_code']; ?></td>
                            <td class="ar-rtl"><?php echo $product['product_title_ar']; ?></td>
                            <td><img src="../../img/products/<?php echo $product['product_main_image']; ?>" style="margin-left: 50px;width: 50%;height: 110px;"></td>
                            <td><?php echo $product['product_price']; ?></td>
                            <td><?php echo $product['product_quantity']; ?></td>
                            <td>
                                <a href="view/?id=<?php echo $product['id']; ?>" class="btn btn-custon-rounded-four btn-success" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                <a href="review/?id=<?php echo $product['id']; ?>" class="btn btn-custon-rounded-four btn-success" title="Review"><i class="fa fa-commenting-o" aria-hidden="true"></i></a>

                                <a href="update/?id=<?php echo $product['product_code']; ?>" class="btn btn-custon-rounded-four btn-success" title="Update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                <a href="deleteProduct.php?id=<?php echo $product['id']; ?>" class="btn btn-custon-rounded-four btn-danger" title="Delete" onclick="confirm('هل انت متأكد من حذف المنتج ؟  لن يتم الحذف اذا كان فى الطلبات الحالية اما اذا كان غير مطلوب او فى الطلبات المنتهية سيتم حذفه ولكن ذلك سيؤدى الى نتائج غير دقيقة فى الطلبات المنتهية');"><i class="fa fa-trash-o" aria-hidden="true"></i> </a> 
                            </td>
                        </tr> 
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</form>
<?php
    include "../includes/innerFooter1.php";
?> 


