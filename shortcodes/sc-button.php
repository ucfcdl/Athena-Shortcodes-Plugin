<?php
/**
 * Provides a shortcode for the .container class
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
					'type'    => 'text',
					'default' => '#'
				),
				array(
					'param'   => 'type',
					'name'    => 'Button Type',
					'desc'    => 'Specify the type of button to use.  Solid buttons are used by default.',
					'type'    => 'select',
					'options' => array(
						'solid' => 'Solid (default)',
						'outline' => 'Outline',
						'outline-inverse' => 'Inverse outline'
					),
					'default' => 'solid'
				),
				array(
					'param'   => 'color',
					'name'    => 'Button Color',
					'desc'    => 'Specify the button color.  "Primary" buttons are used by default.  Note that not all colors are compatible with all button types.',
					'type'    => 'select',
					'options' => array(
						'primary'       => 'Gold (-primary)',
						'default'       => 'White with gray outline (-default)',
						'secondary'     => 'Black (-secondary)',
						'inverse'       => 'White (-inverse)',
						'link'          => 'Unstyled link',
						'complementary' => 'Blue (-complementary)',
						'success'       => 'Green (-success)',
						'info'          => 'Light Blue (-info)',
						'warning'       => 'Orange (-warning)',
						'danger'        => 'Red (-danger)'
					),
					'default' => 'primary'
				),
				array(
					'param'   => 'size',
					'name'    => 'Button Size',
					'desc'    => 'Specify a size override for the button.',
					'type'    => 'select',
					'options' => array(
						''   => '---',
						'sm' => 'Small',
						'lg' => 'Large'
					)
				),
				array(
					'param'   => 'block',
					'name'    => 'Block-level Button',
					'desc'    => 'When checked, the generated button will be block-level (and span the full width of its parent).',
					'type'    => 'checkbox'
				),
				array(
					'param'   => 'state',
					'name'    => 'Button State',
					'desc'    => 'Specify whether the button should have a default state on load.',
					'type'    => 'select',
					'options' => array(
						''   => '---',
						'active'   => 'Active',
						'disabled' => 'Disabled'
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

			$href = $atts['href'];
			$styles = $atts['style'] ?: false;
			$attributes = array();
			$classes = array( 'btn' );

			// Get the color variant class
			$variant_class = 'btn-';
			switch ( $atts['type'] ) {
				case 'outline':
					$variant_class .= 'outline-';
					break;
				case 'outline-inverse':
					$variant_class .= 'outline-i-';
				case 'solid':
				default:
					break;
			}
			$variant_class .= $atts['color'];
			$classes[] = $variant_class;

			// Get the size class, if applicable
			if ( $atts['size'] ) {
				$classes[] = 'btn-' . $atts['size'];
			}

			// Get the block-level btn class, if applicable
			if ( $atts['block'] && filter_var( $atts['block'], FILTER_VALIDATE_BOOLEAN ) ) {
				$classes[] = 'btn-block';
			}

			// Get any other additional classes
			if ( $atts['class'] ) {
				$classes[] = $atts['class'];
			}

			// Get any state-related classes and attributes, if applicable
			switch ( $atts['state'] ) {
				case 'active':
					$classes[] = 'active';
					$attributes[] = 'aria-pressed="true"';
					break;
				case 'disabled':
					$classes[] = 'disabled';
					$attributes[] = 'aria-disabled="true"';
					$attributes[] = 'tabindex="-1"';
					$attributes[] = 'onclick="return false;"';
					break;
				case '':
				default:
					break;
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
			<a href="<?php echo $href; ?>"
			class="<?php echo implode( $classes, ' ' ); ?>"
			<?php if ( $styles ) { echo 'style="' . $styles . '"'; } ?>
			<?php if ( $attributes ) { echo implode( $attributes, ' ' ); } ?>
			>
				<?php echo do_shortcode( $content ); ?>
			</a>
		<?php
			return ob_get_clean();
		}
	}
}
