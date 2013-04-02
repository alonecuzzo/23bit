<?php

/*
 * Template Name: Fullwidth
 */
	// Header
	get_header();

	// get page/post options
    $page_sideabr_position = 'no'; // no-sidebar
    
    // THE LOOP
    if(have_posts()) : while(have_posts()) : the_post();
?>

    <!-- Content -->
    <section class="content <?php echo $page_sideabr_position; ?>-sidebar">
    	
        <h2 class="page-title"><?php the_title(); ?></h2>

        <div class="ln-single-content">
            <?php the_content(); ?>
        </div>
        
        <?php endwhile; endif;  // END LOOP ?>

    </section>

<?php 
    
    // sidebar
	get_sidebar();

	// Footer
	get_footer();

?>