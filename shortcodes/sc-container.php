<?php
/**
 * Provides a shortcode for the .container class
 **/
if ( ! class_exists( 'ContainerSC' ) ) {
	class ContainerSC extends ATHENA_SC_Shortcode {
		public
			$command = 'container',
			$name = 'Container',
			$desc = 'Wraps content in an Athena container.',
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
					'param'   => 'type',
					'name'    => 'Container Type',
					'desc'    => 'Specify the type of container to use.  Standard, fixed-width .container\'s are used by default.',
					'type'    => 'select',
					'options' => array(
						'container' => 'Fixed-width per breakpoint (.container)',
						'container-fluid' => 'Fluid container (.container-fluid)'
					)
				),
				array(
					'param'   => 'class',
					'name'    => 'CSS Classes',
					'type'    => 'text'
				),
				array(
					'param'   => 'style',
					'name'    => 'Inline Styles',
					'desc'    => 'Any additional styles for the container.',
					'type'    => 'text'
				)
			);
		}

		/**
		 * Wraps content inside of a div with class .container
		 **/
		public function callback( $atts, $content='' ) {
			$atts = shortcode_atts( $this->defaults(), $atts );

			$classes = array();
			$classes[] = ( isset( $atts['type'] ) && $atts['type'] ) ? $atts['type'] : 'container';
			if ( isset( $atts['class'] ) && $atts['class'] ) {
				$classes[] = $atts['class'];
			}
			$styles = isset( $atts['style'] ) ? $atts['style'] : false;

			ob_start();
		?>
			<div class="<?php echo implode( $classes, ' ' ); ?>" <?php if ( $styles ) { echo 'style="' . $styles . '"'; } ?>>
				<?php echo do_shortcode( $content ); ?>
			</div>
		<?php
			return ob_get_clean();
		}
	}
}
