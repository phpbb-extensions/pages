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
	* @param object $entity Page entity with new data to insert
	* @return page_interface Added page entity
	* @access public
	*/
	public function add_page($entity);

	/**
	* Delete a page
	*
	* @param int $page_id The page identifier to delete
	* @return bool True if row was deleted, false otherwise
	* @access public
	*/
	public function delete_page($page_id);

	/**
	* Get a page routes (for use in viewonline)
	*
	* @return array Array of routes and page titles for all pages
	* @access public
	*/
	public function get_page_routes();

	/**
	* Get all page link location data for generating page links
	*
	* @param array Optional array of page ids
	* @return array Array of page link location data for the specified pages, or all pages
	* @access public
	*/
	public function get_page_links($page_ids = array());

	/**
	* Insert page link location data for a page
	*
	* @param int Page identifier
	* @param array Page link location identifiers
	* @return bool True if data was added, false otherwise
	* @access public
	* @todo
	*/
	public function insert_page_links($page_id, $link_ids);

	/**
	* Remove page link location data for a page
	*
	* @param int Page identifier
	* @param array Page link location identifiers
	* @return bool True if data was removed, false otherwise
	* @access public
	* @todo
	*/
	public function remove_page_links($page_id, $link_ids);
}
