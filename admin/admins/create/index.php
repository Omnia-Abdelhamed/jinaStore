<?php
ob_start();
    include "../../includes/innerHeader.php";
	$formErrors=array();

    if (isset($_POST['addItem'])) {
    	include_once '../../../admin_class.php';
    	$admins= new Admins();
    	$admins->set_username($_POST['username']);
    	$admins->set_password($_POST['password']);
    	$exit_username=$admins->select_by_username();
    	if (!empty($exit_username)) {
    		$formErrors[]="اسم المستخدم موجود اختر اسم اخر..";
    	}

		if (empty($formErrors)) {
			$result=$admins->insert();	
			if ($result) {
				header("location: ../../admins/");
				exit();
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
		                <div class="main-sparkline12-hd" style="text-align: right;">
		                    <h1 style="display: inline-block;">اضافة مدير</h1>
		                    <span class="dash" style="font-size: 20px;font-weight: bold;color: #bab5b5">|</span>
		                    <span class="required-fields" style="color: red">الحقول باللون الاحمر * مطلوبة</span>
		                </div>
		            </div>
					<div class="sparkline12-graph">
			            <div class="basic-login-form-ad">
							<div class="row">
			                    <div class="col-lg-12">
			                        <div class="all-form-element-inner">
			                        	<?php if (isset($result)) { 
			                        		if ($result) { ?>
											<div class="alert alert-success" style="text-align: right;">تمت الاضافة بنجاح..</div>

										<?php
										}}foreach ($formErrors as $error) {
											echo "<div class='alert alert-danger' style='text-align: right;'>".$error."</div>";
										}
										?>
										<form method="post" enctype="multipart/form-data">
										    <div class="form-group-inner">
										        <div class="row">
													<div class="col-lg-1"></div>
													<div class="col-lg-10" style="text-align:right;">
													    <label style="color: red;">اسم المستخدم <span>*</label>
													</div>
												</div>
                                                <div class="row">
													<div class="col-lg-1"></div>
													<div class="col-lg-10">
														<input type="text" name="username" class="form-control" required="">
													</div>
                                                </div>
                                            </div>
                                            <div class="form-group-inner">
                                                <div class="row">
													<div class="col-lg-1"></div>
													<div class="col-lg-10" style="text-align:right;">
													    <label style="color: red;"> كلمة المرور <span>*</label>
													</div>
												</div>
                                                <div class="row">
													<div class="col-lg-1"></div>
													<div class="col-lg-10">
														<input type="password" name="password" class="form-control" required="">
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
    ob_end_flush();
?>  
</body>
</html>
