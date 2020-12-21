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
                                <li><a href="../sizes/"> المقاسات </a> 
                                </li>
                                <li>
                                    <span class="bread-slash">/</span><span class="bread-blod"><a href="../sizes/create/">اضافة مقاس</a></span>
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
                            <th> المقاس </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../../product_class.php';
                            $sizes= new Products();
                            $sizes_data=$sizes->select_size_keys();
                            foreach ($sizes_data as $size) {
                        ?>
                        <tr class="new-email">
                            <td id="td1"><?php echo $size['size_title']; ?></td>
                             <td>
                                 <a href="../sizes/update/?id=<?php echo $size['size_id']; ?>" class="btn btn-custon-rounded-four btn-success" title="Update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                 <!--<a href="deleteSize.php?id=<?php echo $size['size_id']; ?>" class="btn btn-custon-rounded-four btn-danger confirm" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i> </a> -->
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