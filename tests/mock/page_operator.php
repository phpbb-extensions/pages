<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\mock;

/**
* Mock page operator
*/
class page_operator extends \phpbb\pages\operators\page
{
	public function __construct()
	{
	}

	public function get_pages()
	{
	}

	public function add_page($entity)
	{
	}

	public function delete_page($page_id)
	{
	}

	public function get_page_routes()
	{
		return array('test' => 'Test Page');
	}

	public function get_page_icons()
	{
		return array();
	}

	public function get_page_templates()
	{
		return array();
	}

	public function get_page_links($page_ids = array())
	{
		return array();
	}

	public function insert_page_links($page_id, $link_ids)
	{
	}
}
