<?php
/*** PORTFOLIO
------------------------------*/
function port_portfolio ($atts, $content = null) {
	extract(shortcode_atts(array(
	    'id'      => '2',
        'images'      =>'5',
         'column'      =>'1',
         'style'      =>'link',
        
    ), $atts));
if($column == '5') { $class="one_fifth";}	
if($column == '4') { $class="one_fourth";}
if($column == '3') { $class="one_third";}
if($column == '2') { $class="one_half";}
if($column == '1') { $class="two_third";}
if($column == '5') { $width="154"; $height="250"; }
if($column == '4') { $width="202"; $height="150"; }
if($column == '3') { $width="284"; $height="250"; }
if($column == '2') { $width="447"; $height="250"; }
if($column == '1') { $width="610"; $height="360"; }

global $post, $wpdb;
$c=0;
$out .= '<div class="portfolio_item">';
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts("post_type=portfolio&taxonomy=portfolio_type&posts_per_page=$images&term=$id&paged=$paged");
if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); 
$c++;
$last = ($c == $column && $column != 1) ? 'last ' : ''; ?>
<?php $out.='<div class="'.$class.' '. $last.'">'; ?>

<?php		
$img = get_post_meta(get_the_id(), "post_image",true);
$fullimg = get_post_meta(get_the_id(), "post_fullimg", true);
$timthumboption=get_option("timthumboption");
$post_title = get_the_title(get_the_id());
$my_date = get_the_time('M j, Y', get_the_id());
$permalink = get_permalink(get_the_id());
$portfolio_teasertext=get_post_meta(get_the_id(), 'portfolio_teasertext',true);
$portfolio_readmore=get_post_meta(get_the_id(),'portfolio_readmore',true);
$portfolio_link=get_post_meta(get_the_id(), 'portfolio_link',true);
$radio_coptions=get_post_meta(get_the_id(), 'radio_coptions',true);
$portfoliotype_options = get_post_meta(get_the_id(), "portfoliotype_options", TRUE);
$video_link = get_post_meta(get_the_id(), "video_link", TRUE);
$readmore_str = __('Read more &rarr;','versatile_front');
$visitsite_str = __('Visit Site &rarr;','versatile_front');
$nopage_str = __('Sorry but we could not find what you were looking for. But don\'\t give up, keep at it','versatile_front');

if($portfoliotype_options == "posttype_link")
{
	switch($radio_coptions) {
	case "linkpage":
		$href=get_page_link(get_post_meta(get_the_id(), "slider_c_page", TRUE));
		break;
	case "linktocategory":
		 $href=get_category_link(get_post_meta(get_the_id(), "slider_c_cat", TRUE));
		break;
	case "linktopost":
		$href=get_permalink(get_post_meta(get_the_id(), "slider_c_post", TRUE));
		break;
	case "linkmanually":
		$href=get_post_meta(get_the_id(), "slider_c_manually", TRUE);
		break;
	}
}
if (has_post_thumbnail()) {
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', true);
	if($portfoliotype_options == "posttype_image")
		{
		$href =  get_post_meta(get_the_id(), 'post_fullimg', true);
			if(empty($href)){
				$href = $image[0];
			}
			$rel = ' rel="prettyPhoto[mixed]"';
	}
	if($portfoliotype_options == "posttype_video")
		{
		$href =  get_post_meta(get_the_id(), 'video_link', true);
			if(empty($href)){
				$href = $image[0];
			}
			$rel = ' rel="prettyPhoto[mixed]"';
		}
}
	$out.='<div class="portfolio">';
	$out.='<div class="portimg" style="height:'.$height.'px;">'; 
	$out.='<div class="porthumb"><a '.$rel.' href="' . $href . '" title="' . get_the_title() . '">';
$timthumboption=get_option('timthumboption'); if($timthumboption == "enable") {
	$out.='<img class="image" src="'.get_template_directory_uri().'/timthumb.php?src=' .$image[0]. '&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1&amp;q=100"  />';
}else{ $postcolumn=$column.'_column'; 	$out.=get_the_post_thumbnail($post->ID,$postcolumn); 
 }
$out.='</a></div>';
	$out.='<div class="drop_shadow"><img src="'.get_template_directory_uri().'/images/drop_shadow.png" width="'.$width.'"/></div></div>';
	if($column== "1") {
		$out.="</div>"; } 
	if($column != "1") { 
		global $title;
		$out.='<div class="content">';
		$out.='<h5>'. $post_title. '</h5>';
		if($column != "5"){ 
			$out.='<p>'.wp_html_excerpt(get_the_excerpt(''),100).'</p>'; 
		}
		if($portfolio_readmore != "portfolio_readmore"){ 
			$out.='<a class="more-link" href="' .$permalink. '"><span>'.$readmore_str.'</span></a>&nbsp;';
		}
if($portfolio_link) {	
			$out.='<a class="more-link" href="' .$portfolio_link. '"><span>'.$visitsite_str.'</span></a>'; 
		}
		$out.='</div>';
		$out.='</div>';
		$out.='</div>';
	} 
?>
<?php if($column== "1")  { 
	$out.='</div><div class="one_third last"><div class="port_content">';
	$out .= '<h3>'. $post_title. '</h3><span class="p_date">'.$my_date.'</span>';
	
			$out .= '<p>' .get_the_excerpt(). '</p>'; 
	
		if($portfolio_readmore != "portfolio_readmore"){ 
			$out .= '<a class="more-link" href="' .get_permalink(). '"><span>'.$readmore_str.'</span></a>&nbsp;';	
		}
if($portfolio_link) {	 
			$out .= '<a class="more-link" href="' .$portfolio_link. '"><span>'.$visitsite_str.'</span></a>'; 
		}
	$out.='</div></div>';	
	} 
?>

<?php if($c == $column){
	$c = 0;
	$out.="<div class=\"divider_space\"></div>";
	}
endwhile; ?>

<?php else :
	$out.='<h2>'.$nopage_str.'</h2>';
	endif; 
	$out .='</div>';
	$out.='<div class="clear"></div>';
$out.=portfolio_pagination();
wp_reset_query();
return $out;
?>
<?php } add_shortcode('portfolio','port_portfolio'); ?>
<?php
function portfolio_pagination($range =1)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         $out.="<div class='pagination wp-pagenavi'>";
				$out.="<span class='pages'>";
			$out.="Page ".$paged."  of  ".$pages;
			$out.="</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) $out.="<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) 
		$out.="<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 $out.=($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) $out.="<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $out.="<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         $out.= "</div>\n";
     }
return $out;
}
?>