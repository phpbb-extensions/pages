<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\functional;

/**
* @group functional
*/
class admin_controller_test extends pages_functional_base
{
	/**
	* Test setup
	*/
	public function setUp()
	{
		parent::setUp();
		$this->login();
		$this->admin_login();
	}

	/**
	* Test Pages ACP module appears
	*/
	public function test_acp_module()
	{
		// Load Pages ACP page
		$crawler = self::request('GET', "adm/index.php?i=\\phpbb\\pages\\acp\\pages_module&mode=manage&sid={$this->sid}");

		// Assert Pages module appears in sidebar
		$this->assertContainsLang('ACP_PAGES', $crawler->filter('.menu-block')->text());
		$this->assertContainsLang('ACP_PAGES_MANAGE', $crawler->filter('#activemenu')->text());

		// Assert Pages display appears
		$this->assertContainsLang('ACP_PAGES_EMPTY', $crawler->filter('#main')->text());
		$this->assertContainsLang('ACP_PAGES_MANAGE', $crawler->filter('#main')->text());
		$this->assertContainsLang('ACP_PAGES_PURGE_ICONS_LABEL', $crawler->filter('#main')->text());
	}

	/**
	* Test Pages ACP Create Page
	*/
	public function test_acp_create()
	{
		// Load Pages ACP page
		$crawler = self::request('GET', "adm/index.php?i=\\phpbb\\pages\\acp\\pages_module&mode=manage&sid={$this->sid}");

		// Jump to the create page
		$form = $crawler->selectButton($this->lang('ACP_PAGES_CREATE_PAGE'))->form();
		$crawler = self::submit($form);
		$this->assertContainsLang('ACP_PAGES_CREATE_PAGE', $crawler->filter('#main h1')->text());

		// Confirm error when submitting without required field data
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$crawler = self::submit($form);
		$this->assertGreaterThan(0, $crawler->filter('.errorbox')->count());
		$this->assertContainsLang('EXCEPTION_FIELD_MISSING', $crawler->text());

		// Create page
		$page_title = 'Functional Test Page';
		$this->create_page($page_title, 'This is a functional test page');

		// Confirm new page appears in Pages list
		$crawler = self::request('GET', "adm/index.php?i=\\phpbb\\pages\\acp\\pages_module&mode=manage&sid={$this->sid}");
		$this->assertContains('Functional Test Page', $crawler->text());

		// Confirm the log entry has been added correctly
		$crawler = self::request('GET', "adm/index.php?i=acp_logs&mode=admin&sid={$this->sid}");
		$this->assertContains(strip_tags(html_entity_decode($this->lang('ACP_PAGES_ADDED_LOG', $page_title), ENT_COMPAT, 'UTF-8')), $crawler->text());
	}

	/**
	* Test Pages ACP manage permission
	*/
	public function test_pages_acp_permissions()
	{
		$this->add_lang_ext('phpbb/pages', 'permissions_pages');
		$crawler = self::request('GET', "adm/index.php?i=acp_permissions&mode=setting_group_global&sid={$this->sid}");
		$form = $crawler->selectButton('submit')->form();

		// Select Administrative permissions option
		$form->get('type')->setValue('a_');
		$crawler = self::submit($form);

		$this->assertContainsLang('ACL_A_PAGES', $crawler->text());
	}
}
