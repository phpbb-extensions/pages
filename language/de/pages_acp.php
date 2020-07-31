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
	'ACP_PAGES_MANAGE'					=> 'Seiten verwalten',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Von dieser Seite aus kannst du selbstdefiniert statische Seiten hinzufügen, verwalten und löschen.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Erstelle Seite',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Mit dem Formular unten kannst du neue selbstdefinierte statische Seiten für dein Forum anlegen.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Bearbeite Seite',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Mit dem Formular unten kannst du eine bestehende selbstdefinierte statische Seite aktualisieren.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Titel',
	'ACP_PAGES_DESCRIPTION'				=> 'Beschreibung',
	'ACP_PAGES_ROUTE'					=> 'Route',
	'ACP_PAGES_TEMPLATE'				=> 'Vorlage',
	'ACP_PAGES_ORDER'					=> 'Reihenfolge',
	'ACP_PAGES_LINK'					=> 'Link',
	'ACP_PAGES_VIEW'					=> 'Zeige Seite',
	'ACP_PAGES_STATUS'					=> 'Status',
	'ACP_PAGES_PUBLISHED'				=> 'Veröffentlicht',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Veröffentlicht (nur Benutzer)',
	'ACP_PAGES_PRIVATE'					=> 'Privat',
	'ACP_PAGES_EMPTY'					=> 'Keine Seite gefunden',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Lösche Icons',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Löscht den Icon Cache',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'Wenn du selbstdefinierte Link-Icons hinzufügst musst du unter Umständen den Icon Cache löschen um neue Icons zu sehen. Lade benutzerdefinierte Icons mit dem Namen <samp>pages_route.gif</samp> nach <samp>styles/*/theme/images/</samp> hoch, wobei <samp>route</samp> der Name der URL route ist.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Bist du sicher, dass du diese Seite löschen willst?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Seite erfolgreich gelöscht.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'Seite konnte nicht gelöscht werden.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Seite erfolgreich hinzugefügt.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Seite erfolgreich aktualisiert.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Seiten Einstellungen',
	'ACP_PAGES_OPTIONS'					=> 'Seiten Optionen',
	'ACP_PAGES_FORM_TITLE'				=> 'Seitentitel',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Dies ist ein erforderliches Feld.',
	'ACP_PAGES_FORM_DESC'				=> 'Seiten Beschreibung',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Dies wird nur in der ACP Übersicht der Seiten angezeigt.',
	'ACP_PAGES_FORM_ROUTE'				=> 'Seite URL route',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> 'Die <strong>route</strong> ist eine einzigartige Bezeichnung am Ende der URL der Seite die am Ende des Links zur Seite steht, z.B.: <samp>http://www.phpbb.com/<strong>route</strong></samp>. Es sind nur Buchstaben, Zahlen, Hyphens und Tiefstriche ("_") erlaubt. Dies ist ein erforderliches Feld.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Seiten Inhalt',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Inhalt kann durch BBCode, Smilies und magische URLs erstellt werden, oder du kannst den HTML-Modus nutzen. Im HTML Modus werden BBCodes, Smilies and magische URLs nicht funktionieren, aber es steht dir frei beliebige valide HTML Syntax zu verwenden. Bitte beachte, dass dieser Inhalt zu bestehendem HTML hinzugefügt wird und deshalb auf DOCTYPE, HTML, BODY und HEAD Tags verzichtet werden. Alle anderen HTML Formatierungs-Tags inkl. IFRAME, SCRIPT, STYLE, EMBED, VIDEO, etc. können jedoch verwendet werden.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Seiten Vorlage',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Selbsterstellte Seiten-Vorlagen mit dem Namensschema <samp>pages_*.html</samp> können in phpBBs Verzeichnisstruktur unter <samp>styles/*/template</samp> abgelegt werden.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Vorlage auswählen',
	'ACP_PAGES_FORM_ORDER'				=> 'Seiten Reihenfolge',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Seiten werden nach der Angabe in diesem Feld sortiert, was hilft die Reihenfolge festzulegen in der Seiten erscheinen. Kleinere Zahlen haben Vorrang vor Höheren.',
	'ACP_PAGES_FORM_LINKS'				=> 'Seiten Link Orte',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Wähle einen oder mehre Orte an dem der Link zu der Seite erscheinen soll. Benutze Strg+CLICK (bzw. CMD+CLICK auf Mac) um Einträge anzuwählen/abzuwählen.',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Page link icon',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Enter the name of a <strong><a href="%s" target="_blank">Font Awesome</a></strong> icon to use with the page link. Leave this field blank to use Pages’ traditional CSS/GIF image icons.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Seite anzeigen',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Wenn auf nein gesetzt wird die Seite nicht aufrufbar sein. (Hinweis: Admins werden dennoch in der Lage sein die Seite zu sehen, was die Erstellung erleichtern soll.)',
	'ACP_PAGES_FORM_GUESTS'				=> 'Seite sichtbar für Gäste',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Wenn auf nein gesetzt können nur registrierte Nutzer die Seite sehen.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Seiten Link',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'Parse HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Nav Bar vor Links',
	'NAV_BAR_LINKS_AFTER'				=> 'Nav Bar nach Links',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Nav Bar vor Breadcrumbs',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Nav Bar nach Breadcrumbs',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Footer vor Time Zone',
	'FOOTER_TIMEZONE_AFTER'				=> 'Footer nach Time Zone',
	'FOOTER_TEAMS_BEFORE'				=> 'Footer vor Team Link',
	'FOOTER_TEAMS_AFTER'				=> 'Footer nach Team Link',
	'QUICK_LINK_MENU_BEFORE'			=> 'Quick Links Menu Oben',
	'QUICK_LINK_MENU_AFTER'				=> 'Quick Links Menu Unten',
));
