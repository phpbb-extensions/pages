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
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;

/**
 * phpBB 4 and Symfony 7 adapter for page loader.
 */
class page_loader_phpbb4 extends Loader
{
	/** @var page_loader_core */
	protected page_loader_core $core;

	/**
	 * Constructor for the page_loader_phpbb4 class.
	 *
	 * @param driver_interface $db The database driver instance.
	 * @param string $pages_table The name of the pages table in the database.
	 */
	public function __construct(driver_interface $db, string $pages_table)
	{
		$this->core = new page_loader_core($db, $pages_table);
		parent::__construct();
	}

	/**
	 * Loads a set of routes from a specified resource.
	 *
	 * @param mixed $resource The resource to load routes from.
	 * @param string|null $type The type of the resource, or null if not specified.
	 * @return RouteCollection The collection of loaded routes.
	 */
	public function load(mixed $resource, string|null $type = null): RouteCollection
	{
		return $this->core->load_routes();
	}

	/**
	 * Checks if the loader supports the specified resource and type.
	 *
	 * @param mixed $resource The resource to check support for.
	 * @param string|null $type The type of the resource, or null if not specified.
	 * @return bool True if the loader supports the resource and type, false otherwise.
	 */
	public function supports(mixed $resource, string|null $type = null): bool
	{
		return $this->core->supports_type($type);
	}
}
