<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2025 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\routing;

class page_loader_core_test extends \phpbb_database_test_case
{
	protected static function setup_extensions()
	{
		return array('phpbb/pages');
	}

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\pages\routing\page_loader_core */
	protected $loader;

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/../operators/fixtures/page.xml');
	}

	protected function setUp(): void
	{
		parent::setUp();
		$this->db = $this->new_dbal();
		$this->loader = new \phpbb\pages\routing\page_loader_core($this->db, 'phpbb_pages');
	}

	public function test_load_routes_returns_collection()
	{
		$collection = $this->loader->load_routes();
		self::assertInstanceOf('Symfony\Component\Routing\RouteCollection', $collection);
	}

	public static function route_data()
	{
		return array(
			array(1, '/page_1'),
			array(2, '/page_2'),
			array(3, '/page_3'),
			array(4, '/page_4'),
		);
	}

	/**
	 * @dataProvider route_data
	 */
	public function test_routes_have_correct_paths($id, $expected)
	{
		$collection = $this->loader->load_routes();
		$route = $collection->get('phpbb_pages_dynamic_route_' . $id);
		self::assertInstanceOf('Symfony\Component\Routing\Route', $route);
		self::assertSame($expected, $route->getPath());
	}

	public function test_supports_type()
	{
		self::assertTrue($this->loader->supports_type('phpbb_pages_route'));
		self::assertFalse($this->loader->supports_type('other_type'));
		self::assertFalse($this->loader->supports_type(null));
	}
}
