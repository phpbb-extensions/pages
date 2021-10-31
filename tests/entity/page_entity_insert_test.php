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
* Tests related to insert on page entity
*/
class page_entity_insert_test extends page_entity_base
{
	/**
	* Test inserting new page data
	*/
	public function test_insert()
	{
		// This is needed to set up the s9e text formatter services
		// This can lead to a test failure if PCRE is old.
		$this->get_test_case_helpers()->set_s9e_services();

		$data = array(
			'page_id'							=> 5,
			'page_order'						=> 0,
			'page_route'						=> 'inserted-route',
			'page_title'						=> 'inserted-title',
			'page_description'					=> 'inserted-description',
			'page_description_display'			=> 1,
			'page_content'						=> 'inserted-content',
			'page_content_allow_html'			=> 0,
			'page_display'						=> 1,
			'page_display_to_guests'			=> 0,
			'page_title_switch'					=> 0,
			'page_icon_font'					=> 'inserted-icon'
		);

		// Setup the entity class
		$entity = $this->get_page_entity();

		// Insert a table row
		$result = $entity
			->set_route($data['page_route'])
			->set_title($data['page_title'])
			->set_description($data['page_description'])
			->set_description_display($data['page_description_display'])
			->set_content($data['page_content'])
			->set_order($data['page_order'])
			->set_page_display($data['page_display'])
			->set_page_display_to_guests($data['page_display_to_guests'])
			->set_page_title_switch($data['page_title_switch'])
			->set_icon_font($data['page_icon_font'])
			->insert()
		;

		// Assert the returned value is what we expect
		self::assertInstanceOf('\phpbb\pages\entity\page', $result);

		// Assert that the new page_id was created
		self::assertEquals($data['page_id'], $result->get_id());

		// Reload the inserted data from the db
		$result = $entity->load($result->get_id());

		// Assert the returned value is what we expect
		self::assertInstanceOf('\phpbb\pages\entity\page', $result);

		// Map the fields to the getters
		$map = array(
			'page_id'					=> 'get_id',
			'page_order' 				=> 'get_order',
			'page_route'				=> 'get_route',
			'page_title'				=> 'get_title',
			'page_description'			=> 'get_description',
			'page_description_display'	=> 'get_description_display',
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
	* Try inserting a page that already exists into the database
	* Entities with an existing page_id will fail to insert
	*/
	public function test_insert_fails()
	{
		$this->expectException(\phpbb\pages\exception\out_of_bounds::class);

		// Load some import test data
		$import_data = $this->get_import_data();

		// Setup the entity class
		$entity = $this->get_page_entity();

		// Import an existing page entity
		$entity->import($import_data[1]);

		// Try to insert the existing page entity
		$entity->insert();
	}
}
