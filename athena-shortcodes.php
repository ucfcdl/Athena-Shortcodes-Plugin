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

// Shortcode files
include_once 'includes/class-shortcode.php';
include_once 'shortcodes/bs4-shortcodes.php';

include_once 'includes/athena-sc-config.php';


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
		// Add our preconfigured shortcodes.
		add_action( 'athena_sc_add_shortcode', array( 'ATHENA_SC_Config', 'athena_sc_add_shortcode' ), 10, 1 );
		// Add out shortcodes to the no_texturized list
		//add_action( 'no_texturize_shortcodes', array( 'ATHENA_SC_Config', 'no_texturize' ), 10, 1 );
		// Register our shortcodes.
		add_action( 'init', array( 'ATHENA_SC_Config', 'register_shortcodes' ) );

		// If the `WP-Shortcode-Interface` plugin is installed add the definitions.
		if ( is_plugin_active( 'WP-Shortcode-Interface/wp-shortcode-interface.php' ) ) {
			add_action( 'wp_scif_add_shortcode', array( 'ATHENA_SC_Config', 'register_shortcodes_interface' ), 10, 1 );
		}


		// remove_filter( 'the_content', 'wpautop' );
		// add_filter( 'the_content', 'wpautop' , 99);
		// add_filter( 'the_content', 'shortcode_unautop',100 );

		add_filter('the_content', 'do_shortcode', 9);
		add_filter('widget_text', 'do_shortcode', 9);
	}

	add_action( 'plugins_loaded', 'athena_sc_init' );
}

?>
