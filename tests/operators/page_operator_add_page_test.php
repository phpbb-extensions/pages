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
	*
	* @access public
	*/
	public function test_add_page()
	{
		// Setup the entity class
		$entity = new \phpbb\pages\entity\page($this->db, 'phpbb_pages');

		// Fill the entity with basic data
		$entity
			->content_disable_bbcode()
			->content_disable_magic_url()
			->content_disable_smilies()
			->content_disable_html()
			->set_title('title_added')
			->set_route('route_added')
			->set_description('description_added')
			->set_content('message_added')
			->set_order(5)
			->set_page_display(1)
			->set_page_display_to_guests(1)
		;

		// Setup the operator class
		$operator = $this->get_page_operator();

		// Add the page
		$result = $operator->add_page($entity);

		// Assert the page was added
		$this->assertEquals(5, $result->get_id());
		$this->assertEquals('route_added', $result->get_route());
	}

	/**
	* Test adding a page fails
	*
	* @expectedException \phpbb\pages\exception\base
	* @access public
	*/
	public function test_add_page_fails()
	{
		// Setup the entity class
		$entity = new \phpbb\pages\entity\page($this->db, $this->dispatcher, 'phpbb_pages');

		// Load an existing page data
		$entity->load(1);

		// Setup the operator class
		$operator = $this->get_page_operator();

		// Attempt to add the existing the page data
		$result = $operator->add_page($entity);
	}
}
