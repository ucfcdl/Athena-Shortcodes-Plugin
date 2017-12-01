<?php
/**
 * Provides a shortcode for the .btn class.
 **/
if ( ! class_exists( 'ButtonSC' ) ) {
	class ButtonSC extends ATHENA_SC_Shortcode {
		public
			$command = 'button',
			$name = 'Button',
			$desc = 'Creates a new link styled as an Athena button.',
			$content = true,
			$preview = true,
			$group = 'Athena Framework - Buttons';

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
					'param'   => 'rel',
					'name'    => 'Link object relationship (rel)',
					'desc'    => 'The relationship between the link and target object. Separate each link type with a single space.',
					'type'    => 'text'
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
					'desc'    => 'ID attribute for the button. Must be unique.',
					'type'    => 'text'
				),
				array(
					'param'   => 'style',
					'name'    => 'Inline Styles',
					'desc'    => 'Any additional styles for the button.',
					'type'    => 'text'
				),
				array(
					'param'   => 'data_toggle',
					'name'    => 'Data-Toggle',
					'desc'    => 'Type of toggling functionality the button should have. Use the [modal-toggle], [collapse-toggle], [popover] or [tooltip] shortcodes to create toggles for those components instead of the [button] shortcode.',
					'type'    => 'select',
					'options' => $this->data_toggle_options()
				),
				array(
					'param'   => 'data_dismiss',
					'name'    => 'Data-Dismiss',
					'desc'    => 'Parent component that should be dismissed/closed when the button is clicked.',
					'type'    => 'select',
					'options' => $this->data_dismiss_options()
				)
			);
		}

		public function data_toggle_options() {
			return array(
				''         => '---',
				'button'   => 'button',
				'dropdown' => 'dropdown'
			);
		}

		public function data_dismiss_options() {
			return array(
				''         => '---',
				'alert'    => 'alert',
				'modal'    => 'modal'
			);
		}

		/**
		 * Wraps content inside of a link with class .btn
		 **/
		public function callback( $atts, $content='' ) {
			$atts = shortcode_atts( $this->defaults(), $atts );

			$href       = $atts['href'];
			$new_window = filter_var( $atts['new_window'], FILTER_VALIDATE_BOOLEAN );
			$id         = $atts['id'];
			$styles     = $atts['style'];
			$attributes = array();
			$classes    = array( 'btn' );
			$rel        = $atts['rel'];

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

			// Get any data-attributes, if applicable
			if ( $atts['data_toggle'] && array_key_exists( $atts['data_toggle'], $this->data_toggle_options() ) ) {
				$attributes[] = 'data-toggle="' . $atts['data_toggle'] . '"';
			}
			if ( $atts['data_dismiss'] && array_key_exists( $atts['data_dismiss'], $this->data_dismiss_options() ) ) {
				$attributes[] = 'data-dismiss="' . $atts['data_dismiss'] . '"';
			}

			// Set the button's "role" attribute if it has no href value (we
			// assume its functionality is added via javascript somewhere.)
			// Otherwise, we assume the button should assume its default role
			// of being a basic link.
			if ( $href == '' || $href == '#' ) {
				$attributes[] = 'role="button"';
			}

			// If the href isn't set at all, force a tabindex value to allow
			// the link to still be tabbable. Also works around styling in
			// Athena that resets .btn text colors when no tabindex and href
			// are present.
			if ( !$href ) {
				$attributes[] = 'tabindex="0"';
			}

			ob_start();
		?>
			<a class="<?php echo implode( ' ', $classes ); ?>"
			<?php if ( $href ) { echo 'href="' . $href . '"'; } ?>
			<?php if ( $id ) { echo 'id="' . $id . '"'; } ?>
			<?php if ( $new_window ) { echo 'target="_blank"'; } ?>
			<?php if ( $styles ) { echo 'style="' . $styles . '"'; } ?>
			<?php if ( $rel ) { echo 'rel="' . $rel . '"'; } ?>
			<?php if ( $attributes ) { echo implode( ' ', $attributes ); } ?>
			>
				<?php echo do_shortcode( $content ); ?>
			</a>
		<?php
			return ob_get_clean();
		}
	}
}
