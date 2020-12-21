
	$('#carousel-our').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 5;
	    var totalItems = $('#carousel-our .carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('#carousel-our .carousel-item').eq(i).appendTo('#carousel-our  .carousel-inner');
	            }
	            else {
	                $('#carousel-our .carousel-item').eq(0).appendTo('#carousel-our  .carousel-inner');
	            }
	        }
	    }
	});
	
	$('#carousel-product').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 5;
	    var totalItems = $('#carousel-product  .carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('#carousel-product .carousel-item').eq(i).appendTo('#carousel-product  .carousel-inner');
	            }
	            else {
	                $('#carousel-product .carousel-item').eq(0).appendTo('#carousel-product .carousel-inner');
	            }
	        }
	    }
	});
	
	$('#carousel-category').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 5;
	    var totalItems = $('#carousel-category .carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('#carousel-category .carousel-item').eq(i).appendTo('#carousel-category  .carousel-inner');
	            }
	            else {
	                $('#carousel-category .carousel-item').eq(0).appendTo('#carousel-category  .carousel-inner');
	            }
	        }
	    }
	});
	
	$('#carousel1').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 5;
	    var totalItems = $('#carousel1  .carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('#carousel1 .carousel-item').eq(i).appendTo('#carousel1  .carousel-inner');
	            }
	            else {
	                $('#carousel1 .carousel-item').eq(0).appendTo('#carousel1 .carousel-inner');
	            }
	        }
	    }
	});
	$('#carousel2').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 5;
	    var totalItems = $('#carousel2  .carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('#carousel2 .carousel-item').eq(i).appendTo('#carousel2  .carousel-inner');
	            }
	            else {
	                $('#carousel2 .carousel-item').eq(0).appendTo('#carousel2 .carousel-inner');
	            }
	        }
	    }
	});


$('#carousel3').on('slide.bs.carousel', function (e) {

	    /*
	        CC 2.0 License Iatek LLC 2018
	        Attribution required
	    */
	    var $e = $(e.relatedTarget);
	    var idx = $e.index();
	    var itemsPerSlide = 5;
	    var totalItems = $('#carousel3  .carousel-item').length;
	    
	    if (idx >= totalItems-(itemsPerSlide-1)) {
	        var it = itemsPerSlide - (totalItems - idx);
	        for (var i=0; i<it; i++) {
	            // append slides to end
	            if (e.direction=="left") {
	                $('#carousel3 .carousel-item').eq(i).appendTo('#carousel3  .carousel-inner');
	            }
	            else {
	                $('#carousel3.carousel-item').eq(0).appendTo('#carousel3 .carousel-inner');
	            }
	        }
	    }
	});