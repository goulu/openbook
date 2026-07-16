<?php
/**
 * Standalone mock-based non-regression test runner for OpenBook Translation Loading.
 * Ensures openbook.php and its dependencies do not trigger translations before the init hook.
 */

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals
// phpcs:disable WordPress.PHP.DevelopmentFunctions.error_log_debug_backtrace

if ( php_sapi_name() === 'cli' ) {
	define( 'ABSPATH', true );
}

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define mock functions for WordPress API

$early_translation_calls = array();
$textdomain_loaded_called = false;

function __( $text, $domain = 'default' ) {
	global $early_translation_calls;
	if ( $domain === 'openbook' ) {
		$early_translation_calls[] = array(
			'text' => $text,
			'backtrace' => debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 5 )
		);
	}
	return $text;
}

function load_plugin_textdomain( $domain, $deprecated = false, $plugin_rel_path = false ) {
	global $textdomain_loaded_called;
	if ( $domain === 'openbook' ) {
		$textdomain_loaded_called = true;
	}
	return true;
}

function register_activation_hook( $file, $function ) {}
function register_deactivation_hook( $file, $function ) {}

$registered_hooks = array();
function add_action( $hook, $function, $priority = 10, $accepted_args = 1 ) {
	global $registered_hooks;
	$registered_hooks[] = array( 'type' => 'action', 'hook' => $hook, 'function' => $function );
}

function add_filter( $hook, $function, $priority = 10, $accepted_args = 1 ) {
	global $registered_hooks;
	$registered_hooks[] = array( 'type' => 'filter', 'hook' => $hook, 'function' => $function );
}

function add_shortcode( $tag, $function ) {}
function plugin_basename( $file ) { return basename( $file ); }
function get_locale() { return 'en_US'; }

// 1. Include openbook.php (simulates plugin loading)
require_once dirname( __FILE__ ) . '/../openbook.php';

// Assert no early translation calls were made during inclusion
if ( ! empty( $early_translation_calls ) ) {
	echo "\033[31mFAIL: Translation functions were called too early!\033[0m\n";
	foreach ( $early_translation_calls as $call ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo "  - String: \"{$call['text']}\"\n";
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo "    File: " . $call['backtrace'][0]['file'] . " on line " . $call['backtrace'][0]['line'] . "\n";
	}
	exit( 1 );
}

echo "\033[32mPASS: No translation functions were called during plugin load.\033[0m\n";

// 2. Locate the init callback function
$init_callback = null;
foreach ( $registered_hooks as $hook ) {
	if ( $hook['hook'] === 'init' ) {
		$init_callback = $hook['function'];
		break;
	}
}

if ( ! $init_callback ) {
	echo "\033[31mFAIL: No init action hook registered!\033[0m\n";
	exit( 1 );
}

// 3. Simulate calling the init hook
if ( is_string( $init_callback ) && function_exists( $init_callback ) ) {
	$init_callback();
} else {
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo "\033[31mFAIL: Hook callback $init_callback is not callable!\033[0m\n";
	exit( 1 );
}

// Assert text domain load was called on init
if ( ! $textdomain_loaded_called ) {
	echo "\033[31mFAIL: load_plugin_textdomain was not called on init hook!\033[0m\n";
	exit( 1 );
}

// Assert constants/language strings are now defined
if ( ! defined( 'OB_BOOKNUMBERREQUIRED_LANG' ) ) {
	echo "\033[31mFAIL: Translation constants were not defined on init hook!\033[0m\n";
	exit( 1 );
}

echo "\033[32mPASS: Translations and constants initialized successfully on init hook.\033[0m\n";
echo "\033[32mAll tests passed successfully.\033[0m\n";
exit( 0 );
