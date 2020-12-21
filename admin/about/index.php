<?php
    include "../includes/innerHeader1.php";
    if (isset($_POST['updateItem'])) {
    	$the_settings->set_id($settings_data['id']);
    	$the_settings->set_about_title($_POST['about_title']);
    	$the_settings->set_about($_POST['about']);
    	$the_settings->set_about_title_en($_POST['about_title_en']);
    	$the_settings->set_about_en($_POST['about_en']);
		$result=$the_settings->update_about();	
    }
    $settings_data1=$the_settings->select_all();
?>
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
		<div class="row">
		    <div class="col-lg-12">
		        <div class="sparkline12-list shadow-reset mg-t-30">
		            <div class="sparkline12-hd">
		                <div class="main-sparkline12-hd" style="text-align: right;">
		                    <span class="required-fields" style="color: red">الحقول باللون الاحمر * مطلوبة</span>
		                    <span class="dash" style="font-size: 20px;font-weight: bold;color: #bab5b5">|</span>
		                    <h1 style="display: inline-block;">تعديل من نحن</h1>
		                </div>
		            </div>
					<div class="sparkline12-graph">
			            <div class="basic-login-form-ad" style="direction:rtl">
							<div class="row">
			                    <div class="col-lg-12">
			                        <div class="all-form-element-inner">
			                        	<?php if (isset($result)) { 
			                        		if ($result) { ?>
										<div class="alert alert-success" style="text-align: right;">تم التعديل بنجاح ..</div>

										<?php
										}}
										?>
										<form method="post" enctype="multipart/form-data">
										    <div class="form-group-inner">
									        	<div class="row">
													<div class="col-lg-1"></div>
													<div class="col-lg-10" style="text-align:right;">
														<label>عنوان الصفحة بالعربى</label>
													</div>
												</div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" class="form-control" autocomplete="off" name="about_title" value="<?php echo $settings_data1['about_title']; ?>"/>
										            </div>
										        </div>
										    </div>
										    <div class="form-group-inner">
										        <div class="row">
													<div class="col-lg-1"></div>
													<div class="col-lg-10" style="text-align:right;">
														<label>التفاصيل بالعربى</labeel>
													</div>
												</div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <textarea name="about" class="form-control" rows="10"><?php echo $settings_data1['about']; ?></textarea>
										            </div>
										        </div>
										    </div>
										     <div class="form-group-inner">
										         <div class="row">
													<div class="col-lg-1"></div>
													<div class="col-lg-10" style="text-align:right;">
														<label>عنوان الصفحة بالانجليزى</labeel>
													</div>
												</div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" class="form-control" autocomplete="off" name="about_title_en" value="<?php echo $settings_data1['about_title_en']; ?>" style="text-align: left"/>
										            </div>
										        </div>
										    </div>
										    <div class="form-group-inner">
										        <div class="row">
													<div class="col-lg-1"></div>
													<div class="col-lg-10" style="text-align:right;">
														<label>التفاصيل بالانجليزى</labeel>
													</div>
												</div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <textarea name="about_en" class="form-control" rows="10" style="text-align: left"><?php echo $settings_data1['about_en']; ?></textarea>
										            </div>
										        </div>
										    </div>
										    
										     
										   <div class="form-group-inner">
		                                        <div class="login-btn-inner">
		                                            <div class="row">
		                                                <div class="col-lg-1"></div>
		                                                <div class="col-lg-10" style="text-align:right;">
		                                                    <div class="login-horizental cancel-wp ">
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
    include "../includes/innerFooter1.php";
?> 