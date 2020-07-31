<?php
/**
*
* Pages extension for the phpBB Forum Software package.
* [Dutch] translated by Dutch Translators (https://github.com/dutch-translators)
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
	'ACP_PAGES_MANAGE'					=> 'Beheer Pagina‘s',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Via deze pagina kan je eigen statische pagina‘s toevoegen, wijzigen en verwijderen.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Pagina aanmaken',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Door het formulier hieronder te gebruiken, kan je een eigen statische pagina aanmaken voor je forum.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Pagina wijzigen',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Door het formulier hieronder te gebruiken, kan je een bestaande eigen statische pagina wijzigen.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Titel',
	'ACP_PAGES_DESCRIPTION'				=> 'Beschrijving',
	'ACP_PAGES_ROUTE'					=> 'Route',
	'ACP_PAGES_TEMPLATE'				=> 'Template',
	'ACP_PAGES_ORDER'					=> 'Volgorde',
	'ACP_PAGES_LINK'					=> 'Link',
	'ACP_PAGES_VIEW'					=> 'Bekijk pagina',
	'ACP_PAGES_STATUS'					=> 'Status',
	'ACP_PAGES_PUBLISHED'				=> 'Gepubliceerd',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Gepubliceerd (alleen leden)',
	'ACP_PAGES_PRIVATE'					=> 'Privé',
	'ACP_PAGES_EMPTY'					=> 'Geen pagina‘s gevonden',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Leeg iconen',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Leeg pagina‘s iconencache',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'Wanneer je een eigen pagina link icoon toevoegd, kan het zijn dat je de iconencache moet legen om de nieuwe iconen te kunnen zien. Plaats eigen iconen genaamd <samp>pages_route.gif</samp>, waar <samp>route</samp> de Pagina‘s routenaam is, in phpBB’s <samp>styles/*/theme/images/</samp> folders.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Weet je zeker dat je deze pagina wilt verwijderen?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Pagina succesvol verwijderd.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'Pagina kan niet verwijderd worden.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Pagina succesvol toegevoegd.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Pagina succesvol bijgewerkt.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Pagina-instellingen',
	'ACP_PAGES_OPTIONS'					=> 'Pagina-opties',
	'ACP_PAGES_FORM_TITLE'				=> 'Paginatitel',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Dit is een vereist veld.',
	'ACP_PAGES_FORM_DESC'				=> 'Paginabeschrijving',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Dit zal alleen weergegeven worden in de ACP lijst van pagina‘s.',
	'ACP_PAGES_FORM_ROUTE'				=> 'Pagina-URL route',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> 'De <strong>route</strong> is een unieke identificatie aan het einde van de link van een pagina om de link naar de pagina te definiëren, bijv: <samp>http://www.phpbb.com/<strong>route</strong></samp>. Alleen letters, cijfers, verbindingsteken en underscores zijn toegestaan. Dit is een vereist veld.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Pagina-inhoud',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Inhoud kan aangemaakt worden door gebruik te maken van normale phpBB BBCodes, smilies en magische urls of je kan de HTML mode inschakelen. In HTML mode, BBCodes, smilies en magische urls zullen niet werken, maar je kan gebruik maken van alle geldige HTML syntax. Let op dat deze inhoud zal toegevoegd worden aan een bestaande HTML template, je moet dus geen DOCTYPE, HTML, BODY of HEAD tags toevoegen. Echter alle andere HTML opmaak tags, inclusief IFRAME, SCRIPT, STYLE, EMBED, VIDEO, etc. kunnen gebruikt worden.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Pagina-template',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Eigen pagina-templates genaamd <samp>pages_*.html</samp> kunnen toegevoegd worden aan phpBB’s <samp>styles/*/template</samp> folders.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Selecteer een template',
	'ACP_PAGES_FORM_ORDER'				=> 'Pagina-volgorde',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Pagina‘s zullen gesorteerd worden volgens dit veld, welke kan helpen om de volgorde te organiseren waarin hun links voorkomen. Lagere nummers hebben voorrang over hogere nummers.',
	'ACP_PAGES_FORM_LINKS'				=> 'Paginalink-locaties',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Selecteer één of meerdere locaties waar de link naar deze pagina kan voorkomen. Gebruik CTRL+KLIK (of CMD+KLIK bij Mac) om meer dan één item te selecteren/deselecteren.',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Page link icon',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Enter the name of a <strong><a href="%s" target="_blank">Font Awesome</a></strong> icon to use with the page link. Leave this field blank to use Pages’ traditional CSS/GIF image icons.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Pagina weergeven',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Wanneer dit ingesteld is op nee, dan zal de pagina niet toegankelijk zijn. (Notitie: Admins hebben nog steeds toegang tot de pagina, zodat ze de pagina kunnen bekijken tijdens de ontwikkeling ervan.)',
	'ACP_PAGES_FORM_GUESTS'				=> 'Pagina weergeven aan gasten',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Wanneer dit ingesteld is op nee, dan kunnen alleen geregistreerde gebruikers de pagina bezoeken.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Paginalink',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'Verwerk HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Nav Bar Voor Links',
	'NAV_BAR_LINKS_AFTER'				=> 'Nav Bar Na Links',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Nav Bar Voor Broodkruimels',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Nav Bar Na Broodkruimels',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Footer Voor Tijdzone',
	'FOOTER_TIMEZONE_AFTER'				=> 'Footer Na Tijdzone',
	'FOOTER_TEAMS_BEFORE'				=> 'Footer Voor Teamlink',
	'FOOTER_TEAMS_AFTER'				=> 'Footer Na Teamlink',
	'QUICK_LINK_MENU_BEFORE'			=> 'Snelle Links Menu Top',
	'QUICK_LINK_MENU_AFTER'				=> 'Snelle Links Menu Bodem',
));
