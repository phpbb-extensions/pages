<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2015 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\routing;

use phpbb\db\driver\driver_interface;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Loads routes defined in Page's database.
 */
class page_loader extends Loader
{
	/** @var driver_interface */
	protected $db;

	/** @var string */
	protected $pages_table;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface    $db          Database connection
	 * @param string                               $pages_table Table name
	 * @access public
	 */
	public function __construct(driver_interface $db, $pages_table)
	{
		$this->db          = $db;
		$this->pages_table = $pages_table;
	}

	/**
	 * Loads routes defined in Page's database.
	 *
	 * @param string      $resource Resource (not used, but required by parent interface)
	 * @param string|null $type     The resource type
	 *
	 * @return RouteCollection A RouteCollection instance
	 *
	 * @api
	 */
	public function load($resource, $type = null)
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
		$this->db->sql_freeresult();

		return $collection;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @api
	 */
	public function supports($resource, $type = null)
	{
		return $type === 'phpbb_pages_route';
	}
}
