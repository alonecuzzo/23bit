<?php
/*
Template Name: Right Nav
*/
?>
<?php get_header(); ?>
</div><!-- header-area -->
</div><!-- end rays -->
</div><!-- end header-holder -->
</div><!-- end header -->

<?php truethemes_before_main_hook();// action hook, see truethemes_framework/global/hooks.php ?>

<div id="main">
<?php get_template_part('theme-template-part-tools','childtheme'); ?>

<div class="main-holder">
<?php  
//retrieve value for sub-nav checkbox
global $post;
$post_id = $post->ID;
$meta_value = get_post_meta($post_id,'truethemes_page_checkbox',true);

if(empty($meta_value)){
get_template_part('theme-template-part-subnav-right','childtheme');
}else{ ?>

<div id="sub_nav"  class="nav_right_sub_nav">
<?php generated_dynamic_sidebar(); ?>
</div><!-- end sub_nav -->
<?php } ?>


<div id="content" class="content-right-nav">
<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
comments_template('/page-comments.php', true);
get_template_part('theme-template-part-inline-editing','childtheme'); ?>
</div><!-- end content -->
</div><!-- end main-holder -->
</div><!-- main-area -->

<?php get_footer(); ?>