<?php
/**
 * Provides a shortcode for the .jumbotron class
 **/
if ( ! class_exists( 'JumbotronSC' ) ) {
	class JumbotronSC extends ATHENA_SC_Shortcode {
		public
			$command = 'jumbotron',
			$name = 'Jumbotron',
			$desc = 'Wraps content in an Athena jumbotron.',
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
					'name'    => 'Jumbotron Type',
					'desc'    => 'Specify the type of jumbotron to use. Fluid jumbotrons are used by default.',
					'type'    => 'select',
					'options' => array(
						'jumbotron-fluid' => 'Fluid jumbotron (.jumbotron-fluid)',
						'jumbotron' => 'Standard jumbotron (.jumbotron)'
					),
					'default' => 'jumbotron-fluid'
				),
				array(
					'param'   => 'class',
					'name'    => 'CSS Classes',
					'desc'    => 'Separate each class with a single space. Refer to the Athena Framework documentation for available classes.',
					'type'    => 'text'
				),
				array(
					'param'   => 'id',
					'name'    => 'ID',
					'desc'    => 'ID attribute for the jumbotron. Must be unique.',
					'type'    => 'text'
				),
				array(
					'param'   => 'style',
					'name'    => 'Inline Styles',
					'desc'    => 'Any additional styles for the jumbotron.',
					'type'    => 'text'
				)
			);
		}

		/**
		 * Wraps content inside of a div with class .jumbotron
		 **/
		public function callback( $atts, $content='' ) {
			$atts = shortcode_atts( $this->defaults(), $atts );

			$styles  = $atts['style'];
			$id      = $atts['id'];
			$classes = array( 'jumbotron', $atts['type'] );
			$classes = array_unique( array_merge( $classes, explode( ' ', $atts['class'] ) ) );

			ob_start();
		?>
			<div class="<?php echo implode( ' ', $classes ); ?>"
			<?php if ( $id ) { echo 'id="' . $id . '"'; } ?>
			<?php if ( $styles ) { echo 'style="' . $styles . '"'; } ?>
			>
				<?php echo do_shortcode( $content ); ?>
			</div>
		<?php
			return ob_get_clean();
		}
	}
}
