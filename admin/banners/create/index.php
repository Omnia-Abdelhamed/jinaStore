<?php
ob_start();
    include "../../includes/innerHeader.php";
	$formErrors=array();
	$allowed_extensions=array("jpeg","jpg","png","JPEG","JPG","PNG");

	function resizeImage($resourceType,$image_width,$image_height) {
		$resizeWidth = 1920;
		$resizeHeight = 650;
		$imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
		imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
		return $imageLayer;
	}
    if (isset($_POST['addItem'])) {
    	include_once '../../../banner_class.php';
    	$banners= new Banners();

    	if (!empty($_FILES['image']['name'])) {
			$fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			if(in_array($fileExt, $allowed_extensions)){
				$fileName = $_FILES['image']['tmp_name']; 
				$sourceProperties = getimagesize($fileName);
				$uploadPath = "../../../img/";
				$image_name = 'banner_'.rand(0,100000).".".$fileExt;		
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
			$formErrors[]="صورة البانر مطلوبة..";
		}

		if (empty($formErrors)) {
			if (!empty($image_name)) {
				$banners->set_banner_image($image_name);
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
			$result=$banners->insert();	
			if ($result) {
				header("location: ../../banners/");
				exit();
			}
		}
    }
    
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
		                    <h1 style="display: inline-block;">اضافة صورة</h1>
		                </div>
		            </div>
					<div class="sparkline12-graph">
			            <div class="basic-login-form-ad" style="direction:rtl">
							<div class="row">
			                    <div class="col-lg-12">
			                        <div class="all-form-element-inner">
			                        	<?php if (isset($result)) { 
			                        		if ($result) { ?>
										<div class="alert alert-success" style="text-align: right;">تم التعديل بنجاح...</div>

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
													    <label  style="color: red;">الصورة <span>* </span><span style="font-size:13px;font-weight:normal">(ابعاد الصورة : طول 560 * عرض 1920)</span></label>
													</div>
												</div>
                                                <div class="row">
                                                    <div class="col-lg-1"></div>
													<div class="col-lg-10">
														<div class="file-upload-inner file-upload-inner-right ts-forms">
															<div class="input append-small-btn">
																<div class="file-button" style="background-color: #d41c50;">
																	Browse
																	<input type="file" onchange="
																	val=this.value;
																	val1=val.split('\\');
																	the_val=val1[val1.length-1];
																	document.getElementById('append-small-btn').value =the_val;" name="image">
																</div>
																<input type="text" id="append-small-btn" placeholder="no file selected" readonly="">
															</div>
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
    ob_end_flush();
?>  
</body>
</html>
