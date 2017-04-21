<?php
/**
 * Handles registering shortcodes.
 **/
if ( ! class_exists( 'ATHENA_SC_Config' ) ) {
	class ATHENA_SC_Config {
		/**
		 * Registers the shortcodes
		 **/
		public static function register_shortcodes() {
			$shortcodes = array();
			$installed = apply_filters( 'athena_sc_add_shortcode', $shortcodes );

			$shortcodes = array_map( create_function( '$class', '
				return new $class;
			' ), $installed );

			foreach( $shortcodes as $shortcode ) {
				$shortcode->register_shortcode();
			}
		}

		public static function athena_sc_add_shortcode( $shortcodes ) {
			return array(
				'ContainerSC'
			);
		}
	}
}
