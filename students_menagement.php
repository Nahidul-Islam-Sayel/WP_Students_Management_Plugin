<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Plugin Name:Studens Management
 * Description: This is a students management plugin.
 * Version: 1.0.0
 * Author: Nahidul Islam Sayel
 * Author URI: http://www.nahidulislamsayel.com
 */

 define( 'STUDENTS_MANAGEMENT_VERSION', '1.0.0' );
 define( 'STUDENTS_MANAGEMENT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
 define( 'STUDENTS_MANAGEMENT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
 define( 'STUDENTS_MANAGEMENT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
 define( 'STUDENTS_MANAGEMENT_PLUGIN_FILE', __FILE__ );
 require_once STUDENTS_MANAGEMENT_PLUGIN_DIR . 'src/students_management_funtions.php';

 register_activation_hook( __FILE__, 'result_management_activate' );
 add_action( 'admin_menu', 'result_management_admin_menu' );
 add_action( 'admin_menu', 'result_management_add_menu' );
 add_action( 'admin_menu', 'result_management_students_deshboard' );
 add_action( 'admin_enqueue_scripts', 'result_management_enqueue_scripts' );
 add_action( 'init', 'wporg_simple_role' );
 add_action( 'init', 'wporg_simple_role_caps', 11 );
 add_action( 'admin_menu', 'add_settings_page' );
