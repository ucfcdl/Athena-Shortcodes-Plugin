<?php
/**
 * Provides a shortcode for the .container class
 **/
if ( ! class_exists( 'ColSC' ) ) {
	class ColSC extends ATHENA_SC_Shortcode {
		public
			$command = 'col',
			$name = 'Column',
			$desc = 'Adds a bootstrap column.',
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
					'param'   => 'xl',
					'name'    => 'Extra Large Size',
					'desc'    => 'The size of the column at the -xl breakpoint (>= 1200px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'lg',
					'name'    => 'Large Size',
					'desc'    => 'The size of the column at the -lg breakpoint (>= 992px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'md',
					'name'    => 'Medium Size',
					'desc'    => 'The size of the column at the -md breakpoint (>= 768px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'sm',
					'name'    => 'Small Size',
					'desc'    => 'The size of the column at the -sm breakpoint (>= 576px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'xs',
					'name'    => 'Default Size',
					'desc'    => 'The size of the column at the at the smallest sizes (< 576px).',
					'type'    => 'number'
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
					'desc'    => 'The offset of the column at the -lg breakpoint (>= 992px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'md_offset',
					'name'    => 'Medium Offset',
					'desc'    => 'The offset of the column at the -md breakpoint (>= 768px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'sm_offset',
					'name'    => 'Small Offset',
					'desc'    => 'The offset of the column at the -sm breakpoint (>= 576px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'xs_offset',
					'name'    => 'Default Offset',
					'desc'    => 'The offset of the column at the at the smallest sizes (< 576px).',
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
					'desc'    => 'Pushes the column the specified number of column widths at the -lg breakpoint (>= 992px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'md_push',
					'name'    => 'Medium Push',
					'desc'    => 'Pushes the column the specified number of column widths at the -md breakpoint (>= 768px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'sm_push',
					'name'    => 'Small Push',
					'desc'    => 'Pushes the column the specified number of column widths at the -sm breakpoint (>= 576px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'xs_push',
					'name'    => 'Default Push',
					'desc'    => 'Pushes the column the specified number of column widths at the smallest sizes (< 576px).',
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
					'desc'    => 'Pulls the column the specified number of column widths at the -lg breakpoint (>= 992px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'md_pull',
					'name'    => 'Medium Pull',
					'desc'    => 'Pulls the column the specified number of column widths at the -md breakpoint (>= 768px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'sm_pull',
					'name'    => 'Small Pull',
					'desc'    => 'Pulls the column the specified number of column widths at the -sm breakpoint (>= 576px).',
					'type'    => 'number'
				),
				array(
					'param'   => 'xs_pull',
					'name'    => 'Default Pull',
					'desc'    => 'Pulls the column the specified number of column widths at the smallest sizes (< 576px).',
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

			$classes = array( $atts['class'] ? $atts['class'] : '' );
			$prefixes = array( 'xs', 'sm', 'md', 'lg', 'xl' );
			$suffixes = array( '', '_offset', '_pull', '_push' );

			foreach( $prefixes as $prefix ) {
				foreach( $suffixes as $suffix ) {
					if ( $atts[$prefix.$suffix] ) {
						$suf = str_replace( '_', '', $suffix );
						if ( $suf !== '' ) {
							$classes[] = $suf . '-' . $prefix . '-' . $atts[$prefix.$suffix];
						} else {
							$classes[] = 'col-' . $prefix . '-' . $atts[$prefix.$suffix];
						}
					}
				}
			}

			$cls_str = implode( ' ', $classes );

			ob_start();
		?>
			<div class="<?php echo $cls_str; ?>"<?php echo $attr['style'] ? ' style="'.$attr['style'].'"' : '';?>>
				<?php echo do_shortcode( $content ); ?>
			</div>
		<?php
			return ob_get_clean();
		}
	}
}
