<!doctype html>  
  
<html <?php language_attributes(); ?>>  
<head>  
    
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php ln_get_responsive_viewport(); ?>
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
    <?php ln_get_color_theme(); ?>
    <?php ln_get_responsive_css(); ?>
    
    <!-- Fonts -->
   <?php ln_get_fonts(); ?>
    
    <!-- Pingback -->
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php ln_get_favicon(); ?>
  
	<!-- RSS -->
	<?php ln_get_rss(); ?>
	
   	<!-- Header Hook -->
	<?php wp_head(); ?>
	
</head>  
<body <?php body_class();?> >  

    <?php ln_get_custom_background(false); ?>

    <section id="wrapper">

        <!-- Top Section -->
        <section id="top-section">
            
            <nav id="top-nav" class="top-navigation">
                <?php 
                
                    if(has_nav_menu('secondary')){

                        // top nav
                        wp_nav_menu(array('theme_location' => 'secondary', 'container' => false)); 
                    }

                ?> 
            </nav>

            <?php 

                if(has_nav_menu('secondary')){

                    // mobile top nav
                    wp_nav_menu(array('theme_location' => 'secondary',
                                      'container' => false,
                                      'items_wrap' => '<select id="mobile-top-nav" class="responsive-menu"><option value="#">'.__(' - Top Navigation', 'framework').'</option> %3$s </select>',
                                      'walker' => new Ln_Responsive_Nav_Menu_Walker() 
                                ));
                }

            ?>

            <div class="main-social-icons">
                <?php ln_get_main_social_icons() ?>
            </div>
            <div class="clear"></div>

        </section>

        <section id="main-content">
            
            <!-- Header -->
            <header id="main-header">
                <div id="logo">
                    <?php ln_get_logo(); ?>
                    <?php ln_get_slogan(); ?>
                </div>
                <?php ln_get_header_banner(); ?>
            </header>

            <!-- Navigation -->
            <nav id="main-nav-wrapper">
                <?php 
                    
                    // main nav
                    wp_nav_menu(array('theme_location' => 'primary', 'items_wrap' => '<ul id="main-nav" class="%2$s">%3$s</ul>'));

                    if(has_nav_menu('primary')){
                        
                        // mobile main nav
                        wp_nav_menu(array(  'theme_location' => 'primary',
                                            'container' => false,
                                            'items_wrap' => '<select id="mobile-main-nav" class="responsive-menu"><option value="#">'.__(' - Navigation', 'framework').'</option> %3$s </select>',
                                            'walker' => new Ln_Responsive_Nav_Menu_Walker() 
                                )); 
                    }
                
                ?>
                <div class="main-search">
                    <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="text" name="s" value="Search." onfocus="if(this.value==this.defaultValue){this.value=''}" onblur="if(this.value==''){this.value=this.defaultValue}"/>
                        <input type="submit" id="main-search-button" class="main-search-button" value=""/>
                    </form>
                </div>
            </nav>
            <div class="clear"></div>