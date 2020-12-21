<?php
    include "../includes/innerHeader1.php";
?>
<div class="breadcome-area mg-b-30 ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcome-list shadow-reset">
                  <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcome-menu" style="float: right;">
                                <li>
                                    <span class="bread-blod"><a href="../admins/create/">اضافة مدير</a></span>
                                </li>
                                <li><span class="bread-slash">/</span><a href="../admins/">الادارة</a> 
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

                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" style="direction:rtl;">
                    <thead>
                        <tr>                                    
                            <th>اسم المستخدم</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../../admin_class.php';
                            $admins= new Admins();
                            $admins_data=$admins->select_all_admins();
                            foreach ($admins_data as $admin) {
                        ?>
                        <tr class="new-email">
                            <td id="td1"><?php echo $admin['username']; ?></td>
                            <td>
                                <a href="deleteAdmin.php?id=<?php echo $admin['id']; ?>" class="btn btn-custon-rounded-four btn-danger confirm"><i class="fa fa-trash-o" aria-hidden="true"></i> </a>
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