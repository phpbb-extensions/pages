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
* Tests related to link location ids on page entity
*/
class page_entity_link_location_test extends page_entity_base
{
	/**
	* Test data for the test_link_location() function
	*
	* @return array Array of test data
	* @access public
	*/
	public function link_location_test_data()
	{
		return array(
			// sent to set_link_location(), expected from get_link_location()
			array(1, 1),
			array('1', 1),
			array('', 0),
			array(null, 0),
			array('hello', 0),
		);
	}

	/**
	* Test setting link location
	*
	* @dataProvider link_location_test_data
	* @access public
	*/
	public function test_link_location($id, $expected)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Set the link location
		$result = $entity->set_link_location($id);

		// Assert the returned value is what we expect
		$this->assertInstanceOf('\phpbb\pages\entity\page', $result);

		// Assert that the order matches what's expected
		$this->assertSame($expected, $entity->get_link_location($id));
	}

	/**
	* Test data for the test_link_location_fails() function
	*
	* @return array Array of test data
	* @access public
	*/
	public function link_location_fails_test_data()
	{
		return array(
			array(-1),
			array('-1'),
		);
	}

	/**
	* Test setting invalid data on the link location which should throw an exception
	*
	* @dataProvider link_location_fails_test_data
	* @expectedException \phpbb\pages\exception\base
	* @access public
	*/
	public function test_link_location_fails($id)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Load the entity
		$entity->set_link_location($id);
	}
}
