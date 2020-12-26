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

class page_operator_insert_page_links_test extends page_operator_base
{
	/**
	* Test data for the test_add_page_links() function
	*
	* @return array Array of test data
	*/
	public function insert_page_links_test_data()
	{
		return array(
			// page_id, page_link_ids
			array(1, array(1, 2)),
			array(2, array(2)),
			array(3, array()), // no data to insert
		);
	}

	/**
	* Test inserting page links
	*
	* @dataProvider insert_page_links_test_data
	*/
	public function test_insert_page_links($page_id, $data)
	{
		// Setup the operator class
		$operator = $this->get_page_operator();

		// Add the page links
		$operator->insert_page_links($page_id, $data);

		// Now get the page link data as an array
		$page_links = $operator->get_page_links($page_id);

		$page_link_ids = array();
		foreach ($page_links as $page_link)
		{
			$page_link_ids[] = $page_link['page_link_id'];
		}

		// Assert the page link data was inserted
		self::assertEquals($data, $page_link_ids);
	}

	/**
	* Test data for the test_insert_page_links_fails() function
	*
	* @return array Array of test data
	*/
	public function insert_page_links_fails_test_data()
	{
		return array(
			// page_id, page_link_ids
			array('', array(1, 2)),
			array(100, array(1, 2)),
			array(null, array(1, 2)),
		);
	}

	/**
	* Test inserting page links fails
	*
	* @dataProvider insert_page_links_fails_test_data
	*/
	public function test_insert_page_links_fails($page_id, $data)
	{
		$this->expectException(\phpbb\pages\exception\base::class);

		// Setup the operator class
		$operator = $this->get_page_operator();

		// Add the page links
		$operator->insert_page_links($page_id, $data);
	}
}
