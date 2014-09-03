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

class page_main_controller_test extends \phpbb_database_test_case
{
	/**
	* Define the extensions to be tested
	*
	* @return array vendor/name of extension(s) to test
	* @access static
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
	* @access public
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
	* @access public
	*/
	public function test_display($status_code, $page_content)
	{
		global $cache, $phpbb_dispatcher, $user;

		// Load/Mock classes required by the controller class
		$db = $this->new_dbal();
		$this->auth = $this->getMock('\phpbb\auth\auth');
		$this->container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
		$this->container->expects($this->any())
			->method('get')
			->with('phpbb.pages.entity')
			->will($this->returnCallback(function() use ($db) {
				return new \phpbb\pages\entity\page($db, 'phpbb_pages');
			}))
		;
		$this->template = new \phpbb\pages\tests\mock\template();
		$this->user = new \phpbb\user('\phpbb\datetime');
		$this->controller_helper = new \phpbb\pages\tests\mock\controller_helper();

		// // Global vars called upon during execution
		$cache = new \phpbb_mock_cache();
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));

		$controller = new \phpbb\pages\controller\main_controller(
			$this->auth,
			$this->controller_helper,
			$this->container,
			$this->template,
			$this->user
		);

		$response = $controller->display('page_1');
		$this->assertInstanceOf('\Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertEquals($page_content, $response->getContent());
	}
}
