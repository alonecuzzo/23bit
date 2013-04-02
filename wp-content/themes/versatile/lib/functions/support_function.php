<?php
$theme_data =get_theme_data(TEMPLATEPATH . '/style.css');

$sys_version= $theme_data['Version'];
$wp_version=get_bloginfo('version');

/*---------------------------------*/
// MENU WP3.0 VERSION SUPPORT  
/*---------------------------------*/
if($wp_version >= 3.0){
	add_action( 'init', 'register_my_menus' );
	function register_my_menus() {
	register_nav_menus(
		array(
			'top-menu' => __( '<p>Top Menu <br><small>This will appear on top beside Logo</small></p>' )
			)
		);
	}
	
/*---------------------------------*/
//THEME AUTOMATIC FEED LINK FUNCTION
/*---------------------------------*/
add_theme_support('automatic-feed-links');
	
}

	add_theme_support('post-thumbnails', array('post', 'page', 'portfolio', 'slider'));
	add_action( 'init', 'my_register_image_sizes' );

function my_register_image_sizes() {
	add_image_size('post_slider',600, 300, 'true');
	add_image_size('1_column', 610, 360, 'true');
	add_image_size('2_column', 447, 250, 'true');
	add_image_size('3_column', 284, 250, 'true');
	add_image_size('4_column', 202, 150, 'true');
	add_image_size('5_column', 154, 250, 'true');
	add_image_size('post_thumb',40, 40, 'true');
	add_image_size('post_blog',600, 150, 'true');
	add_image_size('post_portfolio',936, 300, 'true');
}



	
/*---------------------------------*/
// CUSTOM MENU MANAGER
/*---------------------------------*/
if($wp_version >= 3.0) {
class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '';
           $append = '';
           $description  = ! empty( $item->attr_title ) ? '<span>'.esc_attr( $item->attr_title ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}
}

add_action('init', 'sys_admincss');
/*---------------------------------*/
// ADMIN SYSPANEL CSS
/*---------------------------------*/
function sys_admincss() { // include style sheet
if(is_admin()) {
	$adminpostcss = get_template_directory_uri() . '/lib/admin/css';
	wp_enqueue_style('sys_postadmincss', $adminpostcss.'/postadmin.css', false, '3.0', 'all');
	wp_enqueue_style('sys_adminuicss', $adminpostcss.'/jquery-ui-1.7.3.custom.css', false, '3.0', 'all');
	}
	if(isset($_GET['page']) && $_GET['page']=='admin_interface.php') {
		$adminpostcss = get_template_directory_uri() . '/lib/admin/css';
		wp_enqueue_style('sys_admincss', $adminpostcss.'/syspanel.css', false, '3.0', 'all');
   		wp_enqueue_style('sys_checkboxcss', $adminpostcss.'/jquery.checkbox.css', false, '3.0', 'all');
	}
/*---------------------------------*/
//THEME CSS LINKS
/*---------------------------------*/
	if(!is_admin()){
		wp_enqueue_style('sys_prettyphoto', get_template_directory_uri() . '/css/prettyPhoto.css', false, '3.0', 'all');
		wp_enqueue_style('sys_nivoslider', get_template_directory_uri() . '/css/nivo-slider.css', false, '3.0', 'all');
		}
  	 
	}
