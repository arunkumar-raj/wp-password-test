<?php
if(!function_exists('wptst_settings_view')){
    function wptst_settings_view($values){
	?>
	<div class="wrap wptst_admin_page">   
		<h2><?php _e('Password Settings','wptst-password'); ?></h2>
		<div class="narrow">
			<form action="<?php echo admin_url().'admin.php?page='.WPTST_TYPE; ?>" method="post" name="votes_delete_form" id="votes_delete_form">
				<p class="p_color"> <?php _e('By Default No. of attempts is 3 and Email will be sent to admin','wptst-password'); ?></p>
				<table class="form-table"> 
					<tr valign="top">
						<th scope="row">  <?php _e('Number of Attempts','wptst-password'); ?>  </th>
						<td>   
							<input type="number" class="wptst_text_class" name="number_attempts" value="<?php echo $values['number_attempts'];?>"/>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">  <?php _e('Notification Email','wptst-password'); ?>  </th>
						<td>   
							<input type="text" class="wptst_text_class" name="notification_email" value="<?php echo $values['notification_email'];?>"/>
						</td>
					</tr>
				</table>
				
				<p class="submit">
				<input type="submit" value="<?php _e('Save Settings','wptst-password'); ?>" class="button" id="password_setting" name="password_setting" /></p>
			</form>
		</div>
	</div>
	

	<?php
    }
}else{
    die("<h2>".__('Failed to load Password settings view','wptst-password')."</h2>");
}
?>
