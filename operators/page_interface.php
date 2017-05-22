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

/**
* Interface for our pages operator
*
* This describes all of the methods we'll have for working with a set of pages
*/
interface page_interface
{
	/**
	* Get all pages
	*
	* @return array Array of page data entities
	* @access public
	*/
	public function get_pages();

	/**
	* Add a page
	*
	* @param \phpbb\pages\entity\page_interface $entity Page entity with new data to insert
	* @return page_interface Added page entity
	* @throws \phpbb\pages\exception\out_of_bounds
	* @access public
	*/
	public function add_page($entity);

	/**
	* Delete a page
	*
	* @param int $page_id The page identifier to delete
	* @return bool True if row was deleted, false otherwise
	* @throws \phpbb\pages\exception\out_of_bounds
	* @access public
	*/
	public function delete_page($page_id);

	/**
	* Get page routes (for use in viewonline)
	*
	* @return array Array of routes and page titles for all pages
	* @access public
	*/
	public function get_page_routes();

	/**
	* Get all custom page link icons (pages_*.gif)
	* Added by the user to the core style/theme/images directories
	*
	* @return array Array of icon image paths
	* @access public
	*/
	public function get_page_icons();

	/**
	* Get a custom page link icon (pages_*.gif)
	* Added by the user to the core style/theme/images directories
	*
	* @param string $name The page name (uses the route name)
	* @return string The icon name
	* @access public
	*/
	public function get_page_icon($name);

	/**
	* Get custom page templates (pages_*.html)
	* Added by the user to the core style/template directores
	*
	* @return array Array of template file paths
	* @access public
	*/
	public function get_page_templates();

	/**
	* Get all page link location data for generating page links
	*
	* @param array $page_ids Optional array of page ids
	* @return array Array of page link location data for the specified pages, or all pages
	* @access public
	*/
	public function get_page_links($page_ids = array());

	/**
	* Insert page link location data for a page
	*
	* @param int $page_id Page identifier
	* @param array $link_ids Page link location identifiers
	* @return page_interface $this object for chaining calls
	* @throws \phpbb\pages\exception\out_of_bounds
	* @access public
	*/
	public function insert_page_links($page_id, $link_ids);

	/**
	* Get page link location names and identifiers
	*
	* @return array Array of page link location names and identifiers
	* @access public
	*/
	public function get_link_locations();
}
