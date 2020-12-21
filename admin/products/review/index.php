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
    $review_data=$products->select_review();
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
<?php if (!empty($review_data)) { ?>
<div class="breadcome-area mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcome-menu" style="float: right;">
                                <li style="color: #d41c50;">المراجعات</li>
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
                    <thead>
                        <tr> 
                            <th>الكنية</th>
                            <th>الملخص</th>
                            <th>المراجعة</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($review_data as $review) {
                        ?>
                        <tr class="new-email">
                            
                            <td id="td1"><?php echo $review['nickname']; ?></td>
                            <td><?php echo $review['summary']; ?></td>
                            <td><?php echo $review['review']; ?></td>
                            <td>
                                <a href="deleteReview.php?id=<?php echo $review['review_id']; ?>" class="btn btn-custon-rounded-four btn-danger confirm" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                            </td>
                        </tr> 
                        <?php } ?>     
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</form> 

<?php }else{ echo "<div class='alert alert-danger' style='text-align:right'>لا يوجد مراجعات</div>"; } ?>
<?php
    include "../../includes/innerFooter.php";
?>  
</body>
</html>