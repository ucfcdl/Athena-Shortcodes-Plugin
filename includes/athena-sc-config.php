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

		public static function no_texturize( $shortcodes=array() ) {
			$installed = self::installed_shortcodes();

			foreach( $installed as $shortcode ) {
				$shortcodes[] = $shortcode->command;
			}

			return $shortcodes;
		}

		/**
		 * Strip out <p></p> and <br> from inner shortcode contents. Applied
		 * only to shortcodes returned by ATHENA_SC_Config::no_texturize().
		 *
		 * https://wordpress.stackexchange.com/a/130185
		 **/
		public static function format_shortcode_output( $content ) {
			$block = join( '|', self::no_texturize() );
			$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );
			$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );
			return $rep;
		}
	}
}
