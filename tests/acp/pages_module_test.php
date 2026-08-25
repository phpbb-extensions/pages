<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\tests\acp;

require_once __DIR__ . '/../controller/admin_test_helpers.php';

use phpbb\pages\controller\admin_test_state;

class pages_module_test extends \phpbb_test_case
{
	/** @var \phpbb\pages\acp\pages_module */
	protected $module;

	/** @var \phpbb\pages\controller\admin_interface|\PHPUnit\Framework\MockObject\MockObject */
	protected $controller;

	/** @var array */
	protected $variables = array();

	protected function setUp(): void
	{
		parent::setUp();

		global $phpbb_container;

		admin_test_state::reset();
		$this->module = new \phpbb\pages\acp\pages_module();
		$this->module->u_action = 'adm.php?i=pages';
		$this->controller = $this->createMock(\phpbb\pages\controller\admin_interface::class);

		$request = $this->createMock(\phpbb\request\request::class);
		$request->method('variable')->willReturnCallback(function ($name, $default) {
			return array_key_exists($name, $this->variables) ? $this->variables[$name] : $default;
		});
		$lang = $this->getMockBuilder(\phpbb\language\language::class)
			->disableOriginalConstructor()
			->getMock();
		$lang->method('lang')->willReturnArgument(0);

		$phpbb_container = $this->createMock(\Symfony\Component\DependencyInjection\ContainerInterface::class);
		$phpbb_container->method('get')->willReturnCallback(function ($service) use ($request, $lang) {
			switch ($service)
			{
				case 'language':
					return $lang;
				case 'request':
					return $request;
				default:
					return $this->controller;
			}
		});
	}

	public static function action_data()
	{
		return array(
			'list' => array('', 'display_pages', 'ACP_PAGES_MANAGE'),
			'add' => array('add', 'add_page', 'ACP_PAGES_CREATE_PAGE'),
			'edit' => array('edit', 'edit_page', 'ACP_PAGES_EDIT_PAGE'),
			'purge icons' => array('purge_icons', 'purge_icons', 'ACP_PAGES_MANAGE'),
		);
	}

	/**
	 * @dataProvider action_data
	 */
	public function test_main_dispatches_actions($action, $method, $expected_title)
	{
		$this->variables = array('action' => $action, 'page_id' => 7);
		$this->controller->expects(self::once())->method('set_page_url')->with('adm.php?i=pages');
		$this->controller->expects(self::once())->method($method);
		if (!in_array($action, array('', 'purge_icons')))
		{
			$this->controller->expects(self::never())->method('display_pages');
		}

		$this->module->main(1, 'manage');

		self::assertSame('manage_pages', $this->module->tpl_name);
		self::assertSame($expected_title, $this->module->page_title);
	}

	public function test_delete_confirmed_deletes_then_displays()
	{
		$this->variables = array('action' => 'delete', 'page_id' => 7);
		$this->controller->expects(self::once())->method('delete_page')->with(7);
		$this->controller->expects(self::once())->method('display_pages');

		$this->module->main(1, 'manage');
	}

	public function test_delete_unconfirmed_builds_confirmation_then_displays()
	{
		admin_test_state::$confirm = false;
		$this->variables = array('action' => 'delete', 'page_id' => 7);
		$this->controller->expects(self::never())->method('delete_page');
		$this->controller->expects(self::once())->method('display_pages');

		$this->module->main(1, 'manage');

		self::assertSame('ACP_PAGES_DELETE_CONFIRM', admin_test_state::$confirmations[0]['title']);
		self::assertStringContainsString('page_id=7', admin_test_state::$confirmations[0]['hidden']);
	}

	public function test_module_info_is_complete()
	{
		$info = (new \phpbb\pages\acp\pages_info())->module();

		self::assertSame('ACP_PAGES', $info['title']);
		self::assertSame('ACP_PAGES_MANAGE', $info['modes']['manage']['title']);
		self::assertStringContainsString('acl_a_pages', $info['modes']['manage']['auth']);
	}
}
