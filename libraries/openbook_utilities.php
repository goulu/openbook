<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function openbook_getDisplayMessage($message) {
	return "<i>[" . esc_html( $message ) . "]</i> ";
}

//set default options on first activation and on reset
function openbook_utilities_setDefaultOptions() {

	$deprecated='';
    	$autoload='no';

	//test if options exist, if not create them
	$template = get_option(OB_OPTION_TEMPLATE1_NAME); //a required field

	if ($template == FALSE) {
		add_option(OB_OPTION_TEMPLATE1_NAME, OB_OPTION_TEMPLATE1_VAL, '', $autoload);
		add_option(OB_OPTION_TEMPLATE2_NAME, OB_OPTION_TEMPLATE2_VAL, '', $autoload);
		add_option(OB_OPTION_TEMPLATE3_NAME, OB_OPTION_TEMPLATE3_VAL, '', $autoload);
		add_option(OB_OPTION_TEMPLATE4_NAME, OB_OPTION_TEMPLATE4_VAL, '', $autoload);
		add_option(OB_OPTION_TEMPLATE5_NAME, OB_OPTION_TEMPLATE5_VAL, '', $autoload);
		add_option(OB_OPTION_FINDINLIBRARY_OPENURLRESOLVER_NAME, OB_OPTION_FINDINLIBRARY_OPENURLRESOLVER_VAL, '', $autoload);
		add_option(OB_OPTION_FINDINLIBRARY_PHRASE_NAME, OB_OPTION_FINDINLIBRARY_PHRASE_VAL, '', $autoload);
		add_option(OB_OPTION_FINDINLIBRARY_IMAGESRC_NAME, OB_OPTION_FINDINLIBRARY_IMAGESRC_VAL, '', $autoload);
		add_option(OB_OPTION_LIBRARY_DOMAIN_NAME, OB_OPTION_LIBRARY_DOMAIN_VAL, '', $autoload);
		add_option(OB_OPTION_PROXY_NAME, OB_OPTION_PROXY_VAL, '', $autoload);
		add_option(OB_OPTION_PROXYPORT_NAME, OB_OPTION_PROXYPORT_VAL, '', $autoload);
		add_option(OB_OPTION_TIMEOUT_NAME, OB_OPTION_TIMEOUT_VAL, '', $autoload);
		add_option(OB_OPTION_SHOWERRORS_NAME, OB_OPTION_SHOWERRORS_VALUE, '', $autoload);
		add_option(OB_OPTION_SAVETEMPLATES_NAME, OB_OPTION_SAVETEMPLATES_VALUE, '', $autoload);
	}
}

function openbook_utilities_deleteOptions() {

	delete_option(OB_OPTION_TEMPLATE1_NAME);
	delete_option(OB_OPTION_TEMPLATE2_NAME);
	delete_option(OB_OPTION_TEMPLATE3_NAME);
	delete_option(OB_OPTION_TEMPLATE4_NAME);
	delete_option(OB_OPTION_TEMPLATE5_NAME);
	delete_option(OB_OPTION_FINDINLIBRARY_OPENURLRESOLVER_NAME);
	delete_option(OB_OPTION_FINDINLIBRARY_PHRASE_NAME);
	delete_option(OB_OPTION_FINDINLIBRARY_IMAGESRC_NAME);
	delete_option(OB_OPTION_LIBRARY_DOMAIN_NAME);
	delete_option(OB_OPTION_PROXY_NAME);
	delete_option(OB_OPTION_PROXYPORT_NAME);
	delete_option(OB_OPTION_TIMEOUT_NAME);
	delete_option(OB_OPTION_SHOWERRORS_NAME);
	delete_option(OB_OPTION_SAVETEMPLATES_NAME);
}

function openbook_utilities_getUrlContents($url, $timeout, $proxy, $proxyport, $errmessage, $showerrors) {

	$args = array(
		'timeout' => $timeout ? intval($timeout) : 10,
	);

	$response = wp_remote_get($url, $args);

	if ( is_wp_error($response) ) {
		$error_message = $response->get_error_message();
		if ( stripos($error_message, 'timeout') !== false ) {
			throw new Exception( esc_html( OB_CURLTIMEOUT_LANG ) );
		}
		if ($showerrors == OB_HTML_CHECKED_TRUE) {
			/* translators: 1: error message, 2: requested URL */
			throw new Exception( esc_html( sprintf( __( 'HTTP request error - %1$s - %2$s', 'openbook' ), $error_message, $url ) ) );
		}
		throw new Exception( esc_html( OB_CURLERROR_LANG ) );
	}

	$status_code = wp_remote_retrieve_response_code($response);
	$body = wp_remote_retrieve_body($response);

	if ( stripos($body, 'Server') !== false && stripos($body, 'Error') !== false ) {
		throw new Exception( esc_html( OB_OLSERVERERROR_LANG ) );
	}

	if ( $status_code !== 200 ) {
		if ($showerrors == OB_HTML_CHECKED_TRUE) {
			/* translators: 1: HTTP status code, 2: requested URL */
			throw new Exception( esc_html( sprintf( __( 'HTTP request error - Status Code: %1$s - %2$s', 'openbook' ), $status_code, $url ) ) );
		}
		throw new Exception( esc_html( $errmessage ) );
	}

	if ( empty($body) ) {
		throw new Exception( esc_html( $errmessage ) );
	}

	return $body;
}

//test if 10 or 13 digits ISBN
function openbook_utilities_validISBN($testisbn) {
	return (preg_match ("/([0-9]{10})/", $testisbn, $regs) || preg_match ("/([0-9]{13})/", $testisbn, $regs));
}

function openbook_utilities_getDomain()
{
	return wp_strip_all_tags( isset( $_SERVER["SERVER_NAME"] ) ? wp_unslash( $_SERVER["SERVER_NAME"] ) : '' );
}

function openbook_localize_author_name( $name ) {
	if ( empty( $name ) ) {
		return '';
	}

	if ( stripos( get_locale(), 'zh' ) !== 0 ) {
		if ( function_exists( 'transliterator_transliterate' ) ) {
			// Check if the name has non-Latin characters by converting it to Latin without stripping accents
			$latin = transliterator_transliterate( 'Any-Latin; Title', $name );
			if ( $latin !== false && trim( $latin ) !== trim( $name ) ) {
				// Transliterate to ASCII to strip tones/accents from non-Latin scripts (e.g. Cíxīn -> Cixin)
				$ascii = transliterator_transliterate( 'Latin-ASCII', $latin );
				if ( $ascii !== false ) {
					return trim( $ascii ) . ' (' . trim( $name ) . ')';
				}
				return trim( $latin ) . ' (' . trim( $name ) . ')';
			}
		}
	}

	return $name;
}
?>
