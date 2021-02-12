<?php
if(!function_exists('wptst_activation_init')){
	function wptst_activation_init() {
        WPTST_Installation_Model::create_tables_password_plugin();
        $check_option = get_option(WPTST_OPTION);
        if(empty($check_option)){
            $email = get_option('admin_email');
            $values['number_attempts']='3';
			$values['notification_email']=$email;
            update_option(WPTST_OPTION,$values);
        }
    }
}

if(!function_exists('wptst_deactivation_init')){
	function wptst_deactivation_init() {
      
    }
}