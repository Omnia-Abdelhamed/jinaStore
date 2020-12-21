<?php
    include "../includes/innerHeader1.php";
    $formErrors=array();
	$allowed_extensions=array("jpeg","jpg","png","JPEG","JPG","PNG");
	function resizeImage($resourceType,$image_width,$image_height) {
		$resizeWidth = 668;
		$resizeHeight = 675;
		$imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
		imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
		return $imageLayer;
	}
    if (isset($_POST['updateItem'])) {
        if (!empty($_FILES['image']['name'])) {
 			$fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			if(in_array($fileExt, $allowed_extensions)){
    			$fileName = $_FILES['image']['tmp_name'];
				$sourceProperties = getimagesize($fileName);
				$uploadPath = "../../img/";
				$image_name = 'header_logo'.".".$fileExt;
				$uploadImageType = $sourceProperties[2];
				$sourceImageWidth = $sourceProperties[0];
				$sourceImageHeight = $sourceProperties[1];
				switch ($uploadImageType) {
					case IMAGETYPE_JPEG:
						$imageProcess = 1;                
						break;
		 
					case IMAGETYPE_PNG:
						$imageProcess = 2;
						break;
		 
					default:
						$imageProcess = 0;
						break;
				}
			}else{
			    $formErrors[]="الامتداد غير سليم..";
			}
    	}else{
    		$image_name=$settings_data['logo'];
    	}
        
    	$the_settings->set_id($settings_data['id']);
    	$the_settings->set_name($_POST['name']);
    	$the_settings->set_logo($image_name);
    	$the_settings->set_email($_POST['email']);
    	$the_settings->set_phone($_POST['phone']);
    	$the_settings->set_whatsapp($_POST['whatsapp']);
    	$the_settings->set_ar_currency($_POST['ar_currency']);
    	$the_settings->set_en_currency($_POST['en_currency']);
    	$the_settings->set_facebook($_POST['facebook']);
    	$the_settings->set_instagram($_POST['instagram']);
		
		if (empty($formErrors)) {
			if (!empty($_FILES['image']['name'])) {
				if (isset($imageProcess)) {
					if ($imageProcess == 1) {
						$resourceType = imagecreatefromjpeg($fileName); 
						$imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
						imagejpeg($imageLayer,$uploadPath.$image_name);
					}elseif($imageProcess == 2){
						$resourceType = imagecreatefrompng($fileName); 
						$imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
						imagepng($imageLayer, $uploadPath.$image_name);
					}
				}
			} 
			$result=$the_settings->update_settings();
		}
    }
    $settings_data1=$the_settings->select_all();
    
?>
<div class="basic-form-area mg-b-15" style="direction:rtl">
    <div class="container-fluid">
		<div class="row">
		    <div class="col-lg-12">
		        <div class="sparkline12-list shadow-reset mg-t-30">
		            <div class="sparkline12-hd">
		                <div class="main-sparkline12-hd">
		                    <h1 style="display: inline-block;">تعديل الاعدادات</h1>
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
										<div class="alert alert-success" style="text-align:right;">تم التعديل بنجاح</div>

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
										                <label style="color: red;">اسم الموقع <span >*</span></label>
										            </div>
										        </div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" class="form-control" autocomplete="off" name="name" value="<?php echo $settings_data1['name']; ?>" required=""/>
										            </div>
										        </div>
										    </div>
										    <div class="form-group-inner">
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10" style="text-align:right;">
										                <label style="color: red;"> اللوجو <span >*</span></label>
										            </div>
										        </div>
                                                <div class="row">
                                                    <div class="col-lg-1"></div>
                                                    <div class="col-lg-10">
                                                        <div class="file-upload-inner file-upload-inner-right ts-forms">
                                                            <div class="input append-small-btn">
                                                                <div class="file-button" style="background-color: #d41c50;">
																	Browse
																	<input type="file" name="image" onchange="
                                                                    val=this.value;
                                                                    val1=val.split('\\');
                                                                    the_val=val1[val1.length-1];
																	document.getElementById('append-small-btn').style.display ='none';
                                                                    document.getElementById('append-small1-btn').style.display ='block';
																	document.getElementById('append-small1-btn').innerHTML =the_val;
																	">
																</div>
                                                                <div id="append-small-btn" style="border: solid 1px #d41c50">
                                                                	<img src="../../img/<?php echo $settings_data1['logo']; ?>" style="width: 220px;height: 120px;">
                                                                </div>
																<div id="append-small1-btn" style="border: solid 1px #d41c50;height: 35px;line-height: 33px;text-align: left;padding-left: 20px;display:none;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
										    <div class="form-group-inner">
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10" style="text-align:right;">
										                <label>الميل </label>
										            </div>
										        </div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="email" class="form-control" autocomplete="off" name="email" value="<?php echo $settings_data1['email']; ?>"/>
										            </div>
										        </div>
										    </div>
										    <div class="form-group-inner">
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10" style="text-align:right;">
										                <label>الهاتف  </label>
										            </div>
										        </div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" class="form-control" autocomplete="off" name="phone" value="<?php echo $settings_data1['phone']; ?>"/>
										            </div>
										        </div>
										    </div>
										    <div class="form-group-inner">
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10" style="text-align:right;">
										                <label>رقم الواتساب</label>
										            </div>
										        </div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" class="form-control" autocomplete="off" name="whatsapp" value="<?php echo $settings_data1['whatsapp']; ?>"/>
										            </div>
										        </div>
										    </div>
										    <div class="form-group-inner">
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10" style="text-align:right;">
										                <label>العملة بالعربى</label>
										            </div>
										        </div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" class="form-control" autocomplete="off" name="ar_currency" value="<?php echo $settings_data1['ar_currency']; ?>"/>
										            </div>
										        </div>
										    </div>
										    <div class="form-group-inner">
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10" style="text-align:right;">
										                <label>العملة بالانجليزى</label>
										            </div>
										        </div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" class="form-control" autocomplete="off" name="en_currency" value="<?php echo $settings_data1['en_currency']; ?>"/>
										            </div>
										        </div>
										    </div>
                                            <div class="form-group-inner">
                                                <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10" style="text-align:right;">
										                <label>رابط الفيس بوك</label>
										            </div>
										        </div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" name="facebook" class="form-control" value="<?php echo $settings_data1['facebook']; ?>">
										            </div>
										        </div>
										    </div>
										    <div class="form-group-inner">
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10" style="text-align:right;">
										                <label>رابط انستجرام</label>
										            </div>
										        </div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text"  name="instagram" class="form-control" value="<?php echo $settings_data1['instagram']; ?>">
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
    include "../includes/innerFooter1.php";
?>