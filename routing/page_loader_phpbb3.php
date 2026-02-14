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

use InvalidArgumentException;
use phpbb\db\driver\driver_interface;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;

/**
 * phpBB 3 and Symfony 3 through 6 adapter for page loader.
 */
class page_loader_phpbb3 extends Loader
{
	/** @var page_loader_core */
	protected $core;

	/**
	 * Constructor for the page_loader_phpbb3 class.
	 *
	 * @param driver_interface $db The database driver instance.
	 * @param string $pages_table The name of the pages table in the database.
	 */
	public function __construct(driver_interface $db, string $pages_table)
	{
		$this->core = new page_loader_core($db, $pages_table);
	}

	/**
	 * Loads routes from the database.
	 *
	 * @param mixed $resource The resource to load routes from.
	 * @param string|null $type The type of the resource, or null if not specified.
	 * @return RouteCollection The collection of loaded routes.
	 */
	public function load($resource, $type = null)
	{
		if (!is_string($type) && $type !== null)
		{
			throw new InvalidArgumentException('Type must be string or null');
		}
		return $this->core->load_routes();
	}

	/**
	 * Determines if the given resource is supported based on its type.
	 *
	 * @param mixed $resource The resource to be checked.
	 * @param string|null $type The type of the resource, or null for default processing.
	 * @return bool True if the resource type is supported, false otherwise.
	 */
	public function supports($resource, $type = null): bool
	{
		return $this->core->supports_type($type);
	}
}
