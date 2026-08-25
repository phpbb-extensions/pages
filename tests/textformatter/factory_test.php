<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\tests\textformatter;

class factory_data_access extends \phpbb\textformatter\data_access
{
	/** @var string */
	private $template;

	public function __construct($template)
	{
		$this->template = $template;
	}

	public function get_bbcodes()
	{
		return array();
	}

	public function get_smilies()
	{
		return array();
	}

	public function get_censored_words()
	{
		return array();
	}

	public function get_styles_templates()
	{
		return array(
			1 => array(
				'template' => $this->template,
				'bbcodes' => array('quote', 'b', 'i', 'url', 'img', 'size', 'color', 'u', 'code', 'list', '*', 'email', 'flash', 'attachment'),
			),
		);
	}
}

class factory_test extends \phpbb_test_case
{
	public function test_configurator_enables_litedown()
	{
		global $config, $phpbb_root_path, $request, $symfony_request, $user;

		$config = new \phpbb\config\config(array(
			'allowed_schemes_links' => 'http,https',
			'cookie_secure' => false,
			'force_server_vars' => true,
			'script_path' => '/phpbb',
			'server_name' => 'localhost',
			'server_port' => 80,
			'server_protocol' => 'http://',
		));
		$request = new \phpbb_mock_request();
		$symfony_request = new \phpbb\symfony_request($request);
		$user = new \phpbb_mock_user();

		$data_access = new factory_data_access(
			file_get_contents($phpbb_root_path . 'styles/prosilver/template/bbcode.html')
		);
		$factory = new \phpbb\pages\textformatter\factory(
			$data_access,
			new \phpbb_mock_cache(),
			new \phpbb_mock_event_dispatcher(),
			$config,
			new \phpbb\textformatter\s9e\link_helper(),
			new \phpbb\log\dummy(),
			__DIR__ . '/../../../../../../../tests/tmp/',
			'_pages_test_parser',
			'_pages_test_renderer'
		);

		$configurator = $factory->get_configurator();

		self::assertTrue(isset($configurator->Litedown));
	}
}
