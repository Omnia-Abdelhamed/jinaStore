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
                                <li><a href="../../messages/other/"> اخرى </a></li>
                                <li><span class="bread-slash">/</span><span class="bread-blod"><a href="../../messages/cancel/"> الغاء طلب </span></li>
                                <li><span class="bread-slash">/</span><a href="../../messages/">الرسائل</a></li>
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
                            <th>الاسم الأول</th>
                            <th>الاسم الأخير</th>
                            <th>الميل</th>
                            <th>الهاتف</th>
                            <th>الطلب</th>
                            <th>الرسالة</th>
                            <th>التاريخ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../../../messages_class.php';
                            $messages= new Messages();
                            $messages_data=$messages->select_by_subject();
                            foreach ($messages_data as $message) {
                        ?>
                      <tr class="new-email">
                            <td id="td1"><?php echo $message['first_name']; ?></td>
                            <td><?php echo $message['last_name']; ?></td>
                            <td><?php echo $message['email']; ?></td>
                            <td><?php echo $message['phone']; ?></td>
                            <td><?php echo $message['message_order']; ?></td>
                            <td><?php echo $message['message']; ?></td>
                            <td><?php echo $message['send_date']; ?></td>
                            <td>
                                <a href="deleteMessage.php?id=<?php echo $message['message_id']; ?>" class="btn btn-custon-rounded-four btn-danger confirm" title="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                            </td>   
                        </tr 
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