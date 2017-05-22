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

		public static function register_formats( $formats ) {
			// TODO break this up into meaningful chunks that are overridable via hooks

			$style_formats = array();

			// Text, list formatting options
			// $style_formats = array(
			// 	array(
			// 		'title' => 'Text Formatting',
			// 		'items' => array(
			// 			array(
			// 				'title' => 'UPPERCASE',
			// 				'inline' => 'span',
			// 				'classes' => 'text-uppercase'
			// 			),
			// 			array(
			// 				'title' => 'lowercase',
			// 				'inline' => 'span',
			// 				'classes' => 'text-lowercase'
			// 			),
			// 		),
			// 	)
			// );

			// if ( $fonts ) {
			// 	foreach ( $fonts as $font=>$styles ) {
			// 		$font_families[] = array(
			// 			'title' => $font,
			// 			'inline' => 'span',
			// 			'classes' => sanitize_title( $font )
			// 		);
			// 	}
			// 	$style_formats[] = array(
			// 		'title' => 'Font Family',
			// 		'items' => $font_families,
			// 	);
			// }

			$formats['style_formats'] = json_encode( $style_formats );

			return $formats;
		}
	}
}
