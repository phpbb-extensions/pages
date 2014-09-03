<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\entity;

/**
* Tests related to routes on page entity
*/
class page_entity_route_test extends page_entity_base
{
	/**
	* Test data for the test_route() function
	*
	* @return array Array of test data
	* @access public
	*/
	public function route_test_data()
	{
		return array(
			// sent to set_route(), expected from get_route()
			array('foo', 'foo'),
			array('foø-bar', 'foø-bar'),
			array('foó-bar', 'foó-bar'),

			// Maximum length
			array(
				str_repeat('a', 100),
				str_repeat('a', 100),
			),
		);
	}

	/**
	* Test setting route
	*
	* @dataProvider route_test_data
	* @access public
	*/
	public function test_route($route, $expected)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Set the route
		$result = $entity->set_route($route);

		// Assert the returned value is what we expect
		$this->assertInstanceOf('\phpbb\pages\entity\page', $result);

		// Assert that the route matches what's expected
		$this->assertSame($expected, $entity->get_route($route));
	}

	/**
	* Test data for the test_route_fails() function
	*
	* @return array Array of test data
	* @access public
	*/
	public function route_fails_test_data()
	{
		return array(
			// Starts with illegal characters
			array('#foo'),
			array(' foo'),

			// Contains illegal characters
			array('foo bar'),
			array('foo?bar'),
			array('foo#bar'),
			array('foo&bar'),
			array('foo$bar'),
			array('foo/bar'),
			array('foo@bar'),
			array('foo=bar'),
			array('foo+bar'),
			array('foo^bar'),
			array('foo*bar'),
			array('foo\'bar'),
			array('foo\\bar'),

			// Only illegal chars or empty
			array(null),
			array(''),
			array('%'),
			array('('),
			array(')'),
			array('['),
			array(']'),
			array('{'),
			array('}'),
			array('!'),
			array('<'),
			array('>'),
			array(','),
			array(';'),
			array('"'),
			array('`'),
			array('~'),
			array('|'),
			array(':'),

			// Exceeds character maximum length
			array(
				str_repeat('a', 101),
			),

			// Route is not unique
			array('page_1'),
		);
	}

	/**
	* Test setting invalid data on the route which should throw an exception
	*
	* @dataProvider route_fails_test_data
	* @expectedException \phpbb\pages\exception\base
	* @access public
	*/
	public function test_route_fails($route)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Load the entity
		$entity->set_route($route);
	}
}
