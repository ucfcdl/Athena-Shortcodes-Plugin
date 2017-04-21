<?php
/**
 * Helper class for quickly defining shortcodes.
 **/
if ( ! class_exists( 'ATHENA_SC_Shortcode' ) ) {
	abstract class ATHENA_SC_Shortcode {
		public
			$command = 'Shortcode',
			$name = 'shortcode';

		/**
		 * Returns an array of fields
		 *
		 * @author Jim Barnes
		 * @since 1.0.0
		 *
		 * @return Array | The array of fields.
		 **/
		public static function fields() {
			return array();
		}

		/**
		 * Returns the default values.
		 *
		 * @author Jim Barnes
		 * @since 1.0.0
		 * 
		 * @return Array | An array of default values.
		 **/
		public static function defaults() {
			$retval = array();
			$fields = self::fields();

			foreach( $fields as $field ) {
				if ( isset( $field['default'] ) ) {
					$retval[$field['param']] = $field['default'];
				}
			}

			return $retval;
		}

		/**
		 * Registers the shortcode
		 *
		 * @author Jim Barnes
		 * @since 1.0.0
		 **/
		public function register_shortcode() {
			add_shortcode( $this->command, array( $this, 'callback' ) );
		}

		/**
		 * The callback for the shortcode
		 * 
		 * @author Jim Barnes
		 * @since 1.0.0
		 * 
		 * @param $atts Array | The shortcode attributes
		 * @param $content string | The html content within the shortcode
		 *
		 * @return string | The html output of the shortcode.
		 **/
		public static function callback( $atts, $content ) {
			return '';
		}
	}
}
