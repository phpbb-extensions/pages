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

/*
* These are errors which can be triggered by sending invalid data to the
* pages extension API.
*
* These errors will never show to a user unless they are either modifying
* the core pages extension code OR unless they are writing an extension
* which makes calls to this extension.
*
* Translators: Feel free to not translate these language strings
*/
$lang = array_merge($lang, array(
	'EXCEPTION_FIELD_MISSING'		=> 'Campo obbligatorio mancante',
	'EXCEPTION_INVALID_ARGUMENT'	=> 'Argomento non valido specificato per `%1$s`. Motivo: %2$s',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'Il campo `%1$s` ha ricevuto dati oltre i suoi limiti',
	'EXCEPTION_TOO_LONG'			=> 'L´input è più lungo della lunghezza massima.',
	'EXCEPTION_NOT_UNIQUE'			=> 'L´input non era unico.',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'Il campo `%1$s` ha ricevuto dati imprevisti. Motivo: %2$s',
	'EXCEPTION_ILLEGAL_CHARACTERS'	=> 'L´input contiene caratteri non validi.',
));
