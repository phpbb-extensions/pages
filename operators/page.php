<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\operators;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
* Operator for a set of pages
*/
class page implements page_interface
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var ContainerInterface */
	protected $container;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\extension\manager */
	protected $extension_manager;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $pages_table;

	/** @var string */
	protected $pages_links_table;

	/** @var string */
	protected $pages_pages_links_table;

	/**
	* Constructor
	*
	* @param \phpbb\cache\driver\driver_interface $cache                    Cache driver interface
	* @param ContainerInterface                   $container                Service container interface
	* @param \phpbb\db\driver\driver_interface    $db                       Database connection
	* @param \phpbb\extension\manager             $extension_manager        Extension manager object
	* @param \phpbb\user                          $user                     User object
	* @param string                               $pages_table              Table name
	* @param string                               $pages_links_table        Table name
	* @param string                               $pages_pages_links_table  Table name
	* @access public
	*/
	public function __construct(\phpbb\cache\driver\driver_interface $cache, ContainerInterface $container, \phpbb\db\driver\driver_interface $db, \phpbb\extension\manager $extension_manager, \phpbb\user $user, $pages_table, $pages_links_table, $pages_pages_links_table)
	{
		$this->cache = $cache;
		$this->container = $container;
		$this->db = $db;
		$this->extension_manager = $extension_manager;
		$this->user = $user;
		$this->pages_table = $pages_table;
		$this->pages_links_table = $pages_links_table;
		$this->pages_pages_links_table = $pages_pages_links_table;
	}

	/**
	* Get all pages
	*
	* @return array Array of page data entities
	* @access public
	*/
	public function get_pages()
	{
		$entities = array();

		// Load all page data from the database
		$sql = 'SELECT *
			FROM ' . $this->pages_table . '
			ORDER BY page_order ASC, page_id ASC';
		$result = $this->db->sql_query($sql);

		while ($row = $this->db->sql_fetchrow($result))
		{
			// Import each page row into an entity
			$entities[] = $this->container->get('phpbb.pages.entity')->import($row);
		}
		$this->db->sql_freeresult($result);

		// Return all page entities
		return $entities;
	}

	/**
	* Add a page
	*
	* @param \phpbb\pages\entity\page_interface $entity Page entity with new data to insert
	* @return \phpbb\pages\entity\page_interface Added page entity
	* @throws \phpbb\pages\exception\out_of_bounds
	* @access public
	*/
	public function add_page($entity)
	{
		// Insert the page data to the database
		$entity->insert();

		// Get the newly inserted page's identifier
		$page_id = $entity->get_id();

		// Reload the data to return a fresh page entity
		return $entity->load($page_id);
	}

	/**
	* Delete a page
	*
	* @param int $page_id The page identifier to delete
	* @return bool True if row was deleted, false otherwise
	* @throws \phpbb\pages\exception\out_of_bounds
	* @access public
	*/
	public function delete_page($page_id)
	{
		// Remove any existing page link data for this page
		// An exception will be thrown if page identifier is invalid
		$this->remove_page_links($page_id);

		// Delete the page from the database
		$sql = 'DELETE FROM ' . $this->pages_table . '
			WHERE page_id = ' . (int) $page_id;
		$this->db->sql_query($sql);

		// Return true/false if a page was deleted
		return (bool) $this->db->sql_affectedrows();
	}

	/**
	* Get page routes (for use in viewonline)
	*
	* @return array Array of routes and page titles for all pages
	* @access public
	*/
	public function get_page_routes()
	{
		$routes = array();

		// Load all page routes and titles
		$sql = 'SELECT page_id, page_route, page_title
			FROM ' . $this->pages_table;
		$result = $this->db->sql_query($sql);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$routes[$row['page_id']] = array(
				'route' => $row['page_route'],
				'title' => $row['page_title'],
			);
		}
		$this->db->sql_freeresult($result);

		// Return an array of all page routes
		return $routes;
	}

	/**
	* Get all custom page link icons (pages_*.gif)
	* Added by the user to the core style/theme/images directories
	*
	* @return array Array of icon image paths
	* @access public
	*/
	public function get_page_icons()
	{
		// For efficiency, found icons are cached
		if (($icons = $this->cache->get('_pages_icons')) === false)
		{
			$icons = $this->find('styles', 'pages_', '.gif');

			$this->cache->put('_pages_icons', $icons);
		}

		return $icons;
	}

	/**
	* Get a custom page link icon (pages_*.gif)
	* Added by the user to the core style/theme/images directories
	*
	* @param string $name The page name (uses the route name)
	* @return string The icon name
	* @access public
	*/
	public function get_page_icon($name)
	{
		static $icons;

		// We only need to load the icons once
		if ($icons === null)
		{
			$icons = $this->get_page_icons();
		}

		$icon = '';
		foreach ($icons as $icon_path => $ext_name)
		{
			if (strpos($icon_path, $this->user->style['style_path'] . '/theme/images/pages_' . $name . '.gif') !== false)
			{
				$icon = 'pages_' . $name . '.gif';
				break;
			}
		}

		return $icon;
	}

	/**
	* Get custom page templates (pages_*.html)
	* Added by the user to the core style/template directores
	*
	* @return array Array of template file paths
	* @access public
	*/
	public function get_page_templates()
	{
		return $this->find('styles', 'pages_', '.html');
	}

	/**
	* Find files
	*
	* @param string $path The path to search in
	* @param string $prefix The prefix to search for
	* @param string $suffix The suffix to search for
	* @return array Array of found file paths
	* @access protected
	*/
	protected function find($path, $prefix, $suffix)
	{
		$finder = $this->extension_manager->get_finder();

		return $finder
			->set_extensions(array('phpbb/pages'))
			->prefix($prefix)
			->suffix($suffix)
			->core_path("$path/")
			->extension_directory("/$path")
			->find()
		;
	}

	/**
	* Get all page link location data for generating page links
	*
	* @param array $page_ids Optional array of page ids
	* @return array Array of page link location data for the specified pages, or all pages
	* @access public
	*/
	public function get_page_links($page_ids = array())
	{
		$sql_array = array(
			'SELECT'		=> 'ppl.*, pl.page_link_location, pl.page_link_event_name, p.page_route, p.page_title, p.page_icon_font, p.page_display, p.page_display_to_guests',
			'FROM'			=> array($this->pages_pages_links_table => 'ppl'),
			'LEFT_JOIN'		=> array(
				array(
					'FROM'	=> array($this->pages_links_table => 'pl'),
					'ON'	=> 'pl.page_link_id = ppl.page_link_id',
				),
				array(
					'FROM'	=> array($this->pages_table => 'p'),
					'ON'	=> 'p.page_id = ppl.page_id',
				),
			),
			'WHERE'			=> (!empty($page_ids)) ? $this->db->sql_in_set('ppl.page_id', $page_ids) : '',
			'ORDER_BY'		=> 'p.page_order ASC, ppl.page_link_id ASC',
		);

		// Cache the SQL query for 1 hour if page_ids is empty
		$cache_ttl = empty($page_ids) ? 3600 : 0;

		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql, $cache_ttl);

		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		return $rows;
	}

	/**
	* Insert page link location data for a page
	*
	* @param int $page_id Page identifier
	* @param array $link_ids Page link location identifiers
	* @return page_interface $this object for chaining calls
	* @throws \phpbb\pages\exception\out_of_bounds
	* @access public
	*/
	public function insert_page_links($page_id, $link_ids)
	{
		// First remove any existing page link data for this page
		$this->remove_page_links($page_id);

		$sql_ary = array();
		foreach ($link_ids as $link_id)
		{
			$sql_ary[] = array(
				'page_id'		=> (int) $page_id,
				'page_link_id'	=> (int) $link_id,
			);
		}

		if (count($sql_ary))
		{
			// Insert the new page link data for this page
			$this->db->sql_multi_insert($this->pages_pages_links_table, $sql_ary);
		}

		return $this;
	}

	/**
	* Remove page link location data for a page
	* This method usually need not be called outside of this class
	*
	* @param int $page_id Page identifier
	* @return page_interface $this object for chaining calls
	* @throws \phpbb\pages\exception\out_of_bounds
	* @access protected
	*/
	protected function remove_page_links($page_id)
	{
		// Throw an exception if page identifier is invalid
		if (!$this->page_id_exists($page_id))
		{
			throw new \phpbb\pages\exception\out_of_bounds('page_id');
		}

		// Delete the page's links from the database
		$sql = 'DELETE FROM ' . $this->pages_pages_links_table . '
			WHERE page_id = ' . (int) $page_id;
		$this->db->sql_query($sql);

		// Destroy cached page links
		$this->cache->destroy('sql', $this->pages_pages_links_table);

		return $this;
	}

	/**
	* Get page link location names and identifiers
	*
	* @return array Array of page link location names and identifiers
	* @access public
	*/
	public function get_link_locations()
	{
		$sql = 'SELECT page_link_id, page_link_location
			FROM ' . $this->pages_links_table . '
			ORDER BY page_link_id ASC';
		$result = $this->db->sql_query($sql);

		$rows = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		return $rows;
	}

	/**
	* Check if a page identifier exists in the database
	*
	* @param int $id Page identifier
	* @return bool $row True if page exists, false otherwise
	* @access protected
	*/
	protected function page_id_exists($id)
	{
		$sql = 'SELECT 1
			FROM ' . $this->pages_table . '
			WHERE page_id = ' . (int) $id;
		$result = $this->db->sql_query_limit($sql, 1);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return (bool) $row;
	}
}
