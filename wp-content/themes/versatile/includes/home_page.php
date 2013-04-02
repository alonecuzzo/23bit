<?php
query_posts("page_id=$sys_homepages");	
while (have_posts()) : the_post(); 
?>
<h2><?php the_title(); ?></h2> 
<?php
	global $more; $more = 0; 
	the_content('Continue Reading'); 
endwhile; 
wp_reset_query();
?>