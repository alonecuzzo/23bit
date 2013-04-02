<?php
function systheme_add_admin() {

    global $themename, $shortname, $options,$sys_version;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {
		
			// header teaser text update
			update_option('sys_header_teaser', $_REQUEST['sys_header_teaser'] );
			update_option('sys_header_teasertext', $_REQUEST['sys_header_teasertext'] );
			update_option('sys_twitter_teaser_username', $_REQUEST['sys_twitter_teaser_username'] );
			update_option('layoutoption', $_REQUEST['layoutoption'] );
			update_option('boxed_repeat', $_REQUEST['boxed_repeat'] );	
			update_option('boxed_attachment', $_REQUEST['boxed_attachment'] );
			update_option('boxed_position', $_REQUEST['boxed_position'] );	
			update_option('nivoslidereffect', $_REQUEST['nivoslidereffect'] );
			update_option('nivo_header_highlight', $_REQUEST['nivo_header_highlight'] );
			update_option('video_header_highlight', $_REQUEST['video_header_highlight'] );
			update_option('sys_choose_slider', $_REQUEST['sys_choose_slider'] );
			update_option('piecemaker_id', $_REQUEST['piecemaker_id'] );
			
			update_option('nivodisplayimage', $_REQUEST['nivodisplayimage'] );
			update_option('sys_video', $_REQUEST['sys_video'] );
			
			update_option('slider_width', $_REQUEST['slider_width'] );
			update_option('slider_height', $_REQUEST['slider_height'] );
			update_option('bg_img', $_REQUEST['bg_img'] );
			update_option('link_hover', $_REQUEST['link_hover'] );

			if(isset($_POST['social_save'])){
			update_option('sys_social_bookmark', $_REQUEST['sys_social_bookmark'] );
			}
			
			update_option('versatile_content', $_REQUEST['content'] );
			update_option('displayimage', $_REQUEST['displayimage'] );
			 update_option("wpcuf_code", $_POST['wpcuf_code']);
			update_option("enable_font", $_POST['enable_font']);


                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=admin_interface.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=admin_interface.php&reset=true");
            die;

        }
    }

    add_menu_page($themename, "".$themename,'edit_themes', basename(__FILE__), 'systheme_admin',get_template_directory_uri() . '/lib/admin/images/adminicon.gif');
}

