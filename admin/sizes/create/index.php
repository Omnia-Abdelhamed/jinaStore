<?php
    include "../../includes/innerHeader.php";
    $formErrors=array();
    if (isset($_POST['addItem'])) {
    	include_once '../../../size_class.php';
    	$sizes= new Sizes();

    	$sizes->set_size_title($_POST['size_title']);
    	$ar_count=$sizes->select_by_the_size();
    	if($ar_count > 0){
			$formErrors[]="المقاس موجود مسبقا";
		}

		if (empty($formErrors)) {
			$result=$sizes->insert();
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
		                    <h1 style="display: inline-block;">اضافة مقاس</h1>
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
										                <label class="login2 pull-right pull-right-pro" style="color: red;"> المقاس <span >*</span></label>
										            </div>
										        </div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" class="form-control" autocomplete="off" name="size_title" value="<?php echo isset($_POST['size_title']) ? $_POST['size_title'] : '' ?>" required="" />
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
