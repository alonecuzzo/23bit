<?php 
	
	$save_data = false;
	$reset_data = false;

	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.', 'framework') );
	}


	// save
	if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'ln-theme-sidebars-page' ) {
		
		if (isset($_POST['save_submit']) && $_POST['action'] == 'lion_framework') {
			
			$sidebars_array = array();
			$counter = 0;

			if(isset($_POST['custom_sidebar_name'])) {
				
				foreach ($_POST['custom_sidebar_name'] as $name) {
					
					$esc_name = str_replace(' ', '-', $name);
					$sidebars_array[] = array('id' => $counter, 'name' => $esc_name );

					$counter += 1;
				}
				
				// update option
				update_option('ln_custom_sidebars_array', $sidebars_array);
			
				$save_data = true;
			
			}else{

				// empty list update with empty array
				update_option('ln_custom_sidebars_array', array());

				$save_data = true;
			}
		}
    }
    
	// reset
	if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'ln-theme-sidebars-page' ) {
		
		if (isset($_POST['reset_submit']) && $_POST['action'] == 'lion_framework') {
			
			// reset data
			update_option('ln_custom_sidebars_array', array());

			$reset_data = true;
		}
    }


	
?>
<form method="post" id="lion_sidebars_form" class="lion_options_form">
		<input type="hidden" name="action" id="action" value="lion_framework" />
		<div class="wrap" id="ln-wrap-sidebars">
			<?php 
				// show notes
				if(isset($save_data) && $save_data == true){
				   	echo "<span class='ln-note'>".__('All custom sidebars are saved!', 'framework')."</span>";
				   	
				}
				
				if(isset($reset_data) && $reset_data == true){
				   	echo "<span class='ln-note'>".__('All custom sidebars are deleted!', 'framework')."</span>";
				   	
				}
			?>

			<div id="ln-header">
				<h2><?php _e('Sidebars', 'framework'); ?></h2>
				<span><?php _e('Add and delete your custom sidebars.', 'framework'); ?></span>
			</div>
			<div class="line"></div>
			
				<div id="ln-sidebars-content">
					<div class="ln-add-header">
						<h3><?php _e('Add sidebar', 'framework'); ?></h3>
						<p><?php _e('Use unique name for each sidebar (minimum 4 symbols).', 'framework'); ?></p>
						<div>
							<input type="text" class="ln-input" name="ln-new-sidebar-name" id="ln-new-sidebar-name" style="padding:10px;" value="<?php _e('Unique name', 'framework'); ?>" onfocus="if(this.value==this.defaultValue){this.value=''}" onblur="if(this.value==''){this.value=this.defaultValue}" /> 
							<button id="ln-add-new-sidebar" class="ln-page-builder-action-btn"><?php _e('Add Sidebar', 'framework'); ?></button>
						</div>
					</div>
					<ul id="ln-sidebars-list">

						<?php 
							
							$saved_sidebars = get_option('ln_custom_sidebars_array');
							
							if(isset($saved_sidebars) && !empty($saved_sidebars)) {
								foreach ($saved_sidebars as $sidebar => $v) {
								?>
									<li data-index="<?php echo $v['id']; ?>"><?php echo ereg_replace("\\\'", '"', stripslashes( $v['name'] ) ); ?><span class="remove-button"></span>
										<input type="hidden" name="custom_sidebar_name[]" value="<?php echo $v['name']; ?>"/>
									</li>
								<?php
								}
							}
						
						
						?>
					</ul>
					
				</div>
				<div class="ln-clear"></div>
		</div>
			
			<div id="ln-footer">
				
				<span class="ln-reset"><input type="submit" class="button ln-reset-button" id="reset_submit" name="reset_submit" value="Reset" onclick="return confirm(<?php _e("'Delete all custom sidebars?'", "framework"); ?>);"/></span>
				<span class="ln-save"><input type="submit" class="button-primary ln-save-button" id="save_submit" name="save_submit" value="<?php _e('Save changes', 'framework'); ?>" /></span>
				<div class="ln-clear"></div>	
			</div>
		
			
	</form>
