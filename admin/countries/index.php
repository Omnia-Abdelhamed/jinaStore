<?php
    include "../includes/innerHeader1.php";
?>
<div class="breadcome-area mg-b-30" style="direction:rtl">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list shadow-reset">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcome-menu" style="float: right;">
                                <li><a href="../countries/">الدول </a> 
                                </li>
                                <li>
                                    <span class="bread-slash">/</span><span class="bread-blod"><a href="../countries/create/">اضافة دولة</a></span>
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
        <div class="tab-content">
            <div id="inbox" class="tab-pane fade in animated zoomInDown custom-inbox-message shadow-reset active">                    
                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" style="direction:rtl">
                    <thead>
                        <tr>                                    
                            
                            <th>الاسم بالعربى</th>
                            <th>الاسم بالانجليزى</th>
                            <th>الشحن</th>
                            <th>الضريبة</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../../country_class.php';
                            $countries= new Countries();
                            $countries_data=$countries->select_all();
                            foreach ($countries_data as $country) {
                        ?>
                        <tr class="new-email">
                            
                            <td id="td1"><?php echo $country['country_name_ar']; ?></td>
                            <td class="ar-rtl"><?php echo $country['country_name_en']; ?></td>
                            <td class="ar-rtl"><?php echo $country['shipping']; ?></td>
                            <td class="ar-rtl"><?php echo $country['taxes']; ?></td>
                             <td><a href="../countries/update/?id=<?php echo $country['country_id']; ?>" class="btn btn-custon-rounded-four btn-success" title="Update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                 <!--<a href="#" class="btn btn-custon-rounded-four btn-danger confirm" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i> </a> -->
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