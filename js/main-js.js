
$(document).ready(function(){
    $(".open").click(function(){
      $(".open").toggle();
	   $(".close").toggle();
	  $(".sidbar").toggleClass("active");
    });
});
$(document).ready(function(){
    $(".close").click(function(){
      $(".open").toggle();
	   $(".close").toggle();
	  $(".sidbar").toggleClass("active");
    });
});
// ============================================================================
// btn-plus and btn-minus in "#order-detail-content" table
// ============================================================================

  $('.btn-plus').on('click', function () {
    var $count = $(this).parent().find('.count');
    var val = parseInt($count.val(),10);
    $count.val(val+1);
    return false;
  });

  $('.btn-minus').on('click', function () {
    var $count = $(this).parent().find('.count');
    var val = parseInt($count.val(),10);
    if(val > 1) $count.val(val-1);
    return false;
  });
$(".heart").click(function(){
    $(this).toggleClass("main-color");

});