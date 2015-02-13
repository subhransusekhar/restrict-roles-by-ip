<?php

// Performs an IP check on the current user when the page is loaded and redirect user if not in the array
function blockusers_init() {
	global $rri_options;
	if( isset( $rri_options['enable'] ) ) {
		$ips = array_map('trim', explode( "\n", $rri_options['ips'] ) );
		if( check_user_ip( $ips ) == FALSE) {
		  if ( is_admin() && current_user_can( 'administrator' ) &&
		      ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		        if($rri_options['redirect_url'] != '') {
		          wp_redirect( $rri_options['redirect_url'] ); exit;
		        }
		        else {
		          wp_redirect( home_url() ); exit;
		        }
		      }
		}
	}
}
add_action( 'init', 'blockusers_init', 0 );

/**
 * This function returns TRUE if the users IP is in allowed list
 * @param array $ips
 * @return boolean
 */
function check_user_ip( $ips ){
	
	$ip = get_user_ip();

	if( in_array( $ip, $ips ) || $ip == '127.0.0.1' ) {
		return TRUE;
	}
	return FALSE;
}
/**
 * This Fuction returns users client IP
 * @return string IP
 */
function get_user_ip() {
	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
	  $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
	  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
	  $ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}