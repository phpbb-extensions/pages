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
* Base exception
*/
class base extends \Exception
{
	/**
	* Null if the message is a string, array if the message was submitted as an array
	* @var string|array
	*/
	protected $message_full;

	protected $previous;

	/**
	* Constructor
	*
	* Different from normal exceptions in that we do not enforce $message to be a string.
	*
	* @param string|array $message
	* @param int $code
	* @param \Exception $previous
	* @access public
	*/
	public function __construct($message = null, $code = 0, \Exception $previous = null)
	{
		parent::__construct();

		$this->message = $message;

		if (is_array($message))
		{
			$this->message = (string) $message[0];
		}

		// We're slightly changing the way exceptions work
		// Tools, such as xdebug, expect the message to be a string, so to prevent errors
		// with those tools, we store our full message in message_full and only a string in message
		$this->message_full = $message;

		$this->code = $code;
		$this->previous = $previous;
	}

	/**
	* Basic message translation for our exceptions
	*
	* @param \phpbb\language\language $lang
	* @return string
	* @access public
	*/
	public function get_message(\phpbb\language\language $lang)
	{
		// Make sure our language file has been loaded
		$this->add_lang($lang);

		if (is_array($this->message_full))
		{
			return call_user_func_array(array($lang, 'lang'), $this->message_full);
		}

		return $lang->lang($this->message_full);
	}

	/**
	* Translate all portions of the message sent to the exception
	*
	* Goes through each element of the array and tries to translate them
	*
	* @param \phpbb\language\language $lang
	* @param string|array $message_portions The message portions to translate
	* @param string|null $parent_message Send a string to translate all of the
	*     portions with the parent message (typically used to format a string
	*     with the given message portions). Null to ignore. Default: Null
	* @return array|string Array if $parent_message === null else a string
	* @access protected
	*/
	protected function translate_portions(\phpbb\language\language $lang, $message_portions, $parent_message = null)
	{
		// Make sure our language file has been loaded
		$this->add_lang($lang);

		// Ensure we have an array
		if (!is_array($message_portions))
		{
			$message_portions = array($message_portions);
		}

		// Translate each message portion
		foreach ($message_portions as &$message)
		{
			// Attempt to translate each portion
			$translated_message = $lang->lang('EXCEPTION_' . $message);

			// Check if translating did anything
			if ($translated_message !== 'EXCEPTION_' . $message)
			{
				// It did, so replace message with the translated version
				$message = $translated_message;
			}
		}
		// Always unset a variable passed by reference in a foreach loop
		unset($message);

		if ($parent_message !== null)
		{
			// Prepend the parent message to the message portions
			array_unshift($message_portions, (string) $parent_message);

			// We return a string
			return call_user_func_array(array($lang, 'lang'), $message_portions);
		}

		// We return an array
		return $message_portions;
	}

	/**
	* Add our language file
	*
	* @param \phpbb\language\language $lang
	* @return void
	* @access public
	*/
	public function add_lang(\phpbb\language\language $lang)
	{
		static $is_loaded = false;

		// We only need to load the language file once
		if ($is_loaded)
		{
			return;
		}

		// Add our language file
		$lang->add_lang('exceptions', 'phpbb/pages');

		// So the language file is only loaded once
		$is_loaded = true;
	}

	/**
	* Output a string of this error message
	*
	* This will hopefully be never called, always catch the expected exceptions
	* and call get_message to translate them into an error that a user can
	* understand
	*
	* @return string
	* @access public
	*/
	public function __toString()
	{
		return is_array($this->message_full) ? (string) var_export($this->message_full, true) : (string) $this->message_full;
	}
}
