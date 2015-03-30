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

class page_operator_delete_page_test extends page_operator_base
{
	/**
	* Test data for the test_delete_page() function
	*
	* @return array Array of test data
	*/
	public function delete_page_test_data()
	{
		return array(
			array(1),
			array(2),
			array(3),
			array(4),
		);
	}

	/**
	* Test deleting pages
	*
	* @dataProvider delete_page_test_data
	*/
	public function test_delete_page($page_id)
	{
		// Setup the operator class
		$operator = $this->get_page_operator();

		$result = $operator->delete_page($page_id);

		// Assert the delete operation returned true
		$this->assertTrue($result);

		// Try to load the deleted page
		try
		{
			// Setup the entity class
			$entity = new \phpbb\pages\entity\page($this->db, $this->config, $this->dispatcher, 'phpbb_pages');

			$deleted = $entity->load($page_id);
		}
		catch (\phpbb\pages\exception\base $e)
		{
			// Page was not found/deleted
			$deleted = true;
		}

		$this->assertTrue($deleted);
	}

	/**
	* Test data for the test_delete_page_fails() function
	*
	* @return array Array of test data
	*/
	public function delete_page_fails_data()
	{
		return array(
			array(''),
			array(10),
			array(null),
		);
	}

	/**
	* Test deleting non-existent pages which should throw an exception
	*
	* @dataProvider delete_page_fails_data
	* @expectedException \phpbb\pages\exception\base
	*/
	public function test_delete_page_fails($page_id)
	{
		// Setup the operator class
		$operator = $this->get_page_operator();

		$operator->delete_page($page_id);
	}
}
