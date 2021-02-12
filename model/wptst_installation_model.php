<?php
if(!class_exists('WPTST_Installation_Model')){ 
	class WPTST_Installation_Model {
	    static function create_tables_password_plugin(){
			global $wpdb;
			/************* Create Tables if table not exists ****************/
			$pass_tbl_sql = 'CREATE TABLE IF NOT EXISTS ' . WPTST_TBL . '(
								id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
								ip VARCHAR( 255 ) NOT NULL,
								user_id INT NOT NULL,
								username VARCHAR( 255 ) NOT NULL DEFAULT "0",
								user_email VARCHAR( 255 ) NOT NULL DEFAULT "0",	
								counts INT NOT NULL DEFAULT 0,						
								date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
							)';

			$wpdb->query($pass_tbl_sql);
		}
	}	
	
}else
die("<h2>".__('Failed to load Password installation model')."</h2>");
?>
