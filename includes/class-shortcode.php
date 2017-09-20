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
			$content = false,
			$preview = false;

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
				'fields'  => $this->fields(),
				'preview' => $this->preview,
				'group'   => $this->group ?: 'Athena Framework - Uncategorized'
			);
		}

		/**
		 * Returns the default values.
		 *
		 * @author Jim Barnes
		 * @since 1.0.0
		 *
		 * @param $param String | Optional, single shortcode param that a default value should be returned for.
		 * @return Mixed | An array of default values, or a single param's default value (if $param is set).
		 **/
		public function defaults( $param=null ) {
			$retval = array();
			$fields = $this->fields();

			foreach( $fields as $field ) {
				if ( isset( $field['default'] ) ) {
					$retval[$field['param']] = $field['default'];
				}
				else {
					$retval[$field['param']] = '';
				}
			}

			if ( $param && isset( $retval[$param] ) ) {
				$retval = $retval[$param];
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
		public function callback( $atts, $content ) {
			return '';
		}

		/**
		 * Determines if the shortcode $content contains
		 * the shortcode itself.
		 * @author Jim Barnes
		 * @since 1.0.0
		 * @param $content string | The content
		 * @return string
		 **/
		public function contains_nested( $content ) {
			$pattern = '/\[[a-zA-Z \=\"]+?\](.*+)?(\[\/\w+\])?/s';

			preg_match( $pattern, $content, $matches );

			if ( $matches ) {
				return true;
			}

			return false;
		}
	}
}
