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
));
