<?php
    /***************** File paths ******************/
    define('WPTST_MODEL_PATH',WPTST_ABSPATH.'model/');
    define('WPTST_CONTROLLER_PATH',WPTST_ABSPATH.'controller/');
    define('WPTST_VIEWS',WPTST_ABSPATH.'view/');
  
    /*********** Program constants ***********/
    define('WPTST_TYPE', 'password');
    define('WPTST_OPTION', 'wptstpassword_option');
    define('WPTST_TBL', $wpdb->prefix . 'login_attempts');

    //Load appropriate files
    $auto_ctrl_files = array('WPTST_Admin_Controller');
    $auto_model_files = array('WPTST_Installation_Model','WPTST_Admin_Model');
  
    /******** Intialize the needed classes **********/
    require_once('installation.php');

    controller_autoload($auto_ctrl_files);
    model_autoload($auto_model_files);

    function controller_autoload($class_name)
    {
      if(!empty($class_name)){
        foreach($class_name as $class_nam):
          $filename = strtolower($class_nam).'.php';
          $file = WPTST_CONTROLLER_PATH.$filename;
  
          if (file_exists($file) == false)
          {
            return false;
          }
          include_once($file);
        endforeach;
      }               
    }

    function model_autoload($class_name)
    {
      if(!empty($class_name)){
        foreach($class_name as $class_nam):
          $filename = strtolower($class_nam).'.php';
          $file = WPTST_MODEL_PATH.$filename;
  
          if (file_exists($file) == false)
          {
            return false;
          }
          include_once($file);
        endforeach;
      }
    }


?>
