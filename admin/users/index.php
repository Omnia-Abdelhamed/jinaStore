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
                                <li><a href="../users/">المستخدمين</a> 
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
                            <th>الاسم</th>
                            <th>الميل</th>
                            <th>الهاتف</th>
                            <th>النوع</th>
                            <th>تاريخ التسجيل</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../../users_class.php';
                            $users= new Users();
                            $users_data=$users->select_all_users();
                            foreach ($users_data as $user) {
                        ?>
                        <tr class="new-email">
                            <td id="td1"><?php echo $user['user_fullname']; ?></td>
                            <td><?php echo $user['user_email']; ?></td>
                            <td><?php echo $user['user_phone']; ?></td>
                            <td><?php echo $user['user_gender']; ?></td>
                            <td><?php echo $user['regesteration_date']; ?></td>
                            <td>
                                <!-- <a href="deleteUser.php?id=<?php //echo $user['id']; ?>" class="btn btn-custon-rounded-four btn-danger confirm" title="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> </a> -->
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