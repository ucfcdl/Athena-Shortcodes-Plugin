<?php
/**
 * Provides a container for inserting rows
 **/
if ( ! class_exists( 'RowSC' ) ) {
	class RowSC extends ATHENA_SC_Shortcode {
		public
			$command = 'row',
			$name = 'Row',
			$desc = 'Wraps content in a wrapper div with class .row.',
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
					'param'   => 'no_gutters',
					'name'    => 'Disable gutters',
					'desc'    => 'When checked, the generated .row\'s child columns will no left- or right-hand gutters.',
					'type'    => 'checkbox'
				),
				array(
					'param'   => 'class',
					'name'    => 'CSS Classes',
					'type'    => 'text'
				),
				array(
					'param'   => 'style',
					'name'    => 'Inline Styles',
					'desc'    => 'Any additional styles for the column.',
					'type'    => 'text'
				)
			);
		}

		/**
		 * Wraps content inside of a div with class .row
		 **/
		public function callback( $atts, $content='' ) {
			$atts = shortcode_atts( $this->defaults(), $atts );

			$classes = array( 'row' );
			if ( isset( $atts['no_gutters'] ) && filter_var( $atts['no_gutters'], FILTER_VALIDATE_BOOLEAN ) ) {
				$classes[] = 'no-gutters';
			}
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
