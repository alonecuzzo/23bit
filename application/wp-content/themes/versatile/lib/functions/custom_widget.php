<?php
/**
 * Default Sidebar and Homepage Sidebar
 */
if(function_exists('register_sidebar')){

	register_sidebar( array(
		'name'			=> __( 'Default Sidebar', 'atp_admin' ),
		'id'			=> 'defaultsidebar',
		'before_title'	=>'<h3>',
		'after_title'	=>'</h3>',
		'before_widget'	=>'<div class="clearfix syswidget">',
		'after_widget'	=>'</div>',
	));
	
	register_sidebar(array(
		'name'			=> 'Home Page',
		'id'			=>'home_page_widget',
		'description'	=> __('Select only one widget which will appear on your homepage Sidebar.', 'example'),
		'before_title'	=>'<h3>',
		'after_title'	=>'</h3>',
		'before_widget'	=>'<div class="syswidget">',
		'after_widget'	=>'</div>',	
	));
}

/**
 * Footer Widgets
 */
if(function_exists('register_sidebar')){
	$footerwidgetcount=get_option("footerwidgetcount");
	for($i=1; $i<=$footerwidgetcount; $i++) {
		register_sidebar(array(
			'name'			=> 'Footer Column' .$i,
			'id'			=>'footercolumn'.$i,
			'description'	=> __('Select only one widget which will appear on your Footer column'.$i, 'example'),
			'before_widget'	=>'',
			'after_widget'	=>'',
			'before_title'	=>'<h3>',
			'after_title'	=>'</h3>',
		));
	}
}

/**
 * Custom Sidebar function Generates Sidebars based on the name defined
 */
if ( function_exists('register_sidebar') ) {
	$atp_template_custom_widget = get_option('customsidebar');
	if(is_array($atp_template_custom_widget)) {
		foreach ($atp_template_custom_widget as $page_name){
			if($page_name != "")
			register_sidebar(array(
				'name'			=> $page_name,
				'id'			=> 'sidebar-'.strtolower(preg_replace('/\s+/', '-', $page_name)),
				'before_title'	=> '<h3>',
				'after_title'	=> '</h3>',
				'before_widget'	=> '<div class="syswidget">',
				'after_widget'	=> '</div>',
			));
		}
	}
}

/**
 * Load Custom Widgets
 */
require_once(sys_functions."/widget/contactform.php");
require_once(sys_functions."/widget/contactinfo.php");
require_once(sys_functions."/widget/flickr.php");
require_once(sys_functions."/widget/popularpost.php");
require_once(sys_functions."/widget/recentpost.php");
require_once(sys_functions."/widget/sub_navigation.php");
require_once(sys_functions."/widget/searchform.php");
require_once(sys_functions."/widget/twitter.php");
require_once(sys_functions."/widget/advertisement.php");
require_once(sys_functions."/widget/gmap.php");
?>