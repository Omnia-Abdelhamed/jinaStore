<?php
    include "../../includes/innerHeader.php";
?>
<div class="breadcome-area mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcome-menu" style="float: right;">
                                <li><span class="bread-blod"><a href="../finished/">المنتهية</a></span></li>
                                <li><span class="bread-slash">/</span><a href="../current/"> الحالية </a></li>
                                <li><span class="bread-slash">/</span><a href="../../orders/">كل الطلبات</a></li>
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
                            <th>الاسم</th>
                            <th>الميل</th>
                            <th>الهاتف</th>
                            <th>الدولة</th>
                            <th>المدينة</th>
                            <th>الشارع</th>
                            <th>الملاحظات</th>
                            <th>التاريخ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../../../orders_class.php';
                            $orders= new Orders();
                            include_once '../../../country_class.php';
                            $countries= new Countries();
                            $orders_data=$orders->select_the_finished();
                            foreach ($orders_data as $order) {
                                $country_id=$order['country'];
                                $country_data=$countries->select_by_one($country_id);
                        ?>
                        <tr class="new-email">
                            <td id="td1"><?php echo $order['fullname']; ?></td>
                            <td><?php echo $order['email']; ?></td>
                            <td><?php echo $order['phone']; ?></td>
                            <td><?php echo $country_data['country_name_ar']; ?></td>
                            <td><?php echo $order['city']; ?></td>
                            <td><?php echo $order['street']; ?></td>
                            <td><?php echo $order['notes']; ?></td>
                            <td><?php echo $order['order_date']; ?></td>
                            <td>
                                <a href="../viewOrder.php?id=<?php echo $order['order_id']; ?>" class="btn btn-custon-rounded-four btn-danger" title="view"><i class="fa fa-eye" aria-hidden="true"></i> </a>
                                <a href="deleteOrder.php?id=<?php echo $order['order_id']; ?>" class="btn btn-custon-rounded-four btn-danger confirm" title="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> </a>
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
    include "../../includes/innerFooter.php";
?>  
</body>
</html>