<?php
/**
 * Intro Theme Options
 *
 * @package Intro
 * @since Intro 1.0
 */

/**
 * Register the form setting for our intro_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, intro_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since Intro 1.0
 */
function intro_theme_options_init() {
	register_setting(
		'intro_options',
		'intro_options',
		'intro_theme_options_validate'
	);
	
	add_settings_section(
		'slider',
		__( 'Slider Settings', 'intro' ),
		'__return_false',
		'intro_options'
	);

	add_settings_field(
		'featured_category',
		__( 'Featured Project Category', 'intro' ), 
		'intro_settings_field_select',
		'intro_options',
		'slider',
		array(
			'name'        => 'featured_category',
			'value'       => intro_get_theme_option( 'featured_category' ),
			'options'     => intro_get_categories(),
			'description' => __( 'Posts in this portfolio category will be used on the homepage&#39;s slider.', 'intro' )
		)
	);
	
	add_settings_field(
		'featured_show_titles',
		__( 'Show Featured Titles', 'intro' ), 
		'intro_settings_field_checkbox_single',
		'intro_options',
		'slider',
		array(
			'name'        => 'featured_show_titles',
			'value'       => intro_get_theme_option( 'featured_show_titles' ),
			'description' => __( 'Display the title overlay on the featured post slider.', 'intro' )
		)
	);
	
	add_settings_field(
		'portfolio_show_titles',
		__( 'Show Portfolio Titles', 'intro' ), 
		'intro_settings_field_checkbox_single',
		'intro_options',
		'slider',
		array(
			'name'        => 'portfolio_show_titles',
			'value'       => intro_get_theme_option( 'portfolio_show_titles' ),
			'description' => __( 'Display the title overlay on portfolio galleries.', 'intro' )
		)
	);
	
	add_settings_section(
		'homepage',
		__( 'Homepage Settings', 'intro' ),
		'__return_false',
		'intro_options'
	);
	
	add_settings_field(
		'news_description',
		__( 'Latest News Description', 'intro' ), 
		'intro_settings_field_textarea',
		'intro_options',
		'homepage',
		array(
			'name'        => 'news_description',
			'value'       => intro_get_theme_option( 'news_description' ),
			'description' => __( 'A short blurb to be displayed under the "Latest News" section title.', 'intro' )
		)
	);
	
	add_settings_field(
		'project_description',
		__( 'Latest Projects Description', 'intro' ), 
		'intro_settings_field_textarea',
		'intro_options',
		'homepage',
		array(
			'name'        => 'project_description',
			'value'       => intro_get_theme_option( 'project_description' ),
			'description' => __( 'A short blurb to be displayed under the "Our Latest Projects" section title.', 'intro' )
		)
	);
}
add_action( 'admin_init', 'intro_theme_options_init' );

/**
 * Change the capability required to save the 'intro_options' options group.
 *
 * @see intro_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see intro_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function intro_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_intro_options', 'intro_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Intro 1.0
 */
function intro_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'intro' ),
		__( 'Theme Options', 'intro' ),
		'edit_theme_options',
		'intro_options',
		'intro_theme_options_render_page'
	);
}
add_action( 'admin_menu', 'intro_theme_options_add_page' );

/**
 * Returns the options array for Intro.
 *
 * @since Intro 1.0
 */
function intro_get_theme_options() {
	$saved = (array) get_option( 'intro_options' );
	
	$defaults = array(
		'featured_category'     => '',
		'featured_show_titles'  => 'on',
		'portfolio_show_titles' => 'on',
		'news_description'      => '',
		'project_description'   => ''
	);

	$defaults = apply_filters( 'intro_default_theme_options', $defaults );

	$options = wp_parse_args( $saved, $defaults );
	$options = array_intersect_key( $options, $defaults );

	return $options;
}

/**
 * Get a single theme option
 *
 * @since Intro 1.0
 */
function intro_get_theme_option( $key ) {
	$options = intro_get_theme_options();
	
	if ( isset( $options[ $key ] ) )
		return $options[ $key ];
		
	return false;
}

/**
 * Renders the Theme Options administration screen.
 *
 * @since Intro 1.0
 */
