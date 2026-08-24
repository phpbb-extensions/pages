<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\controller;

/**
* Interface for our admin controller
*
* This describes all of the methods we'll use for the admin front-end of this extension
*/
interface admin_interface
{
	/**
	* Display the pages
	*
	* @return void
	* @access public
	*/
	public function display_pages();

	/**
	* Add a page
	*
	* @return void
	* @access public
	*/
	public function add_page();

	/**
	* Edit a page
	*
	* @param int $page_id The page identifier to edit
	* @return void
	* @access public
	*/
	public function edit_page($page_id);

	/**
	* Delete a page
	*
	* @param int $page_id The page identifier to delete
	* @return void
	* @access public
	*/
	public function delete_page($page_id);

	/**
	* Set page url
	*
	* @param string $u_action Custom form action
	* @return void
	* @access public
	*/
	public function set_page_url($u_action);
}
