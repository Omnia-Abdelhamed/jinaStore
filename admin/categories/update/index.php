<?php
ob_start();
    include "../../includes/innerHeader.php";
	$category_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
	 if ($category_id==0) {
    	header("location: ../../categories/");
		exit();
    }
    include_once '../../../category_class.php';
    $categories= new Categories();
    $category_data=$categories->select_by_one($category_id);
    $formErrors=array();
	$allowed_extensions=array("jpeg","jpg","png","JPEG","JPG","PNG");

    function resizeImage($resourceType,$image_width,$image_height) {
		$resizeWidth = 255;
		$resizeHeight = 250;
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
				$uploadPath = "../../../img/categories/";
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
    		$image_name=$category_data['category_image'];
    	}

    	$categories->set_category_name_ar($_POST['arName']);
    	$categories->set_category_name_en($_POST['enName']);
    	$categories->set_category_image($image_name);

    	
		if(empty($_POST['arName'])){
			$formErrors[]="الاسم بالعربى مطلوب..";
		}
		$ar_count=$categories->select_by_name("ar",$category_id);
		if($ar_count > 0){
			$formErrors[]="الاسم بالعربى موجود من قبل..";
		}
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
			$result=$categories->update($category_id);
			if ($result) {
				header("location: ../../categories/");
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
		                    <h1 style="display: inline-block;">تعديل قسم</h1>
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
										<div class="alert alert-success" style="text-align: right;">تمت التعديل بنجاح..</div>

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
													    <label style="color: red;"> الاسم بالعربى <span >*</span></label>
													</div>
												</div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" class="form-control" autocomplete="off" name="arName" value="<?php echo $category_data['category_name_ar']; ?>" />
										            </div>
										        </div>
										    </div>
										    <div class="form-group-inner">
										        <div class="row">
													<div class="col-lg-1"></div>
													<div class="col-lg-10" style="text-align:right;">
													    <label>الاسم بالانجليزى</label>
													</div>
												</div>
										        <div class="row">
										            <div class="col-lg-1"></div>
										            <div class="col-lg-10">
										                <input type="text" class="form-control" autocomplete="off" name="enName" value="<?php echo $category_data['category_name_en']; ?>"/>
										            </div>
										        </div>
										    </div>
										     <div class="form-group-inner">
										        <div class="row">
													<div class="col-lg-1"></div>
													<div class="col-lg-10" style="text-align:right;">
													    <label  style="color: red;">الصورة <span>* </span><span style="font-size:13px;font-weight:normal">(ابعاد الصورة : طول 250 * عرض 255)</span></label>
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
                                                                            	<img src="../../../img/categories/<?php echo $category_data['category_image']; ?>" style="width: 220px;height: 120px;">
                                                                            </div>
																			<div id="append-small1-btn" style="border: solid 1px #d41c50;height: 35px;line-height: 33px;text-align: left;padding-left: 20px;display:none;"></div>
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
    ob_end_flush();
?>  
</body>
</html>
