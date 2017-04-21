<?php
/**
 * Provides shortcodes for BS4 Elements
 **/
if ( ! class_exists( 'ATHENA_SC_Container_Shortcode' ) ) {
	class ContainerSC extends ATHENA_SC_Shortcode {
		public
			$command = 'container',
			$name = 'Container';

		/**
		 * Returns the shortcode's fields.
		 *
		 * @author Jim Barnes
		 * @since 1.0.0
		 *
		 * @return Array | The shortcode's fields.
		 **/
		public static function fields() {
			return array(
				array(
					'param'   => 'class',
					'name'    => 'CSS Classes',
					'type'    => 'text'
				)
			);
		}

		/**
		 * Wraps content inside of a div with class .container
		 **/
		public static function callback( $atts, $content='' ) {
			$atts = shortcode_atts( self::defaults(), $atts );

			$class = 'container';

			$class .= isset( $atts['class'] ) ? ' <?php echo $atts["class"]; ?>' : '';

			ob_start();
		?>
			<div class="<?php echo $class; ?>">
				<?php echo $content; ?>
			</div>
		<?php
			return ob_get_clean();
		}
	}
}
