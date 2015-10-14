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

class page_operator_get_page_routes_test extends page_operator_base
{
	/**
	* Test data for the test_get_routes() function
	*
	* @return array Array of test routes
	*/
	public function get_routes_test_data()
	{
		return array(
			array(
				array(
					1 => array('route' => 'page_1', 'title' => 'title_1'),
					2 => array('route' => 'page_2', 'title' => 'title_2'),
					3 => array('route' => 'page_3', 'title' => 'title_3'),
					4 => array('route' => 'page_4', 'title' => 'title_4'),
				),
			),
		);
	}

	/**
	* Test getting page routes from the database
	*
	* @dataProvider get_routes_test_data
	*/
	public function test_get_routes($expected)
	{
		// Setup the operator class
		$operator = $this->get_page_operator();

		// Grab the route data as an array
		$routes = $operator->get_page_routes();

		$this->assertEquals($expected, $routes);
	}
}