/*---------------------------------*/
// THEME JAVASCRIPT INCLUDES
/*---------------------------------*/
function system32_enqueue_scripts() {
	$homepageslider=get_option('sys_choose_slider');
	if(!is_admin()){
		wp_deregister_script('jquery');
		
		wp_register_script( 'jquery', sys_scripts .'/jquery-1.5.1.min.js');
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'jquery-easing', sys_scripts .'/jquery.easing.1.3.js','',$in_footer);
		wp_enqueue_script( 'jquery-tools', sys_scripts .'/	jquery.tools.min.js','',$in_footer);
		wp_register_script('jquery_map',sys_scripts.'/jquery.gmap.js','',$in_footer);
		wp_enqueue_script( 'jquery-preload', sys_scripts .'/jquery.preloadify.min.js','',$in_footer);
		/*---------------------------------*/
		// SLIDERS JAVASCRIPT ENQUEUE
		/*---------------------------------*/
		if(is_front_page()) {
			if(get_option("sys_choose_slider") =="nivo_slider"){	
				wp_enqueue_script( 'jquery-nivo', sys_scripts .'/nivo/nivo.slider.js');
			}
		}

		wp_enqueue_script('sys_empty',sys_scripts . '/empty.js');
			wp_localize_script( 'sys_empty', 'sys_panel', array(
				'SiteUrl' =>get_template_directory_uri(),
				'clearpath' =>get_bloginfo('template_directory') . '/lib/admin/images/empty.png',
				'colorpath' =>get_bloginfo('template_directory') . '/lib/admin/color/'
			));
		wp_enqueue_script( 'jquery-galleria', sys_scripts .'/src/galleria.js');
		wp_enqueue_script( 'jquery-classic', sys_scripts .'/src/themes/classic/galleria.classic.js');
		wp_enqueue_script( 'jqueryform', sys_scripts .'/jquery.form.js');
		wp_register_script( 'jquery-validate', sys_scripts .'/jquery.validate.js');	
		wp_enqueue_script( 'prettyPhoto', sys_scripts .'/jquery.prettyPhoto.js');
		wp_enqueue_script('sys_colorpicker',sys_scripts . '/mColorPicker.js');
		wp_enqueue_script( 'sys-custom', sys_scripts .'/sys_custom.js');
	}
}
/*---------------------------------*/
//ADMIN SYSPANEL JAVASCRIPT ENQUEUE
/*---------------------------------*/
add_action('wp_print_scripts', 'system32_enqueue_scripts');
if(get_option('gmapapikey')){
	function gmapscript(){
		echo "\n<script type='text/javascript' src='http://maps.google.com/maps?file=api&amp;v=2&amp;key=".get_option('gmapapikey')."'></script>\n";
		wp_print_scripts( 'jquery_map');
	}
	add_filter('wp_head','gmapscript');
}
	function admin_js(){
	if(isset($_GET['page']) && $_GET['page']=='admin_interface.php'){	
		wp_enqueue_script('sys_jquery',sys_scripts . '/jquery-1.5.1.min.js');
		wp_enqueue_script('jquery-uitabs', sys_scripts .'/jquery-ui-1.7.3.custom.min.js');		
		wp_enqueue_script('jquery_easing',sys_scripts . '/jquery.easing.1.3.js');		
		wp_enqueue_script('sys_checkbox',sys_scripts . '/jquery.checkbox.js');
		wp_enqueue_script('sys_colorpicker',sys_scripts . '/mColorPicker.js');
		
		wp_enqueue_script('sys_iphone',sys_scripts . '/iphone-style-checkboxes.js');
		wp_enqueue_script('sys_empty',sys_scripts . '/empty.js');
		wp_localize_script( 'sys_empty', 'sys_panel', array(
			'SiteUrl' =>get_template_directory_uri(),
			'clearpath' =>get_bloginfo('template_directory') . '/lib/admin/images/empty.png',
			'colorpath' =>get_bloginfo('template_directory') . '/lib/admin/color/'
		));
		wp_enqueue_script('jquery_form',sys_scripts . '/jquery.form.js');
		wp_enqueue_script('jquery_validate',sys_scripts . '/jquery.validate.js');
		wp_enqueue_script('jquery_autocomplete',sys_scripts . '/jquery.autocomplete.js');
		}
	}
add_action('wp_print_scripts', 'admin_js',8);

