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
	'ACP_PAGES_MANAGE'					=> 'Håndter sider',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Fra denne side kan du tilføje, redigere og slette tilpassede statiske sider.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Opret side',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Med formularen nedenfor kan du oprette en ny tilpasset statisk side til dit board.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Rediger side',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Med formularen nedenfor kan du opdatere en eksisterende tilpasset statisk side til dit board.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Titel',
	'ACP_PAGES_DESCRIPTION'				=> 'Beskrivelse',
	'ACP_PAGES_ROUTE'					=> 'Rute',
	'ACP_PAGES_TEMPLATE'				=> 'Skabelon',
	'ACP_PAGES_ORDER'					=> 'Rækkefølge',
	'ACP_PAGES_LINK'					=> 'Link',
	'ACP_PAGES_VIEW'					=> 'Vis side',
	'ACP_PAGES_STATUS'					=> 'Status',
	'ACP_PAGES_PUBLISHED'				=> 'Udgivet',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Udgivet (kun medlemmer)',
	'ACP_PAGES_PRIVATE'					=> 'Privat',
	'ACP_PAGES_EMPTY'					=> 'Ingen sider fundet',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Tøm ikoner',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Tøm sidernes ikonmellemlager',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'Når der tilføjes tilpassede ikoner til sidelink, kan det være nødvendigt at tømme ikonmellemlageret for at se de nye ikoner. Placer tilpassede ikoner med navnet <samp>pages_rute.gif</samp>, hvor <samp>rute</samp> er sidens rutenavn, i phpBB’s <samp>styles/*/theme/images/</samp>-mappe.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Er du sikker på, at du vil slette siden?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Side slettet.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'Side kunne ikke slettes.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Side tilføjet.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Side opdateret.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Indstillinger for side',
	'ACP_PAGES_OPTIONS'					=> 'Valgmuligheder for side',
	'ACP_PAGES_FORM_TITLE'				=> 'Sidens titel',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Feltet er obligatorisk.',
	'ACP_PAGES_FORM_DESC'				=> 'Sidens beskrivelse',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Vises kun i ACP-listen med sider.',
	'ACP_PAGES_FORM_ROUTE'				=> 'Sidens URL-rute',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> 'En renset version af sidens navn, bruges til at bygge sidens URL, f.eks. <samp>http://www.phpbb.com/<strong>din-rute</strong></samp>. Kun bogstaver, tal, bindestreger og underscores er tilladt. Feltet er obligatorisk.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Sidens indhold',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Indhold kan oprettes med normale phpBB-BBkoder, smileys og magiske url\'er, eller du kan aktivere HTML-tilstand. I HTML-tilstand, virker BBkoder, smileys og magiske url\'er ikke, men du kan frit bruge gyldig HTML-syntaks. Bemærk venligst at indholdet tilføjes til en eksisterende HTML-skabelon, så du skal ikke inkludere DOCTYPE-, HTML-, BODY- eller HEAD-tags. Alle andre HTML-formateringstags, inklusive IFRAME, SCRIPT, STYLE, EMBED, VIDEO, osv. kan dog stadig bruges.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Sidens skabelon',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Tilpassede sideskabeloner ved navn <samp>pages_*.html</samp> kan tilføjes til phpBB’s <samp>styles/*/template</samp>-mapper.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Vælg en skabelon',
	'ACP_PAGES_FORM_ORDER'				=> 'Sidens rækkefølge',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Sider sorteres efter feltet, hvilket kan hjælpe med at organisere rækkefølgen som deres links vises i. Lavere tal tager forrang over højere tal.',
	'ACP_PAGES_FORM_LINKS'				=> 'Placeringer af sidens link',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Vælg en eller flere placeringer hvor linket til siden kan vises. Brug CTRL+KLIK (eller CMD+KLIK på Mac) for at vælge/fravælge flere end ét element.',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Ikon til sidens link',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Indtast navnet på et <a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Font Awesome</a>-ikon, som skal bruges med sidelinket. Lad feltet være tomt, for at bruge Pages’ traditionelle CSS-/GIF-billedikoner.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Vis side',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Hvis den er sat til nej, kan siden ikke tilgås. (Bemærk: Administratorer kan stadig tilgå siden, så de kan forhåndsvise siden privat mens den udvikles).',
	'ACP_PAGES_FORM_GUESTS'				=> 'Vis side til gæster',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Hvis den er sat til nej, er det kun tilmeldte brugere som kan tilgå siden.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Sidens link',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'Analyser HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Navigationslinje inden links',
	'NAV_BAR_LINKS_AFTER'				=> 'Navigationslinje efter links',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Navigationslinje inden brødkrummer',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Navigationslinje efter brødkrummer',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Sidefod inden tidszone',
	'FOOTER_TIMEZONE_AFTER'				=> 'Sidefod efter tidszone',
	'FOOTER_TEAMS_BEFORE'				=> 'Sidefod inden holdet-link',
	'FOOTER_TEAMS_AFTER'				=> 'Sidefod efter holdet-link',
	'QUICK_LINK_MENU_BEFORE'			=> 'Øverst i menuen hurtige links',
	'QUICK_LINK_MENU_AFTER'				=> 'Nederst i menuen hurtige links',
));
