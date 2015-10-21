<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\exception;

/**
* InvalidArgument exception
*/
class invalid_argument extends base
{
	/**
	* Translate this exception
	*
	* @param \phpbb\language\language $lang
	* @return string
	* @access public
	*/
	public function get_message(\phpbb\language\language $lang)
	{
		return $this->translate_portions($lang, $this->message_full, 'EXCEPTION_INVALID_ARGUMENT');
	}
}
