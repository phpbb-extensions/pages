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

class show_page_links_test extends \phpbb_database_test_case
{
	/**
	* Define the extensions to be tested
	*
	* @return array vendor/name of extension(s) to test
	*/
	protected static function setup_extensions()
	{
		return array('phpbb/pages');
	}

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/fixtures/page.xml');
	}

	/**
	* Test data for the test_show_page_links() function
	*
	* @return array Array of test data
	*/
	public function show_page_links_data()
	{
		return array(
			'guest' => array(ANONYMOUS, false, false, false, array(1, 2)),
			'bot' => array(99, false, true, false, array(1, 2)),
			'member' => array(2, true, false, false, array(1, 2, 4)),
			'admin' => array(2, true, false, true, array(1, 2, 3, 4)),
		);
	}

	/**
	* Test the show_page_links event
	*
	* @dataProvider show_page_links_data
	*/
	public function test_show_page_links($user_id, $is_registered, $is_bot, $is_admin, array $expected_pages)
	{
		global $phpbb_root_path, $phpEx;

		$db = $this->new_dbal();

		// Load/Mock classes required by the event listener class
		$auth = $this->getMockBuilder('\phpbb\auth\auth')
			->disableOriginalConstructor()
			->getMock();
		$auth->method('acl_get')
			->with('a_')
			->willReturn($is_admin);
		$cache = new \phpbb_mock_cache();
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$lang = new \phpbb\language\language($lang_loader);
		$user = new \phpbb\user($lang, '\phpbb\datetime');
		$user->data['user_id'] = $user_id;
		$user->data['is_registered'] = $is_registered;
		$user->data['is_bot'] = $is_bot;
		$ext_manager = new \phpbb_mock_extension_manager($phpbb_root_path);
		$controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$controller_helper->expects(self::exactly(count($expected_pages)))
			->method('route')
			->willReturnCallback(function ($route, array $params = array()) {
				return $route . '#' . serialize($params);
			});
		$phpbb_container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerInterface')
			->disableOriginalConstructor()
			->getMock();
		$router = $this->getMockBuilder('\phpbb\routing\router')
			->disableOriginalConstructor()
			->getMock();

		// Set up the listener
		$listener = new \phpbb\pages\event\listener(
			$auth,
			$controller_helper,
			$lang,
			new \phpbb\pages\operators\page(
				$cache,
				$phpbb_container,
				$db,
				$ext_manager,
				$user,
				'phpbb_pages',
				'phpbb_pages_links',
				'phpbb_pages_pages_links'
			),
			$router,
			$template,
			$user,
			$phpEx
		);

		$page_data = array(
			1 => array('overall_header_navigation_prepend_links', array(
				'U_LINK_URL' => 'phpbb_pages_dynamic_route_1#a:0:{}',
				'LINK_ROUTE' => 'page_1',
				'LINK_TITLE' => 'title_1',
				'LINK_DESC'  => '',
				'ICON_FONT'  => 'icon-1',
				'ICON_LINK'  => '',
			)),
			2 => array('overall_header_navigation_append_links', array(
				'U_LINK_URL' => 'phpbb_pages_dynamic_route_2#a:0:{}',
				'LINK_ROUTE' => 'page_2',
				'LINK_TITLE' => 'title_2',
				'LINK_DESC'  => 'description_2',
				'ICON_FONT'  => '',
				'ICON_LINK'  => '',
			)),
			3 => array('overall_header_navigation_append_links', array(
				'U_LINK_URL' => 'phpbb_pages_dynamic_route_3#a:0:{}',
				'LINK_ROUTE' => 'page_3',
				'LINK_TITLE' => 'title_3',
				'LINK_DESC'  => '',
				'ICON_FONT'  => '',
				'ICON_LINK'  => '',
			)),
			4 => array('overall_header_navigation_append_links', array(
				'U_LINK_URL' => 'phpbb_pages_dynamic_route_4#a:0:{}',
				'LINK_ROUTE' => 'page_4',
				'LINK_TITLE' => 'title_4',
				'LINK_DESC'  => '',
				'ICON_FONT'  => '',
				'ICON_LINK'  => '',
			)),
		);

		$block_vars = array();
		$template_vars = array();
		foreach ($expected_pages as $page_id)
		{
			$block_vars[] = $page_data[$page_id];
			$template_vars[] = array('S_' . strtoupper(substr($page_data[$page_id][0], 0, -6)), true);
		}

		// Test the template values
		$template->expects(self::exactly(count($expected_pages)))
			->method('assign_block_vars')
			->withConsecutive(...$block_vars);
		$template->expects(self::exactly(count($expected_pages)))
			->method('assign_var')
			->withConsecutive(...$template_vars);

		$dispatcher = new \phpbb\event\dispatcher();
		$dispatcher->addListener('core.page_header', array($listener, 'show_page_links'));
		$dispatcher->trigger_event('core.page_header');
	}
}
