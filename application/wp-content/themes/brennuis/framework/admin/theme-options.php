<?php

// Background patterns
$ln_theme_bg_patterns = array(
							
							array(  'id' => 'no-pattern',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/no-pattern.png',
									'pattern_img' => '' ),

							array(  'id' => 'id-cubes',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/cubes.png',
									'pattern_img' => INC_CSS.'/images/patterns/cubes.png' ),

							array(  'id' => 'id-exclusive_paper',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/exclusive_paper.png',
									'pattern_img' => INC_CSS.'/images/patterns/exclusive_paper.png' ),

							array(  'id' => 'id-furley_bg',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/furley_bg.png',
									'pattern_img' => INC_CSS.'/images/patterns/furley_bg.png' ),

							array(  'id' => 'id-gplaypattern.png',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/gplaypattern.png',
									'pattern_img' => INC_CSS.'/images/patterns/gplaypattern.png' ),

							array(  'id' => 'id-gray_sand.png',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/gray_sand.png',
									'pattern_img' => INC_CSS.'/images/patterns/gray_sand.png' ),

							array(  'id' => 'id-grid_noise.png',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/grid_noise.png',
									'pattern_img' => INC_CSS.'/images/patterns/grid_noise.png' ),

							array(  'id' => 'id-purty_wood.png',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/purty_wood.png',
									'pattern_img' => INC_CSS.'/images/patterns/purty_wood.png' ),

							array(  'id' => 'id-struckaxiom.png',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/struckaxiom.png',
									'pattern_img' => INC_CSS.'/images/patterns/struckaxiom.png' ),

							array(  'id' => 'id-tileable_wood_texture.png',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/tileable_wood_texture.png',
									'pattern_img' => INC_CSS.'/images/patterns/tileable_wood_texture.png' ),

							array(  'id' => 'id-vintage_speckles.png',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/vintage_speckles.png',
									'pattern_img' => INC_CSS.'/images/patterns/vintage_speckles.png' ),

							array(  'id' => 'id-whitediamond.png',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/whitediamond.png',
									'pattern_img' => INC_CSS.'/images/patterns/whitediamond.png' ),

							array(  'id' => 'id-black_linen_v2.png',
								    'thumb' => INC_CSS.'/images/patterns/thumbs/black_linen_v2.png',
									'pattern_img' => INC_CSS.'/images/patterns/black_linen_v2.png' )
			   );


/**
 * ln_theme_options
 * - Define theme options array
 * @return array options
 **/
