<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


//handle all translation here with __, see WordPress documentation

//errors

define('OB_ENABLECURL_LANG', __('OpenBook uses the PHP cURL library. Ask your system administrator to enable this package.', 'openbook'));
define('OB_BOOKNUMBERREQUIRED_LANG', __('OpenBook requires at least a book number, e.g., ISBN or Open Library key', 'openbook'));
define('OB_INVALIDTEMPLATENUMBER_LANG', __('Invalid template or template number. Correct the template, or enter a template number of 1-5. If this does not work, click \'Reset to installation values\' in Settings.', 'openbook'));

define('OB_VALUEREQUIRED_LANG', __('%s is a required value. Please return to the OpenBook settings and enter a value.', 'openbook'));

define('OB_OPENLIBRARYDATAUNAVAILABLE_KEY_LANG', __('Open Library Data Unavailable', 'openbook')); //most common
define('OB_OPENLIBRARYDATAUNAVAILABLE_BOOK_LANG', __('Open Library Data Unavailable (books)', 'openbook'));
define('OB_OPENLIBRARYDATAUNAVAILABLE_AUTHOR_LANG', __('Open Library Data Unavailable (authors)', 'openbook'));

define('OB_NOBOOKDATAFORBOOKNUMBER_LANG', __('No Book Data for this Book Number', 'openbook'));
define('OB_INVALIDDOMAIN_LANG', __('Invalid domain. The usual value is http://openlibrary.org.', 'openbook'));
define('OB_INVALIDCOVERSERVER_LANG', __('Invalid cover server. The usual value is http://covers.openlibrary.org.', 'openbook'));

define('OB_CURLTIMEOUT_LANG', __('Timeout contacting Open Library', 'openbook'));
define('OB_CURLERROR_LANG', __('Error contacting Open Library', 'openbook'));
define('OB_OLSERVERERROR_LANG', __('Open Library Server Error', 'openbook'));

//options page

define('OB_OPTIONS_TEMPLATETEMPLATES_LANG', __('Templates', 'openbook'));
define('OB_OPTIONS_TEMPLATETEMPLATES_DETAIL_LANG', __('Modify these templates to change the content and order of the OpenBook display elements. Template 1 is the default, but you can change the template number in the Visual Editor dropdown or in a shortcode, e.g., [openbook booknumber="123" templatenumber="2"]. Modify the template styles by editing the OpenBook stylesheet found in the plugin folder. For more information visit the ', 'openbook'));

define('OB_OPTION_TEMPLATE1_LANG', __('Template 1 (default)', 'openbook'));
define('OB_OPTION_TEMPLATE2_LANG', __('Template 2 (e.g., smaller cover for widgets)', 'openbook'));
define('OB_OPTION_TEMPLATE3_LANG', __('Template 3 (e.g., large cover)', 'openbook'));
define('OB_OPTION_TEMPLATE4_LANG', __('Template 4 (e.g., inline text link)', 'openbook'));
define('OB_OPTION_TEMPLATE5_LANG', __('Template 5 (e.g., academic reference)', 'openbook'));

define('OB_OPTIONS_FINDINLIBRARY_LANG', __('Find in the Library', 'openbook'));

define('OB_OPTIONS_FINDINLIBRARY_OPENURLRESOLVER_LANG', __('OpenURL Resolver', 'openbook'));
define('OB_OPTIONS_FINDINLIBRARY_OPENURLRESOLVER_DETAIL_LANG', __('If you enter a library\'s OpenURL resolver (version 1.0) here, and add [OB_LINK_FINDINLIBRARY] or [OB_IMAGE_FINDINLIBRARY] to a template, a link will point to that library\'s records. To find the resolver, ask the Systems Librarian or look it up in the %1$sWorldCat Registry%2$s.', 'openbook'));

define('OB_OPTIONS_FINDINLIBRARY_PHRASE_LANG', __('Phrase', 'openbook'));
define('OB_OPTIONS_FINDINLIBRARY_PHRASE_DETAIL_LANG', __('If you enter an OpenURL resolver, and add [OB_LINK_FINDINLIBRARY] to a template, this phrase is used for the text link. You may wish to name your library.', 'openbook'));

define('OB_OPTIONS_FINDINLIBRARY_IMAGESRC_LANG', __('Image Source', 'openbook'));
define('OB_OPTIONS_FINDINLIBRARY_IMAGESRC_DETAIL_LANG', __('If you enter an OpenURL resolver, and add [OB_IMAGE_FINDINLIBRARY] to a template, this image URL is used for the image link. You may wish to use your library\'s image.', 'openbook'));

define('OB_OPTIONS_SYSTEM_LANG', __('System', 'openbook'));

define('OB_OPTIONS_LIBRARY_DOMAIN_LANG', __('Library Domain', 'openbook'));
define('OB_OPTIONS_LIBRARY_COVERSERVER_LANG', __('Cover Server', 'openbook'));
define('OB_OPTION_SYSTEM_TIMEOUT_LANG', __('Timeout (sec)', 'openbook'));
define('OB_OPTION_SYSTEM_PROXY_LANG', __('Proxy', 'openbook'));
define('OB_OPTION_SYSTEM_PROXYPORT_LANG', __('Proxy Port', 'openbook'));

