<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\controller;

require_once dirname(__FILE__) . '/../../../../../includes/functions.php';
require_once dirname(__FILE__) . '/../../../../../includes/functions_content.php';

class page_main_controller_test extends \phpbb_database_test_case
{
	/** @var \PHPUnit_Framework_MockObject_MockObject|\phpbb\auth\auth */
	protected $auth;

	/** @var \PHPUnit_Framework_MockObject_MockObject|\Symfony\Component\DependencyInjection\ContainerInterface */
	protected $container;

	/** @var \PHPUnit_Framework_MockObject_MockObject|\phpbb\controller\helper */
	protected $controller_helper;

	/** @var \phpbb\language\language */
	protected $lang;

	/** @var \PHPUnit_Framework_MockObject_MockObject|\phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Define the extensions to be tested
	*
	* @return array vendor/name of extension(s) to test
	*/
	static protected function setup_extensions()
	{
		return array('phpbb/pages');
	}

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/../entity/fixtures/page.xml');
	}

	public function setUp()
	{
		parent::setUp();

		global $cache, $config, $phpbb_extension_manager, $phpbb_dispatcher, $user, $phpbb_root_path, $phpEx;

		// Load/Mock classes required by the controller class
		$db = $this->new_dbal();
		$config = new \phpbb\config\config(array());
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$this->auth = $this->getMock('\phpbb\auth\auth');
		$text_formatter_utils = new \phpbb\textformatter\s9e\utils();

		$this->container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
		$this->container->expects($this->any())
			->method('get')
			->with('phpbb.pages.entity')
			->will($this->returnCallback(function() use ($db, $config, $phpbb_dispatcher, $text_formatter_utils) {
				return new \phpbb\pages\entity\page($db, $config, $phpbb_dispatcher, 'phpbb_pages', $text_formatter_utils);
			}))
		;

		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock()
		;

		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$this->lang = new \phpbb\language\language($lang_loader);
		$this->user = new \phpbb\user($this->lang, '\phpbb\datetime');

		$this->controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$this->controller_helper->expects($this->any())
			->method('render')
			->willReturnCallback(function ($template_file, $page_title = '', $status_code = 200, $display_online_list = false) {
				return new \Symfony\Component\HttpFoundation\Response($template_file, $status_code);
			})
		;

		// Global vars called upon during execution
		$cache = new \phpbb_mock_cache();
		$user = $this->getMock('\phpbb\user', array(), array(
			new \phpbb\language\language(new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx)),
			'\phpbb\datetime'
		));
		$phpbb_extension_manager = new \phpbb_mock_extension_manager($phpbb_root_path);
	}

	public function get_controller()
	{
		return  new \phpbb\pages\controller\main_controller(
			$this->auth,
			$this->container,
			$this->controller_helper,
			$this->lang,
			$this->template,
			$this->user
		);
	}

	/**
	* Test data for the test_display() function
	*
	* @return array Array of test data
	*/
	public function display_data()
	{
		return array(
			array('page_1', 200, 'pages_default.html', 2), // normal viewable page by member
		);
	}

	/**
	* Test controller display
	*
	* @dataProvider display_data
	*/
	public function test_display($route, $status_code, $page_content, $user_id)
	{
		$this->user->data['user_id'] = $user_id;

		$controller = $this->get_controller();

		$response = $controller->display($route);
		$this->assertInstanceOf('\Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertEquals($page_content, $response->getContent());
	}

	/**
	 * Test data for the test_display_fails() function
	 *
	 * @return array Array of test data
	 */
	public function display_fails_data()
	{
		return array(
			array('page_4', 404, 'PAGE_NOT_AVAILABLE', 2), // disabled page, member sees page missing message
			array('page_4', 404, 'PAGE_NOT_AVAILABLE', 1), // disabled page, guests sees page missing message
			array('page_foo', 404, 'PAGE_NOT_AVAILABLE', 2), // non-existent page, loads page missing message
		);
	}

	/**
	 * Test controller display throws 404 exceptions
	 *
	 * @dataProvider display_fails_data
	 */
	public function test_display_fails($route, $status_code, $page_content, $user_id)
	{
		$this->user->data['user_id'] = $user_id;

		$controller = $this->get_controller();

		try
		{
			$controller->display($route);
			$this->fail('The expected \phpbb\exception\http_exception was not thrown');
		}
		catch (\phpbb\exception\http_exception $exception)
		{
			$this->assertEquals($status_code, $exception->getStatusCode());
			$this->assertEquals($page_content, $exception->getMessage());
		}
	}
}
