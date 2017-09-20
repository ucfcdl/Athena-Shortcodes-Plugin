<?php
/**
 * Provides a shortcode for media background containers.
 **/
if ( ! class_exists( 'MediaBackgroundContainerSC' ) ) {
	class MediaBackgroundContainerSC extends ATHENA_SC_Shortcode {
		public
			$command = 'media-background-container',
			$name = 'Media Background Container',
			$desc = 'Creates a media background container.',
			$content = true,
			$preview = false;

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
					'param'   => 'element_type',
					'name'    => 'Element Type',
					'desc'    => 'Specify the type of element to use. Divs are used by default.',
					'type'    => 'select',
					'options' => $this->element_type_options(),
					'default' => 'div'
				),
				array(
					'param'   => 'href',
					'name'    => 'Link (for link elements)',
					'type'    => 'text'
				),
				array(
					'param'   => 'new_window',
					'name'    => 'Open link in a new window (for link elements)',
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

		public function element_type_options() {
			return array(
				'div'     => 'div',
				'section' => 'section',
				'aside'   => 'aside',
				'a'       => 'a'
			);
		}

		/**
		 * Wraps content inside of a .media-background-container and applies
		 * necessary classes to inner img/video
		 **/
		public function callback( $atts, $content='' ) {
			$atts = shortcode_atts( $this->defaults(), $atts );

			$href         = $atts['element_type'] === 'a' ? $atts['href'] : '';
			$new_window   = $atts['element_type'] === 'a' ? filter_var( $atts['new_window'], FILTER_VALIDATE_BOOLEAN ) : false;
			$id           = $atts['id'];
			$element_type = array_key_exists( $atts['element_type'], $this->element_type_options() ) ? $atts['element_type'] : $this->defaults( 'element_type' );
			$styles       = $atts['style'];
			$attributes   = array();
			$classes      = array( 'media-background-container' );
			$content_formatted = do_shortcode( $content );

			if ( $atts['class'] ) {
				$classes = array_unique( array_merge( $classes, explode( ' ', $atts['class'] ) ) );
			}

			if ( $element_type === 'a' && !$href ) {
				$attributes[] = 'tabindex="0"';
			}

			ob_start();
		?>
			<<?php echo $element_type; ?> class="<?php echo implode( ' ', $classes ); ?>"
			<?php if ( $href ) { echo 'href="' . $href . '"'; } ?>
			<?php if ( $id ) { echo 'id="' . $id . '"'; } ?>
			<?php if ( $new_window ) { echo 'target="_blank"'; } ?>
			<?php if ( $styles ) { echo 'style="' . $styles . '"'; } ?>
			<?php if ( $attributes ) { echo implode( ' ', $attributes ); } ?>
			>
				<?php echo $content_formatted; ?>
			</<?php echo $element_type; ?>>
		<?php
			return ob_get_clean();
		}
	}
}


