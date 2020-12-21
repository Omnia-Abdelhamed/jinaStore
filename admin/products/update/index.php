<?php
include "../../includes/innerHeader.php";
$product_code = (isset($_GET['id'])) ? $_GET['id'] : 0;
if(!ctype_alnum($product_code)){
    $product_code=0;
}
if ($product_code === 0) {
	header('location: ../../products/');
}

include_once '../../../product_class.php';
$products= new Products();

$products->set_product_code($product_code);
$product_data=$products->select_by_code();
$id=$product_data['id'];
$size_count=1;
$size_keys=$products->select_size_keys();
$selected_added_images=$products->select_added_images();

$formErrors=array();
$allowed_extensions=array("jpeg","jpg","png","JPEG","JPG","PNG");

function resizeImage($resourceType,$image_width,$image_height) {
    $resizeWidth = 240;
    $resizeHeight = 300;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
if (isset($_POST['updateItem'])) {
	// $my_date=getdate();
	// $last_updated_date=$my_date['year']."-".$my_date['mon']."-".$my_date['mday']." ".$my_date['hours'].":".$my_date['minutes'].":".$my_date['seconds'];
	// $added_images=array();
	// $size_holding=array();
	// if(isset($_POST['best_sellers'])){
	// 	$best_seller=$_POST['best_sellers'];
	// }else{
	// 	$best_seller=0;
	// }
	// if(isset($_POST['new_arrival'])){
	// 	$new_arrival=$_POST['new_arrival'];
	// }else{
	// 	$new_arrival=0;
	// }

	// if (!empty($_FILES['main_image']['name'])) {
	// 	$fileExt = pathinfo($_FILES['main_image']['name'], PATHINFO_EXTENSION);
	// 	if(in_array($fileExt, $allowed_extensions)){
	// 		$fileName = $_FILES['main_image']['tmp_name']; 
	//         $sourceProperties = getimagesize($fileName);
	//         $uploadPath = "../../../img/products/";
	//         $main_image_name = $_POST['code']."_mainImage.".$fileExt;		
	//         $uploadImageType = $sourceProperties[2];
	//         $sourceImageWidth = $sourceProperties[0];
	// 		$sourceImageHeight = $sourceProperties[1];
	// 		switch ($uploadImageType) {
	//             case IMAGETYPE_JPEG:
	// 				$imageProcess = 1;                
	//                 break;
	 
	//             case IMAGETYPE_PNG:
	// 				$imageProcess = 2;
	//                 break;
	 
	//             default:
	//                 $imageProcess = 0;
	//                 break;
	// 		}
	// 	}else{
	// 		$formErrors[]="Not allowed extension for main image..";
	// 	}
	// }else{
 //        $main_image=$product_data['product_main_image'];	
	// }

	// $products->set_product_code($_POST['code']);
	// $products->set_product_title_ar($_POST['title_ar']);
	// $products->set_product_title_en($_POST['title_en']);
	// $products->set_product_details_ar($_POST['details_ar']);
	// $products->set_product_details_en($_POST['details_en']);
	// $products->set_product_price($_POST['price']);
	// $products->product_updated_date($added_date);
	// $products->set_product_quantity($_POST['quantity']);
	// $products->set_best_seller($best_seller);
	// $products->set_new_arrival($new_arrival);
	// $products->set_category_id($_POST['category']);
	// $products->set_subcategory_id($_POST['subcategory']);

	// if (!empty($_FILES['added_images']['name'])) {
	// 	$added_images=$_FILES['added_images'];	
	// }
	
	// foreach ($size_keys as $s_key) {
	// 	$size_id=$s_key['size_id'];
	// 	$size_title=$s_key['size_title'];
	// 	if (array_key_exists($size_title, $_POST)) {
	// 		$size_holding[$size_id]=$_POST[$size_title];
	// 	}
	// }

	// $code_count=$products->select_by_code($id,"count");
	// if($code_count > 0){
	// 	$formErrors[]="Code has already taken..";
	// }
	// if(!ctype_alnum($_POST['code'])){
	// 	$formErrors[]="Code must be letters and digits only..";
	// }

	// if (empty($formErrors)) {
	// 	if (!empty($main_image_name)) {
	// 		$products->set_product_main_image($main_image_name);
	// 		if (isset($imageProcess)) {
	// 			if ($imageProcess == 1) {
	// 				$resourceType = imagecreatefromjpeg($fileName); 
 //                	$imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
 //                	imagejpeg($imageLayer,$uploadPath.$main_image_name);
	// 			}elseif($imageProcess == 2){
	// 				$resourceType = imagecreatefrompng($fileName); 
 //                	$imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
 //                	imagepng($imageLayer, $uploadPath.$main_image_name);
	// 			}
	// 		}
	// 	}
	// 	$result=$products->update($size_holding,$added_images);	
	// }
}
    
?>
<style type="text/css">
	.check_quantity{display:none;border-color:#d41c50;}
	.del_extra_image{
		color: #d41c50;
	}
	.del_extra_image:hover{
		cursor: pointer;
		text-decoration: underline;
	}
</style>
<div class="basic-form-area mg-b-15" style="direction:rtl;">
    <div class="container-fluid">
		<div class="row">
		    <div class="col-lg-12">
		        <div class="sparkline12-list shadow-reset mg-t-30">
		            <div class="sparkline12-hd">
		                <div class="main-sparkline12-hd">
		                    <h1 style="display: inline-block;">تعديل منتج</h1>
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
												<div class="alert alert-success" style="text-align:right;"><?php echo $result; ?></div>
										<?php
										}}foreach ($formErrors as $error) {
											echo "<div class='alert alert-danger' style='text-align:right;'>".$error."</div>";
										}
										?>
										<form method="post" enctype="multipart/form-data">
											<div id="firstTab">
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style='text-align:right;'>
															<div class="i-checks">
																<label><input type="checkbox" <?php if($product_data['new_arrival']==1){ ?> checked=""<?php } ?> value="1" name="new_arrival"> <i></i> &nbsp;جديد </label>
															</div>	
														</div>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style='text-align:right;'>
															<div class="i-checks">
									<label><input type="checkbox" <?php if($product_data['best_seller']==1){ ?> checked=""<?php } ?> value="1" name="best_sellers"> <i></i> &nbsp;منتج مميز</label>
															</div>	
														</div>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style="text-align: right;">
															<label style="color: red;">القسم الرئيسى <span>*</span></label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10">
															<div class="form-select-list">
																<select class="form-control custom-select-value required_inputs" name="category" id="category">
																	<option value="<?php echo $product_data["category_id"]; ?>"><?php echo $product_data["category_name_en"]." - ".$product_data["category_name_ar"]; ?></option>
																	<?php 
																	include_once '../../../category_class.php';
																	$categories= new Categories ();
																	$categories_date=$categories->select_all($order="ASC",$category_id=$product_data["category_id"]);
																	foreach ($categories_date as  $category) {?>
																	<option value="<?php echo $category["category_id"]; ?>"><?php echo $category["category_name_en"]." - ".$category["category_name_ar"]; ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style="text-align: right;">
															<label style="color: red;">القسم الفرعى <span>*</span></label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10">
															<div class="form-select-list">
																<select class="form-control custom-select-value required_inputs" name="subcategory" id="subcategory">
																	<option value="<?php echo $product_data["subcategory_id"]; ?>"><?php echo $product_data["subcategory_name_en"]." - ".$product_data["subcategory_name_ar"]; ?></option>	
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style="text-align: right;">
															<label style="color: red;">الكود <span >*</span> <span style="font-size:13px;font-weight:normal;">(ارقام وحروف فقط , غير قابل للتكرار)</span> </label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10">
															<input type="text" class="form-control required_inputs" name="code" value="<?php echo $product_data['product_code'];?>"/>
														</div>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style="text-align: right;">
															<label style="color: red;">الاسم بالعربى <span>*</span></label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10">
															<input type="text" class="form-control required_inputs" name="title_ar" style="text-align:right;" value="<?php echo $product_data['product_title_ar'];?>"/>
														</div>
													</div>
												</div>
												<div class="form-group-inner">
												    <div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style="text-align: right;">
															<label style="color: red;">الاسم بالانجليزى <span>*</span></label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10">
															<input type="text" class="form-control required_inputs" name="title_en" value="<?php echo $product_data['product_title_en'];?>" style="text-align:left;"/>
														</div>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="text-align: right;">
															<label style="color: red;">الصورة <span>*</span> <span style="font-size:13px;font-weight:normal;">(ابعاد الصورة : طول 300 *عرض 240)</span></label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
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
                                                                            	<img src="../../../img/products/<?php echo $product_data['product_main_image']; ?>" style="width: 220px;height: 120px;">
                                                                            </div>
																			<div id="append-small1-btn" style="border: solid 1px #d41c50;height: 35px;line-height: 33px;text-align: left;padding-left: 20px;display:none;">
																			</div>
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
																	<button class="btn btn-sm btn-primary login-submit-cs" style="background-color: #d41c50;border-color: #d41c50" id="firstNext">التالى</button>																
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="secondTab" style="display:none;">
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style="text-align: right;">
															<label>الوصف بالعربى </label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10">
															<textarea class="form-control" name="details_ar" rows="8" style="text-align:right;"><?php echo $product_data['product_details_ar']; ?></textarea>
														</div>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style="text-align: right;">
															<label>الوصف بالانجليزى </label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10">
															<textarea class="form-control" name="details_en" rows="8" style="text-align:left;"><?php echo $product_data['product_details_en']; ?></textarea>
														</div>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="login-btn-inner">
														<div class="row">
															<div class="col-lg-1"></div>
															<div class="col-lg-10" style="text-align:right;">
																<div class="login-horizental cancel-wp">
																	<button class="btn btn-sm btn-primary login-submit-cs" style="background-color: #d41c50;border-color: #d41c50" id="secondNext">التالى</button>																
																	<button class="btn btn-sm btn-primary login-submit-cs" style="background-color: gray;border-color: gray" id="firstBack">رجوع</button>																
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="thirdTab" style="display:none;">
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style="text-align:right;">
															<div class="i-checks">
																<label style="color:#bc4969 !important;">المقاس (فى حالة الملابس فقط)</label>
															</div>	
														</div>
													</div>
												</div>
												<!-- start -->
												<?php foreach ($size_keys as  $size_key) {
													$the_id=$size_key['size_id'];
													$check=$products->select_size_quantity($the_id);
													if (!empty($check)) {
														$size_quantity_count=$check[0];
														$size_quantity=$check[1]['quantity'];
													}	
												?>
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style="text-align:right;">
															<div class="i-checks">
																<label><input type="checkbox" <?php if (!empty($check)) { if($size_quantity_count > 0){ ?> checked="" <?php } } ?> class="checkSize"> &nbsp;<?php echo $size_key['size_title']; ?></label>
															</div>	
														</div>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10">
															<input type="number" min="1" class="form-control check_quantity"  id="size<?php echo $size_count; ?>" name="<?php echo $size_key['size_title']; ?>" <?php if (!empty($check)) { ?> value="<?php echo $size_quantity ?>" <?php if (!empty($size_quantity)) { ?> style="display: inline;" <?php } } ?> >
														</div>
													</div>
												</div>
												<?php $size_count++; } ?>
												<!-- end -->
												<div class="form-group-inner">
													<div class="login-btn-inner">
														<div class="row">
															<div class="col-lg-1"></div>
															<div class="col-lg-10" style="text-align:right;">
																<div class="login-horizental cancel-wp">
																	<button class="btn btn-sm btn-primary login-submit-cs" style="background-color: #d41c50;border-color: #d41c50" id="thirdNext">التالى</button>																
																	<button class="btn btn-sm btn-primary login-submit-cs" style="background-color: gray;border-color: gray" id="secondBack">رجوع</button>																
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="forthTab" style="display:none;">
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style="text-align: right;">
															<label style="color: red;">الكمية <span>*</span></label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10">
															<input type="number" min="1" class="form-control last_required_inputs" name="quantity" value="<?php echo $product_data['product_quantity'] ?>"/>
														</div>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style="text-align: right;">
															<label style="color: red;">السعر <span>*</span></label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10">
															<input type="text" class="form-control last_required_inputs" name="price" value="<?php echo $product_data['product_price'];?>"/>
														</div>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10" style="text-align: right;">
															<label>الصور الاضافية </label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-1"></div>
														<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
															<div class="file-upload-inner file-upload-inner-right ts-forms">
																<div class="input append-small-btn">
																	<div class="file-button" style="background-color: #d41c50;">
																		Browse
																		<input type="file" onchange="
																		val=this.value;
																		val1=val.split('\\');
																		the_val=val1[val1.length-1];
																		document.getElementById('append-small-btn2').value =the_val;" name="added_images[]" multiple>
																	</div>
																	<input type="text" id="append-small-btn2" placeholder="no file selected" readonly="">
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="row">
														<div class="col-lg-1"></div>
														<?php foreach ($selected_added_images as $selected_added_image) { ?>
														<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12" style="text-align: left;margin-left: 15px;margin-top: 10px;">
															<img src="../../../img/products/<?php echo $selected_added_image['product_extra_image'] ?>" style="width: 185px;height: 190px;" id="image<?php echo $selected_added_image['product_extra_image'] ?>"><br>
															<span class="del_extra_image" id="<?php echo $selected_added_image['product_extra_image'] ?>">Delete Image</span>
														</div>
														<?php } ?>
													</div>
												</div>
												<div class="form-group-inner">
													<div class="login-btn-inner">
														<div class="row">
															<div class="col-lg-1"></div>
															<div class="col-lg-10" style="text-align:right">
																<div class="login-horizental cancel-wp">
																	<button class="btn btn-sm btn-primary login-submit-cs" style="background-color: gray;border-color: gray" id="thirdBack">رجوع</button>																
																	<button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="updateItem" style="background-color: #d41c50;border-color: #d41c50" id="add">تعديل</button>																
																</div>
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
<script src="../../js/addProduct.js"></script>
<script type="text/javascript">
    var the_images_values=document.getElementsByClassName('del_extra_image');
    var m;
    for (m = 0; m < the_images_values.length; m++) {
        the_images_values[m].onclick=function(){
            var theImageId=this.id;
            if(theImageId){
                $.ajax({
                    url: "deleteExtraImage.php",
                    type: "POST",
                    data:{image_id:theImageId},
                    success: function(msg) { 
                        the_id_image="image"+theImageId;
                        document.getElementById(the_id_image).style.visibility="hidden";
                        document.getElementById(theImageId).innerHTML="تم الحذف";
                    },
                    error: function(msg) {
                        alert("error");
                    }
                });
            }
        }
    }
</script> 
</body>
</html>
