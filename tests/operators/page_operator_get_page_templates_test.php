<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\operators;

class page_operator_get_page_templates_test extends page_operator_base
{
	/**
	* Test data for the test_get_templates() function
	*
	* @return array Array of test routes
	*/
	public function get_templates_test_data()
	{
		return array(
			array(
				array(
					'ext/phpbb/pages/styles/prosilver/template/pages_blank.html' => 'phpbb/pages',
					'ext/phpbb/pages/styles/prosilver/template/pages_default.html' => 'phpbb/pages',
				),
			),
		);
	}

	/**
	* Test getting page templates from the filesystem
	*
	* @dataProvider get_templates_test_data
	*/
	public function test_get_templates($expected)
	{
		// Setup the operator class
		$operator = $this->get_page_operator();

		// Grab the route data as an array
		$templates = $operator->get_page_templates();

		foreach ($expected as $key => $ext)
		{
			$this->assertArrayHasKey($key, $templates);
			$this->assertEquals($templates[$key], $ext);
		}

		$this->assertEquals($expected, $templates);
	}
}
