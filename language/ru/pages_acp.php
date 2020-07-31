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
	'ACP_PAGES_MANAGE'					=> 'Управление «Страницами»',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Здесь вы можете добавить, изменить или удалить страницы.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Создать страницу',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Используйте форму для создания новой страницы.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Изменить страницу',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Используя форму ниже вы можете изменить страницу.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Имя',
	'ACP_PAGES_DESCRIPTION'				=> 'Описание',
	'ACP_PAGES_ROUTE'					=> 'Путь',
	'ACP_PAGES_TEMPLATE'				=> 'Шаблон',
	'ACP_PAGES_ORDER'					=> 'Порядок',
	'ACP_PAGES_LINK'					=> 'Ссылка',
	'ACP_PAGES_VIEW'					=> 'Просмотр страницы',
	'ACP_PAGES_STATUS'					=> 'Статус',
	'ACP_PAGES_PUBLISHED'				=> 'Публичная',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Публичная (только для зарегистрированных  пользователей)',
	'ACP_PAGES_PRIVATE'					=> 'Приватная',
	'ACP_PAGES_EMPTY'					=> 'Страницы не найдены',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Очистить иконки',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Очистить кеш иконок',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'При добавлении иконки к ссылке вам нужно очистить кеш иконок. Иконки должны иметь имя  <samp>pages_route.gif</samp>, где <samp>route</samp> - это путь, заданный в настройках конкретной страницы, иконки загружать в папку  <samp>styles/*/theme/images/</samp>.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Вы действительно хотите удалить страницу?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Страница успешно удалена.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'Страница не может быть удалена.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Страница успешно добавлена.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Страница успешно обновлена.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Настройки страницы',
	'ACP_PAGES_OPTIONS'					=> 'Опции страницы',
	'ACP_PAGES_FORM_TITLE'				=> 'Имя страницы',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Это обязательное поле.',
	'ACP_PAGES_FORM_DESC'				=> 'Описание страницы',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Только для отображения в админ.панели в списке страниц.',
	'ACP_PAGES_FORM_ROUTE'				=> 'URL путь страницы',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> 'Путь, по которому страница будет доступна, например, <samp>http://www.phpbb.com/<strong>route</strong></samp>. Разрешены только буквы и цифры, обязательное поле.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Содержимое страницы',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Содержимое может состоять либо из текста, ВВ-кодов и смайликов либо из HTML-кода. Помните, что при использовании  HTML-кода нельзя использовать теги DOCTYPE, HTML, BODY и HEAD. Разумеется, можно использовать любые другие теги, встраивание IFRAME, SCRIPT, STYLE, EMBED, VIDEO.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Шаблон страницы',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Свои шаблоны страниц называйте <samp>pages_*.html</samp> и располагайте по пути <samp>styles/*/template</samp> ',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Выбрать шаблон',
	'ACP_PAGES_FORM_ORDER'				=> 'Порядок страницы',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Страницы будут отсортированы по этому полю. Чем меньше число, тем выше приоритет страницы.',
	'ACP_PAGES_FORM_LINKS'				=> 'Размещение ссылки на страницу',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Выберите место для размещения ссылки на данную страницу. Используйте CTRL+CLICK (или CMD+CLICK в Mac) для выделения нескольких пунктов',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Значок ссылки страницы',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Введите имя значка <strong><a href="%s" target="_blank">Font Awesome</a></strong> для отображения рядом со ссылкой на данную страницу. Оставьте поле пустым для использования в качестве значка обычных изображений CSS/GIF.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Показывать страницу',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Если выберите Нет, то страница не будет показываться (Администраторы будут иметь доступ к этой странице.)',
	'ACP_PAGES_FORM_GUESTS'				=> 'Показывать страницу гостям',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Если выберите Нет, то страница будет показываться только зарегистрированным пользователям',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Ссылка на страницу',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'Обрабатывать HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Верхнее меню перед Ссылками',
	'NAV_BAR_LINKS_AFTER'				=> 'Верхнее меню после Ссылок',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Верхнее меню перед Breadcrumbs',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Верхнее меню после Breadcrumbs',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Футер, перед Часовым Поясом',
	'FOOTER_TIMEZONE_AFTER'				=> 'Футер, после Часового Пояса',
	'FOOTER_TEAMS_BEFORE'				=> 'Футер, перед ссылкой Наша Команда',
	'FOOTER_TEAMS_AFTER'				=> 'Футер, после ссылки Наша Команда',
	'QUICK_LINK_MENU_BEFORE'			=> 'Ссылки в верхнем меню',
	'QUICK_LINK_MENU_AFTER'				=> 'Ссылки в нижнем меню',
));
