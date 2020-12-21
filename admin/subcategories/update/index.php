<?php
ob_start();
    include "../../includes/innerHeader.php";
	$subcategory_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
	if ($subcategory_id==0) {
    	header("location: ../../subcategories/");
		exit();
    }

	include_once '../../../subcategory_class.php';
    $subcategories= new Subcategories();
	$subcategory_data=$subcategories->select_by_one($subcategory_id);
	$category_id=$subcategory_data['category_id'];

    $formErrors=array();
    if (isset($_POST['updateItem'])) {
    
    	$subcategories->set_subcategory_name_ar($_POST['arName']);
    	$subcategories->set_subcategory_name_en($_POST['enName']);
    	$subcategories->set_category_id($_POST['category']);

    	if(empty($_POST['arName'])){
			$formErrors[]="الاسم بالعربى مطلوب";
		}
    	$ar_count=$subcategories->select_by_name("ar",$subcategory_id);
    	if($ar_count > 0){
			$formErrors[]="الاسم بالعربى موجود مسبقا";
		}
		if (empty($formErrors)) {	
			$result=$subcategories->update($subcategory_id);
			if ($result) {
				header("location: ../../subcategories/");
			}	
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
		                    <h1 style="display: inline-block;">تعديل قسم فرعى</h1>
		                    <span class="dash" style="font-size: 20px;font-weight: bold;color: #bab5b5">|</span>
		                    <span class="required-fields" style="color: red">الحقول بالأحمر * مطلوبة</span>
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
										                <input type="text" class="form-control" autocomplete="off" name="arName" value="<?php echo $subcategory_data['subcategory_name_ar']; ?>" />
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
										                <input type="text" class="form-control" autocomplete="off" name="enName" value="<?php echo $subcategory_data['subcategory_name_en']; ?>" style='text-align:left;'/>
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
																<option value="<?php echo $subcategory_data["category_id"] ?>"><?php
                                                                if (!empty($subcategory_data["category_name_en"])){
                                                                	echo $subcategory_data["category_name_en"]." - ".$subcategory_data["category_name_ar"];
                                                                }else{
                                                                	echo 
                                                                	$subcategory_data["category_name_ar"];
                                                                }

                                                                  ?></option>
                                                            	<?php 
                                                            	include_once '../../../category_class.php';
																$categories= new Categories ();
                                                            	$categories_date=$categories->select_all("ASC",$category_id);
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
		                                                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit" style="background-color: #d41c50;border-color: #d41c50" name="updateItem">تعديل</button>
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
    ob_end_flush()
?>  
</body>
</html>
