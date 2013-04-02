<?php 
	
	$save_data = false;
	$reset_data = false;

	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.', 'framework') );
	}


	// save
	if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'ln-review-rating-criteria-page' ) {
		
		if (isset($_POST['save_submit']) && $_POST['action'] == 'lion_framework') {
			
			$criterias_array = array();
			$counter = 0;

			if(isset($_POST['criteria_name'])) {
				
				foreach ($_POST['criteria_name'] as $k => $name) {
					
					// get fields 
					$fields = $_POST['criteria_fields'][$k];
					$filter_name = stripslashes( str_replace(' ', '_', $name) );

					$criterias_array[] = array('id' => $counter.'_'.$filter_name, 'name' => $filter_name, 'fields' => $fields);

					$counter += 1;
				}
				
				// update option
				update_option('ln_custom_rating_criteria_array', $criterias_array);
			
				$save_data = true;
			
			}else{

				// empty list update with empty array
				update_option('ln_custom_rating_criteria_array', array());

				$save_data = true;
			}
		}
    }
    
	// reset
	if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'ln-review-rating-criteria-page' ) {
		
		if (isset($_POST['reset_submit']) && $_POST['action'] == 'lion_framework') {
			
			// reset data
			update_option('ln_custom_rating_criteria_array', array());

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
				   	echo "<span class='ln-note'>".__('All criterias are saved!', 'framework')."</span>";
				   	
				}
				
				if(isset($reset_data) && $reset_data == true){
				   	echo "<span class='ln-note'>".__('All criterias are deleted!', 'framework')."</span>";
				   	
				}
			?>

			<div id="ln-header">
				<h2><?php _e('Rating Criteria', 'framework'); ?></h2>
				<span><?php _e('Add and delete your reviews ratings criteria. Click on edit button to edit criteria rating fields.', 'framework'); ?></span>
			</div>
			<div class="line"></div>
			
				<div id="ln-critera-content">
					
					<div id="ln-edit-criteria-page">
						<div id="ln-edit-criteria-content">
							<header>
								<h4><?php _e('Edit criteria fields', 'framework'); ?></h4>
								<span id="ln-edit-criteria-close-button"></span>
								<div class="ln-clear"></div>
							</header>
							
							<div class="ln-module-edit-inner">
								<div class="ln-add-header">
									<h4 style="width: 100%; margin-bottom: 10px;"><?php _e('Add Field', 'framework'); ?></h4>
									<p><?php _e('Use unique name for each field (minimum 3 symbols)', 'framework'); ?>.</p>
									<div>
										<input type="text" class="ln-input" name="ln-criteria-new-field-name" id="ln-criteria-new-field-name" style="padding:10px;" value="<?php _e('Name', 'framework'); ?>" onfocus="if(this.value==this.defaultValue){this.value=''}" onblur="if(this.value==''){this.value=this.defaultValue}" /> 
										<button id="ln-add-new-criteria-field" class="ln-page-builder-action-btn"><?php _e('Add Field', 'framework'); ?></button>
									</div>
								</div>
								<ul id="ln-criteria-fields-list">
								</ul>
							</div>

							<footer>
								<button id="ln-edit-criteria-save-button" class="ln-page-builder-action-btn" style="float:right;"><?php _e('Save Changes', 'framework'); ?></button>
							</footer>
							<div class="ln-clear"></div>
						</div>
					</div>

					<div class="ln-add-header">
						<h3><?php _e('Add Criteria', 'framework'); ?></h3>
						<p><?php _e('Use unique name for each criteria (minimum 4 symbols).', 'framework'); ?></p>
						<div>
							<input type="text" class="ln-input" name="ln-new-sidebar-name" id="ln-new-criteria-name" style="padding:10px;" value="<?php _e('Unique name', 'framework'); ?>" onfocus="if(this.value==this.defaultValue){this.value=''}" onblur="if(this.value==''){this.value=this.defaultValue}" /> 
							<button id="ln-add-new-criteria" class="ln-page-builder-action-btn"><?php _e('Add Criteria', 'framework'); ?></button>
						</div>
					</div>
					<ul id="ln-criterias-list">

						<?php 
							
							$saved_criteria = get_option('ln_custom_rating_criteria_array');
							
							if(isset($saved_criteria) && !empty($saved_criteria)) {
								foreach ($saved_criteria as $k => $v) {
									// create fields
									$flds = $v['fields'];

								?>
									<li data-index="<?php echo $v['id']; ?>"><?php echo ereg_replace("\\\'", '"', stripslashes($v['name']) ); ?><span class="edit-button"></span><span class="remove-button"></span>
										<input type="hidden" name="criteria_name[]" value="<?php echo $v['name']; ?>"/>
										<input type="hidden" name="criteria_fields[]" value="<?php echo stripslashes($flds); ?>"/>
									</li>
								<?php
								
								}// end foreach
							
							}// end if
						
						?>
						
					</ul>
					
				</div>
				<div class="ln-clear"></div>
		</div>
			
			<div id="ln-footer">
				
				<span class="ln-reset"><input type="submit" class="button ln-reset-button" id="reset_submit" name="reset_submit" value="Reset" onclick="return confirm(<?php _e("'Delete all criterias?'", "framework"); ?>);"/></span>
				<span class="ln-save"><input type="submit" class="button-primary ln-save-button" id="save_submit" name="save_submit" value="<?php _e('Save changes', 'framework'); ?>" /></span>
				<div class="ln-clear"></div>	
			</div>
		
			
	</form>
