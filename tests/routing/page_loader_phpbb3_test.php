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

use Symfony\Component\HttpKernel\Kernel;

class page_loader_phpbb3_test extends \phpbb_database_test_case
{
	protected static function setup_extensions()
	{
		return array('phpbb/pages');
	}

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\pages\routing\page_loader_phpbb3 */
	protected $loader;

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/../operators/fixtures/page.xml');
	}

	protected function setUp(): void
	{
		parent::setUp();

		if (version_compare(Kernel::VERSION, '7.0.0', '>='))
		{
			self::markTestSkipped('phpbb3 adapter tests only run on Symfony 3-6 (phpBB3)');
		}

		$this->db = $this->new_dbal();
		$this->loader = new \phpbb\pages\routing\page_loader_phpbb3($this->db, 'phpbb_pages');
	}

	public function test_load_returns_collection()
	{
		$collection = $this->loader->load('resource', 'phpbb_pages_route');
		self::assertInstanceOf('Symfony\Component\Routing\RouteCollection', $collection);
	}

	public function test_load_with_null_type()
	{
		$collection = $this->loader->load('resource', null);
		self::assertInstanceOf('Symfony\Component\Routing\RouteCollection', $collection);
	}

	public function test_load_throws_on_invalid_type()
	{
		$this->expectException(\InvalidArgumentException::class);
		$this->expectExceptionMessage('Type must be string or null');
		$this->loader->load('resource', 123);
	}

	public function test_supports()
	{
		self::assertTrue($this->loader->supports('resource', 'phpbb_pages_route'));
		self::assertFalse($this->loader->supports('resource', 'other_type'));
	}
}
