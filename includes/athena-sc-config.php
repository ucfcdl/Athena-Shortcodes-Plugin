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

				if ( $interface_install ) {
					$shortcode->register_shortcode_interface();
				}
			}
		}

		public static function register_shortcodes_interface( $shortcodes ) {
			$installed = self::installed_shortcodes();
			$registration_array = array();

			foreach( $installed as $shortcode ) {
				var_dump( $shortcode );
				$shortcodes[] = $shortcode->register_interface();
			}

			return $shortcodes;
		}

		public static function installed_shortcodes() {
			$installed = apply_filters( 'athena_sc_add_shortcode', $shortcodes );

			return array_map( create_function( '$class', '
				return new $class;
			' ), $installed );
		}

		public static function athena_sc_add_shortcode( $shortcodes ) {
			return array(
				'ContainerSC',
				'RowSC',
				'ColSC'
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
