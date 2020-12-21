<?php 
include_once 'database_class.php';
include_once 'country_class.php';
include_once 'settings_class.php';
$the_settings=new Mysettings();
$settings_data=$the_settings->select_all();
$countries= new Countries ();
if(isset($_POST['country_id'])){
	$country_id=$_POST['country_id'];
	if(!empty($country_id)){
        $countries_data=$countries->select_by_one($country_id);
        $count=count($countries_data);
        // echo $count;
		if($count>0){
			echo "<div class='row'>
                    <label class=' col-lg-3 col-sm-12' style='font-weight:bold'>الشحن : </label>
                    <label class=' col-lg-9 col-sm-12'>". $countries_data['shipping'] . " ".$settings_data['ar_currency']."</label>
                </div>
                <div class='row'>
                    <label class=' col-lg-3 col-sm-12' style='font-weight:bold'>الضريبة : </label>
                    <label class='' col-lg-9 col-sm-12'>". $countries_data['taxes'] ." % </label>
                </div>";
		}else{
			echo "اختر الدولة اولا ";
		}
	}else{
        echo "اختر الدولة اولا ";
    }	
}