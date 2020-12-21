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
                                <li><a href="../discoundCodes/">اكواد الخصم </a> 
                                </li>
                                <li>
                                    <span class="bread-slash">/</span><span class="bread-blod"><a href="../discoundCodes/create/">اضافة كود خصم</a></span>
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
                            
                            <th>كود الخصم</th>
                            <th>القيمة مئوية</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../../discound_class.php';
                            $discound_codes= new Discound();
                            $discound_codes_data=$discound_codes->select_all();
                            foreach ($discound_codes_data as $discound_code) {
                        ?>
                        <tr class="new-email">
                            
                            <td id="td1"><?php echo $discound_code['discound_code']; ?></td>
                            <td class="ar-rtl"><?php echo $discound_code['value']; ?></td>
                             <td><a href="../discoundCodes/update/?id=<?php echo $discound_code['code_id']; ?>" class="btn btn-custon-rounded-four btn-success" title="Update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                 <a href="deleteDiscound.php?id=<?php echo $discound_code['code_id']; ?>" class="btn btn-custon-rounded-four btn-danger confirm" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i> </a> 
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