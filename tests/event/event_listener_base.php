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

class event_listener_base extends \phpbb_test_case
{
	protected $controller_helper, $template, $user, $root_path, $php_ext;

	/**
	* Setup test environment
	*
	* @access public
	*/
	public function setUp()
	{
		parent::setUp();

		global $phpbb_dispatcher, $phpbb_root_path, $phpEx;

		// Mock some global classes that may be called during code execution
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		// Load/Mock classes required by the event listener class
		$this->php_ext = $phpEx;
		$this->root_path = $phpbb_root_path;
		$this->auth = $this->getMock('\phpbb\auth\auth');
		$this->template = new \phpbb\pages\tests\mock\template();
		$this->user = new \phpbb\user('\phpbb\datetime');
		$this->controller_helper = new \phpbb_mock_controller_helper(
			$this->template,
			$this->user,
			new \phpbb\config\config(array()),
			new \phpbb\controller\provider(),
			new \phpbb_mock_extension_manager($phpbb_root_path),
			'',
			$phpEx,
			dirname(__FILE__) . '/../../'
		);
	}

	/**
	* Get the event listener
	*
	* @access protected
	*/
	protected function get_listener()
	{
		return new \phpbb\pages\event\listener(
			$this->auth,
			$this->controller_helper,
			new \phpbb\pages\tests\mock\page_operator(),
			$this->template,
			$this->user,
			$this->root_path,
			$this->php_ext
		);
	}
}
