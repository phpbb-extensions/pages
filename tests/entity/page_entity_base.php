<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\entity;

require_once dirname(__FILE__) . '/../../../../../includes/functions.php';
require_once dirname(__FILE__) . '/../../../../../includes/functions_content.php';
require_once dirname(__FILE__) . '/../../../../../includes/utf/utf_tools.php';

/**
* Base page entity test (helper)
*/
class page_entity_base extends \phpbb_database_test_case
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

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/page.xml');
	}

	public function setUp()
	{
		parent::setUp();

		$this->db = $this->new_dbal();

		global $config, $phpbb_dispatcher;
		$config = new \phpbb\config\config(array());
		set_config(null, null, null, $config);

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
	}

	/**
	* Get the page entity
	*
	* @return \phpbb\pages\entity\page
	* @access protected
	*/
	protected function get_page_entity()
	{
		return new \phpbb\pages\entity\page($this->db, 'phpbb_pages');
	}

	/**
	* Some common data to test from which can be imported
	*
	* @return array Data to send to import_data
	* @access public
	*/
	public function get_import_data()
	{
		return array(
			1 => array(
				'page_id'							=> 1,
				'page_order'						=> 1,
				'page_route'						=> 'route1',
				'page_title'						=> '1 Title',
				'page_description'					=> '1 Description',
				'page_content'						=> '1 Message',
				'page_content_bbcode_uid'			=> '1rgq4t6b',
				'page_content_bbcode_bitfield'		=> '',
				'page_content_bbcode_options'		=> 0,
				'page_content_allow_html'			=> 0,
				'page_display'						=> 1,
				'page_display_to_guests'			=> 1,
			),
			2 => array(
				'page_id'							=> 2,
				'page_order'						=> 2,
				'page_route'						=> 'route2',
				'page_title'						=> '2 Title',
				'page_description'					=> '2 Description',
				'page_content'						=> '[b:155nknse]This is a test[/b:155nknse] <!-- s:) --><img src="{SMILIES_PATH}/icon_e_smile.gif" alt=":)" title="Smile" /><!-- s:) -->',
				'page_content_bbcode_uid'			=> '155nknse',
				'page_content_bbcode_bitfield'		=> 'QA==',
				'page_content_bbcode_options'		=> 7,
				'page_content_allow_html'			=> 0,
				'page_display'						=> 1,
				'page_display_to_guests'			=> 1,
			),
			3 => array(
				'page_id'							=> 3,
				'page_order'						=> 1,
				'page_route'						=> 'route3',
				'page_title'						=> '3 Title',
				'page_description'					=> '3 Description',
				'page_content'						=> '[quote=EXreaction]Another [i:2ebzz8aw]test[/i:2ebzz8aw]!<!-- m --><a class="postlink" href="http://google.com">http://google.com</a><!-- m -->[/quote]',
				'page_content_bbcode_uid'			=> '2ebzz8aw',
				'page_content_bbcode_bitfield'		=> 'IA==',
				'page_content_bbcode_options'		=> 7,
				'page_content_allow_html'			=> 0,
				'page_display'						=> 1,
				'page_display_to_guests'			=> 1,
			),
			4 => array(
				'page_id'							=> 4,
				'page_order'						=> 2,
				'page_route'						=> 'route4',
				'page_title'						=> '4 Title',
				'page_description'					=> '4 Description',
				'page_content'						=> '[b]Just[/b] one more :) http://google.com',
				'page_content_bbcode_uid'			=> '',
				'page_content_bbcode_bitfield'		=> '',
				'page_content_bbcode_options'		=> 0,
				'page_content_allow_html'			=> 0,
				'page_display'						=> 1,
				'page_display_to_guests'			=> 1,
			),
			5 => array(
				'page_id'							=> 5,
				'page_order'						=> 0,
				'page_route'						=> 'route5',
				'page_title'						=> '5 Title',
				'page_description'					=> '5 Description',
				'page_content'						=> '<b>Just</b> one more :) <a href="http://google.com">Link</a>',
				'page_content_bbcode_uid'			=> '',
				'page_content_bbcode_bitfield'		=> '',
				'page_content_bbcode_options'		=> 0,
				'page_content_allow_html'			=> 1,
				'page_display'						=> 1,
				'page_display_to_guests'			=> 1,
			),
		);
	}
}
