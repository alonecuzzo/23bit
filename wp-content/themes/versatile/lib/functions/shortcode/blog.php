<?php
// Blog page short code
function sys_blog ($atts, $content = null) {
	extract(shortcode_atts(array(
	    'cat'      => '2',
        'limits'      =>'5',
        'image'      =>'true',
         'pagination'      =>'true',
        
    ), $atts));
ob_start();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts("cat=$cat&posts_per_page=$limits&paged=$paged");

if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
	<div class="blogpost">
			<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to','versatile_front'), the_title_attribute() ); ?>"><?php the_title(); ?></a></h2>
	<?php
	if ($image =="true"){ 
		if (has_post_thumbnail()) {
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', true); ?>	
				<div class="portimg" style="width:604px;"><div class="porthumb">
				<a rel="prettyPhoto" href="<?php echo $image['0']; ?>">
<?php $timthumboption=get_option('timthumboption'); if($timthumboption == "enable") { ?><img src="<?php bloginfo( 'template_directory' ); ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;w=600&amp;h=200&amp;zc=1&amp;q=100" alt="" class="image" /><?php }else{ the_post_thumbnail('post_blog');  } ?></a>
				
				</div></div>
				<?php } } ?>
				<div class="post-info">
				<span><?php the_time('F, jS, Y') ?></span>
				<span><?php _e('Posted in','versatile_front');?>  : <?php the_category(', ') ?> </span>
				<span><?php _e('By','versatile_front');?>  : <?php the_author_posts_link(); ?> </span>
				<span><a href="<?php the_permalink(); ?>#comments" title="<?php _e('View Comments','versatile_front');?> "><?php comments_number(0, 1, '%'); ?> <?php _e('Comments','versatile_front');?> </a></span>
				<?php the_tags(); ?>
				</div>	
	
<?php global $more; $more = 0;  the_excerpt(''); ?>	
	 			<a href="<?php the_permalink() ?>" class="more-link"><span><?php _e('Continue Reading &rarr;','versatile_front');?></span></a>
			</div>	
<?php endwhile; ?>
<?php if( $pagination == "true") { 
 if(function_exists('atp_pagination')) { atp_pagination(); } 
}
	endif;
	$out = ob_get_contents();
	ob_end_clean();
 wp_reset_query();
	return $out;
}
add_shortcode('blog','sys_blog');
?>