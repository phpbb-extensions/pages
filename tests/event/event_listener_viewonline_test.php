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

class event_listener_viewonline_test extends event_listener_base
{
	/**
	* Get an instance of \phpbb\language\language
	*/
	public function get_language_instance()
	{
		global $phpbb_root_path, $phpEx;

		// Get instance of \phpbb\language\language (dataProvider is called before setUp(), so this must be done here)
		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$lang_loader->set_extension_manager(new \phpbb_mock_extension_manager($phpbb_root_path));
		$this->lang = new \phpbb\language\language($lang_loader);
		$this->lang->add_lang('pages_common', 'phpbb/pages');
	}

	protected function setUp(): void
	{
		parent::setUp();

		$this->get_language_instance();
	}

	/**
	* Data set for test_viewonline_page
	*
	* @return array Array of test data
	*/
	public function viewonline_page_data()
	{
		global $phpEx;

		$this->get_language_instance();

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
					'session_page' => 'app.' . $phpEx . '/help/faq'
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
					'session_page' => 'app.' . $phpEx . '/test'
				),
				'$location_url',
				'$location',
				'phpbb_pages_dynamic_route_1#a:0:{}',
				$this->lang->lang('PAGES_VIEWONLINE', '$location'),
			),
			// test when on_page is app and session_page is for non-existent pages
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
		);
	}

	/**
	* Test the viewonline_page event
	*
	* @dataProvider viewonline_page_data
	*/
	public function test_viewonline_page($on_page, $row, $location_url, $location, $expected_location_url, $expected_location)
	{
		$this->page_operator->expects(self::atMost(1))
			->method('get_page_routes')
			->willReturn(array(
				1 => array('route' => 'test', 'title' => $location)
			));

		$this->controller_helper->expects(self::atMost(1))
			->method('route')
			->willReturnCallback(function ($route, array $params = array()) {
				return $route . '#' . serialize($params);
			});

		$listener = $this->get_listener();

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.viewonline_overwrite_location', array($listener, 'viewonline_page'));

		$event_data = array('on_page', 'row', 'location_url', 'location');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.viewonline_overwrite_location', $event);

		$event_data_after = $event->get_data_filtered($event_data);
		foreach ($event_data as $expected)
		{
			self::assertArrayHasKey($expected, $event_data_after);
		}
		extract($event_data_after);

		self::assertEquals($expected_location_url, $location_url);
		self::assertEquals($expected_location, $location);
	}
}