function intro_theme_options_render_page() {
	$theme = wp_get_theme();
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'intro' ), $theme->Name ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'intro_options' );
				do_settings_sections( 'intro_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see intro_theme_options_init()
 * @todo set up Reset Options action
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since Intro 1.0
 */
function intro_theme_options_validate( $input ) {
	$output = array();
	
	if ( $input[ 'featured_category' ] == 0 || array_key_exists( $input[ 'featured_category' ], intro_get_categories() ) )
		$output[ 'featured_category' ] = $input[ 'featured_category' ];

	if ( isset( $input[ 'featured_show_titles' ] ) )
		$output[ 'featured_show_titles' ] = 'on';
	else
		$output[ 'featured_show_titles' ] = '';
		
	if ( isset( $input[ 'portfolio_show_titles' ] ) )
		$output[ 'portfolio_show_titles' ] = 'on';
	else
		$output[ 'portfolio_show_titles' ] = '';
		
	if ( isset ( $input[ 'news_description' ] ) )
		$output[ 'news_description' ] = esc_attr( $input[ 'news_description' ] );
		
	if ( isset ( $input[ 'project_description' ] ) )
		$output[ 'project_description' ] = esc_attr( $input[ 'project_description' ] );
		
	$output = wp_parse_args( $output, intro_get_theme_options() );	
		
	return apply_filters( 'intro_theme_options_validate', $output, $input );
}

/* Fields ***************************************************************/
 
/**
 * Number Field
 *
 * @since Intro 1.0
 */
function intro_settings_field_number( $args = array() ) {
	$defaults = array(
		'menu'        => '', 
		'min'         => 1,
		'max'         => 100,
		'step'        => 1,
		'name'        => '',
		'value'       => '',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'intro_options[%s]', $name ) );
?>
	<label for="<?php echo esc_attr( $id ); ?>">
		<input type="number" min="<?php echo absint( $min ); ?>" max="<?php echo absint( $max ); ?>" step="<?php echo absint( $step ); ?>" name="<?php echo $name; ?>" id="<?php echo $id ?>" value="<?php echo esc_attr( $value ); ?>" />
		<?php echo $description; ?>
	</label>
<?php
} 

/**
 * Textarea Field
 *
 * @since Intro 1.0
 */
function intro_settings_field_textarea( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'intro_options[%s]', $name ) );
?>
	<label for="<?php echo $id; ?>">
		<textarea name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="code large-text" rows="3" cols="30"><?php echo esc_textarea( $value ); ?></textarea>
		<br />
		<?php echo $description; ?>
	</label>
<?php
} 

/**
 * Single Checkbox Field
 *
 * @since Intro 1.0
 */
function intro_settings_field_checkbox_single( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'compare'     => 'on',
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'intro_options[%s]', $name ) );
?>
	<label for="<?php echo esc_attr( $id ); ?>">
		<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo esc_attr( $value ); ?>" <?php checked( $compare, $value ); ?>>
		<?php echo $description; ?>
	</label>
<?php
} 

/**
 * Radio Field
 *
 * @since Intro 1.0
 */
function intro_settings_field_radio( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'options'     => array(),
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'intro_options[%s]', $name ) );
?>
	<?php foreach ( $options as $option_id => $option_label ) : ?>
	<label title="<?php echo esc_attr( $option_label ); ?>">
		<input type="radio" name="<?php echo $name; ?>" value="<?php echo $option_id; ?>" <?php checked( $option_id, $value ); ?>>
		<?php echo esc_attr( $option_label ); ?>
	</label>
		<br />
	<?php endforeach; ?>
<?php
}

/**
 * Select Field
 *
 * @since Intro 1.0
 */
function intro_settings_field_select( $args = array() ) {
	$defaults = array(
		'name'        => '',
		'value'       => '',
		'options'     => array(),
		'description' => ''
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	$id   = esc_attr( $name );
	$name = esc_attr( sprintf( 'intro_options[%s]', $name ) );
?>
	<label for="<?php echo $id; ?>">
		<select name="<?php echo $name; ?>">
			<?php foreach ( $options as $option_id => $option_label ) : ?>
			<option value="<?php echo esc_attr( $option_id ); ?>" <?php selected( $option_id, $value ); ?>>
				<?php echo esc_attr( $option_label ); ?>
			</option>
			<?php endforeach; ?>
		</select>
		<?php echo $description; ?>
	</label>
<?php
}

/* Helpers ***************************************************************/

function intro_get_categories() {
	$output = array();
	$terms  = get_terms( array( 'portfolio_category' ), array( 'hide_empty' => 0 ) );
	
	foreach ( $terms as $term ) {
		$output[ $term->term_id ] = $term->name;
	}
	
	return $output;
}