<div class="search-box">
	<form method="get" action="<?php bloginfo('url'); ?>/">
		<input type="text" size="15" class="search-field" name="s" id="s" value="<?php _e('Search..', 'versatile_front');?>" onfocus="if(this.value == 'Search..') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search..', 'versatile_front');?>';}"/>
		<input type="submit"  value="" class="search-go" /> 
	</form>
</div>