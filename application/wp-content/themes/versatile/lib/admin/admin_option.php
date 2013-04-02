<?php
$themename = "Versatile";
$shortname ="";

$cats_array = get_categories('hide_empty=0');
$pages_array = get_pages('hide_empty=0');
$dynamic_homepages = array( None => 'None');
$dynamic_pages = array();
$dynamic_cats = array();

foreach ($pages_array as $pagg) {
	$dynamic_pages[$pagg->ID] = $pagg->post_title;
	$pages_ids[] = $pagg->ID;
}

foreach ($pages_array as $pagg) {
	$dynamic_homepages[$pagg->ID] = $pagg->post_title;
	$pages_ids[] = $pagg->ID;
}

foreach ($cats_array as $categs) {
	$dynamic_cats[$categs->cat_ID] = $categs->cat_name;
	$cats_ids[] = $categs->cat_ID;
}
// get color stylesheet
		$colors=array();
		if(is_dir(TEMPLATEPATH . "/colors/")) {
			if($style_dirs = opendir(TEMPLATEPATH . "/colors/")) {
				while(($color = readdir($style_dirs)) !== false) {
					if(stristr($color, ".css") !== false) {
						$colors[$color] = $color;
					}
				}
			}
		}
		$colors_select = $colors;
		array_unshift($colors_select,'Default Style');
$socialimages=array();
if(is_dir(TEMPLATEPATH . "/images/followus/")) {
	if($socialimages_dirs = opendir(TEMPLATEPATH . "/images/followus/")) {
		while(($socialimage = readdir($socialimages_dirs)) !== false) {
			if(preg_match_all('!.+\.(?:jpe?g|png|gif)!Ui',$socialimage, $matches)){
				$socialimages[] = $socialimage;
				}
			
		}
	}
}
$socialimages_select = $socialimages;

$fontjs=array();
if(is_dir(get_template_directory_uri() . "/js/cufon/")) {
	if($js_dirs = opendir(get_template_directory_uri() . "/js/cufon/")) {
		while(($js_font = readdir($js_dirs)) !== false) {
			if(stristr($js_font, ".js") !== false) {
				$fontjs[] = $js_font;
			}
		}
	}
}
$font_selects = $fontjs;
$fontrange=array();
for($i=0; $i < 71; $i++)
{
$fontrange[]=$i;
}

