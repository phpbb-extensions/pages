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
	'EXCEPTION_FIELD_MISSING'		=> 'Campo requerido ausente',
	'EXCEPTION_INVALID_ARGUMENT'	=> 'Argumento no válido para `%1$s`. Razón: %2$s',
	'EXCEPTION_OUT_OF_BOUNDS'		=> 'El campo `%1$s` tiene datos recibidos más allá de sus límites',
	'EXCEPTION_TOO_LONG'			=> 'La entrada era más larga que la longitud máxima.',
	'EXCEPTION_NOT_UNIQUE'			=> 'La entrada no fue única.',
	'EXCEPTION_UNEXPECTED_VALUE'	=> 'El campo `%1$s` ha recibido datos inesperados. Razón: %2$s',
	'EXCEPTION_ILLEGAL_CHARACTERS'	=> 'La entrada contiene caracteres no válidos.',
));
