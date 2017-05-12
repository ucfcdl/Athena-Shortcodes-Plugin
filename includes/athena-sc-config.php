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
			$shortcodes = self::installed_shortcodes();

			foreach( $shortcodes as $shortcode ) {
				$shortcode->register_shortcode();
			}
		}

		public static function register_shortcodes_interface( $shortcodes ) {
			$installed = self::installed_shortcodes();

			foreach( $installed as $shortcode ) {
				$shortcodes[] = $shortcode->register_interface();
			}

			return $shortcodes;
		}

		public static function installed_shortcodes() {
			$installed = apply_filters( 'athena_sc_add_shortcode', array( 'ATHENA_SC_Config', 'athena_sc_add_shortcode' ) );

			return array_map( create_function( '$class', '
				return new $class;
			' ), $installed );
		}

		public static function athena_sc_add_shortcode() {
			return array(
				'ContainerSC',
				'RowSC',
				'ColSC',
				'ButtonSC'
			);
		}

		public static function no_texturize( $shortcodes ) {
			$installed = self::installed_shortcodes();

			foreach( $installed as $shortcode ) {
				$shortcodes[] = $shortcode->command;
			}

			return $shortcodes;
		}
	}
}
