$(document).ready(function(){
	
    document.getElementById('firstNext').onclick=function (event) {
		event.preventDefault();
		if(document.getElementById("category").value==0){
			document.getElementById("category").style.backgroundColor="rgba(212, 28, 80,.9)";
		}
		var the_values=document.getElementsByClassName('required_inputs');
		var i;
		var count=0;
		for (i = 0; i < the_values.length; i++) {
			if (the_values[i].value == "") {
				the_values[i].style.backgroundColor = "rgba(212, 28, 80,.9)";
				count=count+1;
			} 	
		}
		if(count > 0 || document.getElementById("category").value==0){
			return false;
		}
		document.getElementById('firstTab').style.display="none";
		document.getElementById('secondTab').style.display="block";
	}
	document.getElementById('secondNext').onclick=function (event) {
		event.preventDefault();
		document.getElementById('secondTab').style.display="none";
		document.getElementById('thirdTab').style.display="block";
	}
	document.getElementById('firstBack').onclick=function (event) {
		event.preventDefault();
		document.getElementById('secondTab').style.display="none";
		document.getElementById('firstTab').style.display="block";
	}
	document.getElementById('thirdNext').onclick=function (event) {
		event.preventDefault();
		document.getElementById('thirdTab').style.display="none";
		document.getElementById('forthTab').style.display="block";
    }
	document.getElementById('secondBack').onclick=function (event) {
		event.preventDefault();
		document.getElementById('thirdTab').style.display="none";
		document.getElementById('secondTab').style.display="block";
	}
	document.getElementById('thirdBack').onclick=function (event) {
		event.preventDefault();
		document.getElementById('forthTab').style.display="none";
		document.getElementById('thirdTab').style.display="block";
	}
	document.getElementById('add').onclick=function (event) {
		var the_values=document.getElementsByClassName('last_required_inputs');
		var i;
		var count=0;
		for (i = 0; i < the_values.length; i++) {
			if (the_values[i].value == "") {
				the_values[i].style.backgroundColor = "rgba(212, 28, 80,.9)";
				count=count+1;
			} 	
		}
		if(count > 0){
			return false;
		}
	}

    $( ".checkSize" ).click(function() {
		var the_checked=document.getElementsByClassName('checkSize');
		var j;
		for (j = 0; j < the_checked.length; j++) {
			var id="size"+(j+1);
			if (the_checked[j].checked) {
				$("#"+id).fadeIn(700);
			}else{
				$("#"+id).val("");
				$("#"+id).fadeOut(500);
			}	
		}
	});
	$("#category").change(function() {
		var category=$("#category").val();
		if(category){
			$.ajax({
				url: "select_subcategory.php",
				type: "POST",
				data:{category_id:$("#category").val()},
				success: function(msg) { 
					$("#subcategory").html(msg);
				},
				error: function(msg) {
					alert("error");
				}
			});
		}
	});
});