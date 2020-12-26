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
* Tests related to load on page entity
*/
class page_entity_load_test extends page_entity_base
{
	/**
	* Test data for the test_load() function
	*
	* @return array Array of test data
	*/
	public function load_test_data()
	{
		return array(
			// id to search, data which should match
			array(
				1, '',
				array(
					'page_id' => 1,
					'page_order' => 1,
					'page_route' => 'page_1',
					'page_title' => 'title_1',
					'page_description' => 'description_1',
					'page_content' => 'message_1',
					'page_display' => 1,
					'page_display_to_guests' => 1,
					'page_title_switch' => 0,
					'page_icon_font' => 'foo',
				),
			),
			array(
				2, '',
				array(
					'page_id' => 2,
					'page_order' => 2,
					'page_route' => 'page_2',
					'page_title' => 'title_2',
					'page_description' => 'description_2',
					'page_content' => 'message_2',
					'page_display' => 1,
					'page_display_to_guests' => 1,
					'page_title_switch' => 0,
					'page_icon_font' => '',
				),
			),
			array(
				0, 'page_3',
				array(
					'page_id' => 3,
					'page_order' => 1,
					'page_route' => 'page_3',
					'page_title' => 'title_3',
					'page_description' => 'description_3',
					'page_content' => 'message_3',
					'page_display' => 1,
					'page_display_to_guests' => 0,
					'page_title_switch' => 0,
					'page_icon_font' => '',
				),
			),
			array(
				0, 'page_4',
				array(
					'page_id' => 4,
					'page_order' => 2,
					'page_route' => 'page_4',
					'page_title' => 'title_4',
					'page_description' => 'description_4',
					'page_content' => 'message_4',
					'page_display' => 0,
					'page_display_to_guests' => 0,
					'page_title_switch' => 0,
					'page_icon_font' => '',
				),
			),
		);
	}

	/**
	* Test loading page data from the database
	*
	* @dataProvider load_test_data
	*/
	public function test_load($id, $route, $data)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Set the data
		$result = $entity->load($id, $route);

		// Assert the returned value is what we expect
		self::assertInstanceOf('\phpbb\pages\entity\page', $result);

		// Map the fields to the getters
		$map = array(
			'page_id'					=> 'get_id',
			'page_order' 				=> 'get_order',
			'page_description'			=> 'get_description',
			'page_route'				=> 'get_route',
			'page_title'				=> 'get_title',
			'page_content'				=> 'get_content_for_edit',
			'page_display'				=> 'get_page_display',
			'page_display_to_guests'	=> 'get_page_display_to_guests',
			'page_title_switch'			=> 'get_page_title_switch',
			'page_icon_font'			=> 'get_icon_font',
		);

		// Go through each field in the data and make sure the function returns
		// what we saved
		foreach ($map as $field => $function)
		{
			self::assertEquals($data[$field], $entity->$function());
		}
	}

	/**
	* Test data for the test_load_fails() function
	*
	* @return array Array of test data
	*/
	public function load_fails_test_data()
	{
		return array(
			// id to search
			array(0),
			array(100),
		);
	}

	/**
	* Test loading (non-existant) pages from the database
	*
	* @dataProvider load_fails_test_data
	*/
	public function test_load_fails($id)
	{
		$this->expectException(\phpbb\pages\exception\out_of_bounds::class);

		// Setup the entity class
		$entity = $this->get_page_entity();

		// Load the entity
		$entity->load($id);
	}
}
