<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'versatile' ), max( $paged, $page ) );

	?>
</title>
<?php require_once(sys_includes."/var.php"); ?>

<?php if(is_front_page()) { ?>
<meta name="slider_url" content="<?php bloginfo('template_directory'); ?>">
<meta name="slider_type" content="<?php echo get_option("sys_choose_slider"); ?>">
<meta name="nivo_slider_effect" content="<?php echo get_option('nivoslidereffect'); ?>">
<?php } ?>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php if($favicon) { ?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>" type="image/x-icon" /> 
<?php } ?>

<!--[if IE]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/ie.css" />
<![endif]-->
	
<!--[if lt IE 9]>
<script src="<?php bloginfo('template_url'); ?>/lib/scripts/html5.js"></script>
<![endif]-->
<?php 
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); 
	
	wp_head(); 
?>

<?php if($default_colors!='0'){ ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/colors/<?php echo $default_colors;?>" media="screen" />
<?php }else{ ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/colorscheme.css" media="screen" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/skin.php" media="screen" />

</head>
<body id="<?php if ($layoutoptions){ echo $layoutoptions;} else { echo get_option('layoutoption'); }?>">
<!-- #wrap-all -->
<div id="wrap-all">
	<header id="header">
		<div id="topbar">
			<div class="inner">
	
			<div class="logo">
				<?php if($s_logo){ ?>
				<a href="<?php echo get_option('home'); ?>" title="<?php bloginfo('name'); ?>">
				<img src="<?php echo $s_logo; ?>" alt="<?php bloginfo('name'); ?>" />
				</a>
				<?php } else { ?>
				<a href="<?php echo get_option('home'); ?>" title="<?php bloginfo('name'); ?>">
				<?php bloginfo('name'); ?>
				<span class="blogdesc"><?php bloginfo('description'); ?></span>	
				</a>
				<?php } ?>
			</div>
			<!-- /.logo -->

            <div class="topmenu">
	        	<?php if (has_nav_menu( 'top-menu' ) ) { wp_menu_functon(); }
				else{?>
				<ul class="nav">
	            <li><a href="<?php echo get_option('home'); ?>" title="<?php
	bloginfo('name'); ?>">Home<span>Frontpage</span></a></li>
				<?php wp_list_pages('title_li=');echo "</ul>"; } ?>
            </div>
            <!-- /.topmenu -->
	
			</div>
			<!-- /.inner -->
		</div><!-- /.topbar -->
		<div class="clear"></div>