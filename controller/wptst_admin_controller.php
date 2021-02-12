<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
require_once WPTST_ABSPATH.'vendor/autoload.php';
use ZxcvbnPhp\Zxcvbn;
if(!class_exists('WPTST_Admin_Controller')){
	class WPTST_Admin_Controller{

		public function __construct(){
				add_action('admin_menu', array($this, 'wpvc_password_admin_menu'));
				// Add scripts 
				add_action( 'admin_enqueue_scripts',array( $this, 'wpvc_add_password_admin_tools' ));	
				add_filter( 'authenticate', array( $this, 'wptst_authenticate_username_password'),  20, 3 );
		}

    	//Admin menu start
		public function wpvc_password_admin_menu(){
			add_menu_page('wptest-password', 'Password', 'manage_options',WPTST_TYPE, array( $this, 'wptst_password_settings'),'dashicons-awards',90);
		}
		
    	// Add CSS
		public function wpvc_add_password_admin_tools(){
			wp_enqueue_style( 'ow-wptst-admin-css', plugins_url( 'assets/css/ow-wptst-admin-css.css' , dirname(__FILE__) ) );		
		}

		//Password settings
		public function wptst_password_settings(){
			$submit_btn = $_POST['password_setting'];
			if($submit_btn){
				$update['number_attempts']=$_POST['number_attempts'];
				$update['notification_email']=$_POST['notification_email'];
				update_option(WPTST_OPTION,$update);
			}
			$values = get_option(WPTST_OPTION);
			require_once(WPTST_VIEWS.'wptst_settings_view.php');
			wptst_settings_view($values);
		}

		public function wptst_authenticate_username_password($user,$username,$pass){
			
			if($user){
				//In case of error on credentials
				$error = $user->errors;
				if($error!=''){
					$incorrect_pass = ($error['incorrect_password']!='')?$error['incorrect_password']:'';
					//Get Userdata by username for Error processing
					$user_data = get_user_by('login',$username);
					if($incorrect_pass){
						$this->insert_incorrect_login_attempts($user_data->data);
					}
					return $user;
				}
				//If user is there then perform test of password
				$zxcvbn = new Zxcvbn();
				$user_data = $user->data;
				$strong = $zxcvbn->passwordStrength($pass);
				
				//Pattern to check 1 uppercase lowecase number and symbols in password
				$pattern = '/^(?=.*[\/\'!"#$%&()*+,-.:;<=>?@[\]^_`{|}~])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{16,30}$/';
				if(preg_match($pattern, $pass)){
					//On succesful login remove count for the user
					WPTST_Admin_Model::update_sucessful_attempts($user_data->ID);
					return $user;
				}else{
					$this->insert_incorrect_login_attempts($user_data);
					return new WP_Error( 'incorrect_password',
						sprintf(
							/* translators: %s: email address */
							__( '<strong>ERROR</strong>: Your password is not strong enough, it has a score of %s Please change it to be allowed to log in again.' ),
							'<strong>' . $strong['score'] . '</strong>'
						) .
						' <a href="' . wp_lostpassword_url() . '">' .
						__( 'Lost your password?' ) .
						'</a>'
					);
				}
				
					
			}
		}

		public function insert_incorrect_login_attempts($user_data){
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$data['ip'] = $ip_address;
			$data['user_id']=$user_data->ID;
			$data['username']=$user_data->user_nicename;
			$data['user_email']=$user_data->user_email;
			$get_value_user = WPTST_Admin_Model::insert_incorrect_password_attempts($data);

			//Get setting saved 
			$get_saved_setting = get_option(WPTST_OPTION);
			$no_attempts = ($get_saved_setting['number_attempts'] !='')?$get_saved_setting['number_attempts']:3;
			$notification_email = ($get_saved_setting['notification_email'] !='')?$get_saved_setting['notification_email']:get_option('admin_email');
			//Traced count
			if($get_value_user){
				$traced_count = $get_value_user['counts'];
				if($traced_count >= $no_attempts){

					$subject = __('User has tried to log in with an unsuitable password ','wptst-password');
					//Add view for mail template
					require_once(WPTST_VIEWS.'wptst_mail_content_view.php');
					$message = wptst_mail_addcontestant_view($get_value_user);

					//Add headers for Email
					$headers[] = 'From: '.$notification_email;
					$headers[] = "Content-type: text/html";
					wp_mail($notification_email, $subject,$message ,$headers);
				}
			}

		}

	}
}
else
die("<h2>".__('Failed to load the Password Admin Controller','wptst-password')."</h2>");

return new WPTST_Admin_Controller();
