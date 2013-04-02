<?php  
/**
 * Post Format : Gallery
 */

// get attachments
$att_args = array(
	'orderby'		 => 'menu_order',
	'post_type'      => 'attachment',
	'post_parent'    => get_the_ID(),
	'post_mime_type' => 'image',
	'post_status'    => null,
	'numberposts'    => -1,
);

$attachments = get_posts($att_args);
$slides = '';

if(!empty($attachments)){
	
	foreach($attachments as $att){
		
		$has_link = false;
		$small_src = wp_get_attachment_image_src($att->ID, 'small-article-crop', true); 
		$big_src = wp_get_attachment_image_src($att->ID, 'post-featured-img', true); 
		$slide_link = esc_attr( get_post_meta($att->ID, 'ln_media_slider_slide_link', true) );
		$slide_caption = esc_attr( get_post_meta($att->ID, 'ln_media_slider_slide_caption', true) );
		$slide_title = esc_attr( get_post_meta($att->ID, 'ln_media_slider_slide_title', true) );

		$slides .= '<li data-small="'.$small_src[0].'">';
					
		// slide link
		if(isset($slide_link) && $slide_link != ''){
			$has_link = true;
			$slides.= '<a class="no-eff" href="'.$slide_link.'" >';
		}

		// slide img
		$slides .=	'<img src="'.$big_src[0].'" alt="'.apply_filters('the_title', $att->post_title).'"/>';
		
		// slider caption
		if($slide_title != '' || $slide_caption != ''){
		
			$slides .= '<section class="flex-caption">';

			if($slide_title != ''){
				$slides .= '<h3>'.$slide_title.'</h3><div class="separator"></div>';
			}

			if($slide_caption != ''){
				$slides .= '<p>'.$slide_caption.'</p>';
			}

			$slides .= '</section>';
		}
		
		// close <a>
		if($has_link){
			$slides .= '</a>';
		}

		// close slide				
		$slides .= '</li>';

	}
}

?>

<?php if(! is_singular()): ?>

	<article class="ln-blog-post">

		<header>
			<span class="format-icon gallery"></span>
			<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="clear"></div>
		</header>

		<div class="ln-gallery-post flexslider ln-col-full">
			<ul class="slides">
			<?php echo $slides; ?>
			</ul>
		</div>
		<div class="clear"></div>
		
		<div class="ln-col-full excerpt excerpt-offset">
			<?php the_excerpt(); ?>
		</div>
		
	<?php get_template_part('framework/post-formats/small-footer'); ?>

<?php else: ?>

	<div class="ln-gallery-post flexslider ln-col-full">
		<ul class="slides">
			<?php echo $slides; ?>
		</ul>
	</div>
	<div class="clear"></div>

<?php endif; ?>