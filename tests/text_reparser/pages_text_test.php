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
		$method->setAccessible(true);
		$method->invoke($reparser, array(
			'text' => $stored_text,
			'markdown' => true,
			'options' => 0,
		));
	}
}
