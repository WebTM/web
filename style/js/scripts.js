/*-----------------------------------------------------------------------------------*/
/*	CUSTOM FUNCTIONS
/*-----------------------------------------------------------------------------------*/
(function(e){"use strict";e.fn.fitVids=function(t){var n={customSelector:null,ignore:null};if(!document.getElementById("fit-vids-style")){var r=document.head||document.getElementsByTagName("head")[0];var i=".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}";var s=document.createElement("div");s.innerHTML='<p>x</p><style id="fit-vids-style">'+i+"</style>";r.appendChild(s.childNodes[1])}if(t){e.extend(n,t)}return this.each(function(){var t=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com'][src*='video.html']","object","embed"];if(n.customSelector){t.push(n.customSelector)}var r=".fitvidsignore";if(n.ignore){r=r+", "+n.ignore}var i=e(this).find(t.join(","));i=i.not("object object");i=i.not(r);i.each(function(){var t=e(this);if(t.parents(r).length>0){return}if(this.tagName.toLowerCase()==="embed"&&t.parent("object").length||t.parent(".fluid-width-video-wrapper").length){return}if(!t.css("height")&&!t.css("width")&&(isNaN(t.attr("height"))||isNaN(t.attr("width")))){t.attr("height",9);t.attr("width",16)}var n=this.tagName.toLowerCase()==="object"||t.attr("height")&&!isNaN(parseInt(t.attr("height"),10))?parseInt(t.attr("height"),10):t.height(),i=!isNaN(parseInt(t.attr("width"),10))?parseInt(t.attr("width"),10):t.width(),s=n/i;if(!t.attr("id")){var o="fitvid"+Math.floor(Math.random()*999999);t.attr("id",o)}t.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",s*100+"%");t.removeAttr("height").removeAttr("width")})})}})(window.jQuery||window.Zepto);
function eborAlignVertical(){
	jQuery('.ebor-align-vertical').each(function(){
		var that = jQuery(this);
		var height = that.height();
		var parentHeight = that.parents('.row').height();
		var padAmount = (parentHeight / 2) - (height/2);
		that.css('padding-top', padAmount);
	});
}
function alignVertical(){
		jQuery('.align-vertical').each(function(){
			var that = jQuery(this);
			var height = that.height();
			var parentHeight = that.parent().height();
			var padAmount = (parentHeight / 2) - (height/2);
			that.css('padding-top', padAmount);
		});
}
function alignBottom(){
	jQuery('.align-bottom').each(function(){
		var that = jQuery(this);
		var height = that.height();
		var parentHeight = that.parent().height();
		var padAmount = (parentHeight) - (height) - 32;
		that.css('padding-top', padAmount);
	});
}
function handleTweets(tweets){
    var x = tweets.length,
    	  n = 0,
    	  element = document.getElementById('tweets'),
    	  html = '<ul class="slides">';
    	  
    while(n < x) {
      html += '<li>' + tweets[n] + '</li>';
      n++;
    }
    html += '</ul>';
    element.innerHTML = html;
    if(jQuery('#tweets').length){
    	setTimeout(function(){
    		jQuery('#tweets').flexslider({ directionNav: false, controlNav: false });
    	}, 100);
    }
}
jQuery.fn.setAllToMaxHeight = function(){
	return this.css({ 'height' : '' }).height( Math.max.apply(this, jQuery.map( this , function(e){ return jQuery(e).height() }) ) );
}
/*-----------------------------------------------------------------------------------*/
/*	NAV BASE LINK
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($) {

	jQuery('a.js-activated').not('a.js-activated[href^="#"]').click(function(){
		var url = $(this).attr('href');
		window.location.href = url;
		return true;
	});
		
});
/*-----------------------------------------------------------------------------------*/
/*	DOCUMENT READY JS
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function(){
	
	onYouTubeIframeAPIReady();
	
	jQuery('.post-password-form').addClass('photo-form-wrapper').find('label:has(input)').each(function(){
		var text = jQuery(this).text(),
			input = jQuery('input', this),
			parent = jQuery(this).parent();
		input.attr('placeholder', text);
		input.prependTo(parent);
		jQuery(this).remove();
	});
	
	/**
	 * Add lightbox to all linked images
	 */
	jQuery("a[href$='jpg'], a[href$='jpeg'], a[href$='gif'], a[href$='png']").each(function(){
		jQuery(this).addClass('lightbox-link-mrv').attr('data-lightbox', 'true');
	});
	
	/**
	 * Adjust header type if there isn't a page header set
	 */
	if(!( 
		jQuery('.main-container > .row > .aq-block').eq(0).hasClass('aq-block-aq_page_header_block') 
		|| jQuery('.main-container > .row > .aq-block').eq(0).hasClass('aq-block-aq_revslider_block') 
		|| jQuery('.main-container > .row > .aq-block').eq(0).hasClass('aq-block-aq_masterslider_block') 
		|| jQuery('.main-container > section').eq(0).hasClass('fullscreen-element') 
		|| jQuery('.main-container > section').eq(0).hasClass('hero-slider')
		|| jQuery('.main-container > header').eq(0).hasClass('title') 
		|| jQuery('.main-container > header').eq(0).hasClass('page-header') 
		|| jQuery('.main-container > .vc_row > .vc_column_container > .wpb_wrapper > div').eq(0).hasClass('aq-block-aq_page_header_block')
		|| jQuery('.main-container > .vc_row > .vc_column_container > .wpb_wrapper > div').eq(0).hasClass('avt_masterslider_el')
	)){
		jQuery('nav.top-bar').removeClass('overlay-bar');
	} else {
		if( 
			jQuery('.main-container > .row > .aq-block').eq(0).hasClass('aq-block-aq_revslider_block') 
			|| jQuery('.main-container > .row > .aq-block').eq(0).hasClass('aq-block-aq_masterslider_block') 
		){
			//nothing
		} else {
			var currentPad = parseInt(jQuery('.ebor-pad-me').eq(0).css('padding-top'));
			var newPad = currentPad + jQuery('.overlay-bar, .contained-bar').outerHeight() - 48;
			if(currentPad > 0){
				jQuery('.ebor-pad-me').eq(0).css('padding-top', newPad);
			} else if(jQuery('.ebor-pad-me').eq(0).hasClass('hero-slider')){
				var height = parseInt(jQuery('.hero-slider .slides li:first-child').outerHeight());
				var newHeight = height + jQuery('.overlay-bar, .contained-bar').outerHeight();
				jQuery('.hero-slider .slides li').css('height', newHeight);
			}
		}
	}
	
	/**
	 * Quick cleanup for mega menus
	 */
	jQuery('.subnav-fullwidth').unwrap().unwrap();
	
	/**
	 * Add arrows to the sidebar
	 */
	jQuery('.sidebar-widget ul li:not(:has(img)) > a').append('<i class="icon arrow_right"></i>');
	
	/**
	 * Fitvids
	 * This makes responsive iframes
	 */
	jQuery('.article-body iframe').wrap('<div class="fitvids" />');
	jQuery(".fitvids").fitVids();
	
	/**
	 * WP-Login.php stuff
	 */
	if( jQuery('body').hasClass('login') ){
		jQuery('#login-css').remove();
		jQuery('#buttons-css').remove();
		jQuery('label:has(input)').not(':has(input[type="checkbox"])').each(function(){
			var text = jQuery(this).text(),
				input = jQuery('input', this),
				parent = jQuery(this).parent();
			input.attr('placeholder', text);
			input.appendTo(parent);
			jQuery(this).remove();
		});
	}
	
	// Nav Sticky
	jQuery(window).scroll(function(){
		if( jQuery(window).scrollTop() > 500 && !jQuery('.mobile-toggle').is(":visible")){
			jQuery('.top-bar').addClass('nav-sticky');
		}else{
			jQuery('.top-bar').removeClass('nav-sticky');
		}
	});
	
	// Offscreen Nav
	jQuery('.offscreen-toggle').click(function(){
		jQuery('.main-container, .footer-container').toggleClass('reveal-nav');
		jQuery('.offscreen-container').toggleClass('reveal-nav');
		jQuery('.offscreen-menu .container').toggleClass('reveal-nav');
	});
	
	jQuery('.main-container').click(function(){
		if(jQuery(this).hasClass('reveal-nav')){
			jQuery('.main-container').toggleClass('reveal-nav');
			jQuery('.offscreen-container').toggleClass('reveal-nav');
			jQuery('.offscreen-menu .container').toggleClass('reveal-nav');
		}
	});
	
	jQuery('.offscreen-container .menu a').click(function(){
		jQuery('.offscreen-toggle').trigger('click');
	});
	
	// Detect logo dimensions and add correct class
	var logoImage = jQuery('.top-bar .logo:first-of-type');
	
	var theImage = new Image();
	theImage.src = logoImage.attr("src");
	
	var logoWidth = theImage.width;
	var logoHeight = theImage.height;
	var logoRatio = logoWidth / logoHeight;
	
	if(logoRatio > 2.8){
		jQuery('.top-bar .logo').addClass('logo-wide');
	}
	
	if(logoRatio < 2){
		jQuery('.top-bar .logo').addClass('logo-square');
	}
	


	
	// Mobile Toggle
	
	jQuery('.mobile-toggle').click(function(){
		jQuery('nav').toggleClass('open-nav');
	});
	
	// Fullscreen nav toggle
	
	jQuery('.fullscreen-nav-toggle').click(function(){
		if(!jQuery('.fullscreen-nav-container').hasClass('show-fullscreen-nav')){
			jQuery('.fullscreen-nav-container').addClass('show-fullscreen-nav');
			setTimeout(function(){
				jQuery('.fullscreen-nav-container').addClass('fade-fullscreen-nav');
			},100);
			jQuery(this).addClass('toggle-icon');
		}else{
			jQuery(this).removeClass('toggle-icon');
				jQuery('.fullscreen-nav-container').removeClass('fade-fullscreen-nav');
			setTimeout(function(){
				
				jQuery('.fullscreen-nav-container').removeClass('show-fullscreen-nav');
			},500);
		}
	});	
	
	jQuery('.fullscreen-nav-container .menu li a').click(function(){
		jQuery('.fullscreen-nav-toggle').removeClass('toggle-icon');
			jQuery('.fullscreen-nav-container').removeClass('fade-fullscreen-nav');
		setTimeout(function(){
			jQuery('.fullscreen-nav-container').removeClass('show-fullscreen-nav');
		},500);
	});
	
	/**
	 * Margin first section for top bar
	 */
	if(!( jQuery('nav').hasClass('overlay-bar') || jQuery('nav').hasClass('contained-bar') )){
		jQuery('.main-container').first().css('margin-top', jQuery('nav').outerHeight());
	}
	jQuery(window).resize(function(){
		if(!( jQuery('nav').hasClass('overlay-bar') || jQuery('nav').hasClass('contained-bar') )){
			jQuery('.main-container').first().css('margin-top', jQuery('nav').outerHeight());
		}
	});
	
	// Fullwidth Subnavs
	
	// Position Fullwidth Subnavs fullwidth correctly

    jQuery('.subnav-fullwidth').each(function () {
        jQuery(this).css('width', jQuery('.container').width());
        var offset = jQuery(this).closest('.has-dropdown').offset();
        offset = offset.left;
        var containerOffset = jQuery(window).width() - jQuery('.container').outerWidth();
        containerOffset = containerOffset /2;
        offset = offset - containerOffset - 15;
        jQuery(this).css('left', -offset);
    });

    jQuery(window).resize(function () {
        jQuery('.subnav-fullwidth').each(function () {
            jQuery(this).css('width', jQuery('.container').width());
			var offset = jQuery(this).closest('.has-dropdown').offset();
			offset = offset.left;
			var containerOffset = jQuery(window).width() - jQuery('.container').outerWidth();
			containerOffset = containerOffset /2;
			offset = offset - containerOffset - 15;
			jQuery(this).css('left', -offset);
        });
    });
	
	// Scroll Reveal
	
	if (!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
       window.scrollReveal = new scrollReveal();
    }else{
    	jQuery('body').addClass('pointer');
    }

	// Slider Initializations
	
	jQuery('.hero-slider').flexslider({});
	jQuery('.image-slider').flexslider({ animation: "slide"});
	jQuery('.testimonials-slider').flexslider({ directionNav: false });
	
	// Slide Sizes
	
	jQuery('.slider-fullscreen .slides li').each(function(){
		jQuery(this).css('height', jQuery(window).height());
	});
	
	jQuery('.fullscreen-element').each(function(){
		jQuery(this).css('height', jQuery(window).height());
	});


	// Feature Selector
	
	jQuery('.selector-tabs li').click(function(){
		jQuery(this).parent('.selector-tabs').children('li').removeClass('active');
		jQuery(this).addClass('active');
		
		var activeTab = jQuery(this).index() + 1;
		
		jQuery(this).closest('.feature-selector').find('.selector-content').children('li').removeClass('active');
		jQuery(this).closest('.feature-selector').find('.selector-content').children('li:nth-child('+activeTab+')').addClass('active');
	});
	
	// Append .background-image-holder <img>'s as CSS backgrounds
	
	jQuery('.background-image-holder').each(function(){
		var imgSrc= jQuery(this).children('img').attr('src');
		jQuery(this).css('background', 'url("' + imgSrc + '")');
    	jQuery(this).children('img').hide();
        jQuery(this).css('background-position', '50% 0%');
	});
	
	// Accordion
	jQuery('.accordion li').click(function(){
		jQuery(this).parent('.accordion').children('li').removeClass('active');
		jQuery(this).addClass('active');
	});
	
	jQuery('.expanding-ul li').click(function(){
		jQuery('.expanding-ul li').removeClass('active');
		jQuery(this).addClass('active');
	});
	
	/************** Parallax Scripts **************/

    var isFirefox = typeof InstallTrigger !== 'undefined';
    var isIE = /*@cc_on!@*/ false || !!document.documentMode;
    var isChrome = !!window.chrome;
    var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
    var prefix;

    if (isFirefox) {
        prefix = '-moz-';
    } else if (isIE) {

    } else if (isChrome || isSafari) {
        prefix = '-webkit-';
    }

    jQuery('.main-container section:first-child').addClass('first-child');

    jQuery('.parallax-background').each(function () {

        if (jQuery(this).closest('section').hasClass('first-child') && !jQuery(this).closest('section').hasClass('slider-fullscreen')) {
            jQuery(this).attr('data-top', prefix + 'transform: translate3d(0px,0px, 0px)');
            jQuery(this).attr('data-top-bottom', prefix + 'transform: translate3d(0px,200px, 0px)');

        } else {

            jQuery(this).attr('data-bottom-top', prefix + 'transform: translate3d(0px,-100px, 0px)');
            jQuery(this).attr('data-center', prefix + 'transform: translate3d(0px,0px, 0px)');
            jQuery(this).attr('data-top-bottom', prefix + 'transform: translate3d(0px,100px, 0px)');

        }

    });
    
    if (!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
        skrollr.init({
            forceHeight: false
        });
    }
    
    // Map Holder Overlay
	
	jQuery('.map-holder').click(function(){
		jQuery(this).addClass('on');
	});
	
	jQuery(window).scroll(function(){
		if(jQuery('.map-holder').hasClass('on')){
			jQuery('.map-holder').removeClass('on');
		}
	});
	
	// Map Details Holder
	
	jQuery('.details-holder').each(function(){
		jQuery(this).css('height', jQuery(this).width());
	});
	
	jQuery('.details-holder').mouseenter(function(){
		jQuery(this).closest('.map-overlay').addClass('fade-overlay');
	}).mouseleave(function(){jQuery(this).closest('.map-overlay').removeClass('fade-overlay');});;
	
	// Countdown
	jQuery('.countdown').each(function(){
		jQuery(this).countdown({until: new Date(jQuery(this).attr('data-date'))});
	});
	
	// Twitter Feed
	if(jQuery('#tweets').length){
		twitterFetcher.fetch(jQuery('#tweets').attr('data-widget-id'), '', 5, true, true, true, '', false, handleTweets);
	}

});
/*-----------------------------------------------------------------------------------*/
/*	WINDOW LOADED JS
/*-----------------------------------------------------------------------------------*/
jQuery(window).load(function(){
	
	eborAlignVertical();
	
	jQuery(window).resize(function(){
		jQuery('.feature-box').setAllToMaxHeight();
		eborAlignVertical();
	});
	
	jQuery('.feature-box').setAllToMaxHeight();
		
	// Align Elements Vertically
	alignVertical();
	alignBottom();
	
	jQuery(window).resize(function(){
		alignVertical();
		alignBottom();
	});
	
	/**
	 * Isotope Blog
	 */
	jQuery('.blog-masonry-container').isotope({
		itemSelector: '.blog-masonry-item',
		layoutMode: 'masonry'
	});
	
	// Isotope Projects
	
	jQuery('.projects-container').isotope({
	  itemSelector: '.project',
	  layoutMode: 'fitRows'
	});
	
	jQuery('.filters li').click(function() {
	  var current = jQuery(this);
	  
	  current.siblings('li').removeClass('active');
	  current.addClass('active');
	  
	  var filterValue = current.attr('data-filter');
	  var container = current.closest('.projects-wrapper').find('.projects-container');
	  container.isotope({ filter: filterValue });
	});
	
	// Isotope contained feature boxes
	
	jQuery('.contained-features-wrapper').isotope({
	  itemSelector: '.no-pad',
	  layoutMode: 'masonry',
	  masonry: {
		  gutter: 0
		}
	});
	
	// Instagram Feed
	
	if(jQuery('.instafeed').length){
		jQuery.fn.spectragram.accessData = {
			accessToken: '1406933036.fedaafa.feec3d50f5194ce5b705a1f11a107e0b',
			clientID: 'fedaafacf224447e8aef74872d3820a1'
		};
		jQuery('.instafeed').each(function () {
	        jQuery(this).children('ul').spectragram('getUserFeed', {
	            query: jQuery(this).attr('data-user-name')
	        });
	    });
	}
    
    /**
     * Remove Preloader
     */
    jQuery('.loader').css('opacity', 0);
    setTimeout(function(){
    	jQuery('.loader').hide();
    	/**
    	 * Trigger window resize to perfect Isotope
    	 */
    	jQuery('.filters li.active').trigger('click');
    	jQuery(window).trigger('resize');
    }, 600);
    
    /**
     * Masterslider stuff
     */
    jQuery('.ebor-parallax-background .ms-slide-bgcont').each(function(){
    	jQuery(this).css({
    		'background' : 'url("' + jQuery(this).children('img').attr('src') + '")',
    		'background-position' : '50% 0%',
    		'width' : '110%',
    		'height' : '110%'
    	}).addClass('ebor-background').children('img').hide();
    	jQuery(this).parents('.ebor-parallax-background').mousemove(function( event ) {
    		jQuery(this).find('.ebor-background').css('transform', 'translate(' + -event.pageX /18 + 'px,' + -event.pageY /18+ 'px)');
    	});
    });
    
    jQuery(window).trigger('resize');
    
});