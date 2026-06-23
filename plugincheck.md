# Plugin Check Report

**Plugin:** OpenBook
**Generated at:** 2026-06-23 14:17:26


## `tests/run-tests.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 10 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$early_translation_calls&quot;. |  |
| 11 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$textdomain_loaded_called&quot;. |  |
| 13 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound | Functions declared in the global namespace by a theme/plugin should start with the theme/plugin prefix. Found: &quot;__&quot;. |  |
| 16 | 9 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$early_translation_calls&quot;. |  |
| 18 | 19 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_debug_backtrace | debug_backtrace() found. Debug code should not normally be used in production. |  |
| 24 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound | Functions declared in the global namespace by a theme/plugin should start with the theme/plugin prefix. Found: &quot;load_plugin_textdomain&quot;. |  |
| 27 | 9 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$textdomain_loaded_called&quot;. |  |
| 32 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound | Functions declared in the global namespace by a theme/plugin should start with the theme/plugin prefix. Found: &quot;register_activation_hook&quot;. |  |
| 33 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound | Functions declared in the global namespace by a theme/plugin should start with the theme/plugin prefix. Found: &quot;register_deactivation_hook&quot;. |  |
| 35 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$registered_hooks&quot;. |  |
| 36 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound | Functions declared in the global namespace by a theme/plugin should start with the theme/plugin prefix. Found: &quot;add_action&quot;. |  |
| 38 | 5 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$registered_hooks&quot;. |  |
| 41 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound | Functions declared in the global namespace by a theme/plugin should start with the theme/plugin prefix. Found: &quot;add_filter&quot;. |  |
| 43 | 5 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$registered_hooks&quot;. |  |
| 46 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound | Functions declared in the global namespace by a theme/plugin should start with the theme/plugin prefix. Found: &quot;add_shortcode&quot;. |  |
| 47 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound | Functions declared in the global namespace by a theme/plugin should start with the theme/plugin prefix. Found: &quot;plugin_basename&quot;. |  |
| 55 | 43 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$call&quot;. |  |
| 65 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$init_callback&quot;. |  |
| 66 | 32 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$hook&quot;. |  |
| 68 | 9 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$init_callback&quot;. |  |

## `.gitignore`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | WARNING | hidden_files | Hidden files are not permitted. |  |

## `.github`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | WARNING | github_directory | GitHub workflow directory ".github" detected. This directory should not be included in production plugins. |  |

## `openbook.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | WARNING | trademarked_term | The plugin slug includes a restricted term. Your plugin slug - "openbook4wordpress" - contains the restricted term "wordpress" which cannot be used at all in your plugin slug. |  |
| 54 | 2 | WARNING | PluginCheck.CodeAnalysis.DiscouragedFunctions.load_plugin_textdomainFound | load_plugin_textdomain() has been discouraged since WordPress version 4.6. When your plugin is hosted on WordPress.org, you no longer need to manually include this function call for translations under your plugin slug. WordPress will automatically load the translations for you as needed. | [Docs](https://make.wordpress.org/core/2016/07/06/i18n-improvements-in-4-6/) |

## `openbook_options.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 48 | 6 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_SERVER[&#039;REQUEST_METHOD&#039;]. Check that the array index exists before using it. |  |
| 57 | 43 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_POST[OB_OPTION_TEMPLATE1_NAME]. Check that the array index exists before using it. |  |
| 58 | 43 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_POST[OB_OPTION_TEMPLATE2_NAME]. Check that the array index exists before using it. |  |
| 59 | 43 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_POST[OB_OPTION_TEMPLATE3_NAME]. Check that the array index exists before using it. |  |
| 60 | 43 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_POST[OB_OPTION_TEMPLATE4_NAME]. Check that the array index exists before using it. |  |
| 61 | 43 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_POST[OB_OPTION_TEMPLATE5_NAME]. Check that the array index exists before using it. |  |
| 62 | 48 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_POST[OB_OPTION_FINDINLIBRARY_OPENURLRESOLVER_NAME]. Check that the array index exists before using it. |  |
| 63 | 60 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_POST[OB_OPTION_FINDINLIBRARY_PHRASE_NAME]. Check that the array index exists before using it. |  |
| 64 | 54 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_POST[OB_OPTION_FINDINLIBRARY_IMAGESRC_NAME]. Check that the array index exists before using it. |  |
| 65 | 39 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_POST[OB_OPTION_LIBRARY_DOMAIN_NAME]. Check that the array index exists before using it. |  |
| 66 | 46 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_POST[OB_OPTION_PROXY_NAME]. Check that the array index exists before using it. |  |
| 67 | 50 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_POST[OB_OPTION_PROXYPORT_NAME]. Check that the array index exists before using it. |  |
| 68 | 48 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_POST[OB_OPTION_TIMEOUT_NAME]. Check that the array index exists before using it. |  |
