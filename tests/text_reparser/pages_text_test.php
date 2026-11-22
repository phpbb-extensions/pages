<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2016 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\tests\text_reparser;

include_once __DIR__ . '/../../../../../../tests/text_reparser/plugins/test_row_based_plugin.php';

class pages_text_test extends \phpbb_textreparser_test_row_based_plugin
{
	protected static function setup_extensions()
	{
		return array('phpbb/pages');
	}

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/fixtures/pages.xml');
	}

	protected function get_reparser()
	{
		$litedown = $this->getMockBuilder('\phpbb\pages\textformatter\litedown')
			->disableOriginalConstructor()
			->getMock();
		$litedown->method('parse')->willReturnCallback(function ($text) {
			return '<t>' . $text . '</t>';
		});

		return new \phpbb\pages\textreparser\plugins\pages_text($this->db, 'phpbb_pages', $litedown);
	}

	public static function literal_entities_data()
	{
		$escaped = '&amp;lt;b&amp;gt;literal&amp;lt;/b&amp;gt; &amp;quot;q&amp;quot; &amp;amp;lt;';

		return array(
			'HTML' => array('<t>&lt;i&gt;markup&lt;/i&gt; ' . $escaped . '</t>', 0, true),
			'BBCode' => array('<r><B><s>[b]</s>' . $escaped . '<e>[/b]</e></B></r>', OPTION_FLAG_BBCODE, false),
		);
	}

	/**
	 * @dataProvider literal_entities_data
	 */
	public function test_standard_reparse_preserves_literal_entities($text, $options, $allow_html)
	{
		$this->db->sql_query('UPDATE phpbb_pages SET ' . $this->db->sql_build_array('UPDATE', array(
			'page_content' => $text,
			'page_content_bbcode_options' => $options,
			'page_content_bbcode_uid' => '',
			'page_content_allow_html' => (int) $allow_html,
		)) . ' WHERE page_id = 2');

		$reparser = $this->get_reparser();
		$reparser->reparse_range(2, 2);
		self::assertSame($text, $this->get_rows(array(2))[0]['text']);

		$reparser->reparse_range(2, 2);
		self::assertSame($text, $this->get_rows(array(2))[0]['text']);
	}

	public function test_forced_reparse_preserves_literal_entities()
	{
		$text = '<t>[b]&amp;lt;literal&amp;gt;[/b]</t>';
		$this->db->sql_query('UPDATE phpbb_pages SET ' . $this->db->sql_build_array('UPDATE', array(
			'page_content' => $text,
			'page_content_bbcode_options' => 0,
			'page_content_bbcode_uid' => '',
		)) . ' WHERE page_id = 2');

		$reparser = $this->get_reparser();
		$reparser->disable_save();
		$reparser->reparse_range(2, 2, true);
		self::assertSame($text, $this->get_rows(array(2))[0]['text']);

		$reparser->enable_save();
		$reparser->reparse_range(2, 2, true);
		self::assertSame('<r><B><s>[b]</s>&amp;lt;literal&amp;gt;<e>[/b]</e></B></r>', $this->get_rows(array(2))[0]['text']);
	}

	public function test_markdown_reparse_decodes_entities_once()
	{
		$stored_text = '<t>&amp;lt;script&amp;gt;</t>';
		$litedown = $this->getMockBuilder('\phpbb\pages\textformatter\litedown')
			->disableOriginalConstructor()
			->getMock();
		$litedown->expects(self::once())
			->method('parse')
			->with('&lt;script&gt;', false, false, false, false)
			->willReturn($stored_text);

		$reparser = new \phpbb\pages\textreparser\plugins\pages_text($this->db, 'phpbb_pages', $litedown);
		$method = new \ReflectionMethod($reparser, 'reparse_record');
		$method->invoke($reparser, array(
			'text' => $stored_text,
			'markdown' => true,
			'options' => 0,
		));
	}
}
