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
                                    <span class="bread-blod"><a href="../categories/create/">اضافة قسم</a></span>
                                </li>
                                <li><span class="bread-slash">/</span><a href="../categories/">الاقسام</a> 
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

                <table id="table" data-toggle="table" data-pagination="true" data-show-columns="true" data-show-pagination-switch="true"  data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" style="direction:rtl;">
                    <thead>
                        <tr>                                    
                            <th>الاسم</th>
                            <th>الاسم بالانجليزى</th>
                            <th>الصورة</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../../category_class.php';
                            $categories= new Categories();
                            $categories_data=$categories->select_all();
                            foreach ($categories_data as $category) {
                        ?>
                        <tr class="new-email">
                            <td id="td1"><?php echo $category['category_name_ar']; ?></td>
                            <td><?php echo $category['category_name_en']; ?></td>
                            <td><img src="../../img/categories/<?php echo $category['category_image']; ?>" style="margin-left: 50px;width:50%;height: 105px;"></td>
                            <td><a href="update/?id=<?php echo $category['category_id']; ?>" class="btn btn-custon-rounded-four btn-success" title="Update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <!-- <a href="#" class="btn btn-custon-rounded-four btn-danger confirm" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i> </a> -->
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