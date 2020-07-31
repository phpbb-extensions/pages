<?php
/**
*
* Pages extension for the phpBB Forum Software package.
* Translators: Basil Taha Alhitary - www.alhitary.net
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
	'ACP_PAGES_MANAGE'					=> 'إدارة الصفحات',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'من هنا تستطيع إضافة , تعديل أو حذف الصفحات التي تريدها.',
	'ACP_PAGES_CREATE_PAGE'				=> 'إنشاء الصفحة',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'تستطيع إنشاء الصفحة التي تريدها لمنتداك باستخدام النموذج الموجود بالأسفل.',
	'ACP_PAGES_EDIT_PAGE'				=> 'تعديل الصفحة',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'تستطيع تعديل الصفحة التي تريدها لمنتداك باستخدام النموذج الموجود بالأسفل.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'العنوان',
	'ACP_PAGES_DESCRIPTION'				=> 'الشرح',
	'ACP_PAGES_ROUTE'					=> 'المسار ',
	'ACP_PAGES_TEMPLATE'				=> 'القالب',
	'ACP_PAGES_ORDER'					=> 'الترتيب',
	'ACP_PAGES_LINK'					=> 'الرابط',
	'ACP_PAGES_VIEW'					=> 'مشاهدة الصفحة',
	'ACP_PAGES_STATUS'					=> 'الحالة',
	'ACP_PAGES_PUBLISHED'				=> 'منشور',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'منشور (للأعضاء فقط)',
	'ACP_PAGES_PRIVATE'					=> 'خاص',
	'ACP_PAGES_EMPTY'					=> 'لم يتم العثور على الصفحات',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'حذف',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'حذف الملفات المؤقتة للأيقونات ',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'قد تحتاج لحذف الملفات المؤقتة للأيقونات لكي تستطيع رؤية الايقونات الجديدة التي أضفتها للصفحة. تستطيع إضافة الأيقونات التي تريدها إلى المجلد <samp>styles/*/theme/images/</samp> على أن يكون بإسم <samp>pages_route.gif</samp> ( الـ <samp>route</samp> هو إسم مسار الصفحة )',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'متأكد أنك تريد حذف هذه الصفحة ؟',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'تم حذف الصفحة بنجاح.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'لا يمكن حذف الصفحة.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'تم إضافة الصفحة بنجاح.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'تم تحديث الصفحة بنجاح.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'الإعدادات',
	'ACP_PAGES_OPTIONS'					=> 'الخيارات',
	'ACP_PAGES_FORM_TITLE'				=> 'عنوان الصفحة ',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'يجب تعبئة هذا الحقل.',
	'ACP_PAGES_FORM_DESC'				=> 'وصف الصفحة ',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'الوصف يظهر فقط في قائمة الصفحات من لوحة التحكم الرئيسية.',
	'ACP_PAGES_FORM_ROUTE'				=> 'اسم مسار الصفحة ',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> 'اسم مسار الصفحة الذي يستخدم كرابط للوصول إلى الصفحة. مثال : <samp>http://www.phpbb.com/<strong>route</strong></samp>. المسموح فقط : الحروف , الأرقام , الواصلة ( - ) و ( _ ). يجب تعبئة هذا الحقل.',
	'ACP_PAGES_FORM_CONTENT'			=> 'المحتوى',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'تستطيع انشاء المجتوى الذي تريده باستخدام أكواد البي بي ( BBCodes ) والابتسامات والروابط , أو تستطيع بدلاً من ذلك تفعيل الـHTML واستخدام أي تركيبة لغوية صحيحة من بنية الـHTML. اذا استخدمت طريقة الـHTML , فسيتم تعطيل أكواد البي بي ( BBCodes ) والابتسامات والروابط. يُرجى الإنتباه إلى أنه سيتم إضافة هذا المحتوى إلى قالب HTML موجود , ولذلك يجب أن يكون المحتوى بدون العلامات / الأوسام : DOCTYPE , HTML , BODY , HEAD. ويُمكن استخدام بقية الأوسام الأخرى : IFRAME, SCRIPT, STYLE, EMBED, VIDEO وغيرها من الأوسام.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'قالب الصفحة ',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'اختار شكل القالب الذي سيحتوي على محتوى صفجتك. تستطيع إضافة القالب الخاص بك إلى المجلد <samp>styles/*/template</samp> على أن يكون بإسم <samp>pages_*.html</samp> ( استبدل ال* بالإسم الذي تريده ).',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'تحديد القالب',
	'ACP_PAGES_FORM_ORDER'				=> 'ترتيب الصفحة',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'تستطيع ترتيب ظهور الصفحات بواسطة هذا الحقل. الصفحات ذات الأرقام الأصغر ستظهر قبل الصفحات ذات الأرقام الأكبر.',
	'ACP_PAGES_FORM_LINKS'				=> 'أماكن ظهور الصفحة ',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'تستطيع تحديد مكان واحد أو أكثر لعرض روابط الصفحات. استخدم النقر على زر الكنترول مع النقر بالماوس CTRL+CLICK ( أو CMD+CLICK في نظام الماك Mac ) لتحديد أو الغاء التحديد لأكثر من مكان.',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Page link icon',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Enter the name of a <strong><a href="%s" target="_blank">Font Awesome</a></strong> icon to use with the page link. Leave this field blank to use Pages’ traditional CSS/GIF image icons.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'عرض الصفحة ',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'اختيارك " لا " يعني عدم عرض هذه الصفحة للأعضاء. ( ملاحظة : يستطيع الإداريين فقط مشاهدة هذه الصفحة )',
	'ACP_PAGES_FORM_GUESTS'				=> 'عرض الصفحة للزائرين ',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'اختيارك "لا" يعني اتاحة هذه الصفحة فقط للأعضاء المسجلين.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'رابط الصفحة ',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'تفعيل الـHTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'بداية الشريط العلوي',
	'NAV_BAR_LINKS_AFTER'				=> 'نهاية الشريط العلوي',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'يداية شريط العناوين',
	'NAV_BAR_CRUMBS_AFTER'				=> 'نهاية شريط العناوين',
	'FOOTER_TIMEZONE_BEFORE'			=> 'الشريط السفلي قبل التوقيت',
	'FOOTER_TIMEZONE_AFTER'				=> 'الشريط السفلي بعد التوقيت',
	'FOOTER_TEAMS_BEFORE'				=> 'الشريط السفلي قبل فريق الموقع',
	'FOOTER_TEAMS_AFTER'				=> 'الشريط السفلي بعد فريق الموقع',
	'QUICK_LINK_MENU_BEFORE'			=> 'بداية قائمة الروابط السريعة',
	'QUICK_LINK_MENU_AFTER'				=> 'نهاية قائمة الروابط السريعة',
));
