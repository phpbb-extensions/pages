<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2016 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\textreparser\plugins;

class pages_text extends \phpbb\textreparser\row_based_plugin
{
	/**
	 * {@inheritdoc}
	 */
	public function get_columns()
	{
		return array(
			'id'			=> 'page_id',
			'text'			=> 'page_content',
			'bbcode_uid'	=> 'page_content_bbcode_uid',
			'options'		=> 'page_content_bbcode_options',
		);
	}
}
