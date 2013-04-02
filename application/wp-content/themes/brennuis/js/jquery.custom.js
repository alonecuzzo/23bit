/**
 * Brennuis Carousel
 * http://themeforest.net/user/Lion
 * 
 * version 1.0
 * 2012
 */
 (function($) {
	$.fn.smallPostsCarousel = function(options) {

		var defaults = {btnPrev: null, btnNext: null, visible: 3, moveBy: 1};
    	
    	var settings = $.extend(defaults, options);
    	var target = $(this).find('ul');
    	var index = 0;
    	var numberOfItems = target.find('li').size();
    	var visible = settings.visible;
    	var btnNext = $(settings.btnNext);
		var btnPrev = $(settings.btnPrev);
		var moveBy = settings.moveBy;
		var margin = 20; // item margin 
		var itemWidth = target.find('li:first-child').width()+margin;
		var moveX = 0;
		var minX = 0;
		var maxX = -(numberOfItems-visible)*itemWidth;
		var canClick = true;
		var prefix;
		var useCSS3 = false;
		
		// bind prev next click
		if(btnPrev != null){
			btnPrev.click(function(){ move('prev'); });
		}

		if(btnNext != null){
			btnNext.click(function(){ move('next'); });
		}
		
		// test browser support for CSS3
		function testBrowserSupport(){

			var obj = document.createElement('div'), props = ['perspectiveProperty', 'WebkitPerspective', 'MozPerspective', 'OPerspective', 'msPerspective'];
		          
		    for (var i in props) {
		            
		        if (obj.style[ props[i] ] !== undefined) {
		        	prefix = props[i].replace('Perspective','').toLowerCase();
		        }
		    }

		    if(prefix != undefined){
		    	useCSS3 = true;
		    }

		}testBrowserSupport();

		// move carusel items
		function move(direction){

			itemWidth = target.find('li:first-child').width()+margin;
			visible = Math.floor(target.parent().width()/itemWidth); 
			maxX = -(numberOfItems-visible)*itemWidth;

			if(canClick){
				
				canClick = false;
			
				if(direction === 'next'){

					moveX -= (itemWidth*moveBy);
					
					if(moveX < maxX){
						moveX = 0;
					}

				}else{
					
					moveX += (itemWidth*moveBy);

					if(moveX > 0){
						moveX = maxX;
					}
				}

				if(!useCSS3){
						
					target.stop(true, true).animate({'left' : moveX}, 400, 'easeOutQuad', function(){ canClick = true; });
					
				}else{
						
					target.css( ('-'+prefix+'-transform'), 'translate3d('+moveX+'px, 0, 0)' );
					canClick = true;
				}
			}

		}

}})(jQuery);

/********************************************
 * Custom jQuery
 ********************************************/
jQuery(document).ready(function($){

	/********************************************
	 *  Menu animation (superfish : http://users.tpg.com.au/j_birch/plugins/superfish/)
	 ********************************************/
	$('#main-nav-wrapper ul, #top-nav ul').superfish({
		delay: 200,
		animation: {opacity:'show'},
		speed: 200,
		autoArrows: false,
		dropShadows: false
	});

	// responsive menu
	$('.responsive-menu').each(function(){
		$(this).change(function(){

			var url = $(this).find('option:selected').attr('value');

			if(url != '#' && url != ''){
				window.location.href = url;
			}
			
		});
	});	

	// full background img 
	var bigBgSrc = $('#backstretch').attr('data-img');
	
	// http://srobbin.com/jquery-plugins/backstretch/	
	if(bigBgSrc != undefined){
		$.backstretch(bigBgSrc, {speed: 0});
	}

	// post img hover
	$('.post-img').hover(function(){
		$(this).find(".img-hover").stop(true, true).css('display', 'block').animate({opacity: '0.8'}, 200);
	},
	function(){
		$(this).find(".img-hover").stop(true, true).animate({opacity: '0'}, 200);
	});

	// Carousel Module
	$('.ln-carousel').each(function(){
		$(this).smallPostsCarousel({
			btnPrev : $(this).find('.prev'), 
			btnNext : $(this).find('.next') 
		});
	});

	/********************************************
	 *  Toggle
	 ********************************************/
	$('.toggle').each(function(){
		 
		 var content = $(this).find('.toggle-content');
		 var state = content.attr('data-show');
		 var disable = 0;
		 
		 if(state == 'false'){
			 disable = false;
	 	 }
		 
		 $(this).accordion({
				collapsible: true,
				active: disable
		 });
		 
	});

	/********************************************
	 *  Tabs
	 ********************************************/
	$('.ln-tabs-wg, .tabs').each(function(){
		$(this).tabs(); 
	}); 

	/********************************************
	 *  Validate Forms
	 ********************************************/
	if($.fn.validate){
	 	$("#contact-form").validate();
	 	$("#commentform").validate();
	}

}); 