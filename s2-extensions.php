<?php
/**
 * Plugin Name: s2 Extensions
 * Plugin URI: 
 * Description: This plugin adds some extended functionality for the s2member plugin. These extensions are unofficial and unsupported.
 * Version: 1.0
 * Author: colinhahn
 * Author URI:
 * License: GPLv2 or later
 */

add_shortcode( 's2Requires', 's2_requires_shortcode' );

function s2_requires_shortcode( $atts, $content = '' ) {

	$atts = shortcode_atts(
		array(
			'ccap' => ''
		),
		$atts
	);

	if( !empty( $atts['ccap'] ) ) {

		if( !empty( $_REQUEST['_s2member_vars' ] ) ) {
			
			// This line comes from the s2 codex in s2Member/API Scripting/Membership Options Page
			@list($restriction_type, $requirement_type, $requirement_type_value, $seeking_type, $seeking_type_value, $seeking_uri) = explode("..", stripslashes((string)$_REQUEST["_s2member_vars"]));

			// The conditional below only works for posts/pages that require a single ccap, not a comma-delimited list
			if( $requirement_type_value == $atts['ccap'] ) {

				return $content;

			} else { // There is a ccap requirement, but it's not for this shortcode

				return null;

			}
		} else { // There is a ccap requirement but there is no _s2_member_vars

			return null;
		}

	} else { // There is no required ccap

		return null;

	}
}

?>