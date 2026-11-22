<?php

namespace phpbb\pages\controller;

class admin_test_state
{
	public static $valid_form = true;
	public static $confirm = true;
	public static $form_keys = array();
	public static $confirmations = array();
	public static $custom_bbcodes_displayed = 0;

	public static function reset()
	{
		self::$valid_form = true;
		self::$confirm = true;
		self::$form_keys = array();
		self::$confirmations = array();
		self::$custom_bbcodes_displayed = 0;
	}
}

function add_form_key($name)
{
	admin_test_state::$form_keys[] = $name;
}

function check_form_key($name, $max_time = 0)
{
	return admin_test_state::$valid_form;
}

function adm_back_link($url)
{
	return '|back:' . $url;
}

function display_custom_bbcodes()
{
	admin_test_state::$custom_bbcodes_displayed++;
}

namespace phpbb\pages\acp;

function confirm_box($check, $title = '', $hidden = '')
{
	if ($check)
	{
		return \phpbb\pages\controller\admin_test_state::$confirm;
	}

	\phpbb\pages\controller\admin_test_state::$confirmations[] = array(
		'title' => $title,
		'hidden' => $hidden,
	);

	return false;
}

function build_hidden_fields(array $fields)
{
	return http_build_query($fields, '', '&');
}

namespace phpbb\pages\tests\controller;

class json_response_test_double
{
	private const DATA_KEY = 'phpbb_test_json_response_data';

	public static function reset()
	{
		$GLOBALS[self::DATA_KEY] = null;
	}

	public static function get_data()
	{
		return $GLOBALS[self::DATA_KEY] ?? null;
	}

	public function send($data, $exit = true)
	{
		$GLOBALS[self::DATA_KEY] = $data;
	}
}

if (!class_exists(\phpbb\json_response::class, false))
{
	//noinspection PhpIgnoredClassAliasDeclaration
	class_alias(json_response_test_double::class, \phpbb\json_response::class);
}
