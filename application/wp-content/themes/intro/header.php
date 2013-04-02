<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Intro
 * @since Intro 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<?php do_action( 'before' ); ?>
	
	<header>
		<div class="mobile-menu">
			<form action="#">
				<fieldset>
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'walker'         => new Intro_Walker_Nav_Menu_Dropdown(),
							'items_wrap'     => '<select class="sel">%3$s</select>',
						) );
					?>
				</fieldset>
			</form>
		</div>
		
		<h1 class="logo">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php 
				$header_image = get_header_image();
				if ( ! empty( $header_image ) ) :
			?>
				<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
			<?php endif; ?>
			
			<?php if ( 'blank' != get_header_textcolor() ) : ?>
				<?php bloginfo( 'name' ); ?>
			<?php endif; ?>
			</a>
		</h1>
		
		<?php 
			wp_nav_menu( array(
				'container'       => 'nav',
				'container_class' => 'menu',
				'theme_location'  => 'primary' 
			) ); 
		?>
	</header><!-- / header -->
	