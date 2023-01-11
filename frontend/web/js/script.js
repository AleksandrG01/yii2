jQuery(document).ready(function($){
	var offset = $( ".header" ).offset();
	checkOffset();

	$(window).scroll(function() {
		checkOffset();
	});

	function checkOffset() {
		if ( $(document).scrollTop() > 50){
			$('.header').addClass('-scrolled');
			$('.main-title').addClass('-scrolled');
		} else {
			$('.header').removeClass('-scrolled');
			$('.main-title').removeClass('-scrolled');
		} 
	}

});