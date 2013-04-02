<?php
$content=get_option('versatile_content');
$content = stripslashes($content); 
$content = do_shortcode($content); 
$content = apply_filters('the_content', $content);
echo $content;
?>