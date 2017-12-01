<?php
/**
 * Provides a means to insert an empty span tag with icon classes.
 **/
if ( ! class_exists( 'IconSC' ) ) {
	class IconSC extends ATHENA_SC_Shortcode {
		public
			$command = 'icon',
			$name = 'Icon',
			$desc = 'Adds a span, classes and styles intended for icons.',
			$group = 'Athena Framework - Utilities';

		/**
		 * Returns the shortcode's fields.
		 *
		 * @author RJ Bruneel
		 * @since 0.2.0
		 *
		 * @return Array | The shortcode's fields.
		 **/
		public function fields() {
			return array(
				array(
					'param'   => 'class',
					'name'    => 'CSS Classes',
					'desc'    => 'Include icon classes to be added to the span.',
					'type'    => 'text'
				),
				array(
					'param'   => 'style',
					'name'    => 'Inline Styles',
					'desc'    => 'Any additional styles to be added to the span.',
					'type'    => 'text'
				)
			);
		}

		/**
		 * Adds an empty span with supplied classes and styles along with aria-hidden="true" attribute.
		 **/
		public function callback( $atts, $content='' ) {
			$atts = shortcode_atts( $this->defaults(), $atts );

			$classes = $atts['class'] ?: false;
			$styles = $atts['style'] ?: false;

			ob_start();
		?>
			<span<?php if ( $classes ) { echo ' class="' . $classes . '"'; } ?><?php if ( $styles ) { echo ' style="' . $styles . '"'; } ?> aria-hidden="true"></span>
		<?php
			return ob_get_clean();
		}
	}
}
