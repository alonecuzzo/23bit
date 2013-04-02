jQuery(document).ready(function($) {

	$(".fland-tabs").tabs({ fx: { opacity: 'show' } });
	
	$(".fland-toggle").each( function () {
		if($(this).attr('data-id') == 'closed') {
			$(this).accordion({ header: '.fland-toggle-title', collapsible: true, active: false  });
		} else {
			$(this).accordion({ header: '.fland-toggle-title', collapsible: true});
		}
	});
	
	
});