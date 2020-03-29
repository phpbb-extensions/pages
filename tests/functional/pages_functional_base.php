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
class pages_functional_base extends \phpbb_functional_test_case
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

	public function setUp(): void
	{
		parent::setUp();

		// Load all of Pages language files
		$this->add_lang_ext('phpbb/pages', array(
			'exceptions',
			'info_acp_pages',
			'pages_acp',
			'pages_common',
			'pages_controller',
		));
	}

	/**
	* Creates a page
	*
	* Be sure to call admin_login() before creating
	*
	* @param string $page_title
	* @param string $page_content
	* @param array $additional_form_data Additional form data to be sent
	* @return string
	*/
	public function create_page($page_title, $page_content, $additional_form_data = array())
	{
		$form_data = array_merge(array(
			'page_title'		=> $page_title,
			'page_content'		=> $page_content,
			'page_route'		=> 'fn_' . time(),
			'page_description'	=> '',
			'parse_bbcode'		=> true,
			'parse_smilies'		=> true,
			'parse_magic_url'	=> true,
			'parse_html'		=> false,
			'page_template'		=> 'pages_default.html',
			'page_order'		=> 0,
			'page_links'		=> array(2),
			'page_display'		=> true,
			'page_guest_display'=> true,
			'page_title_switch'	=> false,
			'page_icon_font'	=> '',
		), $additional_form_data);

		$crawler = self::request('GET', "adm/index.php?i=\\phpbb\\pages\\acp\\pages_module&mode=manage&action=add&sid={$this->sid}");
		$this->assertContainsLang('ACP_PAGES_CREATE_PAGE', $crawler->text());

		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$crawler = self::submit($form, $form_data);
		$this->assertGreaterThan(0, $crawler->filter('.successbox')->count());
		$this->assertContainsLang('ACP_PAGES_ADD_SUCCESS', $crawler->text());

		return $form_data['page_route'];
	}
}
