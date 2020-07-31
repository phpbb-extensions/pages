<?php
/**
*
* Pages extension for the phpBB Forum Software package.
* @简体中文语言　David Yin <https://www.phpbbchinese.com/>
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
	'ACP_PAGES_MANAGE'					=> '管理单页',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> '在这里您可以添加，编辑，或者删除单页。',
	'ACP_PAGES_CREATE_PAGE'				=> '添加单页',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> '使用下面表单，您可以为您的论坛添加一个单页。',
	'ACP_PAGES_EDIT_PAGE'				=> '编辑单页',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> '使用下面的表单，您可以更新一个现存的单页。',

	// Display pages list
	'ACP_PAGES_TITLE'					=> '标题',
	'ACP_PAGES_DESCRIPTION'				=> '描述',
	'ACP_PAGES_ROUTE'					=> '路径',
	'ACP_PAGES_TEMPLATE'				=> '模板',
	'ACP_PAGES_ORDER'					=> '顺序',
	'ACP_PAGES_LINK'					=> '链接',
	'ACP_PAGES_VIEW'					=> '查看单页',
	'ACP_PAGES_STATUS'					=> '状态',
	'ACP_PAGES_PUBLISHED'				=> '已发表',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> '已发表 （仅会员）',
	'ACP_PAGES_PRIVATE'					=> '私有',
	'ACP_PAGES_EMPTY'					=> '没有单页',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> '清除图标缓存',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> '清除单页图标缓存',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> '当增加定制页面的链接图标，您也许需要清除图标缓存才能看到新的图标。如果 <samp>route</samp> 是页面的路径名称，放置定制图标 <samp>pages_route.gif</samp>， 到 phpBB 的 <samp>styles/*/theme/images/</samp> 文件夹。',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> '您确认想要删除此单页？',
	'ACP_PAGES_DELETE_SUCCESS'			=> '单页已成功删除。',
	'ACP_PAGES_DELETE_ERRORED'			=> '单页无法被删除。',
	'ACP_PAGES_ADD_SUCCESS'				=> '单页已成功添加。',
	'ACP_PAGES_EDIT_SUCCESS'			=> '单页已完成更新。',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> '单页设置',
	'ACP_PAGES_OPTIONS'					=> '单页选项',
	'ACP_PAGES_FORM_TITLE'				=> '单页标题',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> '必填项',
	'ACP_PAGES_FORM_DESC'				=> '单页描述',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> '只显示在ACP的单页列表中。',
	'ACP_PAGES_FORM_ROUTE'				=> '单页 URL 路径',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> '路径 <strong>route</strong> 是唯一的标识，放在单页 URL 的最后，用于表示单页的链接。 例如 <samp>http://www.phpbb.com/<strong>route</strong></samp>。 字母，数字，连字符号和下划线。这是必填项。',
	'ACP_PAGES_FORM_CONTENT'			=> '单页内容',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> '内容可以包含 BBCode 笑脸， 以及神奇网址，或者您可以启动 HTML 模式。 在 HTML 模式内，BBCode，笑脸和神奇网址无效，但是你可以自由使用任何有效的 HTML 语法。请注意这些内容会被加入到 HTML 模板内，所以您不应该包括 DOCTYPE，HTML， BODY 或者 HEAD 标签。但是其它标签可以使用，比如 IFRAME， SCRIPT， STYLE， EMBED， VIDEO等。 ',
	'ACP_PAGES_FORM_TEMPLATE'			=> '单页模板',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> '定制单页模板 <samp>pages_*.html</samp> 可以加入到 phpBB 的 <samp>styles/*/template</samp> 文件夹。',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> '选择一个模板',
	'ACP_PAGES_FORM_ORDER'				=> '单页顺序',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> '单页会按照此项要求排序。小的数字比大的数字更优先。',
	'ACP_PAGES_FORM_LINKS'				=> '单页链接位置',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> '选择一个或者多个位置，用于显示页面链接，使用 CTRL+CLICK （或者 Mac 的 CMD+CLICK ） 来选择多个项目。 ',
	'ACP_PAGES_FORM_ICON_FONT'			=> '单页链接图标',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> '输入一个 <strong><a href="%s" target="_blank">Font Awesome</a></strong> 图标的名字，用于单页链接。留空则使用单页传统的 CSS/GIF 图标。',
	'ACP_PAGES_FORM_DISPLAY'			=> '显示单页',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> '若设置为否，单页将无法访问。 （注：管理员总是能够访问单页，可以预览页面内容。）',
	'ACP_PAGES_FORM_GUESTS'				=> '游客可访问单页。',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> '若设置为否，只有注册用户可以访问此单页。',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> '单页链接',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> '解析 HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> '导航条的链接前',
	'NAV_BAR_LINKS_AFTER'				=> '导航条的链接后',
	'NAV_BAR_CRUMBS_BEFORE'				=> '在面包屑前',
	'NAV_BAR_CRUMBS_AFTER'				=> '在面包屑后',
	'FOOTER_TIMEZONE_BEFORE'			=> '页脚区域的时区之前',
	'FOOTER_TIMEZONE_AFTER'				=> '页脚区域的时区之后',
	'FOOTER_TEAMS_BEFORE'				=> '页脚区域的管理团队链接前',
	'FOOTER_TEAMS_AFTER'				=> '页脚区域的管理团队链接后',
	'QUICK_LINK_MENU_BEFORE'			=> '快速链接菜单顶部',
	'QUICK_LINK_MENU_AFTER'				=> '快速链接菜单底部',
));
