<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\operators;

class page_routing_loader_test extends \phpbb_database_test_case
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

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\pages\routing\page_loader */
	protected $loader;

	/** @var \Symfony\Component\Routing\RouteCollection */
	protected $collection;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/page.xml');
	}

	public function setUp()
	{
		parent::setUp();

		$this->db = $this->new_dbal();

		// Instantiate the pages route loader
		$this->loader = new \phpbb\pages\routing\page_loader($this->db, 'phpbb_pages');

		// Get a collection of pages' routes
		$this->collection = $this->get_pages_route_collection();
	}

	/**
	 * Get the route collection from the page_loader
	 *
	 * @return \Symfony\Component\Routing\RouteCollection
	 */
	public function get_pages_route_collection()
	{
		$collection = $this->loader->load('phpbb_pages_new_controller', 'pages_extension');

		// Assert the collection is an instance of RouteCollection
		$this->assertInstanceOf('Symfony\Component\Routing\RouteCollection', $collection, 'A route collection instance could not be made.');

		return $collection;
	}

	/**
	 * Data set for test_page_loader
	 *
	 * @return array
	 */
	public function page_loader_data()
	{
		return array(
			array(1, '/page_1'),
			array(2, '/page_2'),
			array(3, '/page_3'),
			array(4, '/page_4'),
		);
	}

	/**
	 * @dataProvider page_loader_data
	 *
	 * @param int    $id       Id of a Page
	 * @param string $expected Expected route of a Page
	 */
	public function test_page_loader($id, $expected)
	{
		// Get a route instance
		$route = $this->collection->get('phpbb_pages_dynamic_route_' . $id);

		// Assert the roue is an instance of Route
		$this->assertInstanceOf('Symfony\Component\Routing\Route', $route, 'A route instance could not be made.');

		// Assert the route contains the expected path
		$this->assertSame($expected, $route->getPath());
	}
}
