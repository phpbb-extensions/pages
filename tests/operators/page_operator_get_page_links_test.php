<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\operators;

class page_operator_get_page_links_test extends page_operator_base
{
	/**
	* Test data for the test_get_page_links() function
	*
	* @return array Array of test routes
	*/
	public function get_page_links_test_data()
	{
		return array(
			array(
				1, // Get links for page id 1
				array(
					array(
						'page_id' => 1,
						'page_link_id' => 1,
						'page_link_location' => 'NAV_BAR_LINKS_BEFORE',
						'page_link_event_name' => 'overall_header_navigation_prepend',
						'page_route' => 'page_1',
						'page_title' => 'title_1',
						'page_icon_font' => 'foo-1',
						'page_display' => 1,
						'page_display_to_guests' => 1,
					),
					array(
						'page_id' => 1,
						'page_link_id' => 2,
						'page_link_location' => 'NAV_BAR_LINKS_AFTER',
						'page_link_event_name' => 'overall_header_navigation_append',
						'page_route' => 'page_1',
						'page_title' => 'title_1',
						'page_icon_font' => 'foo-1',
						'page_display' => 1,
						'page_display_to_guests' => 1,
					),
				),
			),
			array(
				2, // Get links for page id 2
				array(
					array(
						'page_id' => 2,
						'page_link_id' => 1,
						'page_link_location' => 'NAV_BAR_LINKS_BEFORE',
						'page_link_event_name' => 'overall_header_navigation_prepend',
						'page_route' => 'page_2',
						'page_title' => 'title_2',
						'page_icon_font' => '',
						'page_display' => 1,
						'page_display_to_guests' => 1,
					),
				),
			),
			array(
				array(), // Get all links
				array(
					array(
						'page_id' => 1,
						'page_link_id' => 1,
						'page_link_location' => 'NAV_BAR_LINKS_BEFORE',
						'page_link_event_name' => 'overall_header_navigation_prepend',
						'page_route' => 'page_1',
						'page_title' => 'title_1',
						'page_icon_font' => 'foo-1',
						'page_display' => 1,
						'page_display_to_guests' => 1,
					),
					array(
						'page_id' => 1,
						'page_link_id' => 2,
						'page_link_location' => 'NAV_BAR_LINKS_AFTER',
						'page_link_event_name' => 'overall_header_navigation_append',
						'page_route' => 'page_1',
						'page_title' => 'title_1',
						'page_icon_font' => 'foo-1',
						'page_display' => 1,
						'page_display_to_guests' => 1,
					),
					array(
						'page_id' => 2,
						'page_link_id' => 1,
						'page_link_location' => 'NAV_BAR_LINKS_BEFORE',
						'page_link_event_name' => 'overall_header_navigation_prepend',
						'page_route' => 'page_2',
						'page_title' => 'title_2',
						'page_icon_font' => '',
						'page_display' => 1,
						'page_display_to_guests' => 1,
					),
				),
			),
		);
	}

	/**
	* Test getting page links from the database
	*
	* @dataProvider get_page_links_test_data
	*/
	public function test_get_page_links($page_ids, $expected)
	{
		// Setup the operator class
		$operator = $this->get_page_operator();

		// Grab the page link data as an array
		$result = $operator->get_page_links($page_ids);

		$this->assertEquals($expected, $result);
	}

	/**
	* Test data for the test_get_page_links_fails() function
	*
	* @return array Array of test data
	*/
	public function get_page_links_fails_test_data()
	{
		return array(
			array(100, array()),
		);
	}

	/**
	* Test getting non-existent page links from the database
	*
	* @dataProvider get_page_links_fails_test_data
	*/
	public function test_get_page_links_fails($page_ids, $expected)
	{
		// Setup the operator class
		$operator = $this->get_page_operator();

		// Grab the page link data as an array
		$result = $operator->get_page_links($page_ids);

		$this->assertEquals($expected, $result);
	}
}
