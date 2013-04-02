<?php
function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'my_formatter', 99);
add_filter('widget_text', 'my_formatter', 99);
require_once(sys_functions."/shortcode/buttons.php");
require_once(sys_functions."/shortcode/boxes.php");
require_once(sys_functions."/shortcode/messageboxes.php");
require_once(sys_functions."/shortcode/tabstoggles.php");
require_once(sys_functions."/shortcode/general.php");
require_once(sys_functions."/shortcode/blog.php");
require_once(sys_functions."/shortcode/image_gallery.php");
require_once(sys_functions."/shortcode/videos.php");
require_once(sys_functions."/shortcode/related.php");
require_once(sys_functions."/shortcode/recent.php");
require_once(sys_functions."/shortcode/popular.php");
require_once(sys_functions."/shortcode/contactinfo.php");
require_once(sys_functions."/shortcode/contactform.php");
require_once(sys_functions."/shortcode/flickr.php");
require_once(sys_functions."/shortcode/twitter.php");
require_once(sys_functions."/shortcode/layout.php");
require_once(sys_functions."/shortcode/portfolio.php");
require_once(sys_functions."/shortcode/short_codegmap.php");
?>