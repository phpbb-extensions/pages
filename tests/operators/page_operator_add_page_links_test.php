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

class page_operator_add_page_links_test extends page_operator_base
{
	/**
	* Test data for the test_add_page_links() function
	*
	* @return array Array of test data
	* @access public
	*/
	public function add_page_links_test_data()
	{
		return array(
			array(1, array(1, 2), true),
			array(2, array(2), true),
			array(3, array(), false), // no data to add
		);
	}

	/**
	* Test adding page links
	*
	* @dataProvider add_page_links_test_data
	* @access public
	*/
	public function test_add_page_links($page_id, $link_ids, $expected)
	{
		// Setup the operator class
		$operator = $this->get_page_operator();

		// Add the page links
		$result = $operator->insert_page_links($page_id, $link_ids);

		// Assert the page link data was added
		$this->assertEquals($expected, $result);
	}

	/**
	* Test data for the test_add_page_links_fails() function
	*
	* @return array Array of test data
	* @access public
	*/
	public function add_page_links_fails_test_data()
	{
		return array(
			array('', array(1, 2)),
			array(100, array(1, 2)),
			array(null, array(1, 2)),
		);
	}

	/**
	* Test adding page links fails
	*
	* @dataProvider add_page_links_fails_test_data
	* @expectedException \phpbb\pages\exception\base
	* @access public
	*/
	public function test_add_page_links_fails($page_id, $link_ids)
	{
		// Setup the operator class
		$operator = $this->get_page_operator();

		// Add the page links
		$operator->insert_page_links($page_id, $link_ids);
	}
}
