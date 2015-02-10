<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\functional;

/**
* @group functional
*/
class version_check_test extends pages_functional_base
{
	/**
	* Test extension manager version check
	*/
	public function test_version_check()
	{
		// Log in to the ACP
		$this->login();
		$this->admin_login();

		$this->add_lang('acp/extensions');

		// Load the Pages extension details
		$crawler = self::request('GET', 'adm/index.php?i=acp_extensions&mode=main&action=details&ext_name=phpbb%2Fpages&sid=' . $this->sid);

		// Assert extension is up to date
		$this->assertGreaterThan(0, $crawler->filter('.successbox')->count());
		$this->assertContains($this->lang('UP_TO_DATE', 'Pages'), $crawler->text());
	}
}
