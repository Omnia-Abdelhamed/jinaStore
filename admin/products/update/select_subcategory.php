<?php 
include_once '../../../database_class.php';
include_once '../../../subcategory_class.php';
$subcategories= new Subcategories ();
if(isset($_POST['category_id'])){
	$category_id=$_POST['category_id'];
	if(!empty($category_id)){
        $subcategories_date=$subcategories->select_by_category($category_id);
        $count=count($subcategories_date);
		if($count>0){
			foreach ($subcategories_date as  $subcategory) {
				echo '<option value="'.$subcategory['subcategory_id'].'">'.$subcategory['subcategory_name_en']." - ".$subcategory["subcategory_name_ar"].'</option>';
			}
		}else{
			echo "<option value=''>اختر القسم الرئيسى أولا..</option>";
		}
	}else{
        echo "<option value=''>اختر القسم الرئيسى أولا..</option>";
    }	
}