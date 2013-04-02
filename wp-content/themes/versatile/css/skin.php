<?php require_once( '../../../../wp-load.php' );
require(sys_includes."/var.php");
	Header("Content-type: text/css");
?>
<?php $slider_width=get_option('slider_width');?>
<?php $slider_height=get_option('slider_height');?>

.content table,
.content tr td,
.wp-caption, 
.gallery-item img, 
table.fancy_table, 
.video-stage, 
div.framed, 
.authorbox,
.thinframe, 
.divider_line, 
.divider, 
#sidebar .content, 
.syswidget p.tweet, 
#breadcrumbs, 
#footer, 
#wp-calendar td,
#wp-calendar th, 
#wp-calendar thead, 
.syswidget ul li a, 
#recentcomments li, 
.post-info, 
.post .entry,
#comments, 
code, 
pre, 
.fancytoggle, 
table.fancy_table, 
table.fancy_table td, 
.gallery img, 
.flickr_badge_image  img, 
.pagination, 
.widget_postslist li, 
ul.tabs, 
ul.tabs a, 
.tab_content, 
.fancybox, 
.minimalbox 
.boxcontent, 
.minimalbox, 
.framedbox .boxcontent        { <?php echo ($bordercolor ? 'border-color:'.$bordercolor.';'.'':'');  ?> }

body                          { <?php echo ($pagebgcolor ? 'background-color:'.$pagebgcolor.';'.'':'');  ?><?php echo ($psize ? 'font-size:'.$psize.'px; '.'':''); ?> }
body, body p                  { <?php echo ($paracolor ? 'color:'.$paracolor.';'.'':''); echo ($psize ? 'font-size:'.$psize.'px; '.'':''); ?> }

h1                            { <?php echo ($h1 ? 'font-size:'.$h1.'px; '.'':''); echo ($h1color ? 'color:'.$h1color.';'.'':'');  ?> }
h2                            { <?php echo ($h2 ? 'font-size:'.$h2.'px; '.'':''); echo ($h2color ? 'color:'.$h2color.';'.'':'');  ?> }
h3                            { <?php echo ($h3 ? 'font-size:'.$h3.'px; '.'':''); echo ($h3color ? 'color:'.$h3color.';'.'':'');  ?> }
h4                            { <?php echo ($h4 ? 'font-size:'.$h4.'px; '.'':''); echo ($h4color ? 'color:'.$h4color.';'.'':'');  ?> }
h5                            { <?php echo ($h5 ? 'font-size:'.$h5.'px; '.'':''); echo ($h5color ? 'color:'.$h5color.';'.'':'');  ?> }
h6                            { <?php echo ($h6 ? 'font-size:'.$h6.'px; '.'':''); echo ($h6color ? 'color:'.$h6color.';'.'':'');  ?> }

.nav a                        { <?php echo ($topmenu_l1 ? 'font-size:'.$topmenu_l1.'px; '.'':''); ?> }
.nav li ul a                  { <?php echo ($submenu_l1 ? 'font-size:'.$submenu_l1.'px; '.'':''); ?> }

#sidebar h3                   { <?php echo ($sidebar_h3 ? 'font-size:'.$sidebar_h3.'px; '.'':''); ?> }

.infobox .teaser,
.infobox .teaserfull          { <?php echo ($front_teasertitle ? 'font-size:'.$front_teasertitle.'px; '.'':''); ?> line-height:normal; }

body#stretched #header        { <?php $bg_img=get_option('bg_img'); 
	if($bg_img) {?>background-image:url(<?php echo $bg_img ?>); 
	<?php } ?> 
	background-position:<?php echo $bgposition ?>; 
	background-repeat:<?php echo $bg_repeat ?>;
	}
body#boxed #header            { <?php $bg_img=get_option('bg_img'); 
	if($bg_img) {?>background-image:url(<?php echo $bg_img ?>); <?php } ?> 
	background-position:<?php echo $bgposition ?>; 
	background-repeat:<?php echo $bg_repeat ?>;
	}

body#boxed                    { <?php $boxed_image=get_option('boxed_image'); 
	if($boxed_image) {?>background-image:url(<?php echo $boxed_image ?>); <?php } ?> 
	background-position:<?php echo get_option('boxed_position'); ?>; 
	background-color: transparent;
	background-repeat:<?php echo get_option('boxed_repeat') ?>;
	background-attachment:<?php echo get_option('boxed_attachment'); ?>;
	}

