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
		return new \phpbb\pages\textreparser\plugins\pages_text($this->db, 'phpbb_pages');
	}
}
