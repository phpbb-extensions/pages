<?php
/**
*
* Pages extension for the phpBB Forum Software package.
* @Italian translation by systemcrack http://morfeuscommunity.biz
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
	'ACP_PAGES_MANAGE'					=> 'Gestisci Pagine',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Da questa pagina è possibile aggiungere, modificare ed eliminare le pagine statiche.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Crea pagina',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Utilizzando il modulo qui sotto è possibile creare una nuova pagina statica personalizzata per la vostra board.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Modifica pagina',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Utilizzando il modulo qui sotto è possibile aggiornare una pagina statica personalizzata esistente.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Titolo',
	'ACP_PAGES_DESCRIPTION'				=> 'Descrizzione',
	'ACP_PAGES_ROUTE'					=> 'Percorso',
	'ACP_PAGES_TEMPLATE'				=> 'Template/Modello',
	'ACP_PAGES_ORDER'					=> 'Ordine',
	'ACP_PAGES_LINK'					=> 'Link',
	'ACP_PAGES_VIEW'					=> 'Visualizza pagina',
	'ACP_PAGES_STATUS'					=> 'Stato',
	'ACP_PAGES_PUBLISHED'				=> 'Pubblicato',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Pubblicato (solo membri)',
	'ACP_PAGES_PRIVATE'					=> 'Privato',
	'ACP_PAGES_EMPTY'					=> 'Nessuna pagina trovata',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Pulisci icone',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Pulisci cache delle icone delle pagine',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'Quando si aggiungono icone alle pagine personalizzate potrebbe essere necessario eliminare la cache delle icone per poterle visualizzare. Per inserire le icone personalizzate è necessario denominarle es. <samp>pages_route.gif</samp>, dove <samp>route</samp> è il "nome percorso" della pagina. Inserire l´immagine nella cartella <samp>ROOT/styles/*/theme/images/</samp>.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Sei sicuro di voler cancellare questa pagina?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Pagina cancellata con successo.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'La pagina non può essere cancellata.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Pagina aggiunta con successo.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Pagina aggiornata con successo.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Impostazioni Pagina',
	'ACP_PAGES_OPTIONS'					=> 'Opzioni Pagina',
	'ACP_PAGES_FORM_TITLE'				=> 'Titolo Pagina',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Questo è un campo obbligatorio.',
	'ACP_PAGES_FORM_DESC'				=> 'Descrizione Pagina',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Viene visualizzata solo nell´elenco delle pagine in PCA.',
	'ACP_PAGES_FORM_ROUTE'				=> 'URL percorso pagina',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> 'Il <strong>percorso</strong> è un identificativo univoco utilizzato alla fine dell´URL di una pagina per definire il link alla pagina, ad esempio, <samp>http://www.phpbb.com/<strong>route</strong></samp>. Sono ammessi solo lettere, numeri, trattini e underscore. Questo è un campo obbligatorio.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Contenuto della pagina',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Il contenuto può essere creato utilizzando il normale phpBB BBCodes, oppure è possibile attivare la modalità HTML. In modalità HTML, BBCodes, faccine non funzionano, ma si è liberi di utilizzare qualsiasi sintassi HTML valida. Si prega di notare che a questo contenuto sarà aggiunto un modello HTML esistente, quindi non si dovrebbe includere DOCTYPE, HTML, BODY o tag HEAD. Tuttavia, tutti gli altri tag di formattazione HTML, inclusi IFRAME, SCRIPT, STYLE, EMBED, VIDEO, ecc possono essere utilizzati.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Template pagina',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Template pagina personalizzata denominato <samp>pages_*.html</samp> può essere aggiunto alla cartella phpBB’s <samp>styles/*/template</samp>.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Seleziona il template',
	'ACP_PAGES_FORM_ORDER'				=> 'Ordine Pagina',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Le pagine verranno ordinate in base a questo campo, che può aiutare ad organizzare l´ordine in cui appaiono loro collegamenti. I numeri più bassi hanno la precedenza su numeri più alti.',
	'ACP_PAGES_FORM_LINKS'				=> 'Posizione link alla pagina',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Selezionare uno o più luoghi in cui il link a questa pagina putrà apparire. Utilizzare Ctrl + clic (o CMD + clic su Mac) per selezionare/deselezionare più di una voce.',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Page link icon',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Enter the name of a <strong><a href="%s" target="_blank">Font Awesome</a></strong> icon to use with the page link. Leave this field blank to use Pages’ traditional CSS/GIF image icons.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Visualizza pagina',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Se impostato su no, la pagina non sarà accessibile. (Nota: Gli amministratori saranno ancora in grado di accedere alla pagina, permettendo loro di visualizzare in anteprima privatamente la pagina mentre lo sviluppo è ancora in essere.)',
	'ACP_PAGES_FORM_GUESTS'				=> 'Permetti visualizzazione pagina agli ospiti',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Se impostato su no, solo gli utenti registrati saranno in grado di accedere alla pagina.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Link alla pagina',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'Analizza HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Nav Bar Prima dei Links',
	'NAV_BAR_LINKS_AFTER'				=> 'Nav Bar Dopo i Links',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Nav Bar Prima di Breadcrumbs',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Nav Bar Dopo Breadcrumbs',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Footer Prima Time Zone',
	'FOOTER_TIMEZONE_AFTER'				=> 'Footer Dopo Time Zone',
	'FOOTER_TEAMS_BEFORE'				=> 'Footer Prima Team Link',
	'FOOTER_TEAMS_AFTER'				=> 'Footer Dopo Team Link',
	'QUICK_LINK_MENU_BEFORE'			=> 'In cima ai collegamenti rapidi',
	'QUICK_LINK_MENU_AFTER'				=> 'In fondo ai collegamenti rapidi',
));