.logo a, .logo a:hover        { <?php echo ($logosize ? 'font-size:'.$logosize.'px; '.'':''); echo ($logotextcolor ? 'color:'.$logotextcolor.'; '.'':''); ?> }

body#boxed, 
#header,
.copyright,  
.fancyheading span,  
table.fancy_table th, 
.button                       { <?php echo ($themecolor ? 'background-color:'.$themecolor.';'.'':'');  ?> } 

#header                       { <?php echo ($headercolor ? 'background-color:'.$headercolor.';'.'':'');  ?> } 

body#boxed #header            { <?php echo ($boxedheadercolor ? 'background-color:'.$boxedheadercolor.';'.'':'');  ?> } 

#subheader                    { <?php echo ($subheaderbgcolor ? 'background-color:'.$subheaderbgcolor.';'.'':'');  ?> }

a                             { <?php echo ($linkcolor ? 'color:'.$linkcolor.';'.'':'');  ?>}
a:hover, 
strong, 
.breadcrumbs a:hover, 
.post h2  a:hover             { <?php echo ($linkhoverhover ? 'color:'.$linkhoverhover.';'.'':'');  ?> } 

.subheader a                  { <?php echo ($subheaderlinkcolor ? 'color:'.$subheaderlinkcolor.';'.'':'');  ?>}
.nav li a                     { <?php echo ($navlinkcolor ? 'color:'.$navlinkcolor.';'.'':'');  ?> }
.nav ul li a                  { <?php echo ($subnavlinkcolor ? 'color:'.$subnavlinkcolor.';'.'':'');  echo ($subnavbgcolor ? 'background:'.$subnavbgcolor.';'.'':'');?>}
.nav ul li a                  { <?php echo ($subnavbrcolor ? 'border-color:'.$subnavbrcolor.';'.'':'');  ?> }
.nav ul li a:hover            { <?php echo ($subnavhovercolor ? 'background:'.$subnavhovercolor.';'.'':'');  ?> }

#footer                       { <?php 
	echo ($footerbgcolor ? 'background-color:'.$footerbgcolor.'; '.'':''); 
	echo ($footerbordertopcolor ? 'border-top:'.$footerbordertopcolor.' 1px solid ;'.'':'');  ?>
	}
#footer,
#footer p                     { <?php echo ($footertextcolor ? 'color:'.$footertextcolor.';'.'':'');  ?> }
#footer a,
#footer #wp-calendar, 
#footer #wp-calendar caption, 
#footer #wp-calendar th, 
#footer #wp-calendar td       { <?php echo ($footerlinkcolor ? 'color:'.$footerlinkcolor.';'.'':'');  ?>}

#footer a:hover               { <?php echo ($footerlinkhovercolor ? 'color:'.$footerlinkhovercolor.';'.'':'');  ?>}

.breadcrumbs                  { <?php echo ($breadtextcolor ? 'color:'.$breadtextcolor.';'.'':'');  ?> }
.breadcrumbs a                { <?php echo ($breadlinkcolor ? 'color:'.$breadlinkcolor.';'.'':'');  ?> }

.header_highlight h1          { <?php echo ($headerbigtextcolor ? 'color:'.$headerbigtextcolor.';'.'':'');  ?>}
.header_highlight h4,
.header_highlight p           { <?php echo ($headersmalltextcolor ? 'color:'.$headersmalltextcolor.';'.'':'');  ?>}

.copyright                    { <?php 
	echo ($copybgcolor ? 'background-color:'.$copybgcolor.';'.'':'');  
	echo ($copytextcolor ? 'color:'.$copytextcolor.';'.'':'');  
	echo ($copyfont_size ? 'font-size:'.$copyfont_size.'px; '.'':''); ?>
	}

h2.entry-title                { <?php echo ($entrytitle ? 'font-size:'.$entrytitle.'px; '.'':''); ?> }
h2.entry-title a              { <?php echo ($entrytitlecolor ? 'color:'.$entrytitlecolor.'; '.'':''); ?> }
h2.entry-title a:hover        { <?php echo ($linkhoverhover ? 'color:'.$linkhoverhover.'; '.'':''); ?> }

#footer h3                    { <?php echo ($footerheadingcolor ? 'color:'.$footerheadingcolor.'; '.'':''); ?> }

<?php 
$extracss=get_option("extracss");
echo $extracss;
?>