<?php
function sys_fancy_table( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'headbgcolor'      => '',
    ), $atts));
	$content = str_replace('<table>', '<table class="fancy_table">', do_shortcode($content));
	return $content;
}
add_shortcode('fancy_table', 'sys_fancy_table');
