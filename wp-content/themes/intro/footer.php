<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Intro
 * @since Intro 1.0
 */
?>

	<footer>
		<div class="holder">
			<div id="boxes">
				<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
				<div class="box">
					<?php 
						if ( ! dynamic_sidebar( sprintf( 'footer-%d', $i ) ) ) :
							the_widget( 
								'WP_Widget_Text', 
								array(
									'title' => __( 'Add Some Widgets', 'intro' ),
									'text'  => sprintf( __( 'Add some <a href="%s">widgets</a> to this theme!', 'intro' ), admin_url( 'widgets.php' ) )
								), 
								array(
									'before_widget' => '<div id="%1$s" class="%2$s">',
									'after_widget' => "</div>",
									'before_title' => '<h4 class="widget-title">',
									'after_title' => '</h4>'
								)
							);
						endif; 
					?>
				</div>
				<?php endfor; ?>
			</div>
			<div class="bottom">
				<a href="http://mintthemes.com"><img src="<?php echo get_template_directory_uri(); ?>/images/img01.png" alt="image" width="25" height="27" ></a>
				<p><?php printf( __( '&copy; %1$d %2$s. Powered by <a href="%3$s">WordPress</a> - Intro Theme by <a href="%4$s">Mint Themes</a>', 'intro' ), date( 'Y' ), get_bloginfo( 'name' ), esc_url( 'http://wordpress.org' ), esc_url( 'http://mintthemes.com' ) ); ?></p>
			</div>
		</div>
	</footer><!-- / footer -->

<?php wp_footer(); ?>
</body>
</html>