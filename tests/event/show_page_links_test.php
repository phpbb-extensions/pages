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
	* Test the show_page_links event
	*/
	public function test_show_page_links()
	{
		global $phpbb_root_path, $phpEx;

		$db = $this->new_dbal();

		// Load/Mock classes required by the event listener class
		$auth = $this->getMockBuilder('\phpbb\auth\auth')
			->disableOriginalConstructor()
			->getMock();
		$cache = new \phpbb_mock_cache();
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$lang = new \phpbb\language\language($lang_loader);
		$user = new \phpbb\user($lang, '\phpbb\datetime');
		$user->data['user_id'] = ANONYMOUS;
		$ext_manager = new \phpbb_mock_extension_manager($phpbb_root_path);
		$controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$controller_helper->expects(self::exactly(2))
			->method('route')
			->willReturnCallback(function ($route, array $params = array()) {
				return $route . '#' . serialize($params);
			});
		$phpbb_container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerInterface')
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
			$template,
			$user,
			$phpEx
		);

		// Test the template values
		$template->expects(self::exactly(2))
			->method('assign_block_vars')
			->withConsecutive(
				array('overall_header_navigation_prepend_links', array(
					'U_LINK_URL' => 'phpbb_pages_dynamic_route_1#a:0:{}',
					'LINK_ROUTE' => 'page_1',
					'LINK_TITLE' => 'title_1',
					'LINK_DESC'  => '',
					'ICON_FONT'  => 'icon-1',
					'ICON_LINK'  => '',
				)),
				array('overall_header_navigation_append_links', array(
					'U_LINK_URL' => 'phpbb_pages_dynamic_route_2#a:0:{}',
					'LINK_ROUTE' => 'page_2',
					'LINK_TITLE' => 'title_2',
					'LINK_DESC'  => '',
					'ICON_FONT'  => '',
					'ICON_LINK'  => '',
				))
			);
		$template->expects(self::exactly(2))
			->method('assign_var')
			->withConsecutive(
				array('S_OVERALL_HEADER_NAVIGATION_PREPEND', true),
				array('S_OVERALL_HEADER_NAVIGATION_APPEND', true)
			);

		$dispatcher = new \phpbb\event\dispatcher();
		$dispatcher->addListener('core.page_header', array($listener, 'show_page_links'));
		$dispatcher->trigger_event('core.page_header');
	}
}
