<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\event;

class add_permissions_test extends event_listener_base
{
	/**
	 * Data set for test_add_permissions
	 *
	 * @return array
	 */
	public function add_permissions_test_data()
	{
		return array(
			array(
				array(),
				array(
					'a_pages' => array('lang' => 'ACL_A_PAGES', 'cat' => 'misc'),
				),
			),
			array(
				array(
					'a_foo' => array('lang' => 'ACL_A_FOO', 'cat' => 'misc'),
				),
				array(
					'a_foo' => array('lang' => 'ACL_A_FOO', 'cat' => 'misc'),
					'a_pages' => array('lang' => 'ACL_A_PAGES', 'cat' => 'misc'),
				),
			),
		);
	}

	/**
	 * Test the add_permissions event
	 *
	 * @dataProvider add_permissions_test_data
	 */
	public function test_add_permissions($data, $expected)
	{
		$data = new \phpbb\event\data(array(
			'permissions'	=> $data
		));

		$listener = $this->get_listener();

		$listener->add_permission($data);

		$this->assertSame($data['permissions'], $expected);
	}
}
