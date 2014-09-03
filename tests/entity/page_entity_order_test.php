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
* Tests related to sort order on page entity
*/
class page_entity_order_test extends page_entity_base
{
	/**
	* Test data for the test_page_order() function
	*
	* @return array Array of test data
	* @access public
	*/
	public function page_order_test_data()
	{
		return array(
			// sent to set_order(), expected from get_order()
			array(1, 1),
			array('1', 1),
			array('', 0),
			array(null, 0),
			array('hello', 0),
		);
	}

	/**
	* Test setting page order
	*
	* @dataProvider page_order_test_data
	* @access public
	*/
	public function test_page_order($order, $expected)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Set the order
		$result = $entity->set_order($order);

		// Assert the returned value is what we expect
		$this->assertInstanceOf('\phpbb\pages\entity\page', $result);

		// Assert that the order matches what's expected
		$this->assertSame($expected, $entity->get_order($order));
	}

	/**
	* Test data for the test_order_fails() function
	*
	* @return array Array of test data
	* @access public
	*/
	public function order_fails_test_data()
	{
		return array(
			array(-1),
			array('-1'),
		);
	}

	/**
	* Test setting invalid data on the order which should throw an exception
	*
	* @dataProvider order_fails_test_data
	* @expectedException \phpbb\pages\exception\base
	* @access public
	*/
	public function test_order_fails($order)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Load the entity
		$entity->set_order($order);
	}
}
