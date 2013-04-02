<?php

/////////////////////////////
// Custom Style Options
/////////////////////////////
function ln_theme_get_custom_color_theme_option(&$options){

$options[] = array( "name" => __("Options below will take place when 'Custom' theme color is selected.", "framework"),
					"std" => "",
					"id" => SHORT_NAME."_theme_styling_header_1",
					"type" => "styling_header");

//////////////////////////////////////////////////////////////////////////////////////////////////////
// GENERAL
//////////////////////////////////////////////////////////////////////////////////////////////////////
$options[] = array( "name" => __("General", "framework"),
					"std" => "",
					"id" => SHORT_NAME."_theme_styling_header_1",
					"type" => "styling_header");

// Accent Color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_theme_a_accent_color",
					"type" => "styling_selector",
					"selector" =>  "a:hover, #sidebar a:hover {");
		
		$options[] = array( "name" => __("Links Hover Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_links_background_color",
							"std" => "fddc7f",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " background-color: #",
							"property_end" => ";");

		$options[] = array( "name" => __("Links Hover Text Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_links_txt_color",
							"std" => "222",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

// Top Section
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_theme_top_sec_color",
					"type" => "styling_selector",
					"selector" =>  "#top-section {");
		
		$options[] = array( "name" => __("Top Section Background Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_top_sec_background_color",
							"std" => "393939",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " background-color: #",
							"property_end" => ";");

		$options[] = array( "name" => __("Top Section Border Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_top_sec_brd_color",
							"std" => "393939",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " border-bottom: solid 2px #",
							"property_end" => ";");

//////////////////////////////////////////////////////////////////////////////////////////////////////
// Navigation
//////////////////////////////////////////////////////////////////////////////////////////////////////
$options[] = array( "name" => __("Navigation", "framework"),
					"std" => "",
					"id" => SHORT_NAME."_theme_styling_header_2",
					"type" => "styling_header");

// Nav Color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_nav_txt_color",
					"type" => "styling_selector",
					"selector" =>  "nav ul li a {");
		
		$options[] = array( "name" => __("Navigation Text Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_nav_txt_color",
							"std" => "222",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

// Top Nav Color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_top_nav_txt_color",
					"type" => "styling_selector",
					"selector" =>  ".top-navigation a, #mobile-top-nav {");
		
		$options[] = array( "name" => __("Top Navigation Text Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_top_nav_txt_color",
							"std" => "fff",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

// Nav Hover Color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_nav_color",
					"type" => "styling_selector",
					"selector" =>  "nav ul li.current-menu-item > a, nav ul li a:hover, nav ul li.current_page_parent > a, #mobile-main-nav {");
		
		$options[] = array( "name" => __("Navigation Hover Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_nav_hv_background_color",
							"std" => "fddc7f",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " background-color: #",
							"property_end" => ";");

		$options[] = array( "name" => __("Navigation Hover Text Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_nav_hv_txt_color",
							"std" => "222",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

// Nav Sub menu Color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_nav_sub_color",
					"type" => "styling_selector",
					"selector" =>  "nav ul li ul {");
		
		$options[] = array( "name" => __("Sub Menu Background Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_nav_sub_color",
							"std" => "393939",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " background-color: #",
							"property_end" => ";");

// Nav Sub menu Text Color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_nav_sub_txt_color",
					"type" => "styling_selector",
					"selector" =>  "nav ul li ul a{");
		
		$options[] = array( "name" => __("Sub Menu Text Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_nav_sub_txt_color",
							"std" => "fff",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

// Top nav  mobile bg color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_top_nav_mb_bgcolor",
					"type" => "styling_selector",
					"selector" =>  "#mobile-top-nav{");
		
		$options[] = array( "name" => __("Mobile Top Navigation Background Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_bm_top_nav_bg_color",
							"std" => "393939",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " background-color: #",
							"property_end" => ";");

		$options[] = array( "name" => __("Mobile Top Navigation Text Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_bm_top_nav_txt_color",
							"std" => "fff",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

//////////////////////////////////////////////////////////////////////////////////////////////////////
// Sidebar
//////////////////////////////////////////////////////////////////////////////////////////////////////
$options[] = array( "name" => __("Sidebar", "framework"),
					"std" => "",
					"id" => SHORT_NAME."_theme_styling_header_3",
					"type" => "styling_header");

// Sidebar Background
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_sidebar_bg",
					"type" => "styling_selector",
					"selector" =>  "#sidebar { background: none; ");
		
		$options[] = array( "name" => __("Sidebar Background Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_sidebar_bg_color",
							"std" => "393939",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " background-color: #",
							"property_end" => ";");

		$options[] = array( "name" => __("Sidebar Background Pattern", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_sidebar_bg_pattern",
							"std" => "",
							"class" => "ln-upload",
							"type" => "image",
							"property" => " background: url('",
							"property_end" => "');");

// Sidebar Background
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_sidebar_txt",
					"type" => "styling_selector",
					"selector" =>  "#sidebar a, #sidebar .sidebar-widget h1, #sidebar .sidebar-widget h2, #sidebar .sidebar-widget h3, #sidebar .sidebar-widget h4, #sidebar .sidebar-widget h5, #sidebar .sidebar-widget h6  {");
		
		$options[] = array( "name" => __("Sidebar Headers And Links Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_main_sidebar_link_color",
							"std" => "fff",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

// Sidebar Background
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_sidebar_txt_color",
					"type" => "styling_selector",
					"selector" =>  "#sidebar .sidebar-widget {");
		
		$options[] = array( "name" => __("Sidebar Text Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_main_sidebar_txt_color",
							"std" => "c5c5c5",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

//////////////////////////////////////////////////////////////////////////////////////////////////////
// Blog
//////////////////////////////////////////////////////////////////////////////////////////////////////
$options[] = array( "name" => __("Blog", "framework"),
					"std" => "",
					"id" => SHORT_NAME."_theme_styling_header_4",
					"type" => "styling_header");

// Post border color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_blog_pst",
					"type" => "styling_selector",
					"selector" =>  ".ln-blog-post {");
		
		$options[] = array( "name" => __("Post Border Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_blog_post_brd_color",
							"std" => "393939",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " border-bottom: solid 5px #",
							"property_end" => ";");

// Rating Color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_pst_rating",
					"type" => "styling_selector",
					"selector" =>  ".carousel-article .rating, .rating-wrap .rating-box, .rating-numbers .criteria-score .bar {");
		
		$options[] = array( "name" => __("Rating Background Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_blog_post_rating_bgcolor",
							"std" => "fddc7f",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " background-color: #",
							"property_end" => ";");

// Single Review Post score text color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_revew_score_sng",
					"type" => "styling_selector",
					"selector" =>  ".rating-wrap .score{");
		
		$options[] = array( "name" => __("Review Score Text Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_rev_score_txt_col",
							"std" => "222",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

// Single Review Post text color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_revew_score_sng_scr",
					"type" => "styling_selector",
					"selector" =>  ".rating-wrap .rating-box{");
		
		$options[] = array( "name" => __("Review Score 'score' Text Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_rev_score_small_txt_col",
							"std" => "565656",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

// Carousel Rating Text Color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_carousel_pst_rating_txt",
					"type" => "styling_selector",
					"selector" =>  ".carousel-article .rating {");
		
		$options[] = array( "name" => __("Rating Background Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_carousel_rating_txtcolor",
							"std" => "222",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

// Pagination Hover Text Color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_pg_txt_hover_clr",
					"type" => "styling_selector",
					"selector" =>  ".ln-pagination a:hover {");
		
		$options[] = array( "name" => __("Pagination Hover Text Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_pg_hover_txtcolor",
							"std" => "222",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

//////////////////////////////////////////////////////////////////////////////////////////////////////
// Widgets
//////////////////////////////////////////////////////////////////////////////////////////////////////
$options[] = array( "name" => __("Widgets", "framework"),
					"std" => "",
					"id" => SHORT_NAME."_theme_styling_header_5",
					"type" => "styling_header");

// Post border color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_widgets_tabs",
					"type" => "styling_selector",
					"selector" =>  ".ln-tabs-wg .tabs-widget-nav li.ui-tabs-selected a, .ln-tabs-wg .tabs-widget-nav li a:hover, .tabs ul li.ui-tabs-selected a, .tabs ul li a:hover, .sidebar-widget .ln-tabs-wg .tabs-widget-nav ul li.ui-state-active a {");
		
		$options[] = array( "name" => __("Tabs Background Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_wg_tabs_bgcol",
							"std" => "fddc7f",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " background-color: #",
							"property_end" => ";");

		$options[] = array( "name" => __("Tabs Text Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_theme_wg_tabs_txtcol",
							"std" => "222",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => "!important;");

//////////////////////////////////////////////////////////////////////////////////////////////////////
// Other
//////////////////////////////////////////////////////////////////////////////////////////////////////
$options[] = array( "name" => __("Other", "framework"),
					"std" => "",
					"id" => SHORT_NAME."_theme_styling_header_6",
					"type" => "styling_header");

// Single Review Post text color
$options[] = array( "name" => "", "std" => "", "id" => SHORT_NAME."_theme_styling_selector_btn_clrs",
					"type" => "styling_selector",
					"selector" =>  "button, input[type=submit]{");
		
		$options[] = array( "name" => __("Buttons Background Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_othr_btn_bgcol",
							"std" => "fddc7f",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " background-color: #",
							"property_end" => ";");

		$options[] = array( "name" => __("Buttons Text Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_othr_btn_txtcol",
							"std" => "222",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => " color: #",
							"property_end" => ";");

		$options[] = array( "name" => __("Buttons Shadow Color", "framework"),
							"desc" => "",
							"id" => SHORT_NAME."_theme_styling_othr_btn_sdwcol",
							"std" => "e3b83d",
							"class" => "ln-input",
							"type" => "color_picker",
							"property" => array(" -moz-box-shadow: 0 3px 1px #", " -webkit-box-shadow: 0 3px 1px #", " box-shadow: 0 3px 1px #"),
							"property_end" => ";");

}// end 

?>