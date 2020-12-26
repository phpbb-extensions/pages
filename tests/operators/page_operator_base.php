<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\operators;

/**
* Base pages operator test (helper)
*/
class page_operator_base extends \phpbb_database_test_case
{
	/**
	* Define the extensions to be tested
	*
	* @return array vendor/name of extension(s) to test
	*/
	protected static function setup_extensions()
	{
		return array('phpbb/pages');
	}

	/** @var \phpbb_mock_cache */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \PHPUnit_Framework_MockObject_MockObject|\Symfony\Component\DependencyInjection\ContainerInterface */
	protected $container;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb_mock_event_dispatcher */
	protected $dispatcher;

	/** @var \phpbb_mock_extension_manager */
	protected $extension_manager;

	/** @var \phpbb\textformatter\s9e\utils */
	protected $text_formatter_utils;

	/** @var \PHPUnit_Framework_MockObject_MockObject|\phpbb\user */
	protected $user;

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/fixtures/page.xml');
	}

	protected function setUp(): void
	{
		parent::setUp();

		global $config, $phpbb_dispatcher, $phpbb_root_path;

		$this->db = $this->new_dbal();
		$db = $this->db;

		// Global vars called upon during execution
		$config = $this->config = new \phpbb\config\config(array());

		// mock container for the entity service
		$this->container = $this->getMockBuilder('\Symfony\Component\DependencyInjection\ContainerInterface')
			->disableOriginalConstructor()
			->getMock();
		$phpbb_dispatcher = $this->dispatcher = new \phpbb_mock_event_dispatcher();
		$text_formatter_utils = $this->text_formatter_utils = new \phpbb\textformatter\s9e\utils();
		$this->container
			->method('get')
			->with('phpbb.pages.entity')
			->willReturnCallback(function () use ($db, $config, $phpbb_dispatcher, $text_formatter_utils) {
				return new \phpbb\pages\entity\page($db, $config, $phpbb_dispatcher, 'phpbb_pages', $text_formatter_utils);
			})
		;
		$this->cache = new \phpbb_mock_cache();
		$this->user = $this->getMockBuilder('\phpbb\user')
			->disableOriginalConstructor()
			->getMock();
		$this->extension_manager = new \phpbb_mock_extension_manager(
			$phpbb_root_path,
			array(
				'phpbb/pages' => array(
					'ext_name' => 'phpbb/pages',
					'ext_active' => '1',
					'ext_path' => 'ext/phpbb/pages/',
				),
			)
		);
	}

	/**
	* Get the page operator
	*
	* @return \phpbb\pages\operators\page
	*/
	protected function get_page_operator()
	{
		return new \phpbb\pages\operators\page(
			$this->cache,
			$this->container,
			$this->db,
			$this->extension_manager,
			$this->user,
			'phpbb_pages',
			'phpbb_pages_links',
			'phpbb_pages_pages_links'
		);
	}

	/**
	* Get the page entity
	*
	* @return \phpbb\pages\entity\page
	*/
	protected function get_page_entity()
	{
		return new \phpbb\pages\entity\page(
			$this->db,
			$this->config,
			$this->dispatcher,
			'phpbb_pages',
			$this->text_formatter_utils
		);
	}
}
