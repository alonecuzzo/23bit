<?php
/**
 * 'advertisement_Widget' is the widget class used below.
 */
function advertisement_widgets() {
	register_widget( 'advertisement_widgets' );
}
class advertisement_widgets extends WP_Widget {

	/**
	 * advertisement widget setup.
	 */
	function advertisement_widgets() {
global $themename;
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'advertisement_widgets', 'description' => __('Add Advertisement to your sidebar .', 'example') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'advertisement_widgets' );

		/* Create the widget. */
		$this->WP_Widget( 'advertisement_widgets',$themename.'- Ads Widget', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
	$advertisement_title = $instance['advertisement_title'];
	$advertisement_ad1 = $instance['advertisement_ad1'];
	$advertisement_ad1link = $instance['advertisement_ad1link'];
	$advertisement_ad2 = $instance['advertisement_ad2'];
	$advertisement_ad2link = $instance['advertisement_ad2link'];
	$advertisement_ad3 = $instance['advertisement_ad3'];
	$advertisement_ad3link = $instance['advertisement_ad3link'];
	$advertisement_ad4 = $instance['advertisement_ad4'];
	$advertisement_ad4link = $instance['advertisement_ad4link'];
		/* Our variables from the widget settings. */
			/* Before widget (defined by themes). */
$before_title='<h3>';
$after_title='</h3>';
$before_widget='<div class="syswidget advertisement">';
$after_widget='<div class="clear"></div></div>';

for($i=1; $i<= 4; $i++){
				$image = isset($instance['advertisement_ad'.$i])?$instance['advertisement_ad'.$i]:'';
				$link = isset($instance['advertisement_ad'.$i.'link'])?$instance['advertisement_ad'.$i.'link']:'';
				if(empty($image)){
					$image = sys_theme_images.'/ad125.jpg';
				}
				$out.= '<a  href="'.$link.'" rel="nofollow" target="_blank"><img src="'.$image.'" alt="" width="125" height="125" /></a>';
			}

if ( !empty( $out) ) {
			echo $before_widget;
			if ( $advertisement_title)
				echo $before_title . $advertisement_title . $after_title;
			echo $out;
			echo $after_widget;
		}

}
/**
 * Update the advertisement Widget Settings.
 */
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	/* Strip tags for title and name to remove HTML (important for text inputs). */
	$instance['advertisement_title'] = strip_tags( $new_instance['advertisement_title'] );
	$instance['advertisement_ad1'] = strip_tags( $new_instance['advertisement_ad1'] );
	$instance['advertisement_ad1link'] = strip_tags( $new_instance['advertisement_ad1link'] );
	$instance['advertisement_ad2'] = strip_tags( $new_instance['advertisement_ad2'] );
	$instance['advertisement_ad2link'] = strip_tags( $new_instance['advertisement_ad2link'] );
	$instance['advertisement_ad3'] = strip_tags( $new_instance['advertisement_ad3'] );
	$instance['advertisement_ad3link'] = strip_tags( $new_instance['advertisement_ad3link'] );
	$instance['advertisement_ad4'] = strip_tags( $new_instance['advertisement_ad4'] );
	$instance['advertisement_ad4link'] = strip_tags( $new_instance['advertisement_ad4link'] );
	return $instance;
	}
function form( $instance ) {
	/* Set up some default widget settings. */
 ?>
<!-- advertisement Widget Input -->
<p>
<label for="<?php echo $this->get_field_id( 'advertisement_title' ); ?>"><?php _e('Title:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'advertisement_title' ); ?>" name="<?php echo $this->get_field_name( 'advertisement_title' ); ?>" value="<?php echo $instance['advertisement_title']; ?>" type="text" style="width:100%;" />
</p>
<p>Note: Please input FULL URL(e.g. http://www.example.com)</p>
<p>
<label for="<?php echo $this->get_field_id( 'advertisement_ad1' ); ?>"><?php _e('Image-1 URL::', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'advertisement_ad1' ); ?>" name="<?php echo $this->get_field_name( 'advertisement_ad1' ); ?>" value="<?php echo $instance['advertisement_ad1']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'advertisement_ad1-link' ); ?>"><?php _e('Link-1:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id('advertisement_ad1link'); ?>" name="<?php echo $this->get_field_name( 'advertisement_ad1link'); ?>" value="<?php echo $instance['advertisement_ad1link']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'advertisement_ad2' ); ?>"><?php _e('Image-2 URL::', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'advertisement_ad2' ); ?>" name="<?php echo $this->get_field_name( 'advertisement_ad2' ); ?>" value="<?php echo $instance['advertisement_ad2']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'advertisement_ad2link' ); ?>"><?php _e('Link-2:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id('advertisement_ad2link'); ?>" name="<?php echo $this->get_field_name( 'advertisement_ad2link'); ?>" value="<?php echo $instance['advertisement_ad2link']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'advertisement_ad3' ); ?>"><?php _e('Image-3 URL::', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'advertisement_ad3' ); ?>" name="<?php echo $this->get_field_name( 'advertisement_ad3' ); ?>" value="<?php echo $instance['advertisement_ad3']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'advertisement_ad3link' ); ?>"><?php _e('Link-3:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id('advertisement_ad3link'); ?>" name="<?php echo $this->get_field_name( 'advertisement_ad3link'); ?>" value="<?php echo $instance['advertisement_ad3link']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'advertisement_ad4' ); ?>"><?php _e('Image-4 URL::', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'advertisement_ad4' ); ?>" name="<?php echo $this->get_field_name( 'advertisement_ad4' ); ?>" value="<?php echo $instance['advertisement_ad4']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'advertisement_ad4link' ); ?>"><?php _e('Link-4:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id('advertisement_ad4link'); ?>" name="<?php echo $this->get_field_name( 'advertisement_ad4link'); ?>" value="<?php echo $instance['advertisement_ad4link']; ?>" type="text" style="width:100%;" />
</p>
<?php } }
add_action( 'widgets_init', 'advertisement_widgets' );
 ?>