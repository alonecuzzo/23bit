<?php

/*
 * Template Name: Archives
 */

	// Header
	get_header();

	global $post;
    
    // get page/post options
    $page_sideabr_position = 'right';
    
    if( get_post_meta($post->ID, 'ln_meta_page_sidebar_position', true) ){
        $page_sideabr_position = get_post_meta($post->ID, 'ln_meta_page_sidebar_position', true);
    }

    $page_sidebar_name = get_post_meta($post->ID, 'ln_meta_page_sidebar', true);
?>

    <!-- Content -->
    <section class="content <?php echo $page_sideabr_position; ?>-sidebar">
    	
        <h2 class="page-title"><?php the_title(); ?></h2>
        
         <div class="ln-single-content">
            <?php the_content(); ?>
         </div>
        
        <!-- Archives -->
		<section class="ln-arvhices-list">

			<div class="section-head">
				<h3><?php _e('Recent Posts', 'framework'); ?></h3>
				<div class="section-line"></div>
			</div>

			<?php

				// Show 30 recent posts

	            wp_reset_query();

				query_posts( array('post_type' => 'post', 'posts_per_page' => 30) );
				
				while (have_posts()) : the_post();

				$format = get_post_format();

				if ($format === false){
					if( get_post_meta( get_the_ID(), 'ln_review_meta_use_as_review', true ) == 'on') {
						$format = "review";
					}
					else {
						$format = "standard";
					}
				}

        	?>
        	
			<!-- Entry -->
			<article class="ln-blog-post ln-archive-post">

				<header>
					<span class="format-icon <?php echo $format; ?>"></span>
					<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					<div class="clear"></div>
				</header>

			</article>
			
			<?php endwhile; ?>

			<div class="section-head">
				<h3><?php _e('Recent Reviews', 'framework'); ?></h3>
				<div class="section-line"></div>
			</div>

			<?php

				// Show recent review posts

	            wp_reset_query();

				query_posts( array('post_type' => 'post', 'posts_per_page' => 30) );
				
				while (have_posts()) : the_post();

        	?>
			<?php if( get_post_meta( get_the_ID(), 'ln_review_meta_use_as_review', true ) == 'on'): ?>
			
			<!-- Entry -->
			<article class="ln-blog-post ln-archive-post">

				<header>
					<span class="format-icon review"></span>
					<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					<div class="clear"></div>
				</header>

			</article>
			
			<?php endif; endwhile; ?>
		
			<div class="section-head">
				<h3><?php _e('Archives by Month', 'framework'); ?></h3>
				<div class="section-line"></div>
			</div>
			<ul>
 				<?php wp_get_archives('type=monthly');?>
			</ul>
			
			<div class="section-head">
				<h3><?php _e('Archives by Subject', 'framework');?></h3>
				<div class="section-line"></div>
			</div>
			<ul>
 				<?php wp_list_categories('title_li=');?>
			</ul>
				 
		</section>

    </section>

<?php 
    
    // get content sidebar (extensions.sidebars.php)
    ln_get_single_page_sidebar($page_sidebar_name);

    // sidebar
	get_sidebar();

	// Footer
	get_footer();

?>