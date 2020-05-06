<?php
/**
*
* Pages extension for the phpBB Forum Software package.
* @translated into Swedish by Holger (http://www.maskinisten.net)
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
	'ACP_PAGES_MANAGE'					=> 'Hantera sidor',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Här kan du skapa, uppdatera och radera egna statiska sidor.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Skapa sida',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Använd formuläret nedan till att skapa en egen statisk sida till ditt forum.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Ändra sida',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Använd formuläret nedan till att uppdatera en existerande egen statisk sida till ditt forum.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Rubrik',
	'ACP_PAGES_DESCRIPTION'				=> 'Beskrivning',
	'ACP_PAGES_ROUTE'					=> 'Nod',
	'ACP_PAGES_TEMPLATE'				=> 'Mall',
	'ACP_PAGES_ORDER'					=> 'Ordningsföljd',
	'ACP_PAGES_LINK'					=> 'Länk',
	'ACP_PAGES_VIEW'					=> 'Visa sida',
	'ACP_PAGES_STATUS'					=> 'Status',
	'ACP_PAGES_PUBLISHED'				=> 'Publicerad',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Publicerad (endast för medlemmar)',
	'ACP_PAGES_PRIVATE'					=> 'Privat',
	'ACP_PAGES_EMPTY'					=> 'Ingen sida',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Töm ikoncache',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Töm sidornas ikoncache',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'När du lägger till länkikoner för dina egna sidor kan det vara erforderligt att tömma ikoncachen för att kunna se nya ikoner. Placera egna ikoner med benämningen <samp>pages_nod.gif</samp>, där <samp>nod</samp> är sidans nod-benämning i phpBBs katalog <samp>styles/*/theme/images/</samp>.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Är du säker på att du vill radera denna sida?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Sidan har raderats.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'Sidan kunde ej raderas.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Sidan har skapats.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Sidan har uppdaterats.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Sidinställningar',
	'ACP_PAGES_OPTIONS'					=> 'Sidoptioner',
	'ACP_PAGES_FORM_TITLE'				=> 'Sidans rubrik',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Detta är ett obligatoriskt fält.',
	'ACP_PAGES_FORM_DESC'				=> 'Sidans beskrivning',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Detta kommer endast att visas i listan över sidor i ACPn.',
	'ACP_PAGES_FORM_ROUTE'				=> 'Sidans URL-nod',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> 'En <strong>nod</strong> är en unik identifierare som används i sidans URL för att definera länken till sidan, t.ex. <samp>http://www.phpbb.com/<strong>nod</strong></samp>. Endast bokstäver, siffror, bindestreck och understreck är tillåtna. Detta fält måste fyllas i.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Sidans innehåll',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Innehållet kan bestå av normala phpBB BBCode, smilies och magiska länkar eller så kan du aktivera HTML-läget. I HTML-läget kommer BBCode, smilies och magiska länkar ej att fungera, men du kan använda valfri giltig HTML-kod. Observera att detta innehåll kommer att läggas till en existerande HTML-mall, så du bör ej lägga till taggarna DOCTYPE, HTML, BODY eller HEAD. Alla andra HTML-formaterande taggar inklusive IFRAME, SCRIPT, STYLE, EMBED, VIDEO, osv. får användas.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Sidmall',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Egna sidmallar med benämningen <samp>pages_*.html</samp> kan läggas till i phpBBs katalog <samp>styles/*/template</samp>.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Väj en mall',
	'ACP_PAGES_FORM_ORDER'				=> 'Sidornas ordningsföljd',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Sidorna kommer att sorteras enligt detta fält. Detta kan vara till hjälp för att organisera ordningsföljden av länkarna. Lägre nummer har högre prioritet.',
	'ACP_PAGES_FORM_LINKS'				=> 'Sidlänkens placering',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Välj en eller flera placeringar för länken till sidan. Använd CTRL+CLICK (eller CMD+CLICK på en Mac) för att välja/välja bort fler än en instans.',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Page link icon',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Enter the name of a <strong><a href="%s" target="_blank">Font Awesome</a></strong> icon to use with the page link. Leave this field blank to use Pages’ traditional CSS/GIF image icons.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Visa sidan',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Om inställningen är Nej så kommer sidan ej att vara tillgänglig. (Notera: administratörer kan fortfarande komma åt sidan, så de kan förhandsgranska sidorna medan de skapas.)',
	'ACP_PAGES_FORM_GUESTS'				=> 'Visa sidan för gäster',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Om inställningen är Nej så kommer sidan endast att vara tillgänglig för registrerade användare.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Sidans länk',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'Tolka HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Navigering över länkarna',
	'NAV_BAR_LINKS_AFTER'				=> 'Navigering under länkarna',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Navigering över breadcrumbs',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Navigering under breadcrumbs',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Fotrad över tidszonen',
	'FOOTER_TIMEZONE_AFTER'				=> 'Fotrad under tidszonen',
	'FOOTER_TEAMS_BEFORE'				=> 'Fotrad över teamlänken',
	'FOOTER_TEAMS_AFTER'				=> 'Fotrad under teamlänken',
	'QUICK_LINK_MENU_BEFORE'			=> 'Snabblänkar uppe',
	'QUICK_LINK_MENU_AFTER'				=> 'Snabblänkar nere',
));
