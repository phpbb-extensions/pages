<?php
/**
*
* Pages extension for the phpBB Forum Software package.
* Croatian translation by Ančica Sečan (http://ancica.sunceko.net)
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
	'ACP_PAGES_MANAGE'					=> 'Upravljanje stranicama',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Ovdje možeš dodavati/uređivati/izbrisati prilagođene statične stranice.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Dodaj stranicu',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Korištenjem donje forme možeš dodati novu prilagođenu statičnu stranicu.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Uredi stranicu',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Korištenjem donje forme možeš urediti novu prilagođenu statičnu stranicu.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Naslov',
	'ACP_PAGES_DESCRIPTION'				=> 'Opis',
	'ACP_PAGES_ROUTE'					=> 'Putanja',
	'ACP_PAGES_TEMPLATE'				=> 'Predložak',
	'ACP_PAGES_ORDER'					=> 'Redanje',
	'ACP_PAGES_LINK'					=> 'Link',
	'ACP_PAGES_VIEW'					=> 'Pogledaj stranicu',
	'ACP_PAGES_STATUS'					=> 'Status',
	'ACP_PAGES_PUBLISHED'				=> 'Objavljeno (svi)',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Objavljeno (samo korisnici/e)',
	'ACP_PAGES_PRIVATE'					=> 'Privatno',
	'ACP_PAGES_EMPTY'					=> 'Nije pronađena niti jedna stranica.',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Isprazni ikone',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Isprazni priručnu memoriju ikona stranica',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'Prilikom dodavanja ikona linkova prilagođenih stranica, (a) kako bi nove ikone postale vidljive, ponekad treba isprazniti priručnu memoriju ikona stranica.<br />Prilagođene ikone, nazvane npr. <samp>pages_route.gif</samp>, (a) gdje je <samp>route</samp> <em>usmjerno</em> ime stranice, pohrani u <samp>styles/*/theme/images/</samp> mape phpBBa.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Jesi li siguran/na da želiš izbrisati stranicu?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Stranice je izbrisana.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'Stranicu nije bilo moguće izbrisati.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Stranice je dodana.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Stranice je ažurirana.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Postavke stranice',
	'ACP_PAGES_OPTIONS'					=> 'Opcije stranice',
	'ACP_PAGES_FORM_TITLE'				=> 'Naslov stranice',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Polje je obvezno.',
	'ACP_PAGES_FORM_DESC'				=> 'Opis stranice',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Bit će prikazan samo na popisu stranica u AF.',
	'ACP_PAGES_FORM_ROUTE'				=> 'Usmjerna putanja stranice',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> '<strong>Route</strong> je unikatni identifikator koji se koristi na kraju URLa stranice (a) za definiranje linka (do) stranice, npr. <samp>http://www.phpbb.com/<strong>route</strong></samp>.<br />Dopuštena su samo slova, brojevi, minusnice i podvlaknice.<br />Polje je obvezno.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Sadržaj stranice',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Sadržaj može biti dodan korištenjem uobičajenih phpBB BBKodova, smajlića i “magičnih” linkova odnosno omogućavanjem HTML moda.<br />U HTML modu, BBKodovi, smajlići i “magični” linkovi neće raditi, ali si slobodan/na koristiti bilo koju ispravnu HTML sintaksu.<br />Sadržaj će biti dodan postojećem HTML predlošku, stoga, nemoj uključivati DOCTYPE, HTML, BODY i(li) HEAD tagove (dok) HTML tagove za uređivanje, uključujuć’ IFRAME, SCRIPT, STYLE, EMBED, VIDEO itd., možeš koristiti.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Predložak stranice',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Predlošci prilagođenih stranica nazvani <samp>pages_*.html</samp> mogu biti dodani u <samp>styles/*/template</samp> mape phpBBa.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Izaberi predložak',
	'ACP_PAGES_FORM_ORDER'				=> 'Poredak stranica',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Stranice će biti poredane u skladu s ovim poljem, što pomaže kod organizacije redoslijeda prikaza linkova stranica.<br />“Niži” brojevi imaju prednost pred “višim” brojevima.',
	'ACP_PAGES_FORM_LINKS'				=> 'Lokacije linkova stranice',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Izaberi jednu odnosno odaberi više lokacija na kojima će link na stranicu biti prikazan.<br />Za o(do)značavanje više od jedne stavke, koristi CTRL+KLIK (CMD+KLIK na Macu).',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Page link icon',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Enter the name of a <strong><a href="%s" target="_blank">Font Awesome</a></strong> icon to use with the page link. Leave this field blank to use Pages’ traditional CSS/GIF image icons.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Prikaži stranicu',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Ukoliko je onemogućeno, stranica će biti nedostupna [svima osim administratori(ca)ma koji/e će joj (i dalje) moći pristupati i uređivati ju].',
	'ACP_PAGES_FORM_GUESTS'				=> 'Prikaži stranicu gostima',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Ukoliko je onemogućeno, stranica će biti vidljiva samo registriranim korisnicima/ama.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Link stranice',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'Parsiraj HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Navigacija ispred Linkova',
	'NAV_BAR_LINKS_AFTER'				=> 'Navigacija iza Linkova',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Navigacija ispred Breadcrumbsa',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Navigacija iza Breadcrumbsa',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Podnožje ispred Vremenske zone',
	'FOOTER_TIMEZONE_AFTER'				=> 'Podnožje iza Vremenske zone',
	'FOOTER_TEAMS_BEFORE'				=> 'Podnožje ispred Tim linka',
	'FOOTER_TEAMS_AFTER'				=> 'Podnožje iza Tim linka',
	'QUICK_LINK_MENU_BEFORE'			=> 'Link(o)Bir na Vrhu',
	'QUICK_LINK_MENU_AFTER'				=> 'Link(o)Bir na Dnu',
));
