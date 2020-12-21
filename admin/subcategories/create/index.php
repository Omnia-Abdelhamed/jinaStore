<?php
    include "../../includes/innerHeader.php";
    $formErrors=array();
    if (isset($_POST['addItem'])) {
    	include_once '../../../subcategory_class.php';
    	$subcategories= new Subcategories();

    	$subcategories->set_subcategory_name_ar($_POST['arName']);
    	$subcategories->set_subcategory_name_en($_POST['enName']);
    	$subcategories->set_category_id($_POST['category']);

    	if(empty($_POST['arName'])){
			$formErrors[]="الاسم بالعربى مطلوب";
		}
    	$ar_count=$subcategories->select_by_name("ar");
    	if($ar_count > 0){
			$formErrors[]="الاسم العربى موجود مسبقا";
		}
		if($_POST['category']==0){
			$formErrors[]="القسم الرئيسى مطلوب";
		}

		if (empty($formErrors)) {
			$result=$subcategories->insert();	
		}
    }
    
?>

<div class="basic-form-area mg-b-15" style="direction:rtl;">
    <div class="container-fluid">
		<div class="row">
		    <div class="col-lg-12">
		        <div class="sparkline12-list shadow-reset mg-t-30">
		            <div class="sparkline12-hd">
		                <div class="main-sparkline12-hd">
		                    <h1 style="display: inline-block;">اضافة قسم فرعى</h1>
		                    <span class="dash" style="font-size: 20px;font-weight: bold;color: #bab5b5">|</span>
		                    <span class="required-fields" style="color: red">الحقول باللون الأحمر * مطلوبة</span>
		                </div>
		            </div>
					<div class="sparkline12-graph">
			            <div class="basic-login-form-ad">
							<div class="row">
			                    <div class="col-lg-12">
			                        <div class="all-form-element-inner">
			                        	<?php if (isset($result)) { 
			                        		if ($result) { ?>
										<div class="alert alert-success" style="text-align:right;">تمت الاضافة بنجاح</div>

										<?php
										}}foreach ($formErrors as $error) {
											echo "<div class='alert alert-danger' style='text-align:right;'>".$error."</div>";
										}
										?>
										<form method="post" enctype="multipart/form-data">
										    <div class="form-group-inner">
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <label class="login2 pull-right pull-right-pro" style="color: red;">الاسم بالعربى <span >*</span></label>
										            </div>
										        </div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" class="form-control" autocomplete="off" name="arName" value="<?php echo isset($_POST['arName']) ? $_POST['arName'] : '' ?>" />
										            </div>
										        </div>
										    </div>
										    <div class="form-group-inner">
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <label class="login2 pull-right pull-right-pro">الاسم بالانجليزى</label>
										            </div>
										        </div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" class="form-control" autocomplete="off" name="enName" value="<?php echo isset($_POST['enName']) ? $_POST['enName'] : '' ?>" style='text-align:left;'/>
										            </div>
										        </div>
										    </div>
										    <div class="form-group-inner">
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <label class="login2 pull-right pull-right-pro" style="color: red;"> القسم <span >*</span></label>
										            </div>
										        </div>
                                                <div class="row">
                                                    <div class="col-lg-1"></div>
                                                    <div class="col-lg-10">
                                                        <div class="form-select-list">
                                                            <select class="form-control custom-select-value" name="category">
                                                            	<option value="0">Select</option>
                                                            	<?php 
                                                            	include_once '../../../category_class.php';
                                                            	$categories= new Categories ();
                                                            	$categories_date=$categories->select_all();
                                                            	foreach ($categories_date as  $category) {?>
                                                                <option value="<?php echo $category["category_id"]; ?>"><?php
                                                                if (!empty($category["category_name_en"])){
                                                                	echo $category["category_name_en"]." - ".$category["category_name_ar"];
                                                                }else{
                                                                	echo 
                                                                	$category["category_name_ar"];
                                                                }

                                                                  ?></option>
                                                                }
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
										   	<div class="form-group-inner">
		                                        <div class="login-btn-inner">
		                                            <div class="row">
		                                                <div class="col-lg-1"></div>
		                                                <div class="col-lg-10" style="text-align:right;">
		                                                    <div class="login-horizental cancel-wp">
		                                                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit" style="background-color: #d41c50;border-color: #d41c50" name="addItem">انشاء</button>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
    include "../../includes/innerFooter.php";
?>  
</body>
</html>
