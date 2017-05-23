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

		public static function register_shortcodes_preview_styles( $stylesheets ) {
			$stylesheets[] = plugins_url( 'static/athena-framework/css/framework.min.css', ATHENA_SC__PLUGIN_FILE );
			return $stylesheets;
		}

		public static function installed_shortcodes() {
			// Get shortcodes via the `athena_sc_add_shortcode` hook.
			$installed = self::athena_sc_add_shortcode();
			$installed = apply_filters( 'athena_sc_add_shortcode', $installed );

			return array_map( create_function( '$class', '
				return new $class;
			' ), $installed );
		}

		public static function athena_sc_add_shortcode() {
			return array(
				'ContainerSC',
				'RowSC',
				'ColSC',
				'BadgeSC',
				'ButtonSC',
				'JumbotronSC',
				'NavSC',
				'NavItemSC',
				'NavLinkSC',
				'TabContentSC',
				'TabPaneSC'
			);
		}

		public static function athena_sc_get_formatted_shortcodes() {
			$installed = self::installed_shortcodes();

			foreach( $installed as $shortcode ) {
				$shortcodes[] = $shortcode->command;
			}

			return $shortcodes;
		}

		/**
		 * Strip out <p></p> and <br> from inner shortcode contents. Applied
		 * only to shortcodes returned by the
		 * athena_sc_get_formatted_shortcodes hook.
		 *
		 * https://wordpress.stackexchange.com/a/130185
		 **/
		public static function format_shortcode_output( $content ) {
			// Get shortcodes via the `athena_sc_get_formatted_shortcodes` hook.
			$shortcodes = self::athena_sc_get_formatted_shortcodes();
			$shortcodes = apply_filters( 'athena_sc_get_formatted_shortcodes', $shortcodes );

			$block = join( '|', $shortcodes );
			$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );
			$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );
			return $rep;
		}

		public static function format_image_output_classes( $class, $id, $align, $size ) {
			return; // TODO
		}

		/**
		 * Modifies WordPress's default markup for images.
		 *
		 * I'd like to modify image markup at this level if possible, to ensure
		 * image tags are generated consistently in and outside of the post editor
		 **/
		 public static function format_image_output( $html, $id, $alt, $title, $align, $size ) {
			$athena_align = '';
			switch ( $align ) {
				case 'left':
					$athena_align = 'float-left';
					break;
				case 'center':
					$athena_align = 'mx-auto d-block';
					break;
				case 'right':
					$athena_align = 'float-right';
					break;
				case 'none':
				default:
					break;
			}

			list( $img_src, $width, $height ) = image_downsize( $id, $size );
			$title = $title ? 'title="' . esc_attr( $title ) . '" ' : '';
			$class = $athena_align . ' img-fluid size-' . esc_attr( $size ) . ' wp-image-' . $id;
			$html = '<img src="' . esc_attr( $img_src ) . '" alt="' . esc_attr($alt) . '" ' . $title . 'class="' . $class . '">';
			return $html;
		 }
	}
}
