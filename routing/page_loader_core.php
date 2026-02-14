<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2015, 2025 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\routing;

use phpbb\db\driver\driver_interface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Core loader logic for loading routes from the database.
 */
class page_loader_core
{
	/** @var driver_interface */
	protected $db;

	/** @var string */
	protected $pages_table;

	/**
	 * Constructor for the page_loader_core class.
	 *
	 * @param driver_interface $db The database driver instance.
	 * @param string $pages_table The name of the pages table in the database.
	 */
	public function __construct(driver_interface $db, string $pages_table)
	{
		$this->db = $db;
		$this->pages_table = $pages_table;
	}

	/**
	 * Loads routes defined in Page's database.
	 *
	 * @return RouteCollection A RouteCollection instance
	 */
	public function load_routes(): RouteCollection
	{
		$collection = new RouteCollection();

		$sql = 'SELECT page_id, page_route
			FROM ' . $this->pages_table;
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$route = new Route('/' . $row['page_route']);
			$route->setDefault('_controller', 'phpbb.pages.controller:display');
			$route->setDefault('route', $row['page_route']);
			$collection->add('phpbb_pages_dynamic_route_' . $row['page_id'], $route);
		}
		$this->db->sql_freeresult($result);

		return $collection;
	}

	/**
	 * Checks if the loader supports the specified type.
	 *
	 * @param mixed $type The type to check support for.
	 * @return bool True if the type is supported, false otherwise.
	 */
	public function supports_type($type): bool
	{
		return $type === 'phpbb_pages_route';
	}
}
