<?php

/*
 * Template Name: Magazine (Page Builder)
 */

	require_once ( INC_PATH . '/page-builder/PageBuilder.php' );

	// Header
	get_header();

	global $post;
	$has_modules = false;

    // get page/post options
    $page_sideabr_position = 'right';
    
    if( get_post_meta($post->ID, 'ln_meta_page_sidebar_position', true) ){
        $page_sideabr_position = get_post_meta($post->ID, 'ln_meta_page_sidebar_position', true);
    }
    
    $page_sidebar_name = get_post_meta($post->ID, 'ln_meta_page_sidebar', true);

    // get page builder data
    $builder_data = get_post_meta($post->ID, PageBuilder::PAGE_BUILDER_META_ID, true);
    $layout = new PageBuilder($builder_data, $post->ID);
    
    if(isset($builder_data) && !empty($builder_data)){
        $has_modules = true;
    }
    
   
?>

    <!-- Content -->
    <section class="content <?php echo $page_sideabr_position; ?>-sidebar">
    	
    	<?php 

            // if page has module show them
            if($has_modules){
                
                // output modules
                echo $layout->output_layout_view();

            }else{ // else show page content
                
                wp_reset_query();

                if(have_posts()){
                	while(have_posts()){
                		the_post();
                    
                ?>
                    <h2 class="page-title"><?php echo the_title(); ?></h1>
                    <?php the_content(); ?>
                    
                <?php
                
                	}// end while
            	
            	}// end if
            }

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