function my_admin_scripts() {
global $page_handle;
$svr_uri = $_SERVER['REQUEST_URI'];
	wp_enqueue_script( 'jquery-color' );
	wp_enqueue_script( 'common' );

	wp_print_scripts('media-upload');
	if (function_exists('add_thickbox')) add_thickbox();
	wp_register_script('my-upload', sys_scripts.'/ajaxupload.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
	wp_print_scripts('editor');
	if (function_exists('wp_tiny_mce')) wp_tiny_mce();
	wp_enqueue_script('utils');
	wp_admin_css();
	wp_enqueue_script('sys_colorpicker',sys_scripts . '/mColorPicker.js');
		wp_enqueue_script('sys_empty',sys_scripts . '/empty.js');
		wp_localize_script( 'sys_empty', 'sys_panel', array(
			'SiteUrl' =>get_template_directory_uri(),
			'clearpath' =>get_bloginfo('template_directory') . '/lib/admin/images/empty.png',
			'colorpath' =>get_bloginfo('template_directory') . '/lib/admin/color/'
		));
}

function my_admin_styles() {
	wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');

/*---------------------------------*/
// CUSTOM CUFON FONT SCRIPT INCLUDES
/*---------------------------------*/
function sys_cufon_function()
	{     
	$cufon_font_location = TEMPLATEPATH . '/js/cufon';
	$wpcuf_code = get_option('wpcuf_code');
	/*echo "
	<script type='text/javascript' src='TEMPLATEPATH/js/cufon/cufon-yui.js'></script>          	
	";*/
 	
 	if(isset($_GET['page']) && $_GET['page']=='admin_interface.php') { 
 		wp_enqueue_script('cufon-yui', cufon . '/cufon-yui.js' );  
		wp_print_scripts('cufon-yui');
			$cufon_scripts = "<script type='text/javascript'>\njQuery(document).ready(function() {\n";
			$count1 = 1;
			foreach (glob( TEMPLATEPATH . "/js/cufon/*") as $path_to_files)
				{
				$file_name = basename($path_to_files);
				$file_content = file_get_contents($path_to_files);
				$delimeterLeft = 'font-family":"';
				$delimeterRight = '"';
				$font_name = font_name($file_content, $delimeterLeft, $delimeterRight, $debug = false);
				/*---------------------------------*/
				wp_enqueue_script( $font_name, sys_fonts .'/'.$file_name);
				wp_print_scripts($font_name);
				$cufon_scripts .= stripslashes("Cufon('#font-$count1', { fontFamily: '$font_name' });\n");
					$count1 ++;
				}
			echo $cufon_scripts."});\n</script>";
		}
		else
		{ 
		$cufonenable=get_option('cufonenable');
			if($cufonenable == "true") 
			{
			wp_enqueue_script('cufon-yui', cufon . '/cufon-yui.js' );
			wp_print_scripts('cufon-yui');
			
				$count11 = 1;
				foreach (glob( TEMPLATEPATH . "/js/cufon/*") as $path_to_files)
				{
				$file_name = basename($path_to_files);
				if (get_option(enable_font)) 
					{
					$file_name1 = in_array($file_name,get_option(enable_font))? $file_name:'';
					if($file_name1)
					{
					$path_to_filess=TEMPLATEPATH . "/js/cufon/".$file_name1;
					$file_contents = file_get_contents($path_to_filess);
					$delimeterLeft = 'font-family":"';
					$delimeterRight = '"';
					$font_names = font_name($file_contents, $delimeterLeft,$delimeterRight, $debug = false);
					/*---------------------------------*/
					wp_enqueue_script($font_names, sys_fonts .'/'.$file_name1);
					wp_print_scripts($font_names);
					if(get_option("wpcuf_code") =="")
						{
						if($file_name1 == $file_name) 
							{
							echo "<script type='text/javascript'>";
							echo "/* <![CDATA[ */";
							$cufon_scriptss .="Cufon.replace('h1, h2, h3, h4, h5, .infobox h1, .infobox h2, .logo, .dropcap1, .dropcap2, .dropcap3, .dropcap4, .infobox h3, .bigtitle, .infobox p, .subheader,', { hover:true, fontFamily: '$font_names' });\n";
							echo 	$cufon_scriptss;
							echo "/* ]]> */";
							echo "</script>";
							}
						}
					}	
				} 
			}
			/*---------------------------------*/
			// CUFON Custom Code
			/*---------------------------------*/ 
			if(get_option("wpcuf_code"))
				{
				echo "<script type='text/javascript'>";
				echo stripslashes(get_option("wpcuf_code"));
				echo "</script>";
				}
				$count11 ++;
			}
		}
	}
/*---------------------------------*/
// CUFON FOR ADMIN SYSPANEL
/*---------------------------------*/
 	if(isset($_GET['page']) && $_GET['page']=='admin_interface.php') { 
			add_action('admin_head', 'sys_cufon_function');
		} else {
			add_action('wp_head', 'sys_cufon_function');
		}
		function font_name($inputStr, $delimeterLeft, $delimeterRight, $debug = false)
 			{
				$posLeft = strpos($inputStr, $delimeterLeft);
				if ($posLeft === false)
					{
						if ($debug)
							{
								echo "Warning: left delimiter '{$delimeterLeft}' not found";
							}
					return false;
				}
				$posLeft += strlen($delimeterLeft);
				$posRight = strpos($inputStr, $delimeterRight, $posLeft);
				if ($posRight === false)
				{
					if ($debug)
					{
						echo "Warning: right delimiter '{$delimeterRight}' not found";
					}
					return false;
				}
		return substr($inputStr, $posLeft, $posRight - $posLeft);
	}

?>