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

/**
* Tests related to templates on page entity
*/
class page_entity_template_test extends page_entity_base
{
	/**
	* Test data for the test_template() function
	*
	* @return array Array of test data
	*/
	public function template_test_data()
	{
		return array(
			// sent to set_template(), expected from get_template()
			array('pages_foo.html', 'pages_foo.html'),
			array('', 'pages_default.html'),
			array(null, 'pages_default.html'),

			// Maximum length
			array(
				'pages_' . str_repeat('a', 244) . '.html',
				'pages_' . str_repeat('a', 244) . '.html',
			),
		);
	}

	/**
	* Test setting template
	*
	* @dataProvider template_test_data
	*/
	public function test_template($template, $expected)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Set the template
		$result = $entity->set_template($template);

		// Assert the returned value is what we expect
		self::assertInstanceOf('\phpbb\pages\entity\page', $result);

		// Assert that the template matches what's expected
		self::assertSame($expected, $entity->get_template());
	}

	/**
	* Test data for the test_template_fails() function
	*
	* @return array Array of test data
	*/
	public function template_fails_test_data()
	{
		return array(
			// Some invalid template names
			array('foobar'),
			array('foobar.html'),
			array('pages_foobar'),
			array('pages_foobar.htm'),
			array('pages_føobar.html'),
			array('pages_foo?bar.html'),
			array('pages.foobar.html'),

			// Exceeds character maximum length
			array(
				'pages_' . str_repeat('a', 245) . '.html',
			),
		);
	}

	/**
	* Test setting invalid data on the template which should throw an exception
	*
	* @dataProvider template_fails_test_data
	*/
	public function test_template_fails($template)
	{
		$this->expectException(\phpbb\pages\exception\base::class);

		// Setup the entity class
		$entity = $this->get_page_entity();

		// Load the entity
		$entity->set_template($template);
	}
}
