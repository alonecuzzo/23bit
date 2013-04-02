<?php
/**------------------------------------------
* Search form Widget Settings.
*-------------------------------------------*/

function search_form_widgets() {
	register_widget( 'searchform_widget' );
}

class searchform_widget extends WP_Widget {

function searchform_widget() {
	global $themename;
	/* Widget settings. */
	$widget_ops = array( 'classname' => 'searchform_widget', 'description' => __('A Search Form for your site  .', 'example') );

	/* Widget control settings. */
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'searchearchform_widget' );

	/* Create the widget. */
	$this->WP_Widget( 'searchearchform_widget',$themename.'-Search form', $widget_ops, $control_ops );
}

	function widget( $args, $instance ) {
		extract( $args );
		$Serachform_title = $instance['serachform_title'];

		$before_title='';
		$after_title='';
		$before_widget='<div class="syswidget">';
		$after_widget='</div>';
?>
<?php echo $before_widget;?>
<?php echo $before_title.$Serachform_title.$after_title; ?>
<div class="search-box">

	<form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
	<p><input type="text" class="search-field" name="s" id="s" value="Search" onfocus="if(this.value=='Search'){this.value=''};" onblur="if(this.value==''){this.value='Search'};" /></p>
	<p><input type="submit" class="search-go" name="h" value="" /></p>
	</form>
</div>

<?php
echo $after_widget;
}
/**
 * Update Settings.
 */
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	/* Strip tags for title and name to remove HTML (important for text inputs). */
	$instance['serachform_title'] = strip_tags( $new_instance['serachform_title'] );

	return $instance;
	}
function form( $instance ) {

 ?>
<p>
<label for="<?php echo $this->get_field_id( 'serachform_title' ); ?>"><?php _e('Title:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'serachform_title' ); ?>" name="<?php echo $this->get_field_name( 'serachform_title' ); ?>" value="<?php echo $instance['serachform_title']; ?>" type="text" style="width:100%;" />
</p>
<?php } }
add_action( 'widgets_init', 'search_form_widgets' );
 ?>