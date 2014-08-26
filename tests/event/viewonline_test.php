<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\event;

class viewonline_test extends event_listener_base
{
	/**
	* Data set for test_viewonline_page
	*
	* @return array Array of test data
	* @access public
	*/
	public function viewonline_page_data()
	{
		global $phpEx;

		return array(
			// test when on_page is index
			array(
				array(
					1 => 'index',
				),
				array(),
				'$location_url',
				'$location',
				'$location_url',
				'$location',
			),
			// test when on_page is app and session_page is NOT for pages
			array(
				array(
					1 => 'app',
				),
				array(
					'session_page' => 'app.' . $phpEx . '/foobar'
				),
				'$location_url',
				'$location',
				'$location_url',
				'$location',
			),
			// test when on_page is app and session_page is for pages
			array(
				array(
					1 => 'app',
				),
				array(
					'session_page' => 'app.' . $phpEx . '/page/test'
				),
				'$location_url',
				'$location',
				'app.' . $phpEx . '/page/test',
				'PAGES_VIEWONLINE',
			),
			// test when on_page is app and session_page is for non-existent pages
			array(
				array(
					1 => 'app',
				),
				array(
					'session_page' => 'app.' . $phpEx . '/page/foobar'
				),
				'$location_url',
				'$location',
				'$location_url',
				'$location',
			),
		);
	}

	/**
	* Test the viewonline_page event
	*
	* @dataProvider viewonline_page_data
	* @access public
	*/
	public function test_viewonline_page($on_page, $row, $location_url, $location, $expected_location_url, $expected_location)
	{
		$listener = $this->get_listener();

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.viewonline_overwrite_location', array($listener, 'viewonline_page'));

		$event_data = array('on_page', 'row', 'location_url', 'location');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.viewonline_overwrite_location', $event);

		$event_data_after = $event->get_data_filtered($event_data);
		foreach ($event_data as $expected)
		{
			$this->assertArrayHasKey($expected, $event_data_after);
		}
		extract($event_data_after);

		$this->assertEquals($expected_location_url, $location_url);
		$this->assertEquals($expected_location, $location);
	}
}