$options = array (

##################################################################
# General
##################################################################

array(	"name" => "generalsetting",
		"type" => "title"),

	array(	"type" => "open"),

	array(	"name" => "General Setting",
			"icon" => get_template_directory_uri().'/lib/admin/images/general-icon.png',
			"type" => "ctitle"),


	array(	"name" => "Header Background",
			"desc" => "Please insert the Image URL here or click on upload button to upload the image from your desktop.",
			"id" => $shortname."bg_img",
			"shortinfo" => "Input Full URL to your custom header image.",
            "std" => "",
            "type" => "image_upload"
			),
	
	array(	"name" => "Header Background Position",
			"desc" => "Please select the Background Image position",
			"id" => $shortname."bg_position",
			"shortinfo" => "Select the position of the background you want to assign.",
            "std" => "",
			"options" => array(	"left_top" => "Left Top",
								"left_center" => "Left Center",
								"left_bottom" => "Left Bottom",
								"right_top" => "Right Top",
								"right_center" => "Right Center",
								"right_bottom" => "Right Bottom",
								"center_top" => "Center Top",
								"center_center" => "Center Center",
								"center_bottom" => "Center Bottom"),
		
			"type" => "selectid"
			),

	array(	"name" => "Header Background Repeat",
			"desc" => "Please select the Background Repeat Option",
			"id" => $shortname."bg_repeat",
			"shortinfo" => "Select the style of the background you want to assign repeat or not.",
            "std" => "",
			"options" => array(	"repeat" => "Repeat",
								"no-repeat" => "No Repeat",
								"repeat-x" => "Repeat X",
								"repeat-y" => "Repeat Y"),
		
			"type" => "selectid"
			),

	array(	"name" => "Layout Background",
			"desc" => "Layout Background Attachment Style",
			"id" => $shortname."bgattachment",
			"shortinfo" => "Select the style of the background you want attach either fixed or",
            "std" => "",
			"options" => array(	"fixed" => "Fixed",
								"scroll" => "Scroll"),
		
			"type" => "selectid"
			),

	array(	"name" => "Layout Option",
			"desc" => "Select the layout option, boxed layout or streched layout",
		
			"std" => "", 
	        "type" => "customlayout"
			),

	array(	"name" => "Logo Upload",
			"desc" => "Please insert the Logo URL here or click on upload button to upload the image from your desktop.",
			"id" => $shortname."s_logo",
			"shortinfo" => "Input Full URL to your custom logo image.",
            "std" => "",
            "type" => "image_upload"
			),
	
	array(	"name" => "Upload favicon",
			"desc" => 'Enter the full URL location of your custom "favicon" which is visible in browser favorites and tabs.(Must be .png or .ico file - 16px by 16px ).',
			"id" => $shortname."favicon",
			"shortinfo" => 'Input Full URL to favicon image ("favicon.ico" image file)',
			"std" => "",
			"type" => "image_upload"),

		
	array(	"name" => "Teaser Setting",
			"desc" => "",
			"shortinfo" => "Teaser call out for the subheader section of the theme.",
			"id" => $shortname."teasertext",
			"std" => "",  
            "type" => "header_text"),
			
	array(	"name" => "Contact E-mail ID",
			"shortinfo" => "This is used for the contact page form page.",
			"desc" => "Enter your E-mail address to use on the Contact US Page Template. Ex: name@yoursite.com ",
			"id" => $shortname."contactemail",
			"std" => "",
			"type" => "text"
			),

	array(	"name" => "Google Maps API Key",
			"shortinfo" => "Google Maps API Key.",
			"desc" => "Paste your Google Maps API Key here. If you don't have one, please sign up for a <a href='http://code.google.com/intl/en-US/apis/maps/signup.html'>Google Maps API key</a> ",
			"id" => $shortname."gmapapikey",
			"std" => "",
			"type" => "textarea"
			),


	array(	"name" => "Extra CSS",
			"shortinfo" => "Custom CSS Code which will be added in head section of the page",
			"desc" => "Quickly add some CSS of your own choice to your theme by adding it to this block.",
			"id" => $shortname."extracss",
			"std" => "", 
	        "type" => "textarea"
			),

	array(	"name" => "Timthumb Setting",
			"desc" => "This theme uses dynamic image resizer (timthumb.php) to resize the thumbnails. Remember to CHMOD your cache folder to 777. If your server does not support timthumb then check Disable Option",
			"id" => $shortname."timthumboption",
			"std" => "",
	"options" => array(	"enable" => "enable",
								"disable" => "disable"),			
			"type" => "imageresize"
			),
    array(	"type" => "close"),

##################################################################
# Homepage Setting
##################################################################

array(	"name" => "Homepage",
		"type" => "title"),

	array(	"type" => "open"),

	array(	"name" => "Homepage Setting",
			"icon" => get_template_directory_uri().'/lib/admin/images/home-icon.png',
		"type" => "ctitle"),

	array(	"name" => "Homepage Teaser Box",
			"shortinfo" => "Teaser Text and Sociables on Homepage Below Slider",
			"desc" => 'If "OFF" selected, Teaser area below the slider will be disabled',
			"id" => $shortname."teaserbox",
			"std" => "true",
			"type" => "checkbox"		
			),

	array(	"name" => "Homepage Teaser Text",
			"shortinfo" => "Teaser text which displays on the frontpage below the slider",
			"desc" => "Enter the teaser text you would like to display on the frontpage below the slider, Use the heading elements h1, h2 and h3 ",			
			"id" => $shortname."home_teaser",
			"std" => "",
			"type" => "textarea"
			),

	array(	"name" => "Homepage Welcome page",
			"desc" => "Select the page you want to assign on homepage first column as a welcome content.",
			"id" => $shortname."sys_homepages",
			"std" => "",
            "options" => $dynamic_homepages,
			"type" => "selectid"),

	array(	"name" => "Homepage Layout",
			"desc" => "Select the page layout with sidebar or without sidebar.",
			"id" => $shortname."homepagelayout",
			"std" => "fullpage",
			"options" => array("fullpage" => "Full Page",
							"rightsidebar" => "Right Sidebar", 
							"leftsidebar" => "Left Sidebar"),
		
			"type" => "selectid"),

	array(	"name" => "Homepage Content",
			"shortinfo" => "Content Editor on frontpage below the teaser text area",
			"desc" => "Enter the content which will appear below the intro on the frontpage. You can use shortcode editor as well. If you want to break a new line just hold the shift key and hit Enter key.",
				"id" => $shortname."home_content",
            "std" => "",	
             "type" => "content_editor"),


	array(	"type" => "close"),


##################################################################
# Colors
##################################################################

array(	"name" => "Colors",
		"type" => "title"),

	array(	"type" => "open"),

	array(	"name" => "Theme Color Setting",
			"icon" => get_template_directory_uri().'/lib/admin/images/colors-icon.png',
			"type" => "ctitle"),
	array(	'name'	=> 'Colors',
			'desc'	=> 'Select your themes alternative color scheme for this Theme ',
			'id'	=> $shortname.'default_colors',
			'std'	=> '', 
			'options'=> $colors_select,
			'type'	=> 'selectid'),

	array(	"name" => "General Color Setting",
			"type" => "subsection"),

	array(	"name" => "Logo Text Color",
			"id" => $shortname."logotextcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Theme Color Scheme",
			"id" => $shortname."themecolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Header Background Color",
			"id" => $shortname."headercolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Boxed Layout Header BG Color",
			"id" => $shortname."boxedheadercolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Page Background Color",
			"id" => $shortname."pagebgcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Text Color",
			"id" => $shortname."paracolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Border Color Scheme",
			"id" => $shortname."bordercolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Subheader Background Color",
			"id" => $shortname."subheaderbgcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Slider H1 Text Color",
			"id" => $shortname."headerbigtextcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Slider H4 Text Color",
			"id" => $shortname."headersmalltextcolor",
			"std" => "", 
	        "type" => "color"
			),

array(	"name" => "Links Color Setting",
			"type" => "subsection"),

	array(	"name" => "Link Color",
			"id" => $shortname."linkcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Link Hover Color",
			"id" => $shortname."linkhoverhover",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Sub Header Link Color",
			"id" => $shortname."subheaderlinkcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Menu Link Color",
			"id" => $shortname."navlinkcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Sub Menu Link Color",
			"id" => $shortname."subnavlinkcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Sub Menu Background Color",
			"id" => $shortname."subnavbgcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Sub Menu Hover Color",
			"id" => $shortname."subnavhovercolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Sub Menu Border Color",
			"id" => $shortname."subnavbrcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Breadcrumb Link Color",
			"id" => $shortname."breadlinkcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Breadcrumb Text Color",
			"id" => $shortname."breadtextcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Blog Post Title Color",
			"id" => $shortname."entrytitlecolor",
			"std" => "", 
	        "type" => "color"
			),

array(	"name" => "Headings Color Setting",
			"type" => "subsection"),

	array(	"name" => "Heading H1",
			"id" => $shortname."h1color",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Heading H2",
			"id" => $shortname."h2color",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Heading H3",
			"id" => $shortname."h3color",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Heading H4",
			"id" => $shortname."h4color",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Heading H5",
			"id" => $shortname."h5color",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Heading H6",
			"id" => $shortname."h6color",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Footer Color Settings",
			"type" => "subsection"),

	array(	"name" => "Footer Background Color",
			"id" => $shortname."footerbgcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Footer Border Top",
			"id" => $shortname."footerbordertopcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Footer Text Color",
			"id" => $shortname."footertextcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Footer Heading Color",
			"id" => $shortname."footerheadingcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Footer Link Color",
			"id" => $shortname."footerlinkcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Footer Link Hover Color",
			"id" => $shortname."footerlinkhovercolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Copyright Background Color",
			"id" => $shortname."copybgcolor",
			"std" => "", 
	        "type" => "color"
			),

	array(	"name" => "Copyright Text Color",
			"id" => $shortname."copytextcolor",
			"std" => "", 
	        "type" => "color"
			),
	array(	"type" => "close"),


##################################################################
# Home page slider setting
##################################################################
		
array(	"name" => "homepagesliders",
		"type" => "title"),

	array(	"type" => "open"),

	array(	"name" => "Slider Setting",
			"icon" => get_template_directory_uri().'/lib/admin/images/slider-icon.png',
		"type" => "ctitle"),

	array(	"name" => "Frontpage Slider",
			"shortinfo" => 'If "OFF" Selected the slider will be disabled from the frontpage',
			"desc" => 'Select "OFF" If you want to hide the slider on frontpage.',
			"id" => $shortname."slidervisble",
			"std" => "true",
			"type" => "checkbox"		
			),


	array(	"name" => "Sliders Option",
			"shortinfo" => "Select which slider you want to use for your frontpage featured item display.",
			"desc" => "Select the slider which you want to use for your featured item display on frontpage make sure you post slides in the custom post types right above the versatile tab on left menu.",
			"type" => "custom_slider"
),

	array(	"type" => "close"),


##################################################################
# Cufon
##################################################################
		
array(	"name" => "fonts",
		"type" => "title"),

	array(	"type" => "open"),

	array(	"name" => "Cufon Font Setting",
			"icon" => get_template_directory_uri().'/lib/admin/images/font-icon.png',
		"type" => "ctitle"),

	array(  "name" => "Cufon Font",
			"shortinfo" => "Custom Cufon Font Replacement",
			"desc" => 'If "OFF" Selected the Custom Cufon Font will be disabled and it will display the default font as set in main.css',
			"id" => $shortname."cufonenable",
			"std" => "true",	
			"type" => "checkbox"	
					),

	array(	"name" => "Cufon Code",
			"desc" => "sample:<p>Cufon.replace('h1, h2, h3, h4, h5, .subheader, a.button span,', { hover:true, fontFamily: '$font_names' });</code></p><p><code>Cufon.replace(\"#site_name\", {fontFamily : \"Nobile\", color: '-linear-gradient(gray, black)'});</code></p><p>For more help on cufon font replace code go to official site <a href=\"http://wiki.github.com/sorccu/cufon/styling\">Cufon</a>')",
		"default" => "Segan.js",	
			"type" => "custom_fonts"
),

	array(	"type" => "close"),


##################################################################
# Footer Setting
##################################################################

array(	"name" => "Footer",
		"type" => "title"),

	array(	"type" => "open"),

	array(	"name" => "Footer Setting",
			"icon" => get_template_directory_uri().'/lib/admin/images/footer-icon.png',
		"type" => "ctitle"),

	array(	"name" => "Footer Sidebar",
			"shortinfo" => "Footer Containing 1-6 Columns Layout used for widgets display",
			"desc" => 'If "OFF" Selected, Footer Columns will be disabled and will show you only the copyright content bar.',
			"id" => $shortname."footer_sidebar",
			"std" => "true",
			"type" => "checkbox"	
			),


	array(	"name" => "Footer Columns",
			"desc" => "Select the number of Columns to display on footer sidebar and after selecting save the options and go to your widgets panel and assign the widgets in each column",
			"id" => $shortname."footerwidgetcount",
	       "options" => array( 
						"2" => "2 Columns",
						"3" => "3 Columns",
						"4" => "4 Columns",
						"5" => "5 Columns",
						"6" => "6 Columns",						
					),	
			"std" => "2", 
	        "type" => "radios"
			),


	array(	"name" => "Google Analytics",
			"shortinfo" => 'Google Analytics (or other) tracking code',
			"desc" => "Paste your Google Analytics code here which starts from &lt;script> here. This will be added into the footer of your theme.",
			"id" => $shortname."googleanalytics",
			"std" => "",
			"type" => "textarea"
			),

	array(	"name" => "Footer Copyright Notice in Left Side",
			"desc" => "Here you can place the Footer Copyright content which will be displayed on left side",
			"id" => $shortname."left_footer",
			"std" => "",
			"type" => "textarea"
			),
	array(	"name" => "Footer Copyright Notice In Right Side",
			"desc" => "Here you can place the Footer Copyright content which will be displayed on right side",
			"id" => $shortname."right_footer",
			"std" => "",
			"type" => "textarea"
			),

	array(	"type" => "close"),

##################################################################
# Language Setting
##################################################################

array(	"name" => "Language",
		"type" => "title"),


	array(	"type" => "open"),

	array(	'name'	=> 'Readmore Text ',	
					'desc'	=> 'Read more text on sliders and other different areas on the theme',
					'id'	=> $shortname.'readmoretext',
					'std'	=> '',
					'type'	=> 'text'),

	array( 'name'	=> '404 Page',
						'desc'	=> 'Custom text which appears in subheader area of the 404 Error page',
						'id'	=> $shortname.'error404txt',
						'std'	=> '',
						'type'	=> 'textarea'),

	array( 'name'	=> 'Single Portfolio Page',
						'desc'	=> 'Custom text which appears in subheader area of the single portfolio page',
						'id'	=> $shortname.'singleportfoliotitle',
						'std'	=> '',
						'type'	=> 'textarea'),


	array(	"type" => "close"),
##################################################################
# Social Network Setting
##################################################################

array(	"name" => "SocialSites",
		"type" => "title"),


	array(	"type" => "open"),

	array(	"name" => "Sociables Setting",
			"icon" => get_template_directory_uri().'/lib/admin/images/social-icon.png',
		"type" => "ctitle"),

	array(	"name" => "Followus Social Network Sites",
		"desc" => "Select the social networking sites with URL (e.g http://www.twitter.com/themeflash) and in place of title use Twitter or relevant name which will be displayed on mousehovered",
		"type" => "custom_socialbook_mark"),

	array(	"type" => "close"),
	

##################################################################
# Widget setting
##################################################################
		
array(	"name" => "widget",
		"type" => "title"),

	array(	"type" => "open"),

	array(	"name" => "Custom Sidebars Setting",
			"icon" => get_template_directory_uri().'/lib/admin/images/widgets-icon.png',
		"type" => "ctitle"),

	array( 'name'	=> 'Custom Sidebars',
			'desc'	=> 'The selected pages will show up in the widgets page where you can add your desired widgets for a specific pages.',
			'id'	=> $shortname.'customsidebar',
			'std'	=> '',
			'type'	=> 'customsidebar'),

	array(	"type" => "close"),



##################################################################
# Post Option setting
##################################################################
		
array(	"name" => "postoptions",
		"type" => "title"),

	array(	"type" => "open"),

	array(	"name" => "Post Options",
			"icon" => get_template_directory_uri().'/lib/admin/images/widgets-icon.png',
		"type" => "ctitle"),

array(	"name" => "About Author",
			"shortinfo" => "Author info for the blog post.",
			"desc" => "Check on if you want to disable the Author Info Box in post single page at the end of the post",
			"id" => $shortname."aboutauthor",
			"std" => "true",
			"type" => "checkbox"	
			),
array(	"name" => "Related Posts and Popular Post",
			"desc" => "Check on if you want to disable the related and popular post in post single page.",
			"id" => $shortname."relatedpopular",
			"std" => "true",
			"type" => "checkbox"	
			),
array(	"name" => "Blog Featured Image Lightbox",
			"shortinfo" => "Blog Page Template Featured Image",
			"desc" => "Switch off if you want to disable the lightbox and link the featured image to the blog post itself instead of opening the image in a lightbox",
			"id" => $shortname."bloglightbox",
			"std" => "true",
			"type" => "checkbox"	
			),
array(	"name" => "Post/Page Comments",
			"desc" => "Select if you want to display comments on posts and/or pages.",
			"id" => $shortname."commentstemplate",
			"std" => "fullpage",
			"options" => array("posts" => "Posts Only",
							"pages" => "Pages Only", 
							"both" => "Pages/posts",
							"none" =>"None"	),
		
			"type" => "selectid"
	),
array(	'name'	=> 'Single page Next/Previous Post',
		'desc'	=> 'Turn "OFF" if you want to disable  next/previous in Portfolio single page',
		'id'	=> $shortname.'singlenavigation',
		'std'	=> '',
		'type'	=> 'checkbox'	
		),
array(	'name'	=> 'Portfolio page Next/Previous Post',
		'desc'	=> 'Turn "OFF" if you want to disable  next/previous in Portfolio single page',
		'id'	=> $shortname.'portfolionavigation',
		'std'	=> '',
		'type'	=> 'checkbox'	
		),

	array(	"type" => "close"),
##################################################################
# Typography Setting
##################################################################

array(	"name" => "Typography",
		"type" => "title"),

	array(	"type" => "open"),

	array(	"name" => "Custom Typography Setting",
			"icon" => get_template_directory_uri().'/lib/admin/images/typo-icon.png',
		"type" => "ctitle"),

	array(	"name" => "Paragraph Size",
			"desc" => "Replace default p font size.",
			"id" => $shortname."psize",
			"std" => "12",	
			"options" =>$fontrange,			
			"type" => "range"
			),

	array(	"name" => "Logo Text Size",
			"desc" => "Replace default logo text size.",
			"id" => $shortname."logosize",
			"std" => "36",	
			"options" =>$fontrange,
			"type" => "range"
			),

	array(	"name" => "H1 Font Size",
			"desc" => "Replace Heading H1 Font Size.",
			"id" => $shortname."h1",
			"std" => "32",	
			"options" =>$fontrange,			
			"type" => "range"
			),

	array(	"name" => "H2 Font Size",
			"desc" => "Replace Heading H2 Font Size.",
			"id" => $shortname."h2",
			"std" => "28",
			"options" =>$fontrange,			
			"type" => "range"
			),

	array(	"name" => "H3 Font Size",
			"desc" => "Replace Heading H3 Font Size.",
			"id" => $shortname."h3",
			"std" => "24",
			"options" =>$fontrange,			
			"type" => "range"
			),
	array(	"name" => "H4 Font Size",
			"desc" => "Replace Heading H4 Font Size.",
			"id" => $shortname."h4",
			"std" => "20",
			"options" =>$fontrange,			
			"type" => "range"
			),
	array(	"name" => "H5 Font Size",
			"desc" => "Replace Heading H5 Font Size.",
			"id" => $shortname."h5",
			"std" => "15",
			"options" =>$fontrange,			
			"type" => "range"
			),
	array(	"name" => "H6 Font Size",
			"desc" => "Replace Heading H6 Font Size.",
			"id" => $shortname."h6",
			"std" => "12",
			"options" =>$fontrange,			
			"type" => "range"
			),
	array(	"name" => "Top Level Menu Text Size",
			"desc" => "Top Level Menu Text Size",
			"id" => $shortname."topmenu_l1",
			"std" => "12",
			"options" =>$fontrange,			
			"type" => "range"
			),
	array(	"name" => "Sub Level Menu Text Size",
			"desc" => "Sub Level Menu Text Size",
			"id" => $shortname."submenu_l1",
			"std" => "13",
			"options" =>$fontrange,			
			"type" => "range"
			),
	array(	"name" => "Sidebar Widget Title Size",
			"desc" => "Sidebar Widget Title Size",
			"id" => $shortname."sidebar_h3",
			"std" => "22",
			"options" =>$fontrange,			
			"type" => "range"
			),
	array(	"name" => "Frontpage Teaser Text Size",
			"desc" => "Frontpage Teaser Text Size",
			"id" => $shortname."front_teasertitle",
			"std" => "22",
			"options" =>$fontrange,			
			"type" => "range"
			),
	array(	"name" => "Blog Post Title Size",
			"desc" => "Blog Post Title Size",
			"id" => $shortname."entrytitle",
			"std" => "28",
			"options" =>$fontrange,			
			"type" => "range"
			),
	array(	"name" => "Copyright Text Size",
			"desc" => "Footer Copyright Textarea Font Size",
			"id" => $shortname."copyfont_size",
			"std" => "11",
			"options" =>$fontrange,			
			"type" => "range"
			),

	array(	"type" => "close")
);
?>