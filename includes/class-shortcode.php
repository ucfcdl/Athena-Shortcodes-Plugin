<?php
/**
 * Helper class for quickly defining shortcodes.
 **/
if ( ! class_exists( 'ATHENA_SC_Shortcode' ) ) {
	abstract class ATHENA_SC_Shortcode {
		public
			$command = 'Shortcode',
			$name = 'shortcode',
			$desc = '',
			$content = false;

		/**
		 * Returns an array of fields
		 *
		 * @author Jim Barnes
		 * @since 1.0.0
		 *
		 * @return Array | The array of fields.
		 **/
		public function fields() {
			return array();
		}

		/**
		 * Registers the fields with the `WP-Shortcode-Interface` Plugin
		 * 
		 * @author Jim Barnes
		 * @since 1.0.0
		 * 
		 * @param $shortcodes Array | The registered shortcodes.
		 * @return Array | The modified registered shortcodes array.
		 **/
		public function register_interface() {
			return array(
				'command' => $this->command,
				'name'    => $this->name,
				'desc'    => $this->desc,
				'content' => $this->content,
				'fields'  => $this->fields()
			);
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
