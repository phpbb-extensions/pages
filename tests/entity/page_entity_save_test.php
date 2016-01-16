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
* Tests related to save on page entity
*/
class page_entity_save_test extends page_entity_base
{
	/**
	* Test data for the test_save() function
	*
	* @return array Array of test data
	*/
	public function save_test_data()
	{
		return array(
			array(
				1,
				array(
					'page_id' => 1,
					'page_route' => 'new_route_1',
					'page_title' => 'new_title_1',
				),
			),
			array(
				2,
				array(
					'page_id' => 2,
					'page_route' => 'new_route_2',
					'page_title' => 'new_title_2',
				),
			),
		);
	}

	/**
	* Test saving data
	*
	* @dataProvider save_test_data
	*/
	public function test_save($id, $expected)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Load the data
		$result = $entity->load($id);

		// Assert the returned value is what we expect
		$this->assertInstanceOf('\phpbb\pages\entity\page', $result);

		// Set some new data
		$entity
			->set_route($expected['page_route'])
			->set_title($expected['page_title'])
			->save()
		;

		// Re-load the data from the database
		$result = $entity->load($id);

		// Assert expected matches actual
		$this->assertEquals($expected['page_id'], $result->get_id());
		$this->assertEquals($expected['page_route'], $result->get_route());
		$this->assertEquals($expected['page_title'], $result->get_title());
	}

	/**
	* Test saving to (non-existant) pages from the database
	*
	* @expectedException \phpbb\pages\exception\out_of_bounds
	*/
	public function test_save_fails()
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Save the entity with no rule ID set
		$entity->save();
	}
}
