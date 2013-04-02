<!-- sociables -->
<?php
if (get_option('sys_social_bookmark') != '') { 
	echo "<ul class=\"sociables\">";
if (get_option('sys_social_bookmark') != '') {
	$sys_social_bookmark_icons = explode('#;', get_option('sys_social_bookmark'));
	for($i=0;$i<count($sys_social_bookmark_icons);$i++) {	
	$sys_social_bookmark_icon = explode('#|', $sys_social_bookmark_icons[$i]);
if ($sys_social_bookmark_icon[1] == '') {
	$sys_social_bookmark_icon[1] = '#';	
}?>
<li><a href="<?php echo($sys_social_bookmark_icon[2]); ?>" title="<?php echo($sys_social_bookmark_icon[0]); ?>">
	<img src="<?php bloginfo('template_url');?>/images/followus/<?php echo($sys_social_bookmark_icon[1]); ?>" alt=""  /> </a></li>
<?php } } } echo "</ul>"; ?>
<!-- sociables -->