<?php
    include "../includes/innerHeader1.php";
    $order_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
    if ($order_id == 0) {
        header('location: ../orders/');  
    }
    include_once '../../orders_class.php';
    $orders= new Orders();
    $details_data=$orders->select_from_order_details($order_id);
    $order_data=$orders->select_by_order($order_id);
    $country_id=$order_data['country'];
    $discound=$order_data['discound'];
    include_once '../../country_class.php';
    $countries= new Countries();
    $country_data=$countries->select_by_one($country_id);
    $shipping=$country_data['shipping'];
    $taxes=$country_data['taxes'];
    
?>
<style type="text/css">
    .total .one{
        text-align: center !important;
        background-color: #333;
        color: #fff;
        font-weight: bold;
    }
    .total .two{
        font-weight: bold;
        padding-left: 40px !important;
        color: #d41c50;
    }
</style>
<?php if (!empty($details_data)) { ?>
<div class="breadcome-area mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcome-menu" style="float: right;">
                                <li style="color: #d41c50;">تفاصيل الطلب</li>
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
                <table id="table" data-toggle="table" style="direction:rtl">
                    <div style="text-align: right;margin-bottom: 10px">
                        <?php if($order_data['done'] ==0){ ?>
                        <a href="done.php?id=<?php echo $order_id; ?>" style="text-align: center;line-height: 37px;display:inline-block;border: none;background: #3d60e1;color: #fff;width: 80px;height: 38px;font-weight: bold;" class="print1">تم التسليم</a>
                        <?php }elseif($order_data['done'] ==1){ ?>
                        <label style="margin-right: 20px;">تم التسليم</label>
                        <?php } ?>
                        <button style="border: none;background: #d41c50;color: #fff;width: 50px;height: 37px;font-weight: bold;" class="print1" onClick="printPage()">طباعة</button>
                    </div>
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="new-email">
                            <td id="td1"><?php echo $order_data['fullname'] ?></td>
                            <td><?php echo $order_data['email'] ?></td>
                            <td><?php echo $order_data['phone'] ?></td>
                            <td><?php echo $country_data['country_name_ar'] ?></td>
                            <td><?php echo $order_data['city'] ?></td>
                            <td><?php echo $order_data['street'] ?></td>
                            <td><?php echo $order_data['notes'] ?></td>
                            <td><?php echo $order_data['order_date'] ?></td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</form> 
 
<form method="post">
    <div class="col-lg-12">
        <div class="tab-content">
            <div id="inbox" class="tab-pane fade in animated zoomInDown custom-inbox-message shadow-reset active">  

                <table id="table" data-toggle="table" style="direction:rtl">
                    <thead>
                        <tr>                                    
                            <th>كود المنتج</th>
                            <th>اسم المنتج</th>
                            <th>الكمية</th>
                            <th>المقاس</th>
                            <th>سعر المنتج</th>
                            <th>اجمالى</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_order=0;
                            foreach ($details_data as $detail) {
                                $size_id=$detail['size_id'];
                                if (!empty($size_id)) {
                                    $sizes_result=$db->runDml("SELECT * FROM sizes WHERE size_id='$size_id'");
                                    $sizes=mysqli_fetch_assoc($sizes_result);
                                    $the_size=$sizes['size_title'];
                                }else{
                                    $the_size="";
                                }      
                        ?>
                        <tr class="new-email">
                            <td id="td1"><?php echo $detail['product_code']; ?></td>
                            <td><?php echo $detail['product_title_ar']; ?></td>
                            <td><?php echo $detail['order_quantity']; ?></td>
                            <td><?php echo $the_size; ?></td>
                            <td><?php echo $detail['product_price']." ".$settings_data['ar_currency'] ; ?></td>
                            <td><?php echo ($detail['product_price']*$detail['order_quantity'])." ".$settings_data['ar_currency']; ?></td>

                        </tr> 
                        <?php $total_order=$total_order+($detail['product_price']*$detail['order_quantity']); } ?>
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</form> 

<form method="post">
    <div class="col-lg-12">
        <div class="tab-content">
            <div id="inbox" class="tab-pane fade in animated zoomInDown custom-inbox-message shadow-reset active">  

                <table id="table" data-toggle="table" style="direction:rtl">
                    <tbody>
                        <?php 
                            $discound_value=($discound/100)*$total_order;
                        ?>
                        <tr class="new-email total">
                            <td class="one">صافى الطلب</td>
                            <td colspan="5" class="two"><?php echo $total_order." ".$settings_data['ar_currency']; ?></td>
                        </tr>
                        <tr class="new-email total">
                            <td class="one">الخصم</td>
                            <td colspan="5" class="two"><?php echo $discound." %"; ?></td> 
                        </tr>
                        <tr class="new-email total">
                            <td class="one">بعد الخصم</td>
                            <td colspan="5" class="two"><?php echo ($total_order-$discound_value)." ".$settings_data['ar_currency']; ?></td>
                        </tr>
                        <?php $final_total=$total_order-$discound_value; 
                            $taxes_value=($taxes/100)*$final_total; 
                        ?>
                        <tr class="new-email total">
                            <td class="one">قيمة الضريبة</td>
                            <td colspan="5" class="two"><?php echo $taxes." %"; ?></td> 
                        </tr>
                        <tr class="new-email total">
                            <td class="one"> بعد الضريبة</td>
                            <td colspan="5" class="two"><?php echo ($final_total+$taxes_value)." ".$settings_data['ar_currency']; ?></td>
                        </tr>
                        <tr class="new-email total">
                            <td class="one">قيمة الشحن</td>
                            <td colspan="5" class="two"><?php echo $shipping." ".$settings_data['ar_currency']; ?></td> 
                        </tr>
                        <tr class="new-email total">
                            <td class="one">الاجمالى  </td>
                            <td colspan="5" class="two"><?php echo ($final_total+$taxes_value+$shipping)." ".$settings_data['ar_currency']; ?></td> 
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</form>



<?php }else{ header('location: ../orders/'); } ?>
<?php
    include "../includes/innerFooter1.php"; ?>
<script type="text/javascript">

	function printPage() {
	    document.getElementById('print1').style.display="none";
	    document.getElementById('print2').style.display="none";
		var elements=document.getElementsByClassName('print1');
		for (var i =  0; i < elements.length; i++) {
			elements[i].style.display="none";
		}
		window.print();
	}
</script>
