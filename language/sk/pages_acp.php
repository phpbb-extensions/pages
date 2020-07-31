<?php
/**
*
* Pages extension for the phpBB Forum Software package.
* Slovak translation by ansysko (ansysko@ansysko.eu)
*
* @copyright (c) 2015 phpBB Limited <https://www.phpbb.com>
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
	'ACP_PAGES_MANAGE'					=> 'Správa stránok',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Tu môžete pridať, upraviť alebo odstrániť vlastné statické stránky.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Vytvoriť stránku',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Pomocou nasledujúceho formulára môžete vytvoriť vlastnú statickú stránku pre svoje fórum.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Upraviť stránku',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Pomocou nasledujúceho formulára môžete aktualizovať už existujúcu vlastnú statickú stránku pre svoje fórum.',
	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Názov',
	'ACP_PAGES_DESCRIPTION'				=> 'Popis',
	'ACP_PAGES_ROUTE'					=> 'Cesta',
	'ACP_PAGES_TEMPLATE'				=> 'Šablóna',
	'ACP_PAGES_ORDER'					=> 'Poradie',
	'ACP_PAGES_LINK'					=> 'Odkaz',
	'ACP_PAGES_VIEW'					=> 'Zobraziť stránku',
	'ACP_PAGES_STATUS'					=> 'Stav',
	'ACP_PAGES_PUBLISHED'				=> 'Publikované',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Publikované (len pre členov)',
	'ACP_PAGES_PRIVATE'					=> 'Súkromná',
	'ACP_PAGES_EMPTY'					=> 'Nenájdené žiadné stránky',
	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Vymazať ikony',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Vymazať medzipamäť ikon stránok',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'Pri pridávaní vlastných ikon pre odkazy stránok môže byť potrebné prečistenie cache, aby boli nové ikony vidieť. Ikony s názvom <samp>pages_route.gif</samp>, kde <samp>route</samp> je názov cesty stránky, umiestnite do zložky phpBB motivov <samp>styles/*/theme/images/</samp>.',
	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Naozaj chcete túto stránku zmazať?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Stránka bola úspešne odstránená.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'Stránku nemôžete odstrániť.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Stránka bola úspešne pridaná.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Stránka bola úspešne aktualizovaná.',
	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Nastavenie stránky',
	'ACP_PAGES_OPTIONS'					=> 'Možnosti stránky',
	'ACP_PAGES_FORM_TITLE'				=> 'Názov stránky',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Toto pole je povinné.',
	'ACP_PAGES_FORM_DESC'				=> 'Popis stránky',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Táto informácia bude zobrazená len v zozname stránok v ACP.',
	'ACP_PAGES_FORM_ROUTE'				=> 'URL adresa stránky',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> '<strong>Cesta</strong> je unikátny identifikátor používaný na konci URL adresy stránky, ktorý určuje podobu odkazu na stránku – napr. <samp>http://www.phpBB/<strong>route</strong></samp>. sú povolené len písmená, čísla, spojovníky a podčiarknutia. Toto pole je povinné.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Obsah stránky',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Obsah sa môže vytvoriť pomocou BBCode, smajlíkov a magic URL adries. Môžete tiež povoliť HTML režim, v ktorom BBCode, smajlíky ani magic URL adresy nebudú fungovať, ale môžete používať ľubovolnú platnú HTML syntax. Pamätajte, že tento obsah bude pridaný do už existujúcej šablony, takže by ste nemali používať DOCTYPE, HTML, BODY alebo HEAD tagy. Všetky ostatné formátovacie HTML značky ako napr. IFRAME, SCRIPT, STYLE, EMBED, VIDEO, atď. môžete použiť.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Šablóna stránky',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Šablóny pre vlastnú stránku s názvom <samp>pages_*.html</samp> umiesnite do zložky phpBB motivov: <samp>styles/*/template</samp>.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Výber šablóny',
	'ACP_PAGES_FORM_ORDER'				=> 'Poradie stránok',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Stránky budú radené podľa tohto poľa, ktoré vám umožní organizovať poradie, v ktorom sa odkazy zobrazia. Nižšie čísla majú prednosť pred vyššími.',
	'ACP_PAGES_FORM_LINKS'				=> 'Umiestnenie odkazov na stránku',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Vyberte jednu alebo viac umiestnení, kde bude zobrazený odkaz na túto stránku. Pre označenie/odznačenie viac položiek použite CTRL+CLICK (alebo CMD+CLICK na Macu).',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Page link icon',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Enter the name of a <strong><a href="%s" target="_blank">Font Awesome</a></strong> icon to use with the page link. Leave this field blank to use Pages’ traditional CSS/GIF image icons.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Zobraziť stránku',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Pokiaľ je hodnota nastavená na Nie, stránka nebude dostupná. (Poznámka: Administrátori budú mať k stránke prístup aj naďalej, čo umožňuje zobraziť súkromný náhľad stránky počas jej vývoja.)',
	'ACP_PAGES_FORM_GUESTS'				=> 'Zobrazovať stránku návštevníkom',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Pokiaľ je hodnota nastavená na Nie, stránka bude dostupná len registrovaným členom.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Odkaz na stránku',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'Spracovávať HTML',
	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Navigačný panel pred odkazmi',
	'NAV_BAR_LINKS_AFTER'				=> 'Navigačný panel za odkazmi',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Navigačný panel pred navigáciou',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Navigačný panel za navigaciou',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Pätička pred časovou zónou',
	'FOOTER_TIMEZONE_AFTER'				=> 'Pätička za časovou zónou',
	'FOOTER_TEAMS_BEFORE'				=> 'Pätička pred odkazom „Tím“',
	'FOOTER_TEAMS_AFTER'				=> 'Pätička za odkazom „Tím“',
	'QUICK_LINK_MENU_BEFORE'			=> 'Menu Rychlé odkazy hore',
	'QUICK_LINK_MENU_AFTER'				=> 'Menu Rychlé odkazy dolu',
));
