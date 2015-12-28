jQuery(document).ready(function($) {

	jQuery('a.js-activated').not('a.js-activated[href^="#"]').click(function(){
		var url = $(this).attr('href');
		window.location.href = url;
		return true;
	});
		
});

	jQuery(document).ready(function(){

	// Offscreen Nav
	
	jQuery('.offscreen-toggle').click(function(){
		jQuery('.container').toggleClass('reveal-nav');
		jQuery('.main-container').toggleClass('reveal-nav');
		jQuery('.offscreen-container').toggleClass('reveal-nav');
		jQuery('.offscreen-menu .main-container').toggleClass('reveal-nav');
	});
	
	jQuery('.main-container').click(function(){
		if(jQuery(this).hasClass('reveal-nav')){
			jQuery('.main-container').toggleClass('reveal-nav');
			jQuery('.offscreen-container').toggleClass('reveal-nav');
			jQuery('.offscreen-menu .container').toggleClass('reveal-nav');
		}
	});

});