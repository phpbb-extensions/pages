<?php
/**
*
* Pages extension for the phpBB Forum Software package.
* @Traduzido por: http://phpbbportugal.com - segundo as normas do Acordo Ortográfico, null2 and update by eunaumtenhoid (c) 2017 [ver 2.0.2] (https://github.com/phpBBTraducoes)
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
	'ACP_PAGES_MANAGE'					=> 'Gerenciar Páginas',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'A partir desta página, pode adicionar, editar e excluir páginas personalizadas.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Criar páginas',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Usando o formulário abaixo, pode criar uma nova página personalizada para o seu Fórum.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Editar página',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Usando o formulário abaixo, pode modificar uma página personalizada existente no seu Fórum.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Nome',
	'ACP_PAGES_DESCRIPTION'				=> 'Descrição',
	'ACP_PAGES_ROUTE'					=> 'Route',
	'ACP_PAGES_TEMPLATE'				=> 'Template',
	'ACP_PAGES_ORDER'					=> 'Ordem',
	'ACP_PAGES_LINK'					=> 'Link',
	'ACP_PAGES_VIEW'					=> 'Ver página',
	'ACP_PAGES_STATUS'					=> 'Estatuto',
	'ACP_PAGES_PUBLISHED'				=> 'Publicada',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Publicada (apenas membros)',
	'ACP_PAGES_PRIVATE'					=> 'Privada',
	'ACP_PAGES_EMPTY'					=> 'Não há páginas',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Limpar cache',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Limpar cache dos icones das páginas',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'Ao adicionar ícones para as páginas personalizadas, limpe o cache de ícones para vê-los. Crie os ícones usando o padrão <samp>pages_route.gif</samp>, onde <samp>route</samp> é nome do caminho da página, na pasta <samp>phpbb/styles/*/theme/images/</samp>.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Tem certeza que deseja excluir esta página?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'Página excluída com sucesso.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'A página não pode ser excluída.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'Página criada com sucesso.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'Página atualizada com sucesso.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Configurar página',
	'ACP_PAGES_OPTIONS'					=> 'Opções da página',
	'ACP_PAGES_FORM_TITLE'				=> 'Título da página',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Este campo é obrigatório.',
	'ACP_PAGES_FORM_DESC'				=> 'Descrição da página',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Apenas será exibido na lista de páginas no ACP.',
	'ACP_PAGES_FORM_ROUTE'				=> 'Caminho da URL da página',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> '<strong>route</strong> é um identificador exclusivo, usado no final da URL de uma página, para definir o link para a página, por exemplo, <samp>http://www.phpbb.com/<strong>route</strong></samp>. Apenas letras, números, hífens e sublinhados são permitidos. Este campo é obrigatório.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Conteúdo da página',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Na criação do conteúdo pode usar BBCodes phpBB, smilies e urls mágicos ou pode ativar o modo HTML. No modo HTML, os BBCodes, smilies e urls mágicos não funcionam, mas pode usar qualquer sintaxe HTML válida. Atente que este conteúdo será mostrado no Template HTML existente, pelo que não deve incluir DOCTYPE, HTML, BODY ou tags HEAD. No entanto podem ser usadas todas as outras tags de formatação HTML, incluindo IFRAME, SCRIPT, STYLE, EMBED, VIDEO, etc.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Modelos de página',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Modelos de páginas personalizadas com nomes <samp>pages_*.html</samp> podem ser adicionadas à pasta phpBB’s <samp>styles/*/template</samp>.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Selecione um modelo',
	'ACP_PAGES_FORM_ORDER'				=> 'Ordem das páginas',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'As páginas serão ordenadas de acordo com esta ordem, que pode ajudar a organizar a ordem em que os links aparecem. Os números mais baixos tem precedência sobre os números mais altos.',
	'ACP_PAGES_FORM_LINKS'				=> 'Localizações do link da página',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Selecione um ou mais locais onde serão visíveis links para esta página. Use CTRL+CLICK (ou CMD+CLICK no Mac) para selecionar/desselecionar mais do que um item.',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Link do ícone da página',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Digite o nome de um ícone de <strong><a href="%s" target="_blank">Font Awesome</a></strong> para usar com o link da página. Deixe este campo em branco para usar ícones de imagem CSS/GIF tradicionais das páginas.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Mostrar página',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Se definido como Não, a página não será visível. (Nota: Administradores podem acessar a página, o que lhes permite pré-visualizá-la enquanto estão desenvolvendo-a.)',
	'ACP_PAGES_FORM_GUESTS'				=> 'Mostrar página aos visitantes',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Se definido como Não, apenas utilizadores registados poderão acessar a página.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Link da página',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Display page title first',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'By default browsers will display this page’s title after the site name <samp style="white-space: nowrap">“Site Name - Page Title”</samp>. Enabling this option will display this page’s title before the site name <samp style="white-space: nowrap">“Page Title - Site Name”</samp>.',
	'PARSE_HTML'						=> 'Modo HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Antes dos Links Nav Bar',
	'NAV_BAR_LINKS_AFTER'				=> 'Depois dos Links Nav Bar',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Antes dos Breadcrumbs Nav Bar',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Depois dos Breadcrumbs Nav Bar',
	'FOOTER_TIMEZONE_BEFORE'			=> 'No Rodapé antes da Time Zone',
	'FOOTER_TIMEZONE_AFTER'				=> 'No Rodapé depois da Time Zone',
	'FOOTER_TEAMS_BEFORE'				=> 'No Rodapé antes da Team Link',
	'FOOTER_TEAMS_AFTER'				=> 'No Rodapé depois da Team Link',
	'QUICK_LINK_MENU_BEFORE'			=> 'Nos Links rápidos, no inicio',
	'QUICK_LINK_MENU_AFTER'				=> 'Nos Links rápidos, no final',
));
