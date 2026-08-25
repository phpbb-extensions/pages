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
	'ACP_PAGES_MANAGE'					=> 'Zarządzanie stronami',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Tutaj możesz dodawać, edytować i usuwać niestandardowe strony.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Utwórz stronę',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Za pomocą poniższego formularza możesz stworzyć nową niestandardową stronę.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Edytuj stronę',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Za pomocą poniższego formularza możesz zaktualizować niestandardową stronę.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Tytuł',
	'ACP_PAGES_DESCRIPTION'				=> 'Opis',
	'ACP_PAGES_ROUTE'					=> 'Ścieżka',
	'ACP_PAGES_TEMPLATE'				=> 'Szablon',
	'ACP_PAGES_ORDER'					=> 'Kolejność',
	'ACP_PAGES_LINK'					=> 'Link',
	'ACP_PAGES_VIEW'					=> 'Przejdź do strony',
	'ACP_PAGES_STATUS'					=> 'Status',
	'ACP_PAGES_PUBLISHED'				=> 'Opublikowany',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Opublikowany (tylko dla użytkowników)',
	'ACP_PAGES_PRIVATE'					=> 'Prywatny',
	'ACP_PAGES_EMPTY'					=> 'Nie znaleziono strony',

	// Purge icons
//	'ACP_PAGES_PURGE_ICONS'				=> 'Czyść ikony',
//	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Wyczyść pamięć podręczną ikon',
//	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'Aby niestandardowe ikony stron poprawnie się wyświetlały, koniecznie jest wyczyszczenie pamięci podręcznej tego rozszerzenia.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Czy na pewno chcesz usunąć tę stronę?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Strona została usunięta.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'Strona nie może zostać usunięta.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Strona została dodana.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Strona została zaktualizowana.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Ustawienia strony',
	'ACP_PAGES_OPTIONS'					=> 'Opcje strony',
	'ACP_PAGES_FORM_TITLE'				=> 'Tytuł strony',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'To pole jest wymagane.',
	'ACP_PAGES_FORM_DESC'				=> 'Opis strony',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'To będzie wyświetlane tylko w panel administracyjnym.',
	'ACP_PAGES_FORM_DESC_DISPLAY'		=> 'Wyświetl jako tytuł odnośnika',
	'ACP_PAGES_FORM_ROUTE'				=> 'Ścieżka URL strony',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> '<strong>Ścieżka</strong> jest unikalnym indentyfikatorem strony, który określa link do strony, np. <samp>http://www.phpbb.com/<strong>route</strong></samp>. Dozwolone są tylko litery, cyfry, myślniki i podkreślenia. To pole jest wymagane.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Zawartość strony',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Treść może być tworzona przy użyciu Markdown, standardowych znaczników BBCode phpBB, emotikonów i automatycznie rozpoznawanych adresów URL albo można włączyć tryb HTML. W trybie HTML Markdown, BBCode, emotikony i automatycznie rozpoznawane adresy URL nie będą działać, ale można używać dowolnej poprawnej składni HTML. Należy pamiętać, że treść zostanie dodana do istniejącego szablonu HTML, dlatego nie należy dołączać znaczników DOCTYPE, HTML, BODY ani HEAD. Można jednak używać wszystkich innych znaczników formatowania HTML, w tym IFRAME, SCRIPT, STYLE, EMBED, VIDEO itd.',
	'ACP_PAGES_PARSE_MARKDOWN'			=> 'Przetwarzaj Markdown',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Szablon strony',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Własne szablony stron możesz dodać do pliku <samp>ext/phpbb/styles/*/template</samp>.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Wybierz szablon',
	'ACP_PAGES_FORM_ORDER'				=> 'Kolejność strony',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Strony zostaną posortowane według numeracji. Niższe numery mają pierwszeństwo przed wyższymi numerami.',
	'ACP_PAGES_FORM_LINKS'				=> 'Lokalizacja linku do strony',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Wybierz jedno lub wiele miejsc, w których ma wyświetlać się link do tej strony. Aby zaznaczyć wiele miejsc, kliknij i przytrzymaj przycisk "Ctrl".',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Ikona odnośnika do strony',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Wprowadź nazwę ikony <strong><a href="%s" target="_blank">Font Awesome</a></strong>, która ma być używana przy odnośniku do strony. Pozostaw to pole puste, aby użyć tradycyjnych ikon graficznych CSS/GIF rozszerzenia Pages.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Wyświetlanie strony',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Jeśli jest ustawione na "nie", strona nie będzie dostępna. <i>(Uwaga: Administratorzy nadal będą mogli uzyskać dostęp do strony, co jest pomocne np. przy ocenie tworzonej strony.)</i>',
	'ACP_PAGES_FORM_GUESTS'				=> 'Wyświetlanie strony dla gości',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Jeśli jest ustawione na "nie", tylko zarejestrowani użytkownicy będą mieli dostęp do strony.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Link do strony',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Wyświetl najpierw tytuł strony',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'Domyślnie przeglądarki wyświetlają tytuł tej strony po nazwie witryny <samp style="white-space: nowrap">„Nazwa witryny - Tytuł strony”</samp>. Włączenie tej opcji spowoduje wyświetlenie tytułu strony przed nazwą witryny <samp style="white-space: nowrap">„Tytuł strony - Nazwa witryny”</samp>.',
	'PARSE_HTML'						=> 'HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Pasek nawigacji przed linkami',
	'NAV_BAR_LINKS_AFTER'				=> 'Pasek nawigacji po linkach',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Pasek nawigacji przed wykazem forów',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Pasek nawigacji po wykazie forów',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Stopka przed strefą czasową',
	'FOOTER_TIMEZONE_AFTER'				=> 'Stopka po strefie czasowej',
	'FOOTER_TEAMS_BEFORE'				=> 'Stopka przed zespołem administracyjnym',
	'FOOTER_TEAMS_AFTER'				=> 'Stopka po zespole administracyjnym',
	'QUICK_LINK_MENU_BEFORE'			=> 'Szybkie linki na górze',
	'QUICK_LINK_MENU_AFTER'				=> 'Szybkie linki na dole',
));
