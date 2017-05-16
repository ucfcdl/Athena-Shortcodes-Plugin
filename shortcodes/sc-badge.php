<?php
/**
 * Provides a shortcode for the .container class
 **/
if ( ! class_exists( 'BadgeSC' ) ) {
	class BadgeSC extends ATHENA_SC_Shortcode {
		public
			$command = 'badge',
			$name = 'Badge',
			$desc = 'Wraps content in an Athena badge.',
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
					'param'   => 'href',
					'name'    => 'Badge Link',
					'desc'    => 'If provided, the badge will be rendered as a link.',
					'type'    => 'text'
				),
				array(
					'param'   => 'new_window',
					'name'    => 'Open link in a new window (if the badge is displayed as a link)',
					'type'    => 'checkbox',
					'default' => false
				),
				array(
					'param'   => 'class',
					'name'    => 'CSS Classes',
					'desc'    => 'Separate each class with a single space. Refer to the Athena Framework documentation for available classes.',
					'type'    => 'text'
				),
				array(
					'param'   => 'id',
					'name'    => 'CSS ID',
					'desc'    => 'ID attribute for the badge. Must be unique.',
					'type'    => 'text'
				),
				array(
					'param'   => 'style',
					'name'    => 'Inline Styles',
					'desc'    => 'Any additional styles for the badge.',
					'type'    => 'text'
				)
			);
		}

		/**
		 * Wraps content inside of a div with class .container
		 **/
		public function callback( $atts, $content='' ) {
			$atts = shortcode_atts( $this->defaults(), $atts );

			$href       = $atts['href'];
			$new_window = filter_var( $atts['new_window'], FILTER_VALIDATE_BOOLEAN );
			$id         = $atts['id'];
			$styles     = $atts['style'];
			$attributes = array();
			$classes    = array( 'badge' );
			$elem       = $href ? 'a' : 'span';

			// Use primary badge if the user didn't provide any classes
			if ( !$atts['class'] ) {
				$classes[] = 'badge-primary';
			}
			else {
				$classes = array_unique( array_merge( $classes, explode( ' ', $atts['class'] ) ) );
			}

			ob_start();
		?>
			<<?php echo $elem; ?> class="<?php echo implode( ' ', $classes ); ?>"
			<?php if ( $href ) { echo 'href="' . $href . '"'; } ?>
			<?php if ( $id ) { echo 'id="' . $id . '"'; } ?>
			<?php if ( $href && $new_window ) { echo 'target="_blank"'; } ?>
			<?php if ( $styles ) { echo 'style="' . $styles . '"'; } ?>
			<?php if ( $attributes ) { echo implode( ' ', $attributes ); } ?>
			>
				<?php echo do_shortcode( $content ); ?>
			</<?php echo $elem; ?>>
		<?php
			return ob_get_clean();
		}
	}
}
