<?php
/**
*
* Pages extension for the phpBB Forum Software package.
* Turkish translation by ESQARE (http://www.phpbbturkey.com)
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
	'ACP_PAGES_MANAGE'					=> 'Sayfaları yönet',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Bu sayfadan özel sabit sayfalar ekleyebilir, düzenleyebilir ve silebilirsiniz.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Sayfa oluştur',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Alttaki formu kullanarak mesaj panonuz için yeni bir özel sabit sayfa oluşturabilirsiniz.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Sayfayı düzenle',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Alttaki formu kullanarak mesaj panonuzda mevcut olan özel sabit sayfayı güncelleyebilirsiniz.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Başlık',
	'ACP_PAGES_DESCRIPTION'				=> 'Açıklama',
	'ACP_PAGES_ROUTE'					=> 'Yol',
	'ACP_PAGES_TEMPLATE'				=> 'Şablon',
	'ACP_PAGES_ORDER'					=> 'Sıra',
	'ACP_PAGES_LINK'					=> 'Bağlantı',
	'ACP_PAGES_VIEW'					=> 'Sayfayı görüntüle',
	'ACP_PAGES_STATUS'					=> 'Durum',
	'ACP_PAGES_PUBLISHED'				=> 'Yayınlandı',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Yayınlandı (sadece üyeler)',
	'ACP_PAGES_PRIVATE'					=> 'Özel',
	'ACP_PAGES_EMPTY'					=> 'Hiç bir sayfa bulunamadı',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Simgeleri temizle',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Sayfa simgeleri önbelleğini temizle',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'Özel sayfa bağlantı simgeleri eklediğiniz zaman, yeni simgeleri görmek için simge önbelleğini temizlemeniz gerekebilir. phpBB’nin <samp>styles/*/theme/images/</samp> dizinine <samp>pages_route.gif</samp> adında özel simge yerleştirdiğinizde, <samp>route</samp> Sayfa’nın yolu olacaktır.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Bu sayfayı silmek istediğinize emin misiniz?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Sayfa başarıyla silindi.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'Sayfa silinemedi.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Sayfa başarıyla eklendi.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Sayfa başarıyla güncellendi.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Sayfa ayarları',
	'ACP_PAGES_OPTIONS'					=> 'Sayfa seçenekleri',
	'ACP_PAGES_FORM_TITLE'				=> 'Sayfa başlığı',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Bu gerekli bir alandır.',
	'ACP_PAGES_FORM_DESC'				=> 'Sayfa açıklaması',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Bu, sadece YKP’de sayfaların listesinde gösterilecektir.',
	'ACP_PAGES_FORM_ROUTE'				=> 'Sayfa URL yolu',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> '<strong>yol</strong>, sayfaya bağlantı vermek için belirlenen, sayfanın URL adresinin sonunda kullanılacak benzersiz bir tanımlayıcıdır, ör. <samp>http://www.phpbb.com/<strong>yol</strong></samp>. Sadece harfler, rakamlar, tire ve alt çizgilere izin verilir. Bu zorunlu bir alandır.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Sayfa içeriği',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'İçerik normal phpBB BBCode’ları, ifadeler, sihirli url’ler ya da HTML modu kullanılarak. HTML modunda, BBCode’lar, ifadeler ve sihirli url’ler çalışmayacaktır, fakat bunun yerine herhangi bir HTML sözdizimi kullanmakta özgürsünüz. Not: bu içerik mevcut HTML şablonuna eklenecektir, bu nedenle DOCTYPE, HTML, BODY ya da HEAD etiketleri kullanmamalısınız. Bununla birlikte, tüm diğer IFRAME, SCRIPT, STYLE, EMBED, VIDEO, v.b. gibi HTML biçimlendirme etiketleri kullanılabilir.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Sayfa şablonu',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> '<samp>pages_*.html</samp> adlı özel şablon temaları phpBB’nin <samp>styles/*/template</samp> dizinine eklenebilir.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Bir şablon seçin',
	'ACP_PAGES_FORM_ORDER'				=> 'Sayfa sırası',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Sayfalar bu alana göre sıralanacaktır, bağlantıların görünme sırasını organize edebilirsiniz. Düşük sayılar yüksek sayılardan önceliklidir.',
	'ACP_PAGES_FORM_LINKS'				=> 'Sayfa bağlantı yerleri',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Bu sayfaya görünebilir bağlantı verilecek bir ya da daha fazla yer seçin. Birden fazla öge seçmek için CTRL+TIKLA (ya da Mac’te CMD+TIKLA) fare/klavye kombinasyonunu kullanın.',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Sayfa link simgesi',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Sayfa linkinde gösterilmek üzere bir tane <a href="%s" target="_blank">Font Awesome</a> simge ismi girin. Sayfalar eklentisinin geleneksel CSS/GIF resim simgesini kullanmak için alanı boş bırakın.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Sayfayı göster',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Eğer hayır olarak ayarlarsanız, sayfa erişilebiir olmayacaktır. (Not: Yöneticiler, sayfayı geliştirmeye devam ederken önizleme yapabilmeleri için özel olarak sayfaya erişebileceklerdir.)',
	'ACP_PAGES_FORM_GUESTS'				=> 'Sayfayı misafirlere göster',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Eğer hayır olarak ayarlarsanız, sadece kayıtlı kullanıcılar sayfaya erişebileceklerdir.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Sayfa bağlantısı',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'HTML ayrıştır',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Gezinme Çubuğu Bağlantılardan Önce',
	'NAV_BAR_LINKS_AFTER'				=> 'Gezinme Çubuğu Bağlantılardan Sonra',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Gezinme Çubuğu Menülerden Önce',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Gezinme Çubuğu Menülerden Sonra',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Sayfa Altı Zaman Diliminden Önce',
	'FOOTER_TIMEZONE_AFTER'				=> 'Sayfa Altı Zaman Diliminden Sonra',
	'FOOTER_TEAMS_BEFORE'				=> 'Sayfa Altı Takım Bağlantısından Önce',
	'FOOTER_TEAMS_AFTER'				=> 'Sayfa Altı Takım Bağlantısından Sonra',
	'QUICK_LINK_MENU_BEFORE'			=> 'Hızlı Bağlantılar Menüsünün Üstü',
	'QUICK_LINK_MENU_AFTER'				=> 'Hızlı Bağlantılar Menüsünün Altı',
));
