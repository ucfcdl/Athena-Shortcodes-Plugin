<?php
/**
 * Handles registering TinyMCE WYSIWYG formatting options.
 **/
if ( ! class_exists( 'ATHENA_SC_TinyMCE_Config' ) ) {
	class ATHENA_SC_TinyMCE_Config {

		public static function register_settings( $settings ) {

			// var_dump($styles);
			// TODO break this up into meaningful chunks that are overridable via hooks

			// $fonts = array();
			// $style_formats = array();
			// $font_families = array();
			// $content_css = array();

			// // Text, list formatting options
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
			// 	),
			// 	array(
			// 		'title' => 'List Style',
			// 		'items' => array(
			// 			array(
			// 				'title' => 'Inline Bulleted List',
			// 				'selector' => 'ul',
			// 				'classes' => 'list-inline-styled'
			// 			),
			// 		),
			// 	),
			// );

			// // Webfont family list
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

			// $content_css = implode( ',', array_unique( $content_css ) );
			// $settings['content_css'] = $settings['content_css'].','.$content_css; // Append font stylesheets to list of loaded stylesheets for tinymce
			// $settings['style_formats'] = json_encode( $style_formats );
			// $settings['theme_advanced_buttons2_add_before'] = 'styleselect'; // Add 'Format' button at beginning of 2nd row of btns
			// $settings['fontsize_formats'] = '10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 29px 30px 32px 36px 42px 48px 52px 58px 62px';


			return $settings;
		}
	}
}
