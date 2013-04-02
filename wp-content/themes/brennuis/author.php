<?php
	
	// Header
	get_header();

	global $post;
    
    // get page/post options
    $page_sideabr_position = get_option('ln_blog_sidebar_position');

    $author_bio = get_the_author_meta('description');
    $author_avatar = get_avatar( get_the_author_meta('email'), '50');
?>
	<!-- Content -->
    <section class="content <?php echo $page_sideabr_position;?>-sidebar">
    	
    	<aside class="ln-post-author ln-col-full">
            <div class="section-head">
                <h3><?php the_author(); ?></h3>
                <div class="section-line"></div>
            </div>
            <div class="clear"></div>

            <div class="ln-author-avatar">
                <?php echo $author_avatar;?>
            </div>
            <div class="ln-author-bio">
                <p><?php echo $author_bio; ?></p>
            </div>
            <div class="clear"></div>
        </aside>

        <!-- Social Share -->
        <section class="ln-author-social ln-col-full">
            <ul>
                <?php ln_get_author_social_icons(); // extensions.author.php ?>
            </ul>
        </section>

        <!-- Archives -->
        <section class="ln-arvhices-list">

            <div class="section-head">
                <h3><?php _e('Recent Posts', 'framework'); ?></h3>
                <div class="section-line"></div>
            </div>

            <?php

                // Show 30 recent posts

                wp_reset_query();

                query_posts( array('post_type' => 'post', 'author' => get_the_author_meta('ID'), 'posts_per_page' => 30) );
                
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

        </section>

    </section>


<?php
	
	// get content sidebar (extensions.sidebars.php)
    ln_get_single_page_sidebar('default');
	
	// Sidebar
	get_sidebar();
	
	// Footer
	get_footer();
?>