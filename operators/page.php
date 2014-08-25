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

use Symfony\Component\DependencyInjection\Container;

/**
* Operator for a set of pages
*/
class page implements page_interface
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var Container */
	protected $phpbb_container;

	/** @var string */
	protected $table_name;

	/**
	* Constructor
	*
	* @param \phpbb\db\driver\driver_interface $db Database connection
	* @param Container $phpbb_container
	* @param string $table_name Table name
	* @return \phpbb\pages\operators\page
	* @access public
	*/
	public function __construct(\phpbb\db\driver\driver_interface $db, Container $phpbb_container, $table_name)
	{
		$this->db = $db;
		$this->phpbb_container = $phpbb_container;
		$this->table_name = $table_name;
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
			FROM ' . $this->table_name . '
			ORDER BY page_order ASC';
		$result = $this->db->sql_query($sql);

		while ($row = $this->db->sql_fetchrow($result))
		{
			// Import each page row into an entity
			$entities[] = $this->phpbb_container->get('phpbb.pages.entity')->import($row);
		}
		$this->db->sql_freeresult($result);

		// Return all page entities
		return $entities;
	}

	/**
	* Add a page
	*
	* @param object $entity Rule entity with new data to insert
	* @return page_interface Added page entity
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
	* @access public
	*/
	public function delete_page($page_id)
	{
		// Cast page identifier as integer
		$page_id = (int) $page_id;

		// Return false if something went wrong with page identifier
		if (!$page_id)
		{
			return false;
		}

		// Delete the page from the database
		$sql = 'DELETE FROM ' . $this->table_name . "
			WHERE page_id = $page_id";
		$this->db->sql_query($sql);

		// Reurn true/false if a page was deleted
		return (bool) $this->db->sql_affectedrows();
	}

	/**
	* Get a page routes (for use in viewonline)
	*
	* @return array Array of routes and page titles for all pages
	* @access public
	*/
	public function get_page_routes()
	{
		$routes = array();

		// Load all page routes and titles
		$sql = 'SELECT page_route, page_title
			FROM ' . $this->table_name;
		$result = $this->db->sql_query($sql);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$routes[$row['page_route']] = $row['page_title'];
		}
		$this->db->sql_freeresult($result);

		// Return an array of all page routes
		return $routes;
	}
}