function ln_theme_options(){
	
	global $ln_theme_bg_patterns;
	
	// theme css styles 
	$theme_css = array( array(INC_CSS."/css/light/light.css", "Light"),
						array(INC_CSS."/css/orange/orange.css", "Orange"),
						array("ln-custom", "Custom"));
	
	$theme_css_default = "Light";
	$theme_css_default_uri = INC_CSS."/css/light/light.css";

	// flex slider 
	$flex_slider_animations = array( array("slide", "Slide"), array("fade", "Fade") );
	$flex_slider_default_animation = "slide";

	// sidebars
	$sidebar_position = array( array("left", "Left Sidebar"), array("right", "Right Sidebar"));
	$sidebar_default_position = "right";

	// Google fonts
	$google_fonts = array();
	
	// Get Google Fonts
	$fonts = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDnvzLU4Z9ze_Y_e4T9Wd22nNGIvtIvETU';
	
	if(function_exists('curl_init')){
		// CURL
		$ch = curl_init();
		$timeout = 5;

		curl_setopt ($ch, CURLOPT_URL, $fonts);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		
		$font_content = curl_exec($ch);
		curl_close($ch);

	}else{
		// file get contents
		$font_content = file_get_contents($fonts);
		
	}
	
	// parse
	if(!empty($font_content)){
		
		$fonts_data = json_decode($font_content,true);
		$font_items = $fonts_data['items'];

		if(isset($font_items)){

			foreach ($font_items as $item) {
				$font_name = str_replace(' ', '+', $item['family']);
				$google_fonts[] = array('fonts.googleapis.com/css?family='.$font_name,$item['family']);
				
			}
		}
	
	}else{

		// cant load google fonts add default fonts
		$google_fonts = array( 	array("fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic", "PT Sans"),
								array("fonts.googleapis.com/css?family=Headland+One", "Headland One"),
								array("fonts.googleapis.com/css?family=Droid+Serif", "Droid Serif"),
								array("fonts.googleapis.com/css?family=Droid+Sans", "Droid Sans"),
								array("fonts.googleapis.com/css?family=Questrial", "Questrial"),
								array("fonts.googleapis.com/css?family=Open+Sans", "Open Sans"),
								array("fonts.googleapis.com/css?family=PT+Sans&subset=latin,cyrillic", "PT Sans"),
								array("fonts.googleapis.com/css?family=Ubuntu:400,700&subset=latin,greek,cyrillic", "Ubuntu"),
								array("fonts.googleapis.com/css?family=Lato:400,700", "Lato"),
								array("fonts.googleapis.com/css?family=Cabin", "Cabin"),
								array("fonts.googleapis.com/css?family=Arimo:400,700,400italic", "Arimo"),
								array("fonts.googleapis.com/css?family=Cantarell:400,700,400italic", "Cantarell"),
								array("fonts.googleapis.com/css?family=Quicksand:400,700", "Quicksand"),
								array("fonts.googleapis.com/css?family=Lora", "Lora"),
								array("fonts.googleapis.com/css?family=Arvo", "Arvo"),
								array("fonts.googleapis.com/css?family=Bitter", "Bitter"),
								array("fonts.googleapis.com/css?family=Vollkorn", "Vollkorn"),
								array("fonts.googleapis.com/css?family=Merriweather", "Merriweather"),
								array("fonts.googleapis.com/css?family=PT+Serif", "PT Serif"),
								array("fonts.googleapis.com/css?family=Bree+Serif", "Bree Serif"),
								array("fonts.googleapis.com/css?family=Mate+SC", "Mate SC"),
								array("fonts.googleapis.com/css?family=Kreon", "Kreon"),
								array("fonts.googleapis.com/css?family=Rokkitt:400,700", "Rokkitt"),
								array("fonts.googleapis.com/css?family=Goudy+Bookletter+1911", "Goudy Bookletter 1911"),
								array("fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC", "IM Fell French Canon SC"),
								array("fonts.googleapis.com/css?family=Karla:400,700,400italic", "Karla"),
								array("fonts.googleapis.com/css?family=Federo", "Federo"),
								array("fonts.googleapis.com/css?family=Imprima", "Imprima"),
								array("fonts.googleapis.com/css?family=Belleza", "Belleza"),
								array("fonts.googleapis.com/css?family=Trocchi", "Trocchi"),
								array("fonts.googleapis.com/css?family=Rosarivo:400,400italic", "Rosarivo")
						);
	}

	$default_heading_font = 'fonts.googleapis.com/css?family=Headland+One';
	$default_content_font = 'fonts.googleapis.com/css?family=PT+Sans';			
	////////////////////////////

	$options = array();
	
	///////////////////////////////////////////////////////////////////////
	// General settings
	$options[] = array( "name" => __("General Settings", "framework"),
						"id" => "general-settings",
						"type" => "heading");
	
	$options[] = array( "name" => __("Enable Text Logo", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_theme_logo_text",
						"std" => "false",
						"class" => "ln-input",
						"options" => __("Enable text logo (your site name) rather than an image.", "framework"),
						"default" => "false",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Logo", "framework"),
						"desc" => __("Upload your logo or type your logo url address.", "framework"),
						"id" => SHORT_NAME."_theme_logo",
						"std" => "",
						"class" => "ln-upload",
						"type" => "image");
	
	$options[] = array( "name" => __("Favicon", "framework"),
						"desc" => __("Upload your website favicon image 16px by 16px (png, gif or ico).", "framework"),
						"id" => SHORT_NAME."_theme_favicon",
						"std" => "",
						"class" => "ln-upload",
						"type" => "image");
	
	$options[] = array( "name" => __("Slogan", "framework"),
						"desc" => __("Slogan text displayed under the logo.", "framework"),
						"id" => SHORT_NAME."_theme_slogan",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");
	
	$options[] = array( "name" => __("Responsive Design", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_theme_responsive_design_enabled",
						"std" => "true",
						"class" => "ln-input",
						"options" => __("Enable or disable responsive design.", "framework"),
						"default" => "true",
						"type" => "checkbox");

	$options[] = array( "name" => __("Feed URL", "framework"),
						"desc" => __("Enter your feed url.", "framework"),
						"id" => SHORT_NAME."_theme_feed_url",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");
	
	$options[] = array( "name" => __("Tracking Code", "framework"),
						"desc" => __("Enter your tracking code here (Google Analytics or other) it will be inserted before the closing body tag.", "framework"),
						"id" => SHORT_NAME."_theme_tracking_code",
						"std" => "",
						"class" => "ln-input",
						"type" => "textarea");

	
	
	$options[] = array( "name" => __("Contact E-mail Address", "framework"),
						"desc" => __("Type your e-mail address. It will be used to send you e-mails from contact page (by default its admin e-mail).", "framework"),
						"id" => SHORT_NAME."_theme_contact_email",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Contact confirmation text", "framework"),
						"desc" => __("Type here confirmation text that will appear when user sends you an e-mail.", "framework"),
						"id" => SHORT_NAME."_theme_contact_confirmation_text",
						"std" => "",
						"class" => "ln-input",
						"type" => "textarea");
	
	$options[] = array( "name" => __("Custom JavaScript", "framework"),
						"desc" => __("Write here your custom javascript code without script tags.", "framework"),
						"id" => SHORT_NAME."_theme_custom_js",
						"std" => "",
						"class" => "ln-input",
						"type" => "textarea");
	
	$options[] = array( "name" => __("Footer Left Text", "framework"),
						"desc" => __("Text that will appear in footer left side.", "framework"),
						"id" => SHORT_NAME."_theme_footer_text_left",
						"std" => "",
						"class" => "ln-input",
						"type" => "textarea");

	$options[] = array( "name" => __("Footer Right Text", "framework"),
						"desc" => __("Text that will appear in footer right side.", "framework"),
						"id" => SHORT_NAME."_theme_footer_text_right",
						"std" => "",
						"class" => "ln-input",
						"type" => "textarea");

	$options[] = array( "name" => __("Enable Lightbox", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_theme_enable_lightbox",
						"std" => "true",
						"class" => "ln-input",
						"options" => __("Enable or disable lightbox", "framework"),
						"default" => "true",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("404 page title", "framework"),
						"desc" => __("Enter 404 page title.", "framework"),
						"id" => SHORT_NAME."_theme_404_page_title",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("404 page content", "framework"),
						"desc" => __("Text that will appear on 404 page.", "framework"),
						"id" => SHORT_NAME."_theme_404_page_content",
						"std" => "",
						"class" => "ln-input",
						"type" => "textarea");

	$options[] = array( "name" => __("Enable header banner", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_theme_enable_top_banner_img",
						"std" => "false",
						"class" => "ln-input",
						"options" => __("Enable or disable header banner", "framework"),
						"default" => "false",
						"type" => "checkbox");

	$options[] = array( "name" => __("Select header banner type", "framework"),
						"desc" => __("Choose banner type.", "framework"),
						"id" => SHORT_NAME."_theme_header_banner_type",
						"std" => "image",
						"class" => "ln-input",
						"options" => array( array("image", "Image"), array("text", "Text") ),
						"default" => "image",
						"type" => "select");

	$options[] = array( "name" => __("Header banner image", "framework"),
						"desc" => __("Upload top banner image (468 x 60px).", "framework"),
						"id" => SHORT_NAME."_theme_top_banner_img",
						"std" => "",
						"class" => "ln-upload",
						"type" => "image");

	$options[] = array( "name" => __("Header banner URL", "framework"),
						"desc" => __("Enter banner URL.", "framework"),
						"id" => SHORT_NAME."_theme_top_banner_url",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Head banner text", "framework"),
						"desc" => __("Add here your advertisement code.", "framework"),
						"id" => SHORT_NAME."_theme_header_banner_text",
						"std" => "",
						"class" => "ln-input",
						"type" => "textarea");
	
	///////////////////////////////////////////////////////////////////////
	// Styling
	$options[] = array( "name" => __("Styling Options", "framework"),
						"id" => "styling-options",
						"type" => "heading");
	
	$options[] = array( "name" => __("Theme Color", "framework"),
						"desc" => __("Select theme color.", "framework"),
						"id" => SHORT_NAME."_theme_color_theme",
						"std" => $theme_css_default_uri,
						"class" => "ln-input",
						"options" => $theme_css,
						"default" => $theme_css_default,
						"type" => "select");

	$options[] = array( "name" => __("Background Color", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_theme_custom_bg_color",
						"std" => "fff",
						"type" => "color_picker");

	$options[] = array( "name" => __("Select Background Type", "framework"),
						"desc" => __("Choose background type.", "framework"),
						"id" => SHORT_NAME."_theme_style_custom_background_type",
						"std" => "pattern",
						"class" => "ln-input",
						"options" => array( array("pattern", "Pattern"), array("custom-img", "Custom Image") ),
						"default" => "pattern",
						"type" => "select");

	$options[] = array( "name" => __("Background Pattern", "framework"),
						"desc" => __("Select background pattern.", "framework"),
						"id" => SHORT_NAME."_theme_bg_pattern",
						"std" => 'no-pattern',
						"class" => "ln-input",
						"options" => $ln_theme_bg_patterns,
						"default" => 'no-pattern',
						"type" => "select_pattern");

	$options[] = array( "name" => __("Upload Background Pattern", "framework"),
						"desc" => __("Upload your background pattern.", "framework"),
						"id" => SHORT_NAME."_theme_custom_bg_pattern",
						"std" => "",
						"class" => "ln-upload",
						"type" => "image");
	
	$options[] = array( "name" => __("Background Image Repeat", "framework"),
						"desc" => __("Select your background image repeat option", "framework"),
						"id" => SHORT_NAME."_theme_style_custom_background_repeat_type",
						"std" => "scale",
						"class" => "ln-input",
						"options" => array( array("no-repeat", "No Repeat"), array("scale", "Scale") ),
						"default" => "scale",
						"type" => "select");

	$options[] = array( "name" => __("Upload Background Image", "framework"),
						"desc" => __("Upload your global site background image.", "framework"),
						"id" => SHORT_NAME."_theme_custom_global_background_image",
						"std" => "",
						"class" => "ln-upload",
						"type" => "image");

	$options[] = array( "name" => __("Custom CSS", "framework"),
						"desc" => __("Write here your custom CSS without style tags.", "framework"),
						"id" => SHORT_NAME."_theme_custom_css",
						"std" => "",
						"class" => "ln-input",
						"type" => "textarea");

	// fill array with custom color theme options
	ln_theme_get_custom_color_theme_option($options);

	///////////////////////////////////////////////////////////////////////
	// Fonts
	$options[] = array( "name" => __("Fonts", "framework"),
						"id" => "fonts-options",
						"type" => "heading");
	
	$options[] = array( "name" => __("Headings Font", "framework"),
						"desc" => __("Select headings font (h1 - h6).", "framework"),
						"id" => SHORT_NAME."_theme_heading_font",
						"std" => $default_heading_font,
						"class" => "ln-input",
						"options" => $google_fonts,
						"default" => $default_heading_font,
						"type" => "select_font");
	
	$options[] = array( "name" => __("Body Font", "framework"),
						"desc" => __("Select content font.", "framework"),
						"id" => SHORT_NAME."_theme_content_font",
						"std" => $default_content_font,
						"class" => "ln-input",
						"options" => $google_fonts,
						"default" => $default_content_font,
						"type" => "select_font");
	
	///////////////////////////////////////////////////////////////////////
	// Social Icons settings
	$options[] = array( "name" => __("Social Icons", "framework"),
						"id" => "social-icons-settings",
						"type" => "heading");

	$options[] = array( "name" => __("Twitter", "framework"),
						"desc" => __("Enter your Twitter url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_twitter",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Facebook", "framework"),
						"desc" => __("Enter your Facebook url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_facebook",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Flickr", "framework"),
						"desc" => __("Enter your Flickr url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_flickr",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Delicious", "framework"),
						"desc" => __("Enter your Delicious url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_delicious",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Digg", "framework"),
						"desc" => __("Enter your Digg url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_digg",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Last fm", "framework"),
						"desc" => __("Enter your Last fm url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_lastfm",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Linkedin", "framework"),
						"desc" => __("Enter your Linkedin url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_linkedin",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("RSS", "framework"),
						"desc" => __("Enter your RSS url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_rss",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Stumble Upon", "framework"),
						"desc" => __("Enter your StumbleUpon url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_stumbleupon",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Tumblr", "framework"),
						"desc" => __("Enter your Tumblr url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_tumblr",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Vimeo", "framework"),
						"desc" => __("Enter your Vimeo url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_vimeo",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Youtube", "framework"),
						"desc" => __("Enter your Youtube url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_youtube",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Dribbble", "framework"),
						"desc" => __("Enter your Dribbble url or leave it blank", "framework"),
						"id" => SHORT_NAME."_main_social_icons_dribbble",
						"std" => "",
						"class" => "ln-input",
						"type" => "text");
	
	///////////////////////////////////////////////////////////////////////
	// Social Share settings
	$options[] = array( "name" => __("Social Share", "framework"),
						"id" => "social-share-settings",
						"type" => "heading");

	$options[] = array( "name" => __("Pinterest", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_single_posts_social_icon_enabled_pinterest",
						"std" => "false",
						"class" => "ln-input",
						"options" => __("Enable Pinterest share on single posts", "framework"),
						"default" => "false",
						"type" => "checkbox");

	$options[] = array( "name" => __("Facebook", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_single_posts_social_icon_enabled_facebook",
						"std" => "false",
						"class" => "ln-input",
						"options" => __("Enable Facebook share on single posts", "framework"),
						"default" => "false",
						"type" => "checkbox");

	$options[] = array( "name" => __("Twitter", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_single_posts_social_icon_enabled_twitter",
						"std" => "false",
						"class" => "ln-input",
						"options" => __("Enable Twitter share on single posts", "framework"),
						"default" => "false",
						"type" => "checkbox");

	$options[] = array( "name" => __("Google", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_single_posts_social_icon_enabled_google",
						"std" => "false",
						"class" => "ln-input",
						"options" => __("Enable Google share on single posts", "framework"),
						"default" => "false",
						"type" => "checkbox");

	$options[] = array( "name" => __("Delicious", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_single_posts_social_icon_enabled_delicious",
						"std" => "false",
						"class" => "ln-input",
						"options" => __("Enable Delicious share on single posts", "framework"),
						"default" => "false",
						"type" => "checkbox");

	$options[] = array( "name" => __("Digg", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_single_posts_social_icon_enabled_digg",
						"std" => "false",
						"class" => "ln-input",
						"options" => __("Enable Digg share on single posts", "framework"),
						"default" => "false",
						"type" => "checkbox");

	$options[] = array( "name" => __("Linkedin", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_single_posts_social_icon_enabled_linkedin",
						"std" => "false",
						"class" => "ln-input",
						"options" => __("Enable Linkedin share on single posts", "framework"),
						"default" => "false",
						"type" => "checkbox");

	$options[] = array( "name" => __("StumbleUpon", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_single_posts_social_icon_enabled_stumbleupon",
						"std" => "false",
						"class" => "ln-input",
						"options" => __("Enable StumbleUpon share on single posts", "framework"),
						"default" => "false",
						"type" => "checkbox");

	///////////////////////////////////////////////////////////////////////
	// Slider settings
	$options[] = array( "name" => __("Slider Module", "framework"),
						"id" => "slider-settings",
						"type" => "heading");

	$options[] = array( "name" => __("Slider Animation", "framework"),
						"desc" => __("Select slider transition.", "framework"),
						"id" => SHORT_NAME."_module_slider_transition",
						"std" => "",
						"class" => "ln-input",
						"options" => $flex_slider_animations,
						"default" => $flex_slider_default_animation,
						"type" => "select");
	
	$options[] = array( "name" => __("Enable Slider Slideshow", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_module_slider_slideshow",
						"std" => "false",
						"class" => "ln-input",
						"options" => __("Enable or disable slider autoplay.", "framework"),
						"default" => "false",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Slider Slideshow Speed", "framework"),
						"desc" => __("Input slider slideshow speed value (1000 = 1s).", "framework"),
						"id" => SHORT_NAME."_module_slider_slideshow_value",
						"std" => "5000",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Slider Animation Duration", "framework"),
						"desc" => __("Input slider animation duration value (1000 = 1s).", "framework"),
						"id" => SHORT_NAME."_module_slider_animation_duration",
						"std" => "720",
						"class" => "ln-input",
						"type" => "text");

	///////////////////////////////////////////////////////////////////////
	// Blog settings
	$options[] = array( "name" => __("Blog", "framework"),
						"id" => "blog-settings",
						"type" => "heading");

	$options[] = array( "name" => __("Enable Posts Footer Social Share", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_theme_blog_enable_post_preview_share",
						"std" => "true",
						"class" => "ln-input",
						"options" => __("Enable or disable social share on blog posts.", "framework"),
						"default" => "true",
						"type" => "checkbox");

	$options[] = array( "name" => __("Enable About The Author Box", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_magazine_blog_about_the_author_enable",
						"std" => "true",
						"class" => "ln-input",
						"options" => __("Enable or disable about the author box in posts.", "framework"),
						"default" => "true",
						"type" => "checkbox");

	$options[] = array( "name" => __("Enable Related Posts Carousel", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_magazine_blog_realted_carousel_enable",
						"std" => "true",
						"class" => "ln-input",
						"options" => __("Enable or disable related posts carousel.", "framework"),
						"default" => "true",
						"type" => "checkbox");

	$options[] = array( "name" => __("Number Of Related Posts", "framework"),
						"desc" => __("Enter the number of related posts in carousel", "framework"),
						"id" => SHORT_NAME."_magazine_blog_related_posts_number",
						"std" => "7",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Sidebar Position", "framework"),
						"desc" => __("Select Blog sidebar position.", "framework"),
						"id" => SHORT_NAME."_blog_sidebar_position",
						"std" => "right",
						"class" => "ln-input",
						"options" => $sidebar_position,
						"default" => $sidebar_default_position,
						"type" => "select");
	
	$options[] = array( "name" => __("Gallery Post Slider Animation", "framework"),
						"desc" => __("Select slider transition.", "framework"),
						"id" => SHORT_NAME."_blog_gallery_slider_transition",
						"std" => "",
						"class" => "ln-input",
						"options" => $flex_slider_animations,
						"default" => $flex_slider_default_animation,
						"type" => "select");
	
	$options[] = array( "name" => __("Enable Slider Slideshow", "framework"),
						"desc" => "",
						"id" => SHORT_NAME."_blog_gallery_slider_slideshow",
						"std" => "false",
						"class" => "ln-input",
						"options" => __("Enable or disable slider autoplay.", "framework"),
						"default" => "false",
						"type" => "checkbox");
	
	$options[] = array( "name" => __("Slider Slideshow Speed", "framework"),
						"desc" => __("Input slider slideshow speed value (1000 = 1s).", "framework"),
						"id" => SHORT_NAME."_blog_gallery_slider_slideshow_value",
						"std" => "5000",
						"class" => "ln-input",
						"type" => "text");

	$options[] = array( "name" => __("Slider Animation Duration", "framework"),
						"desc" => __("Input slider animation duration value (1000 = 1s).", "framework"),
						"id" => SHORT_NAME."_blog_gallery_slider_animation_duration",
						"std" => "720",
						"class" => "ln-input",
						"type" => "text");

	
	return $options;
	
}

?>