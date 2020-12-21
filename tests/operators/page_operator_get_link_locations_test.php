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

class page_operator_get_link_locations_test extends page_operator_base
{
	/**
	* Test data for the test_get_link_locations() function
	*
	* @return array Array of test routes
	*/
	public function get_link_locations_test_data()
	{
		return array(
			array(
				array(
					array(
						'page_link_id' => 1,
						'page_link_location' => 'NAV_BAR_LINKS_BEFORE'
					),
					array(
						'page_link_id' => 2,
						'page_link_location' => 'NAV_BAR_LINKS_AFTER'
					),
				),
			),
		);
	}

	/**
	* Test getting link locations from the database
	*
	* @dataProvider get_link_locations_test_data
	*/
	public function test_get_link_locations($expected)
	{
		// Setup the operator class
		$operator = $this->get_page_operator();

		// Grab the route data as an array
		$link_locations = $operator->get_link_locations();

		self::assertEquals($expected, $link_locations);
	}
}
