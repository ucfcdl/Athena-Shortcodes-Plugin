<?php
/**
 * Provides a shortcode for the .container class
 **/
if ( ! class_exists( 'ColSC' ) ) {
	class ColSC extends ATHENA_SC_Shortcode {
		public
			$command = 'col',
			$name = 'Column',
			$desc = 'Adds an Athena column.',
			$content = true,
			$group = 'Athena Framework - Grid System';

		/**
		 * Returns the shortcode's fields.
		 *
		 * @author Jim Barnes
		 * @since 1.0.0
		 *
		 * @return Array | The shortcode's fields.
		 **/
		public function fields() {
			$col_options = array(
				'' => '---',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
				'7' => '7',
				'8' => '8',
				'9' => '9',
				'10' => '10',
				'11' => '11',
				'12' => '12',
				'auto' => 'Auto (variable-width column)',
				'none' => 'None (equal-width column)'
			);

			return array(
				array(
					'param'   => 'xl',
					'name'    => 'Extra Large Size',
					'desc'    => 'The size of the column at the -xl breakpoint (>= 1200px).',
					'type'    => 'select',
					'options' => $col_options
				),
				array(
					'param'   => 'lg',
					'name'    => 'Large Size',
					'desc'    => 'The size of the column at the -lg breakpoint and up (>= 992px).',
					'type'    => 'select',
					'options' => $col_options
				),
				array(
					'param'   => 'md',
					'name'    => 'Medium Size',
					'desc'    => 'The size of the column at the -md breakpoint and up (>= 768px).',
					'type'    => 'select',
					'options' => $col_options
				),
				array(
					'param'   => 'sm',
					'name'    => 'Small Size',
					'desc'    => 'The size of the column at the -sm breakpoint and up (>= 576px).',
					'type'    => 'select',
					'options' => $col_options
				),
				array(
					'param'   => 'xs',
					'name'    => 'Default Size',
					'desc'    => 'The default size of the column (-xs breakpoint and up).',
					'type'    => 'select',
					'options' => $col_options
				),
				array(
					'param'   => 'xl_offset',
					'name'    => 'Extra Large Offset',
					'desc'    => 'The offset of the column at the -xl breakpoint (>= 1200px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'lg_offset',
					'name'    => 'Large Offset',
					'desc'    => 'The offset of the column at the -lg breakpoint and up (>= 992px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'md_offset',
					'name'    => 'Medium Offset',
					'desc'    => 'The offset of the column at the -md breakpoint and up (>= 768px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'sm_offset',
					'name'    => 'Small Offset',
					'desc'    => 'The offset of the column at the -sm breakpoint and up (>= 576px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'xs_offset',
					'name'    => 'Default Offset',
					'desc'    => 'The default offset of the column (-xs breakpoint and up).',
					'type'    => 'number'
				),
				array(
					'param'   => 'xl_push',
					'name'    => 'Extra Large Push',
					'desc'    => 'Pushes the column the specified number of column widths at the -xl breakpoint (>= 1200px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'lg_push',
					'name'    => 'Large Push',
					'desc'    => 'Pushes the column the specified number of column widths at the -lg breakpoint and up (>= 992px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'md_push',
					'name'    => 'Medium Push',
					'desc'    => 'Pushes the column the specified number of column widths at the -md breakpoint and up (>= 768px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'sm_push',
					'name'    => 'Small Push',
					'desc'    => 'Pushes the column the specified number of column widths at the -sm breakpoint and up (>= 576px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'xs_push',
					'name'    => 'Default Push',
					'desc'    => 'Pushes the column the specified number of column widths (-xs breakpoint and up).',
					'type'    => 'number'
				),
				array(
					'param'   => 'xl_pull',
					'name'    => 'Extra Large Pull',
					'desc'    => 'Pulls the column the specified number of column widths at the -xl breakpoint (>= 1200px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'lg_pull',
					'name'    => 'Large Pull',
					'desc'    => 'Pulls the column the specified number of column widths at the -lg breakpoint and up (>= 992px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'md_pull',
					'name'    => 'Medium Pull',
					'desc'    => 'Pulls the column the specified number of column widths at the -md breakpoint and up (>= 768px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'sm_pull',
					'name'    => 'Small Pull',
					'desc'    => 'Pulls the column the specified number of column widths at the -sm breakpoint and up (>= 576px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'xs_pull',
					'name'    => 'Default Pull',
					'desc'    => 'Pulls the column the specified number of column widths (-xs breakpoint and up).',
					'type'    => 'number'
				),
				array(
					'param'   => 'class',
					'name'    => 'CSS Classes',
					'desc'    => 'Any additional classes for the column.',
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
		 * Wraps content inside of a div with class .container
		 **/
		public function callback( $atts, $content='' ) {
			$atts = shortcode_atts( $this->defaults(), $atts );

			$classes  = array( $atts['class'] ?: '' );
			$styles   = $atts['style'] ?: false;
			$prefixes = array( 'xs', 'sm', 'md', 'lg', 'xl' );
			$suffixes = array( '', '_offset', '_pull', '_push' );

			foreach( $prefixes as $prefix ) {
				foreach( $suffixes as $suffix ) {
					$field_key = $prefix.$suffix;
					$field_val = $atts[$field_key];

					if ( isset( $field_val ) && $field_val !== '' ) {
						$modifier   = $suffix === '' ? 'col' : str_replace( '_', '', $suffix );
						$breakpoint = $prefix === 'xs' ? '' : '-' . $prefix;
						$size       = ( in_array( $field_val, array( '', 'none' ), true ) ) ? '' : '-' . $field_val;

						$classes[] = $modifier . $breakpoint . $size;
					}
				}
			}

			$cls_str = implode( ' ', $classes );

			ob_start();
		?>
			<div class="<?php echo $cls_str; ?>" <?php if ( $styles ) { echo 'style="' . $styles . '"'; } ?>>
				<?php echo do_shortcode( $content ); ?>
			</div>
		<?php
			return ob_get_clean();
		}
	}
}
