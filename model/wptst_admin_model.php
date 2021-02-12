<?php
if(!class_exists('WPTST_Admin_Model')){ 
	class WPTST_Admin_Model {

        //Insert if no userid is found in table already
	    public static function insert_incorrect_password_attempts($data){
			global $wpdb;
            $get_row = SELF::get_incorrect_password_attempts($data['user_id']);
            if(empty($get_row)){
                $wpdb->insert( 
                    WPTST_TBL, 
                    array( 
                        'ip' => $data['ip'], 
                        'user_id'      => $data['user_id'],
                        'username' => $data['username'],
                        'user_email'    => $data['user_email'],
                        'counts'  => '1', 
                    ), 
                    array( 
                        '%s','%s','%s','%s' ,'%s'
                    ) 
                );
            }else{
                SELF::update_incorrect_password_attempts($data,$get_row);
            }
            //Get Row after update
            $get_row = SELF::get_incorrect_password_attempts($data['user_id']);
            return $get_row;
		}

        public static function update_incorrect_password_attempts($data,$get_row){
            global $wpdb;  
            //Update count 
            $data['counts'] = $get_row['counts'] + 1;
			$wpdb->update( 
				WPTST_TBL, 
				$data,
				array('id' => $get_row['id']), 
				array( 
					'%s','%s','%s','%s' ,'%s'				
				), 
				array( '%s' ) 
			);
        }

        public static function update_sucessful_attempts($userid){
            global $wpdb;  
            //Update count 
            $data['counts'] = 0;
			$wpdb->update( 
				WPTST_TBL, 
				$data,
				array('user_id' => $userid), 
				array( 
					'%s'				
				), 
				array( '%s' ) 
			);
        }

        public static function get_incorrect_password_attempts($user_id){
            global $wpdb;            
		    $sql = "SELECT * FROM " . WPTST_TBL . " WHERE user_id =".$user_id;
		    $return_val = $wpdb->get_row($sql,ARRAY_A);    
		    return $return_val;
        }
	}	
    
	
}else
die("<h2>".__('Failed to load Password Admin model')."</h2>");
?>
