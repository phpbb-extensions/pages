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
	protected $auth, $controller_helper, $page_operator, $template, $user, $root_path, $php_ext;

	/**
	* Setup test environment
	*/
	public function setUp()
	{
		parent::setUp();

		global $phpbb_root_path, $phpEx;

		// Load/Mock classes required by the event listener class
		$this->php_ext = $phpEx;
		$this->root_path = $phpbb_root_path;
		$this->auth = $this->getMock('\phpbb\auth\auth');
		$this->user = new \phpbb\user('\phpbb\datetime');
		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$this->controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$this->page_operator = $this->getMockBuilder('\phpbb\pages\operators\page')
			->disableOriginalConstructor()
			->getMock();
	}

	/**
	* Get the event listener
	*
	* @return \phpbb\pages\event\listener
	*/
	protected function get_listener()
	{
		return new \phpbb\pages\event\listener(
			$this->auth,
			$this->controller_helper,
			$this->page_operator,
			$this->template,
			$this->user,
			$this->root_path,
			$this->php_ext
		);
	}
}
