<?php
/**
 * 'contactinfo_Widget' is the widget class used below.
 */
function contactinfo_widgets() {
	register_widget( 'contactinfo_widgets' );
}
class contactinfo_widgets extends WP_Widget {

	/**
	 * contactinfo widget setup.
	 */
	function contactinfo_widgets() {
global $themename;
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'contactinfo_widgets', 'description' => __('Add Contactinfo to your sidebar  .', 'example') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contactinfo_widgets' );

		/* Create the widget. */
		$this->WP_Widget( 'contactinfo_widgets',$themename.'-Contact Info', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
	$contactinfo_title = $instance['contactinfo_title'];
	$syscontact_name = $instance['syscontact_name'];
	$syscontact_address = $instance['syscontact_address'];
	$syscontact_city = $instance['syscontact_city'];
	$syscontact_state = $instance['syscontact_state'];
	$syscontact_zip = $instance['syscontact_zip'];
	$syscontact_phone = $instance['syscontact_phone'];
	$syscontact_email = $instance['syscontact_email'];

		/* Our variables from the widget settings. */
			/* Before widget (defined by themes). */
$before_title='<h3>';
$after_title='</h3>';
$before_widget='<div class="contactinfo">';
$after_widget='<div class="clear"></div></div>';
?>
<?php echo $before_widget;?>
<?php echo $before_title.$contactinfo_title.$after_title; ?>
<?php
if($syscontact_name)
{
echo '<span class="author-icon">'.$syscontact_name.'</span><br />';
}
if($syscontact_address)
{
echo '<span class="address-icon">'.$syscontact_address.'</span><br />';
}
if($syscontact_city)
{
echo '<span>'.$syscontact_city.'</span><br />';
}
if($syscontact_state)
{
echo '<span>'.$syscontact_state.'</span><br />';
}
if($syscontact_zip)
{
echo '<span>'.$syscontact_zip.'</span><br />';
}
if($syscontact_phone)
{
echo '<span class="phone-icon">'.$syscontact_phone.'</span><br />';
}
if($syscontact_email)
{
echo '<span class="email-icon">'.$syscontact_email.'</span><br />';
}
?>
<?php
	/* After widget (defined by themes). */
	echo $after_widget;
}
/**
 * Update the Contact Widget Settings.
 */
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	/* Strip tags for title and name to remove HTML (important for text inputs). */
	$instance['contactinfo_title'] = strip_tags( $new_instance['contactinfo_title'] );
	$instance['syscontact_name'] = strip_tags( $new_instance['syscontact_name'] );
	$instance['syscontact_city'] = strip_tags( $new_instance['syscontact_city'] );
	$instance['syscontact_address'] = strip_tags( $new_instance['syscontact_address'] );
	$instance['syscontact_state'] = strip_tags( $new_instance['syscontact_state'] );
	$instance['syscontact_zip'] = strip_tags( $new_instance['syscontact_zip'] );
	$instance['syscontact_email'] = strip_tags( $new_instance['syscontact_email'] );
	$instance['syscontact_phone'] = strip_tags( $new_instance['syscontact_phone'] );
	return $instance;
	}
function form( $instance ) {
	/* Set up some default widget settings. */
 ?>
<!-- Contact Widget Input -->
<p>
<label for="<?php echo $this->get_field_id( 'contactinfo_title' ); ?>"><?php _e('Title:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'contactinfo_title' ); ?>" name="<?php echo $this->get_field_name( 'contactinfo_title' ); ?>" value="<?php echo $instance['contactinfo_title']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'syscontact_name' ); ?>"><?php _e('Name:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'syscontact_name' ); ?>" name="<?php echo $this->get_field_name( 'syscontact_name' ); ?>" value="<?php echo $instance['syscontact_name']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'syscontact_address' ); ?>"><?php _e('Address:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'syscontact_address' ); ?>" name="<?php echo $this->get_field_name( 'syscontact_address' ); ?>" value="<?php echo $instance['syscontact_address']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'syscontact_city' ); ?>"><?php _e('City:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'syscontact_city' ); ?>" name="<?php echo $this->get_field_name( 'syscontact_city' ); ?>" value="<?php echo $instance['syscontact_city']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'syscontact_state' ); ?>"><?php _e('State:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'syscontact_state' ); ?>" name="<?php echo $this->get_field_name( 'syscontact_state' ); ?>" value="<?php echo $instance['syscontact_state']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'syscontact_zip' ); ?>"><?php _e('Zip Code:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'syscontact_zip' ); ?>" name="<?php echo $this->get_field_name( 'syscontact_zip' ); ?>" value="<?php echo $instance['syscontact_zip']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'syscontact_phone' ); ?>"><?php _e('Phone:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'syscontact_phone' ); ?>" name="<?php echo $this->get_field_name( 'syscontact_phone' ); ?>" value="<?php echo $instance['syscontact_phone']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'syscontact_email' ); ?>"><?php _e('E-mail:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'syscontact_email' ); ?>" name="<?php echo $this->get_field_name( 'syscontact_email' ); ?>" value="<?php echo $instance['syscontact_email']; ?>" type="text" style="width:100%;" />
</p>
<?php } }
add_action( 'widgets_init', 'contactinfo_widgets' );
 ?>