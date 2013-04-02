<?php
require(sys_includes."/var.php");
	$f=0;  
	for($s=1; $s<=$footerwidgetcounts; $s++) {
	$f++; global $fclass,$footerwidgetcounts;
	$flast = ($f == $footerwidgetcounts && $footerwidgetcounts != 1) ? 'last' : '';
	echo'<div class="'.$fclass.' '. $flast.'">';
	echo   "<div class=\"footer_column\"><div class=\"syswidget\">";
   	if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footercolumn'.$s)) :?>
		<h3>Main Links</h3>
		<ul>
			<li><a href="#">Home </a></li>
			<li><a href="#">About Us</a></li>
			<li><a href="#">Services</a></li>
			<li><a href="#">Portfolio </a></li>
			<li><a href="#">Blog</a></li>
			<li><a href="#">Contacts </a></li>
		</ul>
<?php endif; echo "</div></div></div>";	} ?>