define('OB_OPTIONS_LIBRARY_DOMAIN_DETAIL_LANG', __('Use the default value for Open Library or enter the domain of your local installation', 'openbook'));
define('OB_OPTION_SYSTEM_TIMEOUT_DETAIL_LANG', __('The timeout for connecting with Open Library. Increase to wait longer. Decrease if page loads are hanging.', 'openbook'));
define('OB_OPTION_SYSTEM_PROXY_DETAIL_LANG', __('May be needed if you are behind a firewall. Ask your system administrator for this value and the port.', 'openbook'));
define('OB_OPTION_SYSTEM_PROXYPORT_DETAIL_LANG', __('Goes with the proxy. Just enter the number, no colon.', 'openbook'));

define('OB_OPTIONS_SHOWERRORS_LANG', __('Show Error Details', 'openbook'));
define('OB_OPTIONS_SHOWERRORS_DETAIL_LANG', __('If checked, OpenBook displays detailed information if an error occurs. Useful for diagnosing problems.', 'openbook'));

define('OB_OPTIONS_SAVETEMPLATES_LANG', __('Save Settings', 'openbook'));
define('OB_OPTIONS_SAVETEMPLATES_DETAIL_LANG', __('If checked, OpenBook will save your settings when the plugin is deactivated, otherwise it will delete them.', 'openbook'));

define('OB_OPTIONS_SAVECHANGES_LANG', __('Save Changes', 'openbook'));
define('OB_OPTIONS_RESET_LANG', __('Reset to Installation Values', 'openbook'));

define('OB_OPTIONS_CONFIRM_SAVED_LANG', __('Your changes have been saved', 'openbook'));
define('OB_OPTIONS_CONFIRM_RESET_LANG', __('The options have been reset to the original installation values', 'openbook'));

//display

define('OB_DISPLAY_FIRSTSENTENCE_LANG', __('First Sentence: ', 'openbook'));
define('OB_DISPLAY_DESCRIPTION_LANG', __('Description: ', 'openbook'));
define('OB_DISPLAY_NOTES_LANG', __('Notes: ', 'openbook'));
define('OB_DISPLAY_CLICKTOVIEWTITLEINOL_LANG', __('View this title in Open Library', 'openbook'));
define('OB_DISPLAY_CLICKTOVIEWAUTHORINOL_LANG', __('View this author in Open Library', 'openbook'));
define('OB_DISPLAY_CLICKTOVIEWPUBLISHER_LANG', __('View the publisher\'s website', 'openbook'));
define('OB_DISPLAY_FINDINLIBRARY_WORLDCAT_TITLE_LANG', __('Find this title in a library using WorldCat', 'openbook'));
define('OB_DISPLAY_FINDINLIBRARY_OPENURL_TITLE_LANG', __('Find this title in the library', 'openbook'));
define('OB_DISPLAY_READONLINE_LANG', __('Read Online', 'openbook'));
define('OB_DISPLAY_READONLINE_TITLE_LANG', __('Read this work online', 'openbook'));

define('OB_DISPLAY_AMAZON_LANG', __('Amazon', 'openbook'));
define('OB_DISPLAY_AMAZON_TITLE_LANG', __('View this title at Amazon', 'openbook'));
define('OB_DISPLAY_GOODREADS_LANG', __('Goodreads', 'openbook'));
define('OB_DISPLAY_GOODREADS_TITLE_LANG', __('View this title at Goodreads', 'openbook'));
define('OB_DISPLAY_GOOGLEBOOKS_LANG', __('Google Books', 'openbook'));
define('OB_DISPLAY_GOOGLEBOOKS_TITLE_LANG', __('View this title at Google Books', 'openbook'));
define('OB_DISPLAY_LIBRARYCONGRESS_LANG', __('Library of Congress', 'openbook'));
define('OB_DISPLAY_LIBRARYCONGRESS_TITLE_LANG', __('View this title at The Library of Congress', 'openbook'));
define('OB_DISPLAY_LIBRARYTHING_LANG', __('LibraryThing', 'openbook'));
define('OB_DISPLAY_LIBRARYTHING_TITLE_LANG', __('View this title at LibraryThing', 'openbook'));
define('OB_DISPLAY_WORLDCAT_LANG', __('WorldCat', 'openbook'));
define('OB_DISPLAY_WORLDCAT_TITLE_LANG', __('View this title at WorldCat', 'openbook'));
define('OB_DISPLAY_PROJECTGUTENBERG_LANG', __('Project Gutenberg', 'openbook'));
define('OB_DISPLAY_PROJECTGUTENBERG_TITLE_LANG', __('View this title at Project Gutenberg', 'openbook'));
define('OB_DISPLAY_BOOKFINDER_LANG', __('BookFinder', 'openbook'));
define('OB_DISPLAY_BOOKFINDER_TITLE_LANG', __('Search for the best price at BookFinder', 'openbook'));

?>
