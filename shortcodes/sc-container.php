<?php
/**
 * Provides a shortcode for the .container class
 **/
if ( ! class_exists( 'ContainerSC' ) ) {
	class ContainerSC extends ATHENA_SC_Shortcode {
		public
			$command = 'container',
			$name = 'Container',
			$desc = 'Wraps content in a wrapper div with class .container.',
			$content = true;

		/**
		 * Returns the shortcode's fields.
		 *
		 * @author Jim Barnes
		 * @since 1.0.0
		 *
		 * @return Array | The shortcode's fields.
		 **/
		public function fields() {
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
		public function callback( $atts, $content='' ) {
			$atts = shortcode_atts( $this->defaults(), $atts );

			$class = 'container';

			$class .= isset( $atts['class'] ) ? $atts['class'] : '';

			ob_start();
		?>
			<div class="<?php echo $class; ?>">
				<?php echo do_shortcode( $content ); ?>
			</div>
		<?php
			return ob_get_clean();
		}
	}
}
