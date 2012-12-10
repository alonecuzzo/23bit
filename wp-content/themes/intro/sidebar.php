<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Intro
 * @since Intro 1.0
 */
?>
		<aside>
			<?php do_action( 'before_sidebar' ); ?>
			
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
			
				<?php
					the_widget( 
						'WP_Widget_Text', 
						array(
							'title' => __( 'Add Some Widgets', 'intro' ),
							'text'  => sprintf( __( 'Add some <a href="%s">widgets</a> to this theme!', 'intro' ), admin_url( 'widgets.php' ) )
						), 
						array(
							'before_widget' => '<div id="%1$s" class="box isotope-item %2$s">',
							'after_widget' => "</div>",
							'before_title' => '<h4 class="widget-title">',
							'after_title' => '</h4>'
						)
					);
				?>
				
			<?php endif; ?>
			
		</aside><!-- / aside -->