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
* Tests related to descriptions on page entity
*/
class page_entity_description_test extends page_entity_base
{
	/**
	* Test data for the test_description() function
	*
	* @return array Array of test data
	*/
	public function description_test_data()
	{
		return array(
			// sent to set_description(), expected from get_description()
			array('hello world', 'hello world'),
			array(1, '1'),
			array(null, ''),

			// Maximum length
			array(
				str_repeat('a', 255),
				str_repeat('a', 255),
			),
		);
	}

	/**
	* Test setting description
	*
	* @dataProvider description_test_data
	*/
	public function test_description($description, $expected)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Set the description
		$result = $entity->set_description($description);

		// Assert the returned value is what we expect
		self::assertInstanceOf('\phpbb\pages\entity\page', $result);

		// Assert that the description matches what's expected
		self::assertSame($expected, $entity->get_description());
	}

	/**
	* Test data for the test_description_fails() function
	*
	* @return array Array of test data
	*/
	public function description_fails_test_data()
	{
		return array(
			// description

			// One character more than maximum length
			array(
				str_repeat('a', 256),
			),
		);
	}

	/**
	* Test setting invalid data on the description which should throw an exception
	*
	* @dataProvider description_fails_test_data
	*/
	public function test_description_fails($description)
	{
		$this->expectException(\phpbb\pages\exception\base::class);

		// Setup the entity class
		$entity = $this->get_page_entity();

		// Load the entity
		$entity->set_description($description);
	}
}
