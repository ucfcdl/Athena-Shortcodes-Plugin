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
						'btn-' => 'Solid (default)',
						'btn-outline-' => 'Outline',
                        'btn-outline-i-' => 'Inverse outline'
					),
                    'default' => 'btn-'
				),
                array(
					'param'   => 'color',
					'name'    => 'Button Color',
					'desc'    => 'Specify the button color.  "Primary" buttons are used by default.  Note that not all colors are compatible with all button types.',
					'type'    => 'select',
					'options' => array(
						'default'       => 'White with gray outline (-default)',
						'primary'       => 'Gold (-primary)',
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
						'btn-sm' => 'Small',
						'btn-lg-' => 'Large'
					)
				),
                array(
					'param'   => 'block',
					'name'    => 'Block-level Button',
					'desc'    => 'When checked, the generated button will be block-level (and span the full width of its parent).',
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
					'desc'    => 'Any additional styles for the button.',
					'type'    => 'text'
				),
                array(
					'param'   => 'attributes',
					'name'    => 'Extra attributes',
					'desc'    => 'Any additional attributes for the button\'s <code>&lt;a&gt;</code> tag.',
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
			$classes = array( 'btn' );
			// ...
			$styles = $atts['style'] ?: false;
            $attributes = isset( $atts['attributes'] ) ? $atts['attributes'] : false; // TODO sanitize me cap'n!

			ob_start();
		?>
			<a href="<?php echo $href; ?>" class="<?php echo implode( $classes, ' ' ); ?>" <?php if ( $styles ) { echo 'style="' . $styles . '"'; } ?> <?php if ( $attributes ) { echo $attributes; } ?>>
				<?php echo do_shortcode( $content ); ?>
			</a>
		<?php
			return ob_get_clean();
		}
	}
}
