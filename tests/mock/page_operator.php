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

	public function get_page_links($page_ids = array())
	{
		return array(
			array(
				'page_id' => 1,
				'page_link_id' => 1,
				'page_link_location' => 'Nav Bar Links Before',
				'page_link_event_name' => 'overall_header_navigation_prepend',
				'page_route' => 'page_1',
				'page_title' => 'title_1',
				'page_display' => 1,
				'page_display_to_guests' => 1,
			),
			array(
				'page_id' => 2,
				'page_link_id' => 2,
				'page_link_location' => 'Nav Bar Links After',
				'page_link_event_name' => 'overall_header_navigation_append',
				'page_route' => 'page_2',
				'page_title' => 'title_2',
				'page_display' => 1,
				'page_display_to_guests' => 1,
			),
		);
	}

	public function insert_page_links($page_id, $link_ids)
	{
	}
}
