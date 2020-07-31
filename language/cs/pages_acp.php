<?php
/**
*
* Pages extension for the phpBB Forum Software package.
* Czech translation by R3gi (regiprogi@gmail.com)
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
	'ACP_PAGES_MANAGE'					=> 'Správa stránek',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Zde můžete přidat, upravit či odstranit vlastní statické stránky.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Vytvořit stránku',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Pomocí následujícího formuláře můžete vytvořit vlastní statickou stránku pro své fórum.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Upravit stránku',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Pomocí následujícího formuláře můžete aktualizovat již existující vlastní statickou stránku pro své fórum.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Název',
	'ACP_PAGES_DESCRIPTION'				=> 'Popis',
	'ACP_PAGES_ROUTE'					=> 'Cesta',
	'ACP_PAGES_TEMPLATE'				=> 'Šablona',
	'ACP_PAGES_ORDER'					=> 'Pořadí',
	'ACP_PAGES_LINK'					=> 'Odkaz',
	'ACP_PAGES_VIEW'					=> 'Zobrazit stránku',
	'ACP_PAGES_STATUS'					=> 'Stav',
	'ACP_PAGES_PUBLISHED'				=> 'Publikováno',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Publikováno (pouze pro členy)',
	'ACP_PAGES_PRIVATE'					=> 'Soukromá',
	'ACP_PAGES_EMPTY'					=> 'Nenalezeny žádné stránky',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Vymazat ikony',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Vymazat mezipaměť ikon stránek',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'Při přidávání vlastních ikon pro odkazy stránek může být potřeba pročištění cache, aby byly nové ikony vidět. Ikony s názvem <samp>pages_route.gif</samp>, kde <samp>route</samp> je název cesty stránky, umístěte do složky phpBB motivů <samp>styles/*/theme/images/</samp>.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Opravdu chcete tuto stránku smazat?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Stránka byla úspěšně odstraněna.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'Stránku nelze odstranit.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Stránka byla úspěšně přidána.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Stránka byla úspěšně aktualizována.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Nastavení stránky',
	'ACP_PAGES_OPTIONS'					=> 'Možnosti stránky',
	'ACP_PAGES_FORM_TITLE'				=> 'Název stránky',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Toto pole je povinné.',
	'ACP_PAGES_FORM_DESC'				=> 'Popis stránky',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Tato informace bude zobrazena pouze v seznamu stránek v ACP.',
	'ACP_PAGES_FORM_ROUTE'				=> 'URL adresa stránky',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> '<strong>Cesta</strong> je unikátní identifikátor používaný na konci URL adresy stránky, který určuje podobu odkazu na stránku – např. <samp>http://www.phpbb.com/<strong>route</strong></samp>. Jsou povolena pouze písmena, čísla, spojovníky a podtržítka. Toto pole je povinné.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Obsah stránky',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Obsah lze vytvořit pomocí BBCode, smajlíků a magic URL adres. Můžete také povolit HTML režim, ve kterém BBCode, smajlíci ani magic URL adresy nebudou fungovat, ale můžete používat libovolnou platnou HTML syntaxi. Pamatujte, že tento obsah bude přidán do již existující šablony, takže byste neměli používat DOCTYPE, HTML, BODY nebo HEAD tagy. Všechny ostatní formátovací HTML značky jako např. IFRAME, SCRIPT, STYLE, EMBED, VIDEO, atp. použít lze.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Šablona stránky',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Šablony pro vlastní stránku s názvem <samp>pages_*.html</samp> umístěte do složky phpBB motivů: <samp>styles/*/template</samp>.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Výběr šablony',
	'ACP_PAGES_FORM_ORDER'				=> 'Pořadí stránek',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Stránky budou řazeny podle tohoto pole, které vám umožní organizovat pořadí, ve kterém se odkazy zobrazí. Nižší čísla mají přednost před vyššími.',
	'ACP_PAGES_FORM_LINKS'				=> 'Umístění odkazů na stránku',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Vyberte jednu či více umístění, kde bude zobrazen odkaz na tuto stránkue. Pro označení/odznačení více položek použijte CTRL+CLICK (nebo CMD+CLICK na Macu).',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Page link icon',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Enter the name of a <strong><a href="%s" target="_blank">Font Awesome</a></strong> icon to use with the page link. Leave this field blank to use Pages’ traditional CSS/GIF image icons.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Zobrazit stránku',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Pokud je hodnota nastavena na Ne, stránka nebude dostupná. (Poznámka: Administrátoři budou mít ke stránce přístup i nadále, což umožňuje zobrazit soukromý náhled stránky během jejího vývoje.)',
	'ACP_PAGES_FORM_GUESTS'				=> 'Zobrazovat stránku návštěvníkům',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Pokud je hodnota nastavena na Ne, stránka bude dostupná pouze registrovaným členům.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Odkaz na stránku',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'Zpracovávat HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Navigační panel před odkazy',
	'NAV_BAR_LINKS_AFTER'				=> 'Navigační panel za odkazy',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Navigační panel před navigací',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Navigační panel za navigací',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Patička před časovou zónou',
	'FOOTER_TIMEZONE_AFTER'				=> 'Patička za časovou zónou',
	'FOOTER_TEAMS_BEFORE'				=> 'Patička před odkazem „Tým“',
	'FOOTER_TEAMS_AFTER'				=> 'Patička za odkazem „Tým“',
	'QUICK_LINK_MENU_BEFORE'			=> 'Menu Rychlé odkazy nahoře',
	'QUICK_LINK_MENU_AFTER'				=> 'Menu Rychlé odkazy dole',
));