function systheme_admin() {
global $themename, $shortname, $options,$sys_version;
    if ( $_REQUEST['saved'] ) $msgsetting='<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
 if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
require_once(sys_admin_js_folder.'/admin.php'); ?>
<div id="syspanel-wrap">
<div id="syspanel-container">
<div class="qhead">
  <div class="logo"><img src="<?php echo bloginfo('template_url'); ?>/lib/admin/images/logo.png" width="200" height="171" alt="sysPanel" /></div>
	<div class="information">
		<div class="content">
		<h2><?php echo $themename; ?> Wordpress Theme - <span class="yellowtext">Version <?php echo $sys_version; ?></span></h2>
<p>Themeforest : <a href="http://themeforest.net/user/system32/portfolio?ref=system32" class="">View Portfolio</a> - 
			Website : <a href="http://themeflash.com" class="">www.themeflash.com</a>

    <?php echo $msgsetting; ?>
			</div>
		</div>
	</div>

<form method="post" id="myform" >
<div id="maincontent">
<div id="sysnav">
<div id="vtabs">
<ul class="tabs_nav">
<li><a href="#generalsetting"><img src="<?php echo bloginfo('template_url'); ?>/lib/admin/images/general-icon.png" width="24" height="24" alt="" />General</a></li>
<li><a href="#Homepage"><img src="<?php echo bloginfo('template_url'); ?>/lib/admin/images/home-icon.png" width="24" height="24" alt="" />Homepage</a></li>
<li><a href="#Colors"><img src="<?php echo bloginfo('template_url'); ?>//lib/admin/images/colors-icon.png" width="24" height="24" alt="" />Colors</a></li>
<li><a href="#homepagesliders"><img src="<?php echo bloginfo('template_url'); ?>/lib/admin/images/slider-icon.png" width="24" height="24" alt="" />Slider Options</a></li>
<li><a href="#fonts"><img src="<?php echo bloginfo('template_url'); ?>/lib/admin/images/font-icon.png" width="24" height="24" alt="fonts" />Fonts</a></li>
<li><a href="#Footer"><img src="<?php echo bloginfo('template_url'); ?>/lib/admin/images/footer-icon.png" width="24" height="24" alt="" />Footer</a></li>
<li><a href="#SocialSites"><img src="<?php echo bloginfo('template_url'); ?>/lib/admin/images/social-icon.png" width="24" height="24" alt="" />Sociables</a></li>
<li><a href="#widget"><img src="<?php echo bloginfo('template_url'); ?>/lib/admin/images/widgets-icon.png" width="24" height="24" alt="" />Custom Sidebars</a></li>
<li><a href="#postoptions"><img src="<?php echo bloginfo('template_url'); ?>/lib/admin/images/general-icon.png" width="24" height="24" alt="" />Post Options</a></li>
<li><a href="#Typography"><img src="<?php echo bloginfo('template_url'); ?>/lib/admin/images/typo-icon.png" width="24" height="24" alt="" />Typography</a></li>
<li><a href="#Language"><img src="<?php echo bloginfo('template_url'); ?>/lib/admin/images/lang-icon.png" width="24" height="24" alt="" />Language</a></li>
</ul>
</div>
</div>
<?php require_once(sys_admin."/option_page.php"); ?>
<div class="clear"></div>
<div class="foot">
	<p class="submit">
	<input name="save" class="button-secondary" type="submit" value="Save all changes" />
	<input type="hidden" name="action" value="save" />
	</p>
</form>
</div>
</div>
<?php }
add_action('admin_menu', 'systheme_add_admin'); 
?>
<?php	if ($_GET['activated']){
if(get_option("footerwidgetcount") == false ) {
$footerwidgetcount="4";
update_option(footerwidgetcount,$footerwidgetcount);
}
if(get_option("slidervisble") == false ) {
	$slidervisble="true";
update_option(slidervisble,$slidervisble);	
}
if(get_option("navmenu") == false ) {
	$navmenu="true";
update_option(navmenu,$navmenu);	
}
if(get_option("cufonenable") == false ) {
	$cufonenable="true";
update_option(cufonenable,$cufonenable);	
}
if(get_option("breadcrumbs") == false ) {
	$breadcrumbs="true";
update_option(breadcrumbs,$breadcrumbs);	
}
if(get_option("home_teaser") == false ) {
	$home_teaser="[one_third] [button link=\"http://wpdemo.bannersmonster.com/versatile/?page_id=3019\" size=\"large\" bgcolor=\"#00b4ff\"] Get Started [/button][/one_third] [two_third_last]<h3>Change this header background from theme options panel.</h3>[/two_third_last]";
update_option(home_teaser,$home_teaser);	
}
if(get_option("footer_sidebar") == false ) {
	$footer_sidebar="true";
	update_option(footer_sidebar,$footer_sidebar);	
}
if(get_option("left_footer") == false ) {
$left_footer="(C) 2010 Versatile - Business & Portfolio Wordpress Theme by system32";
update_option(left_footer,$left_footer);
}
if(get_option("layoutoption") == false ) {
$layoutoption="stretched";
update_option(layoutoption,$layoutoption);
}
if(get_option("commentstemplate") == false ) {
$commentstemplate="both";
update_option(commentstemplate,$commentstemplate);
}
if(get_option("defaultsidebaroption") == false ) {
$defaultsidebaroption="leftsidebar";
update_option(defaultsidebaroption,$defaultsidebaroption);
}
if(get_option("nivo_header_highlight") == false ) {
$nivo_header_highlight="<h1>Super Flexible Wordpress Theme</h1>
<h4>The ultimate all-in-one template. With over 40 unique style variations to choose from your website.</h4>
 [button size=\"large\" bgcolor=\"#db004c\"] BUY THIS THEME NOW! [/button]";
update_option(nivo_header_highlight,$nivo_header_highlight);
}
if(get_option("versatile_content") == false ) {
$content="
[one_half]
<h2>Why Versatile?</h2>
<p>Versatile is a Powerful &amp; Professional Wordpress theme suitable for almost any other kind of website. Versatile admin panel gives you full control over every major design element throughout your site.</p>
<p>Versatile admin panel comes with the color and font options where you can customize you website more than you could ever imagine. Take a look at the list of features.</p>
[button link=\"http://wpdemo.bannersmonster.com/versatile/?page_id=3017\" size=\"large full\" bgcolor=\"#3ba600\"]Options Panel Preview [/button]
[/one_half]
[one_half_last]
<h2>Versatile Speciality</h2>
[list style=\"check\"]
<ul>
	<li>Built in HTML5</li>
	<li>Easy to change background</li>
	<li>Unlimited Color Optionr</li>
	<li>Typography Size Changable</li>
	<li>Customizable Footer Widgets</li>
	<li>Left and Right Sidebars</li>
	<li>Custom Sidebars</li>
	<li>Custom post types for Slider &amp; Portfolio</li>
</ul>
[/list]
[/one_half_last]
";
update_option(versatile_content,$content);
}

if(get_option("teaserbox") == false ) {
$teaserbox="true";
update_option(teaserbox,$teaserbox);
}
if(get_option("enable_font") == false ) {
	$enable_font = Array('Segan.js'); 
	update_option(enable_font,$enable_font);	
}
if(get_option("enable_font") == false ) {
	$enable_font = Array('Segan.js'); 
	update_option(enable_font,$enable_font);	
}
if(get_option("timthumboption") == false ) {
$timthumboption="enable";
update_option(timthumboption,$timthumboption);
}

if(get_option("sys_header_teasertext") == false ) {
$sys_header_teasertext="Custom teaser text editable via theme options panel";
update_option(sys_header_teasertext,$sys_header_teasertext);
}

if(get_option("homepagelayout") == false ) {
$homepagelayout="rightsidebar";
update_option(homepagelayout,$homepagelayout);
}
if(get_option("sys_homepages") == false ) {
$sys_homepages="None";
update_option(sys_homepages,$sys_homepages);
}
wp_redirect(admin_url("admin.php?page=admin_interface.php"));
}
?>