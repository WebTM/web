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

	 
    /**
	 * Adjust header type if there isn't a page header set
	 */
    if (!(
    jQuery('.main-container > .row > .aq-block').eq(0).hasClass('aq-block-aq_page_header_block') 
    || jQuery('.main-container > .row > .aq-block').eq(0).hasClass('aq-block-aq_revslider_block') 
    || jQuery('.main-container > .row > .aq-block').eq(0).hasClass('aq-block-aq_masterslider_block') 
    || jQuery('.main-container > section').eq(0).hasClass('fullscreen-element') 
    || jQuery('.main-container > section').eq(0).hasClass('hero-slider') 
    || jQuery('.main-container > header').eq(0).hasClass('title') 
    || jQuery('.main-container > header').eq(0).hasClass('page-header') 
    || jQuery('.main-container > .vc_row > .vc_column_container > .wpb_wrapper > div').eq(0).hasClass('aq-block-aq_page_header_block') 
    || jQuery('.main-container > .vc_row > .vc_column_container > .wpb_wrapper > div').eq(0).hasClass('avt_masterslider_el') 
    || jQuery('.main-container > .vc_row > .vc_column_container > .wpb_wrapper > div').eq(0).hasClass('wpb_revslider_element')
    )) {
        jQuery('nav.top-bar').removeClass('overlay-bar');
    } else {
        if (
        jQuery('.main-container > .row > .aq-block').eq(0).hasClass('aq-block-aq_revslider_block') 
        || jQuery('.main-container > .row > .aq-block').eq(0).hasClass('aq-block-aq_masterslider_block')
        ) {
        //nothing
        } else {
            var currentPad = parseInt(jQuery('.ebor-pad-me').eq(0).css('padding-top'));
            var newPad = currentPad + jQuery('.overlay-bar, .contained-bar').outerHeight() - 48;
            if (currentPad > 0) {
                jQuery('.ebor-pad-me').eq(0).css('padding-top', newPad);
            } else if (jQuery('.ebor-pad-me').eq(0).hasClass('hero-slider')) {
                var height = parseInt(jQuery('.hero-slider .slides li:first-child').outerHeight());
                var newHeight = height + jQuery('.overlay-bar, .contained-bar').outerHeight();
                jQuery('.hero-slider .slides li').css('height', newHeight);
            }
        }
    }