<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	// Manage page
	'ACP_PAGES_MANAGE'					=> 'Manage Pages',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'From this page you can add, edit and delete custom static pages.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Create page',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Using the form below you can create a new custom static page for your board.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Edit page',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Using the form below you can update an existing custom static page for your board.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Title',
	'ACP_PAGES_DESCRIPTION'				=> 'Description',
	'ACP_PAGES_ROUTE'					=> 'Route',
	'ACP_PAGES_TEMPLATE'				=> 'Template',
	'ACP_PAGES_ORDER'					=> 'Order',
	'ACP_PAGES_LINK'					=> 'Link',
	'ACP_PAGES_VIEW'					=> 'View page',
	'ACP_PAGES_STATUS'					=> 'Status',
	'ACP_PAGES_PUBLISHED'				=> 'Published',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Published (member only)',
	'ACP_PAGES_PRIVATE'					=> 'Private',
	'ACP_PAGES_EMPTY'					=> 'No pages found',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Purge icons',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Purge pages icons cache',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'When adding custom page link icons, you may need to purge the icon cache to see the new icons. Place custom icons named <samp>pages_route.gif</samp>, where <samp>route</samp> is the Page’s route name, in phpBB’s <samp>styles/*/theme/images/</samp> folders.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Are you sure you want to delete this page?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Page successfully deleted.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'Page could not be deleted.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Page successfully added.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Page successfully updated.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Page settings',
	'ACP_PAGES_OPTIONS'					=> 'Page options',
	'ACP_PAGES_FORM_TITLE'				=> 'Page title',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'This is a required field.',
	'ACP_PAGES_FORM_DESC'				=> 'Page description',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'This will only be displayed in the ACP list of pages.',
	'ACP_PAGES_FORM_ROUTE'				=> 'Page URL route',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> 'A cleaned version of the page name, used to build the URL for the page, e.g.  <samp>http://www.phpbb.com/<strong>your-route</strong></samp>. Only letters, numbers, hyphens and underscores are allowed. This is a required field.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Page content',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Content can be created using normal phpBB BBCodes, smilies and magic urls or you can enable HTML mode. In HTML mode, BBCodes, smilies and magic urls will not work, but you are free to use any valid HTML syntax. Please note that this content will be added to an existing HTML template, so you should not include DOCTYPE, HTML, BODY or HEAD tags. However, all other HTML formatting tags, including IFRAME, SCRIPT, STYLE, EMBED, VIDEO, etc. can be used.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Page template',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Custom page templates named <samp>pages_*.html</samp> can be added to phpBB’s <samp>styles/*/template</samp> folders.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Select a template',
	'ACP_PAGES_FORM_ORDER'				=> 'Page order',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Pages will be sorted according to this field, which can help organize the order in which their links appear. Lower numbers take precedence over higher numbers.',
	'ACP_PAGES_FORM_LINKS'				=> 'Page link locations',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Select one or more locations where the link to this page can appear. Use CTRL+CLICK (or CMD+CLICK on Mac) to select/deselect more than one item.',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Page link icon',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Enter the name of a <strong><a href="%s" target="_blank">Font Awesome</a></strong> icon to use with the page link. Leave this field blank to use Pages’ traditional CSS/GIF image icons.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Display page',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'If set to no, the page will not be accessible. (Note: Admins will still be able to access the page, allowing them to privately preview the page while developing it.)',
	'ACP_PAGES_FORM_GUESTS'				=> 'Display page to guests',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'If set to no, only registered users will be able to access the page.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Page link',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'Parse HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Nav Bar Before Links',
	'NAV_BAR_LINKS_AFTER'				=> 'Nav Bar After Links',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Nav Bar Before Breadcrumbs',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Nav Bar After Breadcrumbs',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Footer Before Time Zone',
	'FOOTER_TIMEZONE_AFTER'				=> 'Footer After Time Zone',
	'FOOTER_TEAMS_BEFORE'				=> 'Footer Before Team Link',
	'FOOTER_TEAMS_AFTER'				=> 'Footer After Team Link',
	'QUICK_LINK_MENU_BEFORE'			=> 'Quick Links Menu Top',
	'QUICK_LINK_MENU_AFTER'				=> 'Quick Links Menu Bottom',
));
