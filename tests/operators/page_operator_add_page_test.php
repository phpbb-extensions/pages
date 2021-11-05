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

class page_operator_add_page_test extends page_operator_base
{
	/**
	* Test adding a page
	*/
	public function test_add_page()
	{
		// This is needed to set up the s9e text formatter services
		// This can lead to a test failure if PCRE is old.
		$this->get_test_case_helpers()->set_s9e_services();

		// Setup the entity class
		$entity = $this->get_page_entity();

		// Fill the entity with basic data
		$entity
			->content_disable_bbcode()
			->content_disable_magic_url()
			->content_disable_smilies()
			->content_disable_html()
			->set_title('title_added')
			->set_route('route_added')
			->set_description('description_added')
			->set_description_display(0)
			->set_content('message_added')
			->set_order(5)
			->set_page_display(1)
			->set_page_display_to_guests(1)
			->set_page_title_switch(0)
			->set_icon_font('icon-added')
		;

		// Setup the operator class
		$operator = $this->get_page_operator();

		// Add the page
		$result = $operator->add_page($entity);

		// Assert the page was added
		self::assertEquals(5, $result->get_id());
		self::assertEquals('route_added', $result->get_route());
	}

	/**
	* Test adding a page fails
	*/
	public function test_add_page_fails()
	{
		$this->expectException(\phpbb\pages\exception\base::class);

		// Setup the entity class
		$entity = $this->get_page_entity();

		// Load an existing page data
		$entity->load(1);

		// Setup the operator class
		$operator = $this->get_page_operator();

		// Attempt to add the existing the page data
		$operator->add_page($entity);
	}
}
