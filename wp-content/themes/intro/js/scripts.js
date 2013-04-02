jQuery(document).ready(function($){
	jQuery.fn.exists = function () { return jQuery(this).length > 0; }
	WebFontConfig = {
		google: { families: [ 'Droid+Serif:400,400italic,700,700italic' , 'Bree+Serif', 'Yellowtail' ] },
		loading: function() {
			jQuery.fn.exists = function(){return this.length>0;}
			if ($('.slideshow').exists()) {
				$('.slideshow').flexslider({
					animation: "slide",
					selector: '.gallery > li',
					slideshowSpeed: 5000,
					animationSpeed: 500,
					directionNav: false
				});
			}
			if ($('#video').exists()) {
				$("#video").fitVids();
			}
			// Slide effect
			if ($('.slide-block').exists()) {
			    var _parentSlide = 'div.slide-block';
			    var _linkSlide = 'a.open-close';
			    var _slideBlock = '.slide';
			    var _openClassS = 'active';
			    var _durationSlide = 500;
			    
			    $(_parentSlide).each(function(){
					if (!$(this).is('.'+_openClassS)) {
						$(this).find(_slideBlock).css('display','none');
					}
			    });
			    $(_linkSlide,_parentSlide).click(function(){
					if ($(this).parents(_parentSlide).is('.'+_openClassS)) {
						$(this).parents(_parentSlide).removeClass(_openClassS);
						$(this).parents(_parentSlide).find(_slideBlock).slideUp(_durationSlide);
					} else {
						$(this).parents(_parentSlide).addClass(_openClassS);
						$(this).parents(_parentSlide).find(_slideBlock).slideDown(_durationSlide);
					}
					return false;
			    });
			}
			$( 'blockquote' ).each(function() {
				$( this )
					.children( 'p' )
					.contents()
					.unwrap();
					
				$( this )
					.append( '<span class="quote">&#8221;</span>' )
					.wrapInner( '<q></q>' )
					.prepend( '<span class="quote">&#8220;</span>' )
			});
			
			$( '.mobile-menu select' )
				.prepend( '<option selected="selected">Select Page</option>' );
				
			$( '.mobile-menu select' ).change(function() {
				selected =  $( this ).find( 'option:selected' ).val();
				
				if ( '' != selected )
					window.location = selected;
			});
			$( '.holder.view-site a' ).each(function() {
				$( this )
					.addClass( 'btn01' )
					.wrapInner( '<span></span>' );
			});
		}
	};
	(function() {
	var wf = document.createElement('script');
		wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
			'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wf, s);
	})(); 
});

(function($){
   $(window).load(function(){
	if ($('footer #boxes').exists()) {
		$('footer #boxes').isotope({
			itemSelector: '.box',
			layoutMode : 'fitRows'
		});
	}
	if ($('.info .list').exists()) {
		$('.info .list').isotope({
			itemSelector: '.info .list li',
			layoutMode : 'fitRows'
		});
	}
	if ($('#filtered').exists()) {
		var $container = $('#filtered');
		// initialize isotope
		$container.isotope({layoutMode : 'fitRows'});
		
		// filter items when filter link is clicked
		$('#filters a').click(function(){
			$('#filters a').removeClass('selected');
			$(this).addClass('selected');
			var selector = $(this).attr('data-filter');
			$container.isotope({ filter: selector });
			return false;
		});
	}
	if ($('.single-portfolio .list').exists()) {
		$('.single-portfolio .list').isotope({
			itemSelector: '.single-portfolio .list li',
			layoutMode : 'fitRows'
		});
	}
 })
})(jQuery);