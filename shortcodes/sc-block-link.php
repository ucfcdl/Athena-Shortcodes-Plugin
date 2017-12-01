<?php
/**
 * Provides a shortcode for media background containers.
 **/
if ( ! class_exists( 'BlockLinkSC' ) ) {
	class BlockLinkSC extends ATHENA_SC_Shortcode {
		public
			$command = 'block-link',
			$name = 'Block Link',
			$desc = 'Inserts a generic link. Useful for wrapping block-level content in a link that would otherwise get stripped by the WYSIWYG editor.',
			$content = true,
			$preview = false,
			$group = 'Athena Framework - Utilities';

		/**
		 * Returns the shortcode's fields.
		 *
		 * @author Jo Dickson
		 * @since 1.0.0
		 *
		 * @return Array | The shortcode's fields.
		 **/
		public function fields() {
			return array(
				array(
					'param'   => 'href',
					'name'    => 'Link location',
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
					'desc'    => 'ID attribute for the element. Must be unique.',
					'type'    => 'text'
				),
				array(
					'param'   => 'style',
					'name'    => 'Inline Styles',
					'desc'    => 'Any additional styles for the element.',
					'type'    => 'text'
				)
			);
		}

		/**
		 * Wraps content inside of a generic link
		 **/
		public function callback( $atts, $content='' ) {
			$atts = shortcode_atts( $this->defaults(), $atts );

			$href         = $atts['href'];
			$new_window   = filter_var( $atts['new_window'], FILTER_VALIDATE_BOOLEAN );
			$id           = $atts['id'];
			$styles       = $atts['style'];
			$rel          = $atts['rel'];
			$attributes   = array();
			$classes      = $atts['class'];

			if ( !$href ) {
				$attributes[] = 'tabindex="0"';
			}

			ob_start();
		?>
			<a class="<?php echo $classes; ?>"
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
