<?php
/**
 * googlmap_Widget' is the widget class used below.
 */
function gmap_widgets() {
	register_widget( 'gmap_widgets' );
}
class gmap_widgets extends WP_Widget {

	/**
	 * googlemap widget setup.
	 */
	function gmap_widgets() {
global $themename;
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'gmap_widgets', 'description' => __('Add Google Map to your sidebar  .', 'example') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'gmap_widgets' );

		/* Create the widget. */
		$this->WP_Widget( 'gmap_widgets',$themename.'-googlemap', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
	$g_title = $instance['g_title'];
	$g_address = $instance['g_address'];
		$g_latitude = !empty($instance['g_latitude'])?$instance['g_latitude']:0;
		$g_longitude = !empty($instance['g_longitude'])?$instance['g_longitude']:0;
		$g_zoom = (int)$instance['g_zoom'];
		$g_html = $instance['g_html'];
		$g_popup = $instance['g_popup'];
		$g_height = (int)$instance['g_height'];

		/* Our variables from the widget settings. */
			/* Before widget (defined by themes). */
$before_title='<h3>';
$after_title='</h3>';
$before_widget='<div class="syswidget">';
$after_widget='<div class="clear"></div>';
?>
<?php echo $before_widget;?>
<?php echo $before_title.$g_title.$after_title;
	$id = rand(1,400);
 ?>
<div id="googlemap_widget_<?php echo $id;?>"  style="height:<?php echo $g_height;?>px"></div>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery("#googlemap_widget_<?php echo $id;?>").gMap({
			    zoom: <?php echo $g_zoom;?>,
			    markers:[{
					address: "<?php echo $g_address;?>",
					latitude: <?php echo $g_latitude;?>,
			    	longitude: <?php echo $g_longitude;?>,
			    	html: "<?php echo $g_html;?>",
			    	popup: <?php echo $g_popup;?>
				}],
				controls: false,
				maptype: G_NORMAL_MAP
			});
		});
		</script>

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
	$instance['g_title'] = strip_tags( $new_instance['g_title'] );
	$instance['g_address'] = strip_tags( $new_instance['g_address'] );
	$instance['g_latitude'] = strip_tags( $new_instance['g_latitude'] );
	$instance['g_longitude'] = strip_tags( $new_instance['g_longitude'] );
	$instance['g_zoom'] = strip_tags( $new_instance['g_zoom'] );
	$instance['g_height'] = strip_tags( $new_instance['g_height'] );
		$instance['g_popup'] = !empty($new_instance['g_popup']) ? 1 : 0;
				$instance['g_html'] = strip_tags( $new_instance['g_html'] );
	return $instance;
	}
function form( $instance ) {
	/* Set up some default widget settings. */
	$g_popup = isset( $instance['g_popup'] ) ? (bool) $instance['g_popup'] : false;
 ?>
<!-- Google Map Widget Input -->
<p>
<label for="<?php echo $this->get_field_id( 'g_title' ); ?>"><?php _e('Title:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'g_title' ); ?>" name="<?php echo $this->get_field_name( 'g_title' ); ?>" value="<?php echo $instance['g_title']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'g_address' ); ?>"><?php _e('Address(optional):', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'g_address' ); ?>" name="<?php echo $this->get_field_name( 'g_address' ); ?>" value="<?php echo $instance['g_address']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'g_latitude' ); ?>"><?php _e('Latitude:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'g_latitude' ); ?>" name="<?php echo $this->get_field_name( 'g_latitude' ); ?>" value="<?php echo $instance['g_latitude']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'g_longitude' ); ?>"><?php _e('Longitude:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'g_longitude' ); ?>" name="<?php echo $this->get_field_name( 'g_longitude' ); ?>" value="<?php echo $instance['g_longitude']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'g_zoom' ); ?>"><?php _e('Zoom value from 1 to 19:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'g_zoom' ); ?>" name="<?php echo $this->get_field_name( 'g_zoom' ); ?>" value="<?php echo $instance['g_zoom']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'g_html' ); ?>"><?php _e('Content for the marker::', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'g_html' ); ?>" name="<?php echo $this->get_field_name( 'g_html' ); ?>" value="<?php echo $instance['g_html']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'g_height' ); ?>"><?php _e('Height:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'g_height' ); ?>" name="<?php echo $this->get_field_name( 'g_height' ); ?>" value="<?php echo $instance['g_height']; ?>" type="text" style="width:100%;" />
</p>
<p>
<input type="checkbox"  id="<?php echo $this->get_field_id( 'g_popup' ); ?>" name="<?php echo $this->get_field_name( 'g_popup' ); ?>" <?php checked( $g_popup ); ?>" class="checkbox" /> <label for="<?php echo $this->get_field_id( 'g_popup' ); ?>"><?php _e('Auto popup the info?', 'example'); ?></label>
</p>

<?php } }
add_action( 'widgets_init', 'gmap_widgets' );
 ?>