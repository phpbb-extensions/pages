<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\tests\controller;

require_once __DIR__ . '/admin_test_helpers.php';

use phpbb\pages\controller\admin_controller;
use phpbb\pages\controller\admin_test_state;

class admin_controller_test extends \phpbb_database_test_case
{
	/** @var admin_controller */
	protected $controller;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\pages\operators\page */
	protected $page_operator;

	/** @var \phpbb\request\request|\PHPUnit\Framework\MockObject\MockObject */
	protected $request;

	/** @var \phpbb\template\template|\PHPUnit\Framework\MockObject\MockObject */
	protected $template;

	/** @var \phpbb\log\log|\PHPUnit\Framework\MockObject\MockObject */
	protected $log;

	/** @var \phpbb\pages\routing\route_cache|\PHPUnit\Framework\MockObject\MockObject */
	protected $route_cache;

	/** @var array */
	protected $variables = array();

	/** @var array */
	protected $post = array();

	/** @var bool */
	protected $ajax = false;

	/** @var array */
	protected $assigned_vars = array();

	/** @var array */
	protected $blocks = array();

	protected static function setup_extensions()
	{
		return array('phpbb/pages');
	}

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/../operators/fixtures/page.xml');
	}

	protected function setUp(): void
	{
		parent::setUp();

		global $config, $phpbb_container, $phpbb_dispatcher, $phpbb_extension_manager, $phpbb_root_path, $phpEx;

		admin_test_state::reset();
		\phpbb\json_response::$data = null;

		$this->db = $this->new_dbal();
		$config = new \phpbb\config\config(array());
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$cache = new \phpbb_mock_cache();
		$text_formatter_utils = new \phpbb\textformatter\s9e\utils();
		$litedown = $this->getMockBuilder(\phpbb\pages\textformatter\litedown::class)
			->disableOriginalConstructor()
			->getMock();
		$litedown->method('parse')->willReturnCallback(function ($text) {
			return '<t>' . $text . '</t>';
		});
		$litedown->method('render')->willReturnCallback(function ($text) {
			return $text;
		});

		$extension_manager = new \phpbb_mock_extension_manager(
			$phpbb_root_path,
			array('phpbb/pages' => array(
				'ext_name' => 'phpbb/pages',
				'ext_active' => '1',
				'ext_path' => 'ext/phpbb/pages/',
			))
		);
		$phpbb_extension_manager = $extension_manager;
		$this->get_test_case_helpers()->set_s9e_services($phpbb_container);
		$user = $this->getMockBuilder(\phpbb\user::class)
			->disableOriginalConstructor()
			->getMock();
		$user->data['user_id'] = 2;
		$user->ip = '127.0.0.1';

		$entity_factory = function () use ($config, $phpbb_dispatcher, $text_formatter_utils, $litedown) {
			return new \phpbb\pages\entity\page(
				$this->db,
				$config,
				$phpbb_dispatcher,
				'phpbb_pages',
				$text_formatter_utils,
				$litedown
			);
		};

		$operator_container = $this->createMock(\Symfony\Component\DependencyInjection\ContainerInterface::class);
		$operator_container->method('get')
			->with('phpbb.pages.entity')
			->willReturnCallback($entity_factory);
		$this->page_operator = new \phpbb\pages\operators\page(
			$cache,
			$operator_container,
			$this->db,
			$extension_manager,
			$user,
			'phpbb_pages',
			'phpbb_pages_links',
			'phpbb_pages_pages_links'
		);

		$pagination = $this->getMockBuilder(\phpbb\pagination::class)
			->disableOriginalConstructor()
			->getMock();
		$container = $this->createMock(\Symfony\Component\DependencyInjection\ContainerInterface::class);
		$container->method('get')->willReturnCallback(function ($service) use ($entity_factory, $pagination) {
			return $service === 'pagination' ? $pagination : $entity_factory();
		});

		$this->request = $this->createMock(\phpbb\request\request::class);
		$this->request->method('variable')->willReturnCallback(function ($name, $default) {
			return array_key_exists($name, $this->variables) ? $this->variables[$name] : $default;
		});
		$this->request->method('is_set_post')->willReturnCallback(function ($name) {
			return !empty($this->post[$name]);
		});
		$this->request->method('is_ajax')->willReturnCallback(function () {
			return $this->ajax;
		});

		$this->template = $this->createMock(\phpbb\template\template::class);
		$this->template->method('assign_vars')->willReturnCallback(function (array $vars) {
			$this->assigned_vars = array_merge($this->assigned_vars, $vars);
		});
		$this->template->method('assign_block_vars')->willReturnCallback(function ($block, array $vars) {
			$this->blocks[$block][] = $vars;
		});

		$loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$loader->set_extension_manager($extension_manager);
		$lang = new \phpbb\language\language($loader);
		$lang->set_default_language('en');
		$lang->set_user_language('en');
		$lang->add_lang('pages_acp', 'phpbb/pages');

		$helper = $this->getMockBuilder(\phpbb\controller\helper::class)
			->disableOriginalConstructor()
			->getMock();
		$helper->method('route')->willReturnCallback(function ($route) {
			return '/' . $route;
		});
		$this->log = $this->createMock(\phpbb\log\log::class);
		$this->route_cache = $this->getMockBuilder(\phpbb\pages\routing\route_cache::class)
			->disableOriginalConstructor()
			->getMock();

		$this->controller = new admin_controller(
			$cache,
			$this->route_cache,
			$helper,
			$lang,
			$this->log,
			$this->page_operator,
			$this->request,
			$this->template,
			$user,
			$container,
			$phpbb_dispatcher,
			$phpbb_root_path,
			$phpEx
		);
		$this->controller->set_page_url('adm.php?i=pages');
	}

	public function test_display_pages_uses_real_entities()
	{
		$this->controller->display_pages();

		self::assertSame(array('phpbb_pages_purge_icons'), admin_test_state::$form_keys);
		self::assertCount(4, $this->blocks['pages']);
		self::assertSame('title_1', $this->blocks['pages'][0]['PAGES_TITLE']);
		self::assertSame('/phpbb_pages_dynamic_route_1', $this->blocks['pages'][0]['U_PAGES_ROUTE']);
		self::assertSame('adm.php?i=pages&amp;action=add', $this->assigned_vars['U_ADD_PAGE']);
	}

	public function test_add_page_initial_form_uses_real_entity()
	{
		$this->controller->add_page();

		self::assertTrue($this->assigned_vars['S_ADD_PAGE']);
		self::assertFalse($this->assigned_vars['S_ERROR']);
		self::assertSame('', $this->assigned_vars['PAGES_TITLE']);
		self::assertCount(2, $this->blocks['page_template_options']);
		self::assertCount(2, $this->blocks['page_link_options']);
		self::assertSame(1, admin_test_state::$custom_bbcodes_displayed);
	}

	public function test_edit_page_initial_form_loads_links_and_parse_options()
	{
		$this->controller->edit_page(1);

		self::assertTrue($this->assigned_vars['S_EDIT_PAGE']);
		self::assertSame('title_1', $this->assigned_vars['PAGES_TITLE']);
		self::assertSame('/phpbb_pages_dynamic_route_1', $this->assigned_vars['U_VIEW_PAGE']);
		self::assertFalse($this->blocks['page_link_options'][0]['S_SELECTED']);
		self::assertFalse($this->blocks['page_link_options'][1]['S_SELECTED']);
		self::assertSame(0, $this->assigned_vars['S_PARSE_BBCODE_CHECKED']);
	}

	public function test_page_link_options_load_stored_links_when_current_is_empty()
	{
		$method = new \ReflectionMethod(admin_controller::class, 'create_page_link_options');
		$method->setAccessible(true);
		$method->invoke($this->controller, 1, array());

		self::assertTrue($this->blocks['page_link_options'][0]['S_SELECTED']);
		self::assertTrue($this->blocks['page_link_options'][1]['S_SELECTED']);
	}

	public function test_add_page_rejects_invalid_form_and_entity_values()
	{
		admin_test_state::$valid_form = false;
		$this->post['submit'] = true;
		$this->variables = array(
			'page_title' => '',
			'page_route' => 'invalid route',
			'page_content' => 'Valid content',
			'page_template' => 'missing.html',
		);

		$this->controller->add_page();

		self::assertTrue($this->assigned_vars['S_ERROR']);
		self::assertStringContainsString('The submitted form was invalid', $this->assigned_vars['ERROR_MSG']);
		self::assertStringContainsString('Required field missing', $this->assigned_vars['ERROR_MSG']);
	}

	public function test_add_page_submission_persists_and_purges_routes()
	{
		$this->post['submit'] = true;
		$this->variables = $this->valid_page_data('new-page', 'New page');
		$this->route_cache->expects(self::once())->method('purge');
		$this->log->expects(self::once())
			->method('add')
			->with('admin', 2, '127.0.0.1', 'ACP_PAGES_ADDED_LOG');
		$this->setExpectedTriggerError(E_USER_NOTICE, 'Page successfully added.|back:adm.php?i=pages');

		$this->controller->add_page();
	}

	public function test_edit_page_submission_persists_and_purges_routes()
	{
		$this->post['submit'] = true;
		$this->variables = $this->valid_page_data('page-1-updated', 'Updated page');
		$this->route_cache->expects(self::once())->method('purge');
		$this->log->expects(self::once())
			->method('add')
			->with('admin', 2, '127.0.0.1', 'ACP_PAGES_EDITED_LOG');
		$this->setExpectedTriggerError(E_USER_NOTICE, 'Page successfully updated.|back:adm.php?i=pages');

		$this->controller->edit_page(1);
	}

	public function test_delete_page_removes_real_page_and_logs()
	{
		$this->log->expects(self::once())
			->method('add')
			->with('admin', 2, '127.0.0.1', 'ACP_PAGES_DELETED_LOG');

		$this->controller->delete_page(1);

		self::assertSame(3, $this->page_operator->get_total_pages());
	}

	public function test_delete_page_ajax_returns_json_response()
	{
		$this->ajax = true;

		$this->controller->delete_page(1);

		self::assertSame('Information', \phpbb\json_response::$data['MESSAGE_TITLE']);
		self::assertSame('Page successfully deleted.', \phpbb\json_response::$data['MESSAGE_TEXT']);
		self::assertSame(3, \phpbb\json_response::$data['REFRESH_DATA']['time']);
	}

	public function test_delete_page_reports_operator_failure()
	{
		$operator = $this->getMockBuilder(\phpbb\pages\operators\page::class)
			->disableOriginalConstructor()
			->getMock();
		$operator->method('delete_page')
			->willThrowException(new \phpbb\pages\exception\out_of_bounds('page_id'));
		$this->replace_controller_service('page_operator', $operator);
		$this->setExpectedTriggerError(E_USER_WARNING, 'Page could not be deleted.|back:adm.php?i=pages');

		$this->controller->delete_page(1);
	}

	public function test_purge_icons_destroys_only_pages_icon_cache()
	{
		$cache = $this->createMock(\phpbb\cache\driver\driver_interface::class);
		$cache->expects(self::once())->method('destroy')->with('_pages_icons');
		$this->replace_controller_service('cache', $cache);

		$this->controller->purge_icons();
	}

	public function test_purge_icons_rejects_invalid_form()
	{
		admin_test_state::$valid_form = false;
		$this->setExpectedTriggerError(E_USER_WARNING, 'The submitted form was invalid. Try submitting again.|back:adm.php?i=pages');

		$this->controller->purge_icons();
	}

	protected function valid_page_data($route, $title)
	{
		return array(
			'page_title' => $title,
			'page_route' => $route,
			'page_description' => 'Description',
			'page_description_display' => true,
			'page_content' => 'Content',
			'parse_bbcode' => true,
			'parse_magic_url' => true,
			'parse_smilies' => true,
			'parse_markdown' => false,
			'parse_html' => false,
			'page_template' => 'pages_default.html',
			'page_links' => array(1, 2),
			'page_order' => 5,
			'page_icon_font' => 'fa-file',
			'page_display' => 1,
			'page_guest_display' => 1,
			'page_title_switch' => 1,
		);
	}

	protected function replace_controller_service($property, $service)
	{
		$reflection = new \ReflectionProperty(admin_controller::class, $property);
		$reflection->setAccessible(true);
		$reflection->setValue($this->controller, $service);
	}
}
