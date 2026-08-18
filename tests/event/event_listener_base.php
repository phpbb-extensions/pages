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
	/** @var \PHPUnit\Framework\MockObject\MockObject|\phpbb\auth\auth */
	protected $auth;

	/** @var \PHPUnit\Framework\MockObject\MockObject|\phpbb\controller\helper */
	protected $controller_helper;

	/** @var \phpbb\language\language */
	protected $lang;

	/** @var \PHPUnit\Framework\MockObject\MockObject|\phpbb\pages\operators\page */
	protected $page_operator;

	/** @var \PHPUnit\Framework\MockObject\MockObject|\phpbb\routing\router */
	protected $router;

	/** @var \PHPUnit\Framework\MockObject\MockObject|\phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $php_ext;

	/**
	* Setup test environment
	*/
	protected function setUp(): void
	{
		parent::setUp();

		global $phpbb_root_path, $phpEx;

		// Load/Mock classes required by the event listener class
		$this->php_ext = $phpEx;
		$this->auth = $this->getMockBuilder('\phpbb\auth\auth')
			->disableOriginalConstructor()
			->getMock();
		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$this->lang = new \phpbb\language\language($lang_loader);
		$this->user = new \phpbb\user($this->lang, '\phpbb\datetime');
		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$this->controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$this->page_operator = $this->getMockBuilder('\phpbb\pages\operators\page')
			->disableOriginalConstructor()
			->getMock();
		$this->router = $this->getMockBuilder('\phpbb\routing\router')
			->disableOriginalConstructor()
			->getMock();

		$route_collection = new \Symfony\Component\Routing\RouteCollection();
		$route_collection->add('phpbb_pages_dynamic_route_1', new \Symfony\Component\Routing\Route('/test'));
		$this->router->method('getRouteCollection')
			->willReturn($route_collection);
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
			$this->lang,
			$this->page_operator,
			$this->router,
			$this->template,
			$this->user,
			$this->php_ext
		);
	}
}
