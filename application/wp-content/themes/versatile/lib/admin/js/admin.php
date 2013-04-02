<script type="text/javascript">

	
	var template_url = '<?php echo(bloginfo('template_url')); ?>';
	
	function sys_social_book_form() {


		
		var sys_social_data = '';
		
		
		jQuery('#sys_socialbookmark tr').each(function() {
			social1 = jQuery(this).find('.sys_social_title').val();
			social2 = jQuery(this).find('.sys_social_file_icon').val();
			social3 = jQuery(this).find('.sys_social_account_url').val();
			if (social1 !== undefined) {
		
				social1 = social1.replace(/#;/g, '').replace(/#\|/g, '');
				social2 = social2.replace(/#;/g, '').replace(/#\|/g, '');
				social3 = social3.replace(/#;/g, '').replace(/#\|/g, '');
				sys_social_data =  sys_social_data + social1 + '#|' + social2 + '#|' + social3 + '#;';
				
			}
		});
		
		sys_social_data = sys_social_data.substr(0, sys_social_data.length - 2);

		document.getElementById('sys_social_bookmark').value = sys_social_data;
	}
	
	function sys_add_social_item() {
		jQuery('#sys_socialbookmark tr:last').after('' +
		'<tr>' +
		'<td align="center" width="70"><a href="#" class="sys_social_item_delete"><img src="' + template_url + '/lib/admin/images/delete.png" alt="x"></a></td>' +

			'<td width="100">Title: <input type="text"  class="sys_social_title" /></td>' +
			'<td width="100">Icon: <select class="sys_social_file_icon" name="sys_social_file_icon" ><?php global $socialimages_select,$wpdb; $sysimgpath=get_template_directory_uri();  foreach ( $socialimages_select as $key => $values) { 
			echo "<option   style=".'background:url('.$sysimgpath.'/images/followus/'.$values.');'." value=".$values.">$values</option>"; } ?></select></td>' +
			'<td width="100">Url: <input type="text"  class="sys_social_account_url"/></td>' +
			'</tr>'
		);
		jQuery('.sys_social_item_delete').click(function() {
			jQuery(this).closest('tr').remove();
			return false;
		});
	}
	
	jQuery(document).ready(function() {
		jQuery('.sys_social_item_delete').click(function() {
			jQuery(this).closest('tr').remove();
			return false;
		});
	});
	</script>