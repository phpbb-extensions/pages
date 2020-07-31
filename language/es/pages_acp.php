<?php
/**
*
* Pages extension for the phpBB Forum Software package.
* Spanish translation by Raul [ThE KuKa] (www.phpbb-es.com)
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
	'ACP_PAGES_MANAGE'					=> 'Gestionar Páginas',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Desde esta página puede añadir, editar y borrar páginas estáticas personalizadas.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Crear página',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Usando el siguiente formulario puede crear una nueva página estática personalizada para su foro.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Editar página',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Usando el siguiente formulario puede actualizar una página estática personalizada existente de su foro.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Título',
	'ACP_PAGES_DESCRIPTION'				=> 'Descripción',
	'ACP_PAGES_ROUTE'					=> 'Ruta',
	'ACP_PAGES_TEMPLATE'				=> 'Plantilla',
	'ACP_PAGES_ORDER'					=> 'Orden',
	'ACP_PAGES_LINK'					=> 'Enlace',
	'ACP_PAGES_VIEW'					=> 'Ver página',
	'ACP_PAGES_STATUS'					=> 'Estado',
	'ACP_PAGES_PUBLISHED'				=> 'Publicada',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Publicada (sólo para miembros)',
	'ACP_PAGES_PRIVATE'					=> 'Privada',
	'ACP_PAGES_EMPTY'					=> 'No se encontraron páginas',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Purgar iconos',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Purgar caché de iconos de páginas',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'Al añadir enlaces de iconos a las páginas personalizados, puede que tenga que purgar el caché de iconos para ver los nuevos iconos. Coloque los iconos personalizados así, <samp>pages_ruta.gif</samp>, donde <samp>ruta</samp> es el nombre de la Página ruta, en phpBB las carpetas <samp>styles/*/theme/images/</samp>',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> '¿Seguro que quiere eliminar esta página?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Página borrada correctamente.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'La página no pudo ser borrada.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Página añadida correctamente.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Página actualizada correctamente.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Ajustes de la página',
	'ACP_PAGES_OPTIONS'					=> 'Opciones de la página',
	'ACP_PAGES_FORM_TITLE'				=> 'Título de la página',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Esto es un campo requerido.',
	'ACP_PAGES_FORM_DESC'				=> 'Descripción de la página',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Esto solo se mostrará en la lista de páginas del PCA.',
	'ACP_PAGES_FORM_ROUTE'				=> 'Ruta URL de la página',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> 'La <strong>ruta</strong> es un identificador único utilizado al final de la URL de una página para definir el vínculo a la página, por ejemplo, <samp>http://www.phpbb.com/<strong>route</strong></samp>. Sólo se admiten letras, números, guiones y guiones bajos. Este es un campo obligatorio.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Contenido de la página',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'El contenido puede ser creado usando BBCodes normales phpBB, emoticonos y URLs de magia, o se puede activar el modo HTML. En modo HTML, los BBCodes, emoticonos y URLs de magia no funcionarán, pero es libre de utilizar cualquier sintaxis HTML válido. Tenga en cuenta que este contenido se añadirá a una plantilla HTML existente, por lo que no debe incluir DOCTYPE, HTML, BODY o etiquetas HEAD. Sin embargo, todas las demás etiquetas de formato HTML, incluyendo IFRAME, SCRIPT, STYLE, EMBED, VIDEO, etc. si se pueden utilizar.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Plantilla de la página',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Plantillas de página personalizadas denominadas <samp>pages_*.html</samp> pueden ser añadidas a las carpetas phpBB <samp>styles/*/template</samp>',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Seleccionar una plantilla',
	'ACP_PAGES_FORM_ORDER'				=> 'Orden de páginas',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Las páginas se ordenan según este campo, lo que puede ayudar a organizar el orden en que aparecen sus enlaces. Los números más bajos tienen prioridad sobre los números más altos.',
	'ACP_PAGES_FORM_LINKS'				=> 'Ubicación del enlace de la página',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Seleccionar una o más ubicaciones donde puede aparecer el enlace a esta página. Use CTRL+CLICK (o CMD+CLICK en Mac) para seleccionar/anular selección de más de un artículo.',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Icono del enlace de página',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Introduzca el nombre de un icono <strong><a href="%s" target="_blank">Font Awesome</a></strong> para usarlo con el enlace de la página. Deje este campo en blanco para utilizar los iconos de imagen tradicionales CSS/GIF de Páginas.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Mostrar página',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Si se establece en no, la página no será accesible. (Nota: Los Administradores todavía serán capaces de acceder a la página, lo que les permite una vista previa de la página de forma privada mientras se desarrolla.)',
	'ACP_PAGES_FORM_GUESTS'				=> 'Mostrar página a invitados',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Si se establece en no, sólo los usuarios registrados podrán acceder a la página.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Enlace de la página',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'Reconocer HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Barra de navegación Antes de enlaces',
	'NAV_BAR_LINKS_AFTER'				=> 'Barra de navegación Después de enlaces',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Barra de navegación Antes Breadcrumbs',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Barra de navegación Después Breadcrumbs',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Píe de página Antes Zona horaria',
	'FOOTER_TIMEZONE_AFTER'				=> 'Píe de página Después Zona horaria',
	'FOOTER_TEAMS_BEFORE'				=> 'Píe de página Antes de enlace de equipo',
	'FOOTER_TEAMS_AFTER'				=> 'Píe de página Después de enlace de equipo',
	'QUICK_LINK_MENU_BEFORE'			=> 'Menú enlaces rápidos de arriba',
	'QUICK_LINK_MENU_AFTER'				=> 'Menú enlaces rápidos de abajo',
));
