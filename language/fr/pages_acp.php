<?php
/**
*
* Pages extension for the phpBB Forum Software package.
* French translation by ForumsFaciles (www.forumsfaciles.fr) & Galixte (http://www.galixte.com)
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
	$lang = [];
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
// ’ « » “ ” …
//

$lang = array_merge($lang, [
	// Manage page
	'ACP_PAGES_MANAGE'					=> 'Gestion des Pages',
	'ACP_PAGES_MANAGE_EXPLAIN'			=> 'Depuis cette page vous pouvez ajouter, modifier et supprimer des pages personnalisées.',
	'ACP_PAGES_CREATE_PAGE'				=> 'Créer une page',
	'ACP_PAGES_CREATE_PAGE_EXPLAIN'		=> 'Au moyen du formulaire ci-dessous, vous pouvez ajouter une nouvelle page personnalisée à votre forum.',
	'ACP_PAGES_EDIT_PAGE'				=> 'Modifier une page',
	'ACP_PAGES_EDIT_PAGE_EXPLAIN'		=> 'Au moyen du formulaire ci-dessous, vous pouvez modifier une page personnalisée existante de votre forum.',

	// Display pages list
	'ACP_PAGES_TITLE'					=> 'Titre',
	'ACP_PAGES_DESCRIPTION'				=> 'Description',
	'ACP_PAGES_ROUTE'					=> 'Chemin',
	'ACP_PAGES_TEMPLATE'				=> 'Modèle',
	'ACP_PAGES_ORDER'					=> 'Ordre',
	'ACP_PAGES_LINK'					=> 'Lien',
	'ACP_PAGES_VIEW'					=> 'Voir la page',
	'ACP_PAGES_STATUS'					=> 'Statut',
	'ACP_PAGES_PUBLISHED'				=> 'Publiée',
	'ACP_PAGES_PUBLISHED_NO_GUEST'		=> 'Publiée (membres uniquement)',
	'ACP_PAGES_PRIVATE'					=> 'Privée',
	'ACP_PAGES_EMPTY'					=> 'Aucune page trouvée',

	// Purge icons
	'ACP_PAGES_PURGE_ICONS'				=> 'Purger les icônes',
	'ACP_PAGES_PURGE_ICONS_LABEL'		=> 'Purger le cache des icônes des pages',
	'ACP_PAGES_PURGE_ICONS_EXPLAIN'		=> 'Lors de l’ajout d’icônes aux liens des pages personnalisées, il est nécessaire de purger le cache des icônes pour les voir apparaitre.<br /> Placer les icônes personnalisées nommées, par exemple : <samp>pages_route.gif</samp>, où <samp>route</samp> correspond au chemin de la page, dans les répertoires <samp>./styles/*/theme/images/</samp> de phpBB.',

	// Messages shown to user
	'ACP_PAGES_DELETE_CONFIRM'			=> 'Êtes-vous sûr de vouloir supprimer cette page ?',
	'ACP_PAGES_DELETE_SUCCESS'			=> 'La page a été supprimée avec succès.',
	'ACP_PAGES_DELETE_ERRORED'			=> 'La page n’a pas été supprimée.',
	'ACP_PAGES_ADD_SUCCESS'				=> 'La page a été ajoutée avec succès.',
	'ACP_PAGES_EDIT_SUCCESS'			=> 'La page a été mise à jour avec succès.',

	// Add/edit page
	'ACP_PAGES_SETTINGS'				=> 'Paramètres de la page',
	'ACP_PAGES_OPTIONS'					=> 'Options de la page',
	'ACP_PAGES_FORM_TITLE'				=> 'Titre de la page',
	'ACP_PAGES_FORM_TITLE_EXPLAIN'		=> 'Ce champ est obligatoire.',
	'ACP_PAGES_FORM_DESC'				=> 'Description de la page',
	'ACP_PAGES_FORM_DESC_EXPLAIN'		=> 'Cette description ne sera affichée que dans la rubrique « Gestion des Pages » du PCA.',
	'ACP_PAGES_FORM_DESC_DISPLAY'		=> 'Utiliser comme titre de lien',
	'ACP_PAGES_FORM_ROUTE'				=> 'Route de l’URL de la page',
	'ACP_PAGES_FORM_ROUTE_EXPLAIN'		=> 'Une version simplifiée du nom de la page, utilisée pour construire l’URL de cette dernière. Exemple : <samp>http://www.phpbb.com/<strong>nom-de-la-page</strong></samp>. Seuls sont autorisés les lettres, chiffres, traits d’union et tirets bas. Ce champ est obligatoire.',
	'ACP_PAGES_FORM_CONTENT'			=> 'Contenu de la page',
	'ACP_PAGES_FORM_CONTENT_EXPLAIN'	=> 'Le contenu peut être créé en utilisant les BBCodes, les smileys et les urls magiques de phpBB ou vous pouvez activer le mode HTML. En mode HTML, les BBCodes, les smileys et les urls magiques ne fonctionneront pas, mais vous êtes libre d’utiliser n’importe quelle syntaxe HTML valide. Veuillez noter que ce contenu sera ajouté à un modèle HTML existant, vous ne devez donc pas inclure les balises DOCTYPE, HTML, BODY ou HEAD. Cependant, toutes les autres balises de formatage HTML, y compris IFRAME, SCRIPT, STYLE, EMBED, VIDEO, etc. peuvent être utilisées.',
	'ACP_PAGES_FORM_TEMPLATE'			=> 'Modèle de la page',
	'ACP_PAGES_FORM_TEMPLATE_EXPLAIN'	=> 'Les modèles des pages personnalisées, sont nommés <samp>pages_*.html</samp> et peuvent être ajoutés dans les répertoires <samp>./styles/*/template</samp> de phpBB.',
	'ACP_PAGES_FORM_TEMPLATE_SELECT'	=> 'Sélectionner un modèle',
	'ACP_PAGES_FORM_ORDER'				=> 'Ordre de la page',
	'ACP_PAGES_FORM_ORDER_EXPLAIN'		=> 'Les pages seront triées selon ce champ, permettant ainsi d’organiser l’ordre dans lequel vous souhaitez que leurs liens apparaissent. Les plus petits nombres seront affichés avant les plus grands.',
	'ACP_PAGES_FORM_LINKS'				=> 'Emplacements du lien de la page',
	'ACP_PAGES_FORM_LINKS_EXPLAIN'		=> 'Sélectionne un ou plusieurs emplacements où le lien de cette page apparaitra. Utilisez CTRL+CLICK (ou CMD + CLICK sur Mac) pour (dé)sélectionner plus d’un item.',
	'ACP_PAGES_FORM_ICON_FONT'			=> 'Icône du lien de la page',
	'ACP_PAGES_FORM_ICON_FONT_EXPLAIN'	=> 'Permet de saisir le nom de l’icône provenant de la police de caractères <strong><a href="%s" target="_blank">Font Awesome</a></strong> qui sera utilisée pour le lien de cette page. Laisser ce champ vide pour utiliser l’icône par défaut CSS/GIF.',
	'ACP_PAGES_FORM_DISPLAY'			=> 'Afficher la page',
	'ACP_PAGES_FORM_DISPLAY_EXPLAIN'	=> 'Si défini sur non, la page ne sera pas accessible aux utilisateurs néanmoins les administrateurs y auront accès, leur permettant d’avoir un aperçu pendant la création.',
	'ACP_PAGES_FORM_GUESTS'				=> 'Afficher la page aux invités',
	'ACP_PAGES_FORM_GUESTS_EXPLAIN'		=> 'Si défini sur non, seuls les utilisateurs enregistrés pourront accéder à la page.',
	'ACP_PAGES_FORM_VIEW_PAGE'			=> 'Lien de la page',
	'ACP_PAGES_TITLE_SWITCH'			=> 'Afficher le titre de la page en premier',
	'ACP_PAGES_TITLE_SWITCH_EXPLAIN'	=> 'Par défaut, les navigateurs affichent le titre de cette page après le nom du site <samp style="white-space : nowrap">« Nom du site - Titre de la page »</samp>. En activant cette option, le titre de cette page sera affiché avant le nom du site <samp style="white-space : nowrap">« Titre de la page - Nom du site »</samp>.',
	'PARSE_HTML'						=> 'Analyser le HTML',

	// Page link location names
	'NAV_BAR_LINKS_BEFORE'				=> 'Barre de navigation avant les liens',
	'NAV_BAR_LINKS_AFTER'				=> 'Barre de navigation après les liens',
	'NAV_BAR_CRUMBS_BEFORE'				=> 'Barre de navigation avant le fil d’Ariane',
	'NAV_BAR_CRUMBS_AFTER'				=> 'Barre de navigation après le fil d’Ariane',
	'FOOTER_TIMEZONE_BEFORE'			=> 'Pied de page avant le fuseau horaire',
	'FOOTER_TIMEZONE_AFTER'				=> 'Pied de page après le fuseau horaire',
	'FOOTER_TEAMS_BEFORE'				=> 'Pied de page avant le lien de l’équipe',
	'FOOTER_TEAMS_AFTER'				=> 'Pied de page après le lien de l’équipe',
	'QUICK_LINK_MENU_BEFORE'			=> 'En haut du menu « Accès rapide »',
	'QUICK_LINK_MENU_AFTER'				=> 'En bas du menu « Accès rapide »',
]);
