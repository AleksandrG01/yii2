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

	$('.--js-body-subjects').on('click', '.--js-open-close-form', function () {

		event.preventDefault();
		$('.success-add-subject').remove();
		$( '.--js-subject-form' ).toggleClass( "-active" ); 
		$( '.--js-section-subjects' ).toggleClass( "-active" );

	});

	$('.--js-body-subjects').on('click', '.--js-sorting-open-close', function () {

		$( '.--js-sorting-open-close' ).toggleClass( "active" );
		$( '.--js-subject-sorting-list' ).toggle();

	});

});