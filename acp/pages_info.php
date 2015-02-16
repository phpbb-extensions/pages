<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\acp;

class pages_info
{
	public function module()
	{
		return array(
			'filename'	=> '\phpbb\pages\acp\pages_module',
			'title'		=> 'ACP_PAGES',
			'modes'		=> array(
				'manage'	=> array('title' => 'ACP_PAGES_MANAGE', 'auth' => 'ext_phpbb/pages && acl_a_pages', 'cat' => array('ACP_PAGES')),
			),
		);
	}
}
