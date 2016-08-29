<?php
/*
Plugin Name: DB Trigger
Description: Database developer tool and its not recommended for end users 
Author: dbtrigger
Version: 0.0.1
Text Domain: db-trigger
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
$db_trigger_plugin_dir = WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__));
$db_trigger_plugin_url = WP_PLUGIN_URL . '/' . basename(dirname(__FILE__));

if ( ! class_exists( 'TriggerDB' ) ) {
	class TriggerDB extends wpdb{
		function __construct()
		{
			echo "OK I m There!!!";
		}
	}
}
if( !function_exists('triggerdb_init')){
	function triggerdb_init() {
		$GLOBALS['triggerdb'] = new TriggerDB();
	}
}

if( !function_exists('trigger_db_create_menu')){
	function trigger_db_create_menu() {
		
		add_menu_page( 'DB Trigger Welcome', 'Trigger', 'administrator', 'trigger_db', 'trigger_db_welcome_page');
		
		add_submenu_page( 'trigger_db', 'Set Trigger', 'Set New', 'administrator', 'trigger_set_trigger', 'trigger_set_trigger_page' );
		add_submenu_page( 'trigger_db', 'Compare', 'Compare', 'administrator', 'trigger_compare_trigger', 'trigger_compare_trigger_page' );
		
		add_action( 'admin_init', 'register_trigger_db_settings' );
	}
}

if( !function_exists('trigger_set_trigger_page')){
	function trigger_set_trigger_page(){
		require_once "$iwp_mmb_plugin_dir/includes/db-trigger-set.php"; 
	}
}
if( !function_exists('trigger_compare_trigger_page')){
	function trigger_compare_trigger_page(){
		echo 'Sub Menu 2';
	}
}

if( !function_exists('register_trigger_db_settings')){
	function register_trigger_db_settings() {
		register_setting( 'trigger-db-settings-group', 'tdb_mode' );
		
		settings_fields( 'trigger-db-settings-group' );
		do_settings_sections( 'trigger-db-settings-group' );
		
		if( get_option('tdb_mode') == '' ){
			update_option( 'tdb_mode' , 'false' );
		}
	}
}

if( !function_exists('trigger_db_welcome_page')){
	function trigger_db_welcome_page() {
		require_once "$iwp_mmb_plugin_dir/includes/db-trigger-welcome.php"; 
	}
}

add_action( 'admin_init', 'triggerdb_init' );
add_action( 'admin_menu', 'trigger_db_create_menu' );