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
	protected $auth;
	protected $container;
	protected $controller_helper;
	protected $template;
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

	/**
	* Test data for the test_display() function
	*
	* @return array Array of test data
	*/
	public function display_data()
	{
		return array(
			array(200, 'pages_default.html'),
		);
	}

	/**
	* Test controller display
	*
	* @dataProvider display_data
	*/
	public function test_display($status_code, $page_content)
	{
		global $cache, $config, $phpbb_extension_manager, $phpbb_dispatcher, $user, $phpbb_root_path;

		// Load/Mock classes required by the controller class
		$db = $this->new_dbal();
		$config = new \phpbb\config\config(array());
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$this->auth = $this->getMock('\phpbb\auth\auth');

		$this->container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
		$this->container->expects($this->any())
			->method('get')
			->with('phpbb.pages.entity')
			->will($this->returnCallback(function() use ($db, $config, $phpbb_dispatcher) {
				return new \phpbb\pages\entity\page($db, $config, $phpbb_dispatcher, 'phpbb_pages');
			}))
		;

		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock()
		;

		$this->user = new \phpbb\user('\phpbb\datetime');

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
		$user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));
		$phpbb_extension_manager = new \phpbb_mock_extension_manager($phpbb_root_path);

		$controller = new \phpbb\pages\controller\main_controller(
			$this->auth,
			$this->container,
			$this->controller_helper,
			$this->template,
			$this->user
		);

		$response = $controller->display('page_1');
		$this->assertInstanceOf('\Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertEquals($page_content, $response->getContent());
	}
}