/**
 * Provides a shortcode for media backgrounds.
 **/
 if ( ! class_exists( 'MediaBackgroundSC' ) ) {
	class MediaBackgroundSC extends ATHENA_SC_Shortcode {
		public
			$command = 'media-background',
			$name = 'Media Background',
			$desc = 'Creates a media background. Immediate child images and video are auto-detected and used as media background(s).',
			$content = true,
			$preview = false;

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
					'param'   => 'object_fit',
					'name'    => 'Object Fit',
					'desc'    => 'How the inner media background should be resized within the media background container.',
					'type'    => 'select',
					'options' => $this->object_fit_options(),
					'default' => 'object-fit-cover'
				),
				array(
					'param'   => 'object_position',
					'name'    => 'Object Position',
					'desc'    => 'How the inner media background should be positioned within the media background container. See <a href="https://css-tricks.com/almanac/properties/o/object-position/">object-position documentation</a> for usage/more information. Note that setting this value is not necessary when using an object-fit of "cover".',
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
					'desc'    => 'ID attribute for the inner element. Must be unique.',
					'type'    => 'text'
				),
				array(
					'param'   => 'style',
					'name'    => 'Inline Styles',
					'desc'    => 'Any additional styles for the inner element.',
					'type'    => 'text'
				)
			);
		}

		public function object_fit_options() {
			return array(
				'object-fit-contain'    => 'contain',
				'object-fit-cover'      => 'cover',
				'object-fit-fill'       => 'fill',
				'object-fit-none'       => 'none (unset an existing object-fit rule)',
				'object-fit-scale-down' => 'scale-down'
			);
		}

		/**
		 * Wraps content inside of a .media-background and applies
		 * necessary classes to inner img/picture/video
		 **/
		public function callback( $atts, $content='' ) {
			$atts = shortcode_atts( $this->defaults(), $atts );

			$id         = $atts['id'];
			$object_fit = array_key_exists( $atts['object_fit'], $this->object_fit_options() ) ? $atts['object_fit'] : $this->defaults( 'object_fit' );
			$styles     = trim( $atts['style'] );
			$classes    = array( 'media-background', $object_fit );
			$object_pos = $atts['object_position'];

			if ( $atts['class'] ) {
				$classes = array_unique( array_merge( $classes, explode( ' ', $atts['class'] ) ) );
			}
			if ( $styles && substr( $styles, -1 ) !== ';' ) {
				$styles .= ';';
			}
			if ( $object_pos ) {
				$styles .= ' object-position: ' . $object_pos . ';';
			}

			$content_formatted = do_shortcode( $content );
			$has_valid_media_bg = false;

			// Match any one inner <img> (either on its own, or as a <picture>
			// fallback)
			// TODO simplify match regex--no need to capture p/a elems here
			if ( preg_match( '/(<p>)?(<a [^>]+>)?<img [^>]+>(<\/a>)?(<\/p>)?/', $content_formatted, $match ) ) {
				$match_full = $match[0];
				$p_start    = $match[1];
				$a_start    = $match[2];
				$a_end      = $match[3];
				$p_end      = $match[4];
				$match_filtered = $match_full;

				// Strip wrapper <p>'s and <a>'s from inner elems
				$match_filtered = str_replace( array( $p_start, $a_start, $a_end, $p_end ), '', $match_filtered );

				// Apply extra classes
				if ( preg_match( '/class\=[\"|\']([^\"|\']+)[\"|\']/', $match_filtered, $class_matches ) ) {
					$elem_classes = array_merge( explode( ' ', $class_matches[1] ), $classes );
					$match_filtered = str_replace( $class_matches[0], 'class="' . implode( ' ', $elem_classes ) . '"', $match_filtered );
				}
				else {
					$match_filtered = str_replace( '<img ', '<img class="' . implode( ' ', $classes ) . '" ', $match_filtered );
				}

				// Apply extra styles
				if ( $styles ) {
					if ( preg_match( '/style\=[\"|\']([^\"|\']+)[\"|\']/', $match_filtered, $style_matches ) ) {
						$match_filtered = str_replace( $style_matches[0], 'style="' . $styles . '"', $match_filtered );
					}
					else {
						$match_filtered = str_replace( '<img ', '<img style="' . $styles . '" ', $match_filtered );
					}
				}

				// Apply ID if this is a standalone img
				if ( $id && strpos( $content_formatted, '<picture' ) === false ) {
					if ( preg_match( '/id\=[\"|\']([^\"|\']+)[\"|\']/', $match_filtered, $id_match ) ) {
						$match_filtered = str_replace( $id_match[0], 'id="' . $id . '"', $match_filtered );
					}
					else {
						$match_filtered = str_replace( '<img ', '<img id="' . $id . '" ', $match_filtered );
					}
				}

				// Apply object-position data attribute if necessary
				if ( $object_pos ) {
					if ( preg_match( '/data-object-position\=[\"|\']([^\"|\']+)[\"|\']/', $match_filtered, $object_pos_matches ) ) {
						$match_filtered = str_replace( $object_pos_matches[0], 'data-object-position="' . $object_pos . '"', $match_filtered );
					}
					else {
						$match_filtered = str_replace( '<img ', '<img data-object-position="' . $object_pos . '" ', $match_filtered );
					}
				}

				$content_formatted = str_replace( $match_full, $match_filtered, $content_formatted );
				$has_valid_media_bg = true;
			}

			if ( preg_match( '/<picture [^>]+>.*<\/picture>/', $content_formatted, $match ) ) {
				// TODO picture elem support
				$has_valid_media_bg = true;
			}

			if ( preg_match( '/(<video [^>]+>)(.*)<\/video>/', $content_formatted, $match ) ) {
				$match_full       = $match[0];
				$match_video_open = $match[1]; // the opening <video> tag, with attributes
				$match_video_open_filtered = $match_video_open;
				$match_filtered   = $match_full;

				// Remove fixed width/height attributes from video tag
				if ( strpos( $match_video_open, 'width=' ) !== false || strpos( $match_video_open, 'height=' ) !== false ) {
					$match_video_open_filtered = preg_replace( '/(width|height)="\d*"\s/', '', $match_video_open_filtered );
				}

				// Remove controls attribute from video tag
				if ( strpos( $match_video_open, ' controls' ) !== false ) {
					$match_video_open_filtered = preg_replace( '/ controls(\=[\"|\']controls[\"|\'])?/', '', $match_video_open_filtered );
				}

				// Apply extra classes.  Strip 'wp-video-shortcode' class
				if ( preg_match( '/class\=[\"|\']([^\"|\']+)[\"|\']/', $match_video_open, $class_matches ) ) {
					$elem_classes = array_merge( explode( ' ', $class_matches[1] ), $classes );

					if ( ( $key = array_search( 'wp-video-shortcode', $elem_classes ) ) !== false ) {
						unset( $elem_classes[$key] );
					}

					$match_video_open_filtered = str_replace( $class_matches[0], 'class="' . implode( ' ', $elem_classes ) . '"', $match_video_open_filtered );
				}
				else {
					$match_video_open_filtered = str_replace( '<video ', '<video class="' . implode( ' ', $classes ) . '" ', $match_video_open_filtered );
				}

				// Apply extra styles
				if ( $styles ) {
					if ( preg_match( '/style\=[\"|\']([^\"|\']+)[\"|\']/', $match_video_open, $style_matches ) ) {
						$match_video_open_filtered = str_replace( $style_matches[0], 'style="' . $styles . '"', $match_video_open_filtered );
					}
					else {
						$match_video_open_filtered = str_replace( '<video ', '<video style="' . $styles . '" ', $match_video_open_filtered );
					}
				}

				// Apply ID
				if ( $id ) {
					if ( preg_match( '/id\=[\"|\']([^\"|\']+)[\"|\']/', $match_video_open, $id_match ) ) {
						$match_video_open_filtered = str_replace( $id_match[0], 'id="' . $id . '"', $match_video_open_filtered );
					}
					else {
						$match_video_open_filtered = str_replace( '<video ', '<video id="' . $id . '" ', $match_video_open_filtered );
					}
				}

				// Apply object-position data attribute if necessary
				if ( $object_pos ) {
					if ( preg_match( '/data-object-position\=[\"|\']([^\"|\']+)[\"|\']/', $match_video_open, $object_pos_matches ) ) {
						$match_video_open_filtered = str_replace( $object_pos_matches[0], 'data-object-position="' . $object_pos . '"', $match_video_open_filtered );
					}
					else {
						$match_video_open_filtered = str_replace( '<video ', '<video data-object-position="' . $object_pos . '" ', $match_video_open_filtered );
					}
				}

				$match_filtered = str_replace( $match_video_open, $match_video_open_filtered, $match_filtered );
				$content_formatted = $match_filtered;
				$has_valid_media_bg = true;
			}

			// Return the media background.  If no valid inner contents are
			// detected, an empty div will be returned.
			if ( !$has_valid_media_bg ) {
				ob_start();
			?>
				<div class="<?php echo implode( $classes, ' ' ); ?>"
				<?php if ( $id ) { echo 'id="' . $id . '"'; } ?>
				<?php if ( $styles ) { echo 'style="' . $styles . '"'; } ?>
				<?php if ( $object_pos ) { echo 'data-object-position="' . $object_pos . '"'; } ?>
				></div>
			<?php
				$content_formatted = ob_get_clean();
			}
			return $content_formatted;
		}
	}
}
