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
* This describes all the methods we'll have for working with a set of pages
*/
interface page_interface
{
	/**
	 * Create an empty page entity.
	 *
	 * @return \phpbb\pages\entity\page_interface
	 */
	public function create_page();

	/**
	 * Get one page by identifier or route.
	 *
	 * @param int $id Page identifier
	 * @param string $route Page route
	 * @return \phpbb\pages\entity\page_interface
	 * @throws \phpbb\pages\exception\base If the page is missing or stored data is invalid
	 */
	public function get_page($id = 0, $route = '');

	/**
	 * Get all pages
	 *
	 * @param int $limit
	 * @param int $start
	 * @return array Array of page data entities
	 * @throws \phpbb\pages\exception\base If stored page data is invalid
	 * @access public
	 */
	public function get_pages($limit = 0, $start = 0);

	/**
	* Add a page
	*
	* @param \phpbb\pages\entity\page_interface $entity Page entity with new data to insert
	* @return \phpbb\pages\entity\page_interface Added page entity
	* @throws \phpbb\pages\exception\base If the entity already exists or stored data is invalid
	* @access public
	*/
	public function add_page($entity);

	/**
	 * Persist changes to an existing page.
	 *
	 * @param \phpbb\pages\entity\page_interface $entity Page entity
	 * @return \phpbb\pages\entity\page_interface Persisted page entity
	 * @throws \phpbb\pages\exception\base If the entity is new, missing, or stored data is invalid
	 */
	public function save_page($entity);

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
	* Get page routes (for use in view online)
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
	* Added by the user to the core style/template directories
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

	/**
	 * Get the total number of pages
	 *
	 * @return int
	 * @access public
	 */
	public function get_total_pages();
}
