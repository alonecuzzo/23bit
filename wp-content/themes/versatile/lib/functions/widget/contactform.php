<?php
/**
 * 'contactform_Widget' is the widget class used below.
 */
function contact_form_widgets() {
	register_widget( 'contactform_widget' );
}
class contactform_widget extends WP_Widget {
	/**
	 * contact form Widget setup.
	 */
	function Contactform_widget() {
global $themename;
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'contactform_widget', 'description' => __('Quick Contact Form widget for sidebar.', 'example') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contactform_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'contactform_widget',$themename.'-Contact form', $widget_ops, $control_ops );
	}

	/**
	 * How to display the contact widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
	$semail = $instance['semail'];
		/* Our variables from the widget settings. */
		$contact_widgetemail = $instance['contact_widgetemail'];
			/* Before widget (defined by themes). */
$contacttitle="Contact Us";
$before_title='<h3>';
$after_title='</h3>';
$before_widget='<div class="syswidget sysform">';
$after_widget='</div>';
?><div id="result"></div>
<?php echo $before_widget;?>
<?php echo $before_title.$contacttitle.$after_title; ?>

<form action="<?php bloginfo('template_url'); ?>/lib/includes/submitform.php" id="validate_form" method="post">
<p><input type="text" size="25" name="contact_name" class="txt required"><label><?php _e('Name', 'versatile_front'); ?> *</label></p>
<p><input type="text" size="25" name="contact_email" class="txt required"><label><?php _e('Email', 'versatile_front'); ?> *</label></p>
<p><textarea name="contactcomment" rows="5" cols="30" class="required"></textarea></p>
<p><button type="submit" value="submit" name="contactsubmit" class="button small gray"><span><?php _e('submit','versatile_front');?></span></button></p>
<input type="hidden" name="contact_check" value="checking">
<input type="hidden" name="contact_widgetemail" value="<?php echo 	$contact_widgetemail; ?>">
</form>
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
	$instance['contact_widgetemail'] = strip_tags( $new_instance['contact_widgetemail'] );

	return $instance;
	}
function form( $instance ) {
	/* Set up some default widget settings. */
 ?>
<!-- Contact Widget Input -->
<p>
<label for="<?php echo $this->get_field_id( 'contact_widgetemail' ); ?>"><?php _e('Email:', 'versatile_front'); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'contact_widgetemail' ); ?>" name="<?php echo $this->get_field_name( 'contact_widgetemail' ); ?>" value="<?php echo $instance['contact_widgetemail']; ?>" style="width:100%;" />
</p>
<?php 
} 
} 
add_action( 'widgets_init', 'contact_form_widgets' );
?>
