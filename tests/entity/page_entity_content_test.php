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
* Tests related to the content on page entity
*/
class page_entity_content_test extends page_entity_base
{
	public function setUp()
	{
		parent::setUp();

		global $cache, $db, $request, $user, $phpbb_path_helper, $phpbb_root_path, $phpEx;

		$cache = new \phpbb_mock_cache();

		$db = $this->db;

		$request = new \phpbb_mock_request();

		$user = new \phpbb_mock_user();
		$user->optionset('viewcensors', false);
		$user->style['style_path'] = 'prosilver';

		$phpbb_path_helper = new \phpbb\path_helper(
			new \phpbb\symfony_request($request),
			new \phpbb\filesystem(),
			$this->getMock('\phpbb\request\request'),
			$phpbb_root_path,
			$phpEx
		);
	}

	/**
	* Test data for the test_content() function
	*
	* @return array Array of test data
	* @access public
	*/
	public function content_test_data()
	{
		return array(
			// sent to set_content()
			array('This is a test message.'),
			array('This is a test message. :)'),
			array('This is a test [b]message[/b].'),
			array('This is a test [b]message[/b]. :)'),
			array('This is a test message. http://test.com'),
			array('This is a test message. :) http://test.com'),
			array('This is a test [b]message[/b]. http://test.com'),
			array('This is a test [b]message[/b]. :) http://test.com'),
		);
	}

	/**
	* Test setting content
	*
	* This function automatically handles different options for parsing the
	* content and tests them all
	*
	* @dataProvider content_test_data
	* @access public
	*/
	public function test_content($content)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Set the content
		$result = $entity->set_content($content);

		// Assert the returned value is what we expect
		$this->assertInstanceOf('\phpbb\pages\entity\page', $result);

		// We start with all options set to false
		$enable_bbcode = $enable_magic_url = $enable_smilies = $censor_text = false;
		$i = 0;

		// We continue until all options are set to true (should be 2 ^ 4 (16) times)
		while (!$enable_bbcode || !$enable_magic_url || !$enable_smilies || !$censor_text)
		{
			// We're using bitwise operation to figure out what option is set at each iteration
			$enable_bbcode = ($i & 1) ? true : false;
			$enable_magic_url = ($i & 2) ? true : false;
			$enable_smilies = ($i & 4) ? true : false;
			$censor_text = ($i & 8) ? true : false;

			// Enable/disable bbcodes/smilies/magic url based on the options
			// The content is automatically reparsed once the option is set
			if ($enable_bbcode)
			{
				$entity->content_enable_bbcode();
			}
			else
			{
				$entity->content_disable_bbcode();
			}

			if ($enable_magic_url)
			{
				$entity->content_enable_magic_url();
			}
			else
			{
				$entity->content_disable_magic_url();
			}

			if ($enable_smilies)
			{
				$entity->content_enable_smilies();
			}
			else
			{
				$entity->content_disable_smilies();
			}

			// Get what we're expecting from
			$test = $this->content_test_helper($content, $enable_bbcode, $enable_magic_url, $enable_smilies, $censor_text);

			$this->assertSame($test['edit'], $entity->get_content_for_edit());

			$this->assertSame($test['display'], $entity->get_content_for_display($censor_text));

			// Increment the options
			$i++;
		}
	}

	/**
	* Helper for content test
	*
	* @param string $content The content
	* @param bool $enable_bbcode
	* @param bool $enable_magic_url
	* @param bool $enable_smilies
	* @param bool $censor_text
	* @return array
	* @access protected
	*/
	protected function content_test_helper($content, $enable_bbcode, $enable_magic_url, $enable_smilies, $censor_text)
	{
		$return = array();

		// Prepare the text for storage
		$uid = $bitfield = $flags = '';
		generate_text_for_storage($content, $uid, $bitfield, $flags, $enable_bbcode, $enable_magic_url, $enable_smilies);

		// Prepare for edit
		$return['edit'] = generate_text_for_edit($content, $uid, $flags);
		$return['edit'] = $return['edit']['text'];

		// Prepare for display
		$return['display'] = generate_text_for_display($content, $uid, $bitfield, $flags, $censor_text);

		return $return;
	}

	/**
	* Test data for the test_html_content() function
	*
	* @return array Array of test data
	* @access public
	*/
	public function html_content_test_data()
	{
		return array(
			// sent to set_content()
			array('This is a test message.'),
			array('This is a test <b>message</b>.'),
			array('This is a test <b>message</b><br />This is a new line.'),
			array('This is a test <b>message</b><br />This is a <a href="#">new line</a>. Føó.'),
		);
	}

	/**
	* Test setting html content
	*
	* @dataProvider html_content_test_data
	* @access public
	*/
	public function test_html_content($content)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Set the content
		$result = $entity->set_content($content);

		// Assert the returned value is what we expect
		$this->assertInstanceOf('\phpbb\pages\entity\page', $result);

		// Enable HTML
		$entity->content_enable_html();

		// Get what we're expecting from
		$test = $this->content_test_helper($content, $entity->content_bbcode_enabled(), $entity->content_magic_url_enabled(), $entity->content_smilies_enabled(), true);

		$this->assertSame($test['edit'], $entity->get_content_for_edit());

		$this->assertSame($test['display'], $entity->get_content_for_display());
	}
}
