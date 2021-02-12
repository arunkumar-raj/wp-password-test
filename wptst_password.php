<?php
/*
Plugin Name: WP Test Password
Version: 1.0
Description: WordPress plugin that validates password strength during login only after confirming that the credentials are correct. If the password does not match all the rules, the user should not be allowed to log in and should be presented with a warning message above the login form.
Author: Arunkumar
Author URI: 
Copyright (c) 2008-2016 All Rights Reserved.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
*/

//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
error_reporting(0);

if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;

define('WPTST_VOTE_VERSION','1');
/*********** File path constants **********/
define('WPTST_ABSPATH', dirname(__FILE__) . '/');
define('WPTST_PATH', plugin_dir_url(__FILE__));
define('WPTST_SL_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WPTST_SL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WPTST_SL_PLUGIN_FILE', __FILE__);
define('WPTST_WP_SL_PRODUCT_NAME', 'WP Test Password');

require_once('configuration/config.php');
register_activation_hook(__FILE__,'wptst_activation_init');
register_deactivation_hook(__FILE__,'wptst_deactivation_init');
