<?php

/**

 * Makes a custom Widget for displaying recent projects/portfolio

 *

 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets

 *

 * @package Intro

 * @since Intro 1.0

 */

class Intro_Recent_Projects_Widget extends WP_Widget {



	/**

	 * Constructor

	 *

	 * @return void

	 **/

	function Intro_Recent_Projects_Widget () {

		$widget_ops = array( 

			'classname' => 'widget_intro_recent_projects', 

			'description' => __( 'Use this widget to list your recent projects/portfolio items.', 'intro' ) 

		);

		

		$this->WP_Widget( 'widget_intro_recent_projects', __( 'Intro Recent Projects', 'intro' ), $widget_ops );

		$this->alt_option_name = 'widget_intro_recent_projects';



		add_action( 'save_post', array(&$this, 'flush_widget_cache' ) );

		add_action( 'deleted_post', array(&$this, 'flush_widget_cache' ) );

		add_action( 'switch_theme', array(&$this, 'flush_widget_cache' ) );

	}



	/**

	 * Outputs the HTML for this widget.

	 *

	 * @param array An array of standard parameters for widgets in this theme

	 * @param array An array of settings for this widget instance

	 * @return void Echoes it's output

	 **/

	function widget( $args, $instance ) {

		$cache = wp_cache_get( 'widget_intro_recent_projects', 'widget' );



		if ( !is_array( $cache ) )

			$cache = array();



		if ( ! isset( $args['widget_id'] ) )

			$args['widget_id'] = null;



		if ( isset( $cache[$args['widget_id']] ) ) {

			echo $cache[$args['widget_id']];

			return;

		}



		ob_start();

		extract( $args, EXTR_SKIP );



		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Projects', 'intro' ) : $instance['title'], $instance, $this->id_base);



		if ( ! isset( $instance['number'] ) )

			$instance['number'] = '16';



		if ( ! $number = absint( $instance['number'] ) )

 			$number = 16;



		$recent_args = array(

			'order' => 'DESC',

			'posts_per_page' => $number,

			'no_found_rows' => true,

			'post_status' => 'publish',

			'post__not_in' => get_option( 'sticky_posts' ),

			'tax_query' => array(

				array(

					'taxonomy' => 'post_format',

					'terms' => array( 'post-format-gallery', 'post-format-video' ),

					'field' => 'slug',

					'operator' => 'IN',

				),

			),

		);

		$recent = new WP_Query( $recent_args );



		if ( $recent->have_posts() ) :

			echo $before_widget;

			echo $before_title;

			echo $title; // Can set this with a widget option, or omit altogether

			echo $after_title;

			?>

			<ul class="projects">

			<?php while ( $recent->have_posts() ) : $recent->the_post(); ?>

				<li><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'intro' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail( array( 36, 36 ) ); ?></a></li>

			<?php endwhile; ?>

			</ul>

			<?php



			echo $after_widget;



			// Reset the post globals as this query will have stomped on it

			wp_reset_postdata();



		// end check for recent posts

		endif;



		$cache[$args['widget_id']] = ob_get_flush();

		wp_cache_set( 'widget_intro_recent_projects', $cache, 'widget' );

	}



	/**

	 * Deals with the settings when they are saved by the admin. Here is

	 * where any validation should be dealt with.

	 **/

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['number'] = (int) $new_instance['number'];

		$this->flush_widget_cache();



		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset( $alloptions['widget_intro_recent_projects'] ) )

			delete_option( 'widget_intro_recent_projects' );



		return $instance;

	}



	function flush_widget_cache() {

		wp_cache_delete( 'widget_intro_recent_projects', 'widget' );

	}



	/**

	 * Displays the form for this widget on the Widgets page of the WP Admin area.

	 **/

	function form( $instance ) {

		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';

		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 16;

?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'intro' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>



			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'intro' ); ?></label>

			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

		<?php

	}

}