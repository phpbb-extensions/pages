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
	public function test_configurator_enables_markdown_plugins()
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
		self::assertTrue(isset($configurator->PipeTables));
	}

	public function test_markdown_headers_have_litedown_ids()
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
			sys_get_temp_dir() . '/',
			'_pages_test_parser',
			'_pages_test_renderer'
		);

		$objects = $factory->get_configurator()->finalize();
		$xml = $objects['parser']->parse(
			"# Basic usage\n\n"
			. "## Global options (work on every command)\n\n"
			. "## cache — cache management\n\n"
			. "## Quick-reference table"
		);
		$html = $objects['renderer']->render($xml);

		self::assertStringContainsString('<h1 id="basic-usage">Basic usage</h1>', $html);
		self::assertStringContainsString('<h2 id="global-options-work-on-every-command">Global options (work on every command)</h2>', $html);
		self::assertStringContainsString('<h2 id="cache-cache-management">cache — cache management</h2>', $html);
		self::assertStringContainsString('<h2 id="quick-reference-table">Quick-reference table</h2>', $html);
	}

	public function test_markdown_pipe_tables_are_rendered()
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
			sys_get_temp_dir() . '/',
			'_pages_table_test_parser',
			'_pages_table_test_renderer'
		);

		$objects = $factory->get_configurator()->finalize();
		$xml = $objects['parser']->parse(
			"| Option | Meaning |\n"
			. "|---|---|\n"
			. "| `--safe-mode` | Boot without extensions |"
		);
		$html = $objects['renderer']->render($xml);

		self::assertStringContainsString('<table>', $html);
		self::assertStringContainsString('<th>Option</th>', $html);
		self::assertStringContainsString('<td><code>--safe-mode</code></td>', $html);
		self::assertStringContainsString('<td>Boot without extensions</td>', $html);
	}
}
