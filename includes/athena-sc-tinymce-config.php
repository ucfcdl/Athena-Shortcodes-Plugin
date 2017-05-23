<?php
/**
 * Handles registering TinyMCE WYSIWYG formatting options.
 **/
if ( ! class_exists( 'ATHENA_SC_TinyMCE_Config' ) ) {
	class ATHENA_SC_TinyMCE_Config {

		public static function enable_formats( $buttons ) {
			array_unshift( $buttons, 'styleselect' );
			return $buttons;
		}

		public static function tinymce_formats_to_array( $formats ) {
			$retval = array();
			$array = array_filter( array_map( 'trim', explode( ';', $formats ) ) );
			foreach ( $array as $keyval ) {
				list( $key, $val ) = explode( '=', $keyval );
				$retval[$key] = $val;
			}
			return $retval;
		}

		public static function array_to_tinymce_formats( $array ) {
			$retval = '';
			$keys = array_keys( $array );
			$last_key = array_pop( $keys );
			foreach ( $array as $key => $val ) {
				$retval .= $key . '=' . $val;
				if ( $key !== $last_key ) {
					$retval .= ';';
				}
			}
			return $retval;
		}

		public static function get_block_formats( $block_formats ) {
			$block_formats = self::tinymce_formats_to_array( $block_formats );
			$new_block_formats = array_merge( $block_formats, array(
				'Div' => 'div',
				'Paragraph' => 'p',
				'Heading 1' => 'h1',
				'Heading 2' => 'h2',
				'Heading 3' => 'h3',
				'Heading 4' => 'h4',
				'Heading 5' => 'h5',
				'Heading 6' => 'h6',
				'Preformatted' => 'p'
			) );
			return self::array_to_tinymce_formats( $new_block_formats );
		}

		public static function get_format_options( $classes ) {
			$retval = array();
			if ( is_array( $classes ) ) {
				foreach ( $classes as $cls ) {
					$option = array(
						'title'      => '',
						'inline'     => '',
						'block'      => '',
						'selector'   => 'span,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
						'classes'    => '',
						'styles'     => '',
						'attributes' => '',
						'exact'      => '',
						'wrapper'    => ''
					);

					if ( is_string( $cls ) ) {
						$option['title'] = $option['classes'] = $cls;
					}
					elseif ( is_array( $cls ) ) {
						$option = array_replace( $option, $cls );
						if ( !$option['title'] ) { $option['title'] = $option['classes']; }
					}
					else {
						break;
					}

					$option = array_filter( $option );
					$retval[] = $option;
				}
			}
			return $retval;
		}

		public static function get_format( $title, $options ) {
			return array(
				'title' => $title,
				'items' => self::get_format_options( $options )
			);
		}

		public static function get_style_formats( $style_formats ) {
			$style_formats = $style_formats ? json_decode( $style_formats, true ) : array();

			$new_style_formats = array();

			// Text, list formatting options
			$new_style_formats = array(
				self::get_format( 'Blockquote Styles', array(
					array( 'block' => 'blockquote', 'classes' => 'blockquote', 'selector' => 'blockquote' ),
					array( 'block' => 'blockquote', 'classes' => 'blockquote-reverse', 'selector' => 'blockquote' ),
					array( 'block' => 'blockquote', 'classes' => 'blockquote-quotation', 'selector' => 'blockquote' ),
					array( 'block' => 'blockquote', 'classes' => 'blockquote-quotation-inverse', 'selector' => 'blockquote' ),
					array( 'block' => 'footer', 'classes' => 'blockquote-footer' )
				) ),
				self::get_format( 'Font Family', array(
					'font-sans-serif',
					'font-serif',
					'font-slab-serif',
					'font-condensed'
				) ),
				self::get_format( 'Font Weight/Style', array(
					'font-weight-light',
					'font-weight-normal',
					'font-weight-italic',
					'font-weight-bold',
					'font-weight-black'
				) ),
				self::get_format( 'Heading Size Styles', array(
					'h1',
					'h2',
					'h3',
					'h4',
					'h5',
					'h6',
					'display-1',
					'display-2',
					'display-3',
					'display-4'
				) ),
				self::get_format( 'Heading Underline Styles', array(
					'heading-underline',
					'heading-underline-inverse'
				) ),
				self::get_format( 'Horizontal Rule (hr) Styles', array(
					array( 'classes' => 'hr-2', 'selector' => 'hr' ),
					array( 'classes' => 'hr-3', 'selector' => 'hr' ),
					array( 'classes' => 'hr-black', 'selector' => 'hr' ),
					array( 'classes' => 'hr-primary', 'selector' => 'hr' ),
					array( 'classes' => 'hr-white', 'selector' => 'hr' ),
				) ),
				self::get_format( 'Inline Text Styles', array(
					'lead'
				) ),
				self::get_format( 'Letter Spacing', array(
					'letter-spacing-0',
					'letter-spacing-1',
					'letter-spacing-2',
					'letter-spacing-3',
					'letter-spacing-4',
					'letter-spacing-5'
				) ),
				self::get_format( 'List Styles', array(
					array( 'classes' => 'list-unstyled', 'selector' => 'ul' ),
					array( 'classes' => 'list-inline', 'selector' => 'ul' ),
					array( 'classes' => 'list-inline-item', 'selector' => 'li' )
				) ),
				self::get_format( 'Responsive Display Utilities', array(
					'hidden-xs-down',
					'hidden-sm-down',
					'hidden-md-down',
					'hidden-lg-down',
					'hidden-xl-down',
					'hidden-xs-up',
					'hidden-sm-up',
					'hidden-md-up',
					'hidden-lg-up',
					'hidden-xl-up',
					'visible-print-block',
					'visible-print-inline',
					'visible-print-inline-block',
					'hidden-print'
				) ),
				self::get_format( 'Text Alignment', array(
					'text-left',
					'text-center',
					'text-right',
					'text-justify',
					'text-truncate',
					'text-nowrap',
					'text-sm-left',
					'text-md-left',
					'text-lg-left',
					'text-xl-left',
					'text-sm-center',
					'text-md-center',
					'text-lg-center',
					'text-xl-center',
					'text-sm-right',
					'text-md-right',
					'text-lg-right',
					'text-xl-right'
				) ),
				self::get_format( 'Text Color', array(
					'text-default',
					'text-primary',
					'text-secondary',
					'text-complementary',
					'text-success',
					'text-info',
					'text-warning',
					'text-danger',
					'text-inverse',
					'text-muted',
					'text-white',
					'text-default-aw',
					'text-primary-aw',
					'text-secondary-aw',
					'text-complementary-aw',
					'text-success-aw',
					'text-info-aw',
					'text-warning-aw',
					'text-danger-aw',
					'text-inverse-aw',
					'text-primary-darkest',
					'text-primary-darker',
					'text-primary-lighter',
					'text-primary-lightest',
					'text-metallic-darkest',
					'text-metallic-darker',
					'text-metallic',
					'text-metallic-lighter',
					'text-metallic-lightest'
				) ),
				self::get_format( 'Text Transform', array(
					'text-uppercase',
					'text-lowercase',
					'text-capitalize',
					'text-transform-unset'
				) ),
				self::get_format( 'Text Visibility', array(
					'invisible',
					'text-hide',
					'sr-only',
					'sr-only-focusable'
				) ),
				self::get_format( 'Vertical Align', array(
					'align-baseline',
					'align-top',
					'align-middle',
					'align-bottom',
					'align-text-top',
					'align-text-bottom'
				) ),
			);

			return json_encode( array_merge( $style_formats, $new_style_formats ) );
		}

		public static function register_settings( $settings ) {
			$settings['block_formats'] = self::get_block_formats( $settings['block_formats'] );
			$settings['style_formats'] = self::get_style_formats( $settings['style_formats'] );

			return $settings;
		}

		/**
		 * Modifies WordPress's default markup for images added to the WYSIWYG
		 * editor.
		 *
		 * Had this as a separate method from ATHENA_SC_Config::format_image_output()
		 * to split out default markup output changes from editor-specific markup changes.
		 **/
		 public static function format_image_output( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
			// We shouldn't have to do this, but hooking into get_image_tag
			// eliminates any inserted [caption] shortcodes.
			// width=1 is overridden via a hook to img_caption_shortcode_width.
			// if ( $caption ) {
			// 	$html = '[caption caption="' . $caption . '" width="1"]' . $html . '[/caption]';
			// }
			return $html;
		 }
	}
}
