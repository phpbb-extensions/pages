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

class show_page_links_test extends event_listener_base
{
	/**
	* Data set for test_show_page_links
	*
	* @return array Array of test data
	* @access public
	*/
	public function show_page_links_data()
	{
		return array(
			array(
				array(
					// Links for page 1
					'overall_header_navigation_prepend_links' => array(
						'U_LINK_URL' => 'app.php/page/page_1',
						'LINK_TITLE' => 'title_1',
					),
					'S_OVERALL_HEADER_NAVIGATION_PREPEND' => true,
					// Links for page 2
					'overall_header_navigation_append_links' => array(
						'U_LINK_URL' => 'app.php/page/page_2',
						'LINK_TITLE' => 'title_2',
					),
					'S_OVERALL_HEADER_NAVIGATION_APPEND' => true,
				),
			),
		);
	}

	/**
	* Test the show_page_links event
	*
	* @dataProvider show_page_links_data
	* @access public
	*/
	public function test_show_page_links($expected)
	{
		$listener = $this->get_listener();

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.page_header', array($listener, 'show_page_links'));
		$dispatcher->dispatch('core.page_header');

		$this->assertEquals($expected, $this->template->get_template_vars());
	}
}
