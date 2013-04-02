<?php

/*
 * Template Name: Category View
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
    $page_posts_category = get_post_meta($post->ID, 'ln_meta_catgory_page_select_category', true);
    $page_enable_pg = get_post_meta($post->ID, 'ln_meta_category_page_enable_pagination', true);
    $page_posts_num = get_post_meta($post->ID, 'ln_meta_category_page_numbef_of_posts', true); 

?>

    <!-- Content -->
    <section class="content <?php echo $page_sideabr_position; ?>-sidebar">
    	
        <h2 class="page-title"><?php the_title(); ?></h2>

        <?php

            // framework/extensions/extensions.blog.php
            ln_get_posts_form_category($page_posts_category, $page_posts_num, $page_enable_pg);

        ?>

    </section>

<?php 
    
    // get content sidebar (extensions.sidebars.php)
    ln_get_single_page_sidebar($page_sidebar_name);

    // sidebar
	get_sidebar();

	// Footer
	get_footer();

?>