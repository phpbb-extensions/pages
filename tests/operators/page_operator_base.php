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
	static protected function setup_extensions()
	{
		return array('phpbb/pages');
	}

	protected $container, $db, $extension_manager;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/page.xml');
	}

	public function setUp()
	{
		parent::setUp();

		global $phpbb_dispatcher, $phpbb_root_path;

		$this->db = $this->new_dbal();
		$db = $this->db;

		// mock container for the entity service
		$this->container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
		$phpbb_dispatcher = $this->dispatcher = new \phpbb_mock_event_dispatcher();
		$this->cache = new \phpbb_mock_cache();
		$this->container->expects($this->any())
			->method('get')
			->with('phpbb.pages.entity')
			->will($this->returnCallback(function() use ($db, $phpbb_dispatcher) {
				return new \phpbb\pages\entity\page($db, $phpbb_dispatcher, 'phpbb_pages');
			}))
		;
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
		return new \phpbb\pages\operators\page($this->cache, $this->container, $this->db, $this->extension_manager, 'phpbb_pages', 'phpbb_pages_links', 'phpbb_pages_pages_links');
	}
}
