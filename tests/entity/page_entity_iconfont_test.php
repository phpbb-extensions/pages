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
* Tests related to icon font on page entity
*/
class page_entity_iconfont_test extends page_entity_base
{
	/**
	* Test data for the test_icon_font() function
	*
	* @return array Array of test data
	*/
	public function icon_font_test_data()
	{
		return array(
			// sent to set_icon_font(), expected from get_icon_font()
			array('foo', 'foo'),
			array('foo1', 'foo1'),
			array('foo-1', 'foo-1'),
			array('foo-bar', 'foo-bar'),
			array('', ''),
			array(null, ''),
			array(str_repeat('a', 255), str_repeat('a', 255)),
		);
	}

	/**
	* Test setting icon font
	*
	* @dataProvider icon_font_test_data
	*/
	public function test_icon_font($input, $expected)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Set the icon font
		$result = $entity->set_icon_font($input);

		// Assert the returned value is what we expect
		self::assertInstanceOf('\phpbb\pages\entity\page', $result);

		// Assert that the input matches what's expected
		self::assertSame($expected, $entity->get_icon_font());
	}

	/**
	* Test data for the test_icon_font_fails() function
	*
	* @return array Array of test data
	*/
	public function icon_font_fails_test_data()
	{
		return array(
			// Some invalid icon font names
			array(0),
			array('0'),
			array('0foo'),
			array('foo_bar'),
			array('foo?bar'),
			array('foo‘bar'),
			array('føø-bár'),
			array(str_repeat('a', 256)),
		);
	}

	/**
	* Test setting invalid icon font which should throw an exception
	*
	* @dataProvider icon_font_fails_test_data
	*/
	public function test_icon_font_fails($input)
	{
		$this->expectException(\phpbb\pages\exception\base::class);

		// Setup the entity class
		$entity = $this->get_page_entity();

		// Load the entity
		$entity->set_icon_font($input);
	}
}
