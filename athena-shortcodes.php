<?php
/*
Plugin Name: Athena Shortcodes
Version: 1.0.0
Author: UCF Web Communications
Description: Provides shortcodes for use with the Athena-Framework.
Plugin URL: https://github.com/UCF/Athena-Shortcodes-Plugin/
Tags: athena-framework,shortcodes
*/
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'ATHENA_SC__PLUGIN_FILE', __FILE__ );
define( 'ATHENA_SC__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( ! function_exists( 'athena_sc_plugin_activated' ) ) {
	function athena_sc_plugin_activated() {
		return;
	}

	register_activation_hook( ATHENA_SC__PLUGIN_FILE, 'athena_sc_plugin_activated' );
}

if ( ! function_exists( 'athena_sc_plguin_deactivated' ) ) {
	function athena_sc_plugin_deactivated() {
		return;
	}

	register_deactivation_hook( ATHENA_SC__PLUGIN_FILE, 'athena_sc_plugin_deactivated' );
}

if ( ! function_exists( 'athena_sc_init' ) ) {
	function athena_sc_init() {
		// Add hooks here.
	}

	add_action( 'plugins_loaded', 'athena_sc_init' );
}

?>
