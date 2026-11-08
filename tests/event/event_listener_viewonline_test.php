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
			// test when the front controller has the phpBB 4 name
			array(
				array(
					1 => 'index',
				),
				array(
					'session_page' => 'index.' . $phpEx . '/test'
				),
				'$location_url',
				'$location',
				'phpbb_pages_dynamic_route_1#a:0:{}',
				$this->lang->lang('PAGES_VIEWONLINE', '$location'),
			),
			// test without relying on a particular front-controller name
			array(
				array(
					1 => 'front',
				),
				array(
					'session_page' => 'front.' . $phpEx . '/test?foo=bar'
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
		$this->controller_helper->expects(self::atMost(1))
			->method('route')
			->willReturnCallback(function ($route, array $params = array()) {
				return $route . '#' . serialize($params);
			});

		$listener = $this->get_listener();

		$dispatcher = new \phpbb\event\dispatcher();
		$dispatcher->addListener('core.viewonline_overwrite_location', array($listener, 'viewonline_page'));

		$event_data = array('on_page', 'row', 'location_url', 'location');
		$event_data_after = $dispatcher->trigger_event('core.viewonline_overwrite_location', compact($event_data));
		extract($event_data_after, EXTR_OVERWRITE);

		self::assertEquals($expected_location_url, $location_url);
		self::assertEquals($expected_location, $location);
	}

	/**
	* Data set for test_viewonline_page_visibility
	*
	* @return array Array of test data
	*/
	public function viewonline_page_visibility_data()
	{
		return array(
			'public page is visible to guest' => array(false, false, 1, 1, true),
			'guest-restricted page is hidden from guest' => array(false, false, 1, 0, false),
			'guest-restricted page is visible to registered user' => array(true, false, 1, 0, true),
			'unpublished page is hidden from registered user' => array(true, false, 0, 1, false),
			'unpublished page is hidden from admin' => array(true, true, 0, 1, false),
		);
	}

	/**
	* Test page visibility is enforced for viewonline locations
	*
	* @dataProvider viewonline_page_visibility_data
	*/
	public function test_viewonline_page_visibility($is_registered, $is_admin, $page_display, $page_display_to_guests, $is_visible)
	{
		$this->user->data['is_registered'] = $is_registered;
		$this->auth->method('acl_get')->with('a_')->willReturn($is_admin);
		$route = $this->route_collection->get('phpbb_pages_dynamic_route_1');
		$route->setDefault('_pages_title', 'Secret page title');
		$route->setDefault('_pages_display', (bool) $page_display);
		$route->setDefault('_pages_display_to_guests', (bool) $page_display_to_guests);
		$this->controller_helper->method('route')->willReturn('page-url');

		$event = new \phpbb\event\data(array(
			'row' => array('session_page' => 'app.php/test'),
			'location' => 'Index page',
			'location_url' => 'index.php',
		));

		$this->get_listener()->viewonline_page($event);

		if ($is_visible)
		{
			self::assertSame($this->lang->lang('PAGES_VIEWONLINE', 'Secret page title'), $event['location']);
			self::assertSame('page-url', $event['location_url']);
		}
		else
		{
			self::assertSame('Index page', $event['location']);
			self::assertSame('index.php', $event['location_url']);
		}
	}

	public function test_viewonline_page_ignores_invalid_session_url()
	{
		$event = new \phpbb\event\data(array(
			'row' => array('session_page' => 'http://['),
			'location' => 'unchanged',
			'location_url' => 'unchanged',
		));

		$this->get_listener()->viewonline_page($event);

		self::assertSame('unchanged', $event['location']);
	}

	public function test_viewonline_page_ignores_route_missing_metadata()
	{
		$this->route_collection->get('phpbb_pages_dynamic_route_1')->setDefaults(array());
		$event = new \phpbb\event\data(array(
			'row' => array('session_page' => 'app.php/test'),
			'location' => 'unchanged',
			'location_url' => 'unchanged',
		));

		$this->get_listener()->viewonline_page($event);

		self::assertSame('unchanged', $event['location']);
	}

	public function test_viewonline_page_decodes_title_entities()
	{
		$this->route_collection->get('phpbb_pages_dynamic_route_1')
			->setDefault('_pages_title', 'Caf&#233;');
		$this->controller_helper->method('route')->willReturn('page-url');
		$event = new \phpbb\event\data(array(
			'row' => array('session_page' => 'app.php/test'),
			'location' => 'Index page',
			'location_url' => 'index.php',
		));

		$this->get_listener()->viewonline_page($event);

		self::assertSame($this->lang->lang('PAGES_VIEWONLINE', 'Café'), $event['location']);
	}

	public function test_viewonline_page_uses_route_metadata_for_repeated_entries()
	{
		$route = $this->route_collection->get('phpbb_pages_dynamic_route_1');
		$route->setDefault('_pages_title', 'Test page');
		$this->controller_helper->method('route')->willReturn('page-url');

		$listener = $this->get_listener();
		foreach (array(1, 2) as $unused)
		{
			$event = new \phpbb\event\data(array(
				'row' => array('session_page' => 'app.php/test'),
				'location' => 'Index page',
				'location_url' => 'index.php',
			));

			$listener->viewonline_page($event);

			self::assertSame($this->lang->lang('PAGES_VIEWONLINE', 'Test page'), $event['location']);
			self::assertSame('page-url', $event['location_url']);
		}
	}
}
