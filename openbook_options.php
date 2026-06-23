<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function openbook_options_validate_required($option_name, $option_value) {
	$option_value = trim($option_value);
	$message = $option_name . OB_VALUEREQUIRED_LANG;
	if ($option_value == '') {
		wp_die( esc_html( $message ) );
	}
}

//update or insert
function openbook_options_save_option($option_name, $option_value) {
	$option_value = trim($option_value);

	if (get_option($option_name) !== false) {
		update_option($option_name, $option_value);
	}
	else {
		$autoload='no';
		delete_option($option_name); //handles case where option exists with a blank value - fails get_option test in this function
		add_option($option_name, $option_value, '', $autoload);
	}
}

function openbook_render_options_page() {
	include_once('libraries/openbook_constants.php');
	include_once('libraries/openbook_language.php');
	include_once('libraries/openbook_utilities.php');

	$template1 = stripslashes(get_option(OB_OPTION_TEMPLATE1_NAME));
	$template2 = stripslashes(get_option(OB_OPTION_TEMPLATE2_NAME));
	$template3 = stripslashes(get_option(OB_OPTION_TEMPLATE3_NAME));
	$template4 = stripslashes(get_option(OB_OPTION_TEMPLATE4_NAME));
	$template5 = stripslashes(get_option(OB_OPTION_TEMPLATE5_NAME));
	$openurlresolver = get_option(OB_OPTION_FINDINLIBRARY_OPENURLRESOLVER_NAME);
	$findinlibraryphrase = get_option(OB_OPTION_FINDINLIBRARY_PHRASE_NAME);
	$findinlibraryimagesrc = get_option(OB_OPTION_FINDINLIBRARY_IMAGESRC_NAME);
	$domain = get_option(OB_OPTION_LIBRARY_DOMAIN_NAME);
	$proxy = get_option(OB_OPTION_PROXY_NAME);
	$proxyport = get_option(OB_OPTION_PROXYPORT_NAME);
	$timeout = get_option(OB_OPTION_TIMEOUT_NAME);
	$showerrors = get_option(OB_OPTION_SHOWERRORS_NAME);
	$savetemplates = get_option(OB_OPTION_SAVETEMPLATES_NAME);

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		// Nonce verification
		if ( ! isset( $_POST['openbook_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['openbook_nonce'] ), 'openbook_options_update' ) ) {
			wp_die( 'Security check failed.' );
		}

		if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'save') {

			$template1 = wp_kses_post( wp_unslash( $_POST[OB_OPTION_TEMPLATE1_NAME] ) );
			$template2 = wp_kses_post( wp_unslash( $_POST[OB_OPTION_TEMPLATE2_NAME] ) );
			$template3 = wp_kses_post( wp_unslash( $_POST[OB_OPTION_TEMPLATE3_NAME] ) );
			$template4 = wp_kses_post( wp_unslash( $_POST[OB_OPTION_TEMPLATE4_NAME] ) );
			$template5 = wp_kses_post( wp_unslash( $_POST[OB_OPTION_TEMPLATE5_NAME] ) );
			$openurlresolver = esc_url_raw( wp_unslash( $_POST[OB_OPTION_FINDINLIBRARY_OPENURLRESOLVER_NAME] ) );
			$findinlibraryphrase = sanitize_text_field( wp_unslash( $_POST[OB_OPTION_FINDINLIBRARY_PHRASE_NAME] ) );
			$findinlibraryimagesrc = esc_url_raw( wp_unslash( $_POST[OB_OPTION_FINDINLIBRARY_IMAGESRC_NAME] ) );
			$domain = esc_url_raw( wp_unslash( $_POST[OB_OPTION_LIBRARY_DOMAIN_NAME] ) );
			$proxy = sanitize_text_field( wp_unslash( $_POST[OB_OPTION_PROXY_NAME] ) );
			$proxyport = sanitize_text_field( wp_unslash( $_POST[OB_OPTION_PROXYPORT_NAME] ) );
			$timeout = sanitize_text_field( wp_unslash( $_POST[OB_OPTION_TIMEOUT_NAME] ) );
			
			$showerrors = isset($_POST[OB_OPTION_SHOWERRORS_NAME]) && $_POST[OB_OPTION_SHOWERRORS_NAME] == 'on' ? OB_HTML_CHECKED_TRUE : OB_HTML_CHECKED_FALSE;
			$savetemplates = isset($_POST[OB_OPTION_SAVETEMPLATES_NAME]) && $_POST[OB_OPTION_SAVETEMPLATES_NAME] == 'on' ? OB_HTML_CHECKED_TRUE : OB_HTML_CHECKED_FALSE;

			openbook_options_validate_required(OB_OPTION_TEMPLATE1_LANG, $template1);
			openbook_options_save_option(OB_OPTION_TEMPLATE1_NAME, $template1);

			openbook_options_save_option(OB_OPTION_TEMPLATE2_NAME, $template2);
			openbook_options_save_option(OB_OPTION_TEMPLATE3_NAME, $template3);
			openbook_options_save_option(OB_OPTION_TEMPLATE4_NAME, $template4);
			openbook_options_save_option(OB_OPTION_TEMPLATE5_NAME, $template5);

			openbook_options_save_option(OB_OPTION_FINDINLIBRARY_OPENURLRESOLVER_NAME, $openurlresolver);

			openbook_options_validate_required(OB_OPTION_FINDINLIBRARY_PHRASE_LANG, $findinlibraryphrase);
			openbook_options_save_option(OB_OPTION_FINDINLIBRARY_PHRASE_NAME, $findinlibraryphrase);

			openbook_options_save_option(OB_OPTION_FINDINLIBRARY_IMAGESRC_NAME, $findinlibraryimagesrc);

			openbook_options_validate_required(OB_OPTION_LIBRARY_DOMAIN_LANG, $domain);
			openbook_options_save_option(OB_OPTION_LIBRARY_DOMAIN_NAME, $domain);

			openbook_options_save_option(OB_OPTION_PROXY_NAME, $proxy);
			openbook_options_save_option(OB_OPTION_PROXYPORT_NAME, $proxyport);

			openbook_options_validate_required(OB_OPTION_TIMEOUT_LANG, $timeout);
			openbook_options_save_option(OB_OPTION_TIMEOUT_NAME, $timeout);

			openbook_options_save_option(OB_OPTION_SHOWERRORS_NAME, $showerrors);
			openbook_options_save_option(OB_OPTION_SAVETEMPLATES_NAME, $savetemplates);

			echo '<strong><em>' . esc_html( OB_OPTIONS_CONFIRM_SAVED_LANG ) . '</em></strong>';
		}
		else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'reset') {

			openbook_utilities_deleteOptions();
			openbook_utilities_setDefaultOptions();

			$template1 = get_option(OB_OPTION_TEMPLATE1_NAME);
			$template2 = get_option(OB_OPTION_TEMPLATE2_NAME);
			$template3 = get_option(OB_OPTION_TEMPLATE3_NAME);
			$template4 = get_option(OB_OPTION_TEMPLATE4_NAME);
			$template5 = get_option(OB_OPTION_TEMPLATE5_NAME);
			$openurlresolver = get_option(OB_OPTION_FINDINLIBRARY_OPENURLRESOLVER_NAME);
			$findinlibraryphrase = get_option(OB_OPTION_FINDINLIBRARY_PHRASE_NAME);
			$findinlibraryimagesrc = get_option(OB_OPTION_FINDINLIBRARY_IMAGESRC_NAME);
			$domain = get_option(OB_OPTION_LIBRARY_DOMAIN_NAME);
			$proxy = get_option(OB_OPTION_PROXY_NAME);
			$proxyport = get_option(OB_OPTION_PROXYPORT_NAME);
			$timeout = get_option(OB_OPTION_TIMEOUT_NAME);
			$showerrors = get_option(OB_OPTION_SHOWERRORS_NAME);
			$savetemplates = get_option(OB_OPTION_SAVETEMPLATES_NAME);

			echo '<strong><em>' . esc_html( OB_OPTIONS_CONFIRM_RESET_LANG ) . '</em></strong>';
		}
	}
	?>
	<style>
	.pifButton {
		-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
		-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
		box-shadow:inset 0px 1px 0px 0px #ffffff;
		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
		background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
		background-color:#ededed;
		-moz-border-radius:6px;
		-webkit-border-radius:6px;
		border-radius:6px;
		border:1px solid #dcdcdc;
		display:inline-block;
		color:#777777;
		font-family:arial;
		font-size:15px;
		font-weight:bold;
		padding:6px 24px;
		text-decoration:none;
		text-shadow:1px 1px 0px #ffffff;
	}.pifButton:hover {
		background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) );
		background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
		background-color:#dfdfdf;
	}.pifButton:active {
		position:relative;
		top:1px;
	}
	</style>

	<div class="wrap">
	<h2>OpenBook</h2>

	<form method="post" action="">
	<?php wp_nonce_field( 'openbook_options_update', 'openbook_nonce' ); ?>

	<h3><?php echo esc_html( OB_OPTIONS_TEMPLATETEMPLATES_LANG ); ?></h3>
	<p><?php echo esc_html( OB_OPTIONS_TEMPLATETEMPLATES_DETAIL_LANG ); ?></p>

	<table class="form-table">

	<tr valign="top">
	<td width="12%"><?php echo esc_html( OB_OPTION_TEMPLATE1_LANG ); ?></td>
	<td><textarea cols="80" rows="8" name="<?php echo esc_attr( OB_OPTION_TEMPLATE1_NAME ); ?>" ><?php echo esc_textarea( $template1 ); ?></textarea></td>
	<td></td>
	</tr>

	<tr valign="top">
	<td><?php echo esc_html( OB_OPTION_TEMPLATE2_LANG ); ?></td>
	<td><textarea cols="80" rows="8" name="<?php echo esc_attr( OB_OPTION_TEMPLATE2_NAME ); ?>" ><?php echo esc_textarea( $template2 ); ?></textarea></td>
	<td></td>
	</tr>

	<tr valign="top">
	<td><?php echo esc_html( OB_OPTION_TEMPLATE3_LANG ); ?></td>
	<td><textarea cols="80" rows="8" name="<?php echo esc_attr( OB_OPTION_TEMPLATE3_NAME ); ?>" ><?php echo esc_textarea( $template3 ); ?></textarea></td>
	<td></td>
	</tr>

	<tr valign="top">
	<td><?php echo esc_html( OB_OPTION_TEMPLATE4_LANG ); ?></td>
	<td><textarea cols="80" rows="8" name="<?php echo esc_attr( OB_OPTION_TEMPLATE4_NAME ); ?>" ><?php echo esc_textarea( $template4 ); ?></textarea></td>
	<td></td>
	</tr>

	<tr valign="top">
	<td><?php echo esc_html( OB_OPTION_TEMPLATE5_LANG ); ?></td>
	<td><textarea cols="80" rows="8" name="<?php echo esc_attr( OB_OPTION_TEMPLATE5_NAME ); ?>" ><?php echo esc_textarea( $template5 ); ?></textarea></td>
	<td></td>
	</tr>

	</table>

	<h3><?php echo esc_html( OB_OPTIONS_FINDINLIBRARY_LANG ); ?></h3>
	<table class="form-table">

	<tr valign="top">
	<td width="12%"><?php echo esc_html( OB_OPTIONS_FINDINLIBRARY_OPENURLRESOLVER_LANG ); ?></td>
	<td width="28%"><input type="text" name="<?php echo esc_attr( OB_OPTION_FINDINLIBRARY_OPENURLRESOLVER_NAME ); ?>" value="<?php echo esc_attr( $openurlresolver ); ?>" size="50" /></td>
	<td><?php echo esc_html( OB_OPTIONS_FINDINLIBRARY_OPENURLRESOLVER_DETAIL_LANG ); ?> <a href="http://www.worldcat.org/registry/institutions">WorldCat Registry</a>.</td>
	</tr>

	<tr valign="top">
	<td><?php echo esc_html( OB_OPTIONS_FINDINLIBRARY_PHRASE_LANG ); ?></td>
	<td><input type="text" name="<?php echo esc_attr( OB_OPTION_FINDINLIBRARY_PHRASE_NAME ); ?>" value="<?php echo esc_attr( $findinlibraryphrase ); ?>" size="50" /></td>
	<td><?php echo esc_html( OB_OPTIONS_FINDINLIBRARY_PHRASE_DETAIL_LANG ); ?></td>
	</tr>

	<tr valign="top">
	<td><?php echo esc_html( OB_OPTIONS_FINDINLIBRARY_IMAGESRC_LANG ); ?></td>
	<td><input type="text" name="<?php echo esc_attr( OB_OPTION_FINDINLIBRARY_IMAGESRC_NAME ); ?>" value="<?php echo esc_attr( $findinlibraryimagesrc ); ?>" size="50" /></td>
	<td><?php echo esc_html( OB_OPTIONS_FINDINLIBRARY_IMAGESRC_DETAIL_LANG ); ?></td>
	</tr>

	</table>

	<h3><?php echo esc_html( OB_OPTIONS_SYSTEM_LANG ); ?></h3>
	<table class="form-table">

	<tr valign="top">
	<td width="12%"><?php echo esc_html( OB_OPTIONS_LIBRARY_DOMAIN_LANG ); ?></td>
	<td width="28%"><input type="text" name="<?php echo esc_attr( OB_OPTION_LIBRARY_DOMAIN_NAME ); ?>" value="<?php echo esc_attr( $domain ); ?>" size="50" /></td>
	<td><?php echo esc_html( OB_OPTIONS_LIBRARY_DOMAIN_DETAIL_LANG ); ?></td>
	</tr>

	<tr valign="top">
	<td><?php echo esc_html( OB_OPTION_SYSTEM_PROXY_LANG ); ?></td>
	<td><input type="text" name="<?php echo esc_attr( OB_OPTION_PROXY_NAME ); ?>" value="<?php echo esc_attr( $proxy ); ?>" size="50" /></td>
	<td><?php echo esc_html( OB_OPTION_SYSTEM_PROXY_DETAIL_LANG ); ?></td>
	</tr>

	<tr valign="top">
	<td><?php echo esc_html( OB_OPTION_SYSTEM_PROXYPORT_LANG ); ?></td>
	<td><input type="text" name="<?php echo esc_attr( OB_OPTION_PROXYPORT_NAME ); ?>" value="<?php echo esc_attr( $proxyport ); ?>" size="5" /></td>
	<td><?php echo esc_html( OB_OPTION_SYSTEM_PROXYPORT_DETAIL_LANG ); ?></td>
	</tr>

	<tr valign="top">
	<td><?php echo esc_html( OB_OPTION_SYSTEM_TIMEOUT_LANG ); ?></td>
	<td><input type="text" name="<?php echo esc_attr( OB_OPTION_TIMEOUT_NAME ); ?>" value="<?php echo esc_attr( $timeout ); ?>" size="5" /></td>
	<td><?php echo esc_html( OB_OPTION_SYSTEM_TIMEOUT_DETAIL_LANG ); ?></td>
	</tr>

	<tr valign="top">
	<td><?php echo esc_html( OB_OPTIONS_SHOWERRORS_LANG ); ?></td>
	<td><input type="checkbox" name="<?php echo esc_attr( OB_OPTION_SHOWERRORS_NAME ); ?>" <?php echo ' ' . esc_attr( $showerrors ) . ' '; ?> /> </td>
	<td><?php echo esc_html( OB_OPTIONS_SHOWERRORS_DETAIL_LANG ); ?></td>
	</tr>

	<tr valign="top">
	<td><?php echo esc_html( OB_OPTIONS_SAVETEMPLATES_LANG ); ?></td>
	<td><input type="checkbox" name="<?php echo esc_attr( OB_OPTION_SAVETEMPLATES_NAME ); ?>" <?php echo ' ' . esc_attr( $savetemplates ) . ' '; ?> /> </td>
	<td><?php echo esc_html( OB_OPTIONS_SAVETEMPLATES_DETAIL_LANG ); ?></td>
	</tr>

	</table>

	<p class="submit">
	<input name="save" type="submit" class="button-primary" value="<?php echo esc_attr( OB_OPTIONS_SAVECHANGES_LANG ); ?>" />
	<input type="hidden" name="action" value="save" />
	</p>
	</form>

	<form method="post">
	<?php wp_nonce_field( 'openbook_options_update', 'openbook_nonce' ); ?>
	<p class="submit">
	<input name="reset" type="submit" class="button-primary" value="<?php echo esc_attr( OB_OPTIONS_RESET_LANG ); ?>" />
	<input type="hidden" name="action" value="reset" />
	</p>
	</form>
	<br>

	</div>
	<?php
}
