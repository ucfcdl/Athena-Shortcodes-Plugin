<?php
/**
 * Provides a shortcode for the .btn class.
 *
 * Note: button plugin features (toggle states, checkbox/radio buttons) are not
 * supported by this shortcode.
 **/
if ( ! class_exists( 'ButtonSC' ) ) {
	class ButtonSC extends ATHENA_SC_Shortcode {
		public
			$command = 'button',
			$name = 'Button',
			$desc = 'Creates a new link styled as an Athena button.',
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
					'name'    => 'Button Link',
					'type'    => 'text'
				),
				array(
					'param'   => 'new_window',
					'name'    => 'Open link in a new window',
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
					'desc'    => 'ID attribute for the button. Must be unique.',
					'type'    => 'text'
				),
				array(
					'param'   => 'style',
					'name'    => 'Inline Styles',
					'desc'    => 'Any additional styles for the button.',
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
			$classes    = array( 'btn' );

			// Use primary button if the user didn't provide any classes
			if ( !$atts['class'] ) {
				$classes[] = 'btn-primary';
			}
			else {
				$classes = array_unique( array_merge( $classes, explode( ' ', $atts['class'] ) ) );
			}

			// Get any state-related attributes, if applicable
			if ( in_array( 'active', $classes ) ) {
				$attributes[] = 'aria-pressed="true"';
			}
			else if ( in_array( 'disabled', $classes ) ) {
				$attributes[] = 'aria-disabled="true"';
				$attributes[] = 'tabindex="-1"';
				$attributes[] = 'onclick="return false;"';
			}

			// Set the button's "role" attribute if it has no href value (we
			// assume its functionality is added via javascript somewhere.)
			// Otherwise, we assume the button should assume its default role
			// of being a basic link.
			if ( $href == '' || $href == '#' ) {
				$attributes[] = 'role="button"';
			}

			ob_start();
		?>
			<a class="<?php echo implode( ' ', $classes ); ?>"
			<?php if ( $href ) { echo 'href="' . $href . '"'; } ?>
			<?php if ( $id ) { echo 'id="' . $id . '"'; } ?>
			<?php if ( $new_window ) { echo 'target="_blank"'; } ?>
			<?php if ( $styles ) { echo 'style="' . $styles . '"'; } ?>
			<?php if ( $attributes ) { echo implode( ' ', $attributes ); } ?>
			>
				<?php echo do_shortcode( $content ); ?>
			</a>
		<?php
			return ob_get_clean();
		}
	}
}
