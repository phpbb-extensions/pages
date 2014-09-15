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
	*
	* @access public
	*/
	public function test_version_check()
	{
		$this->markTestSkipped('Version info files not online yet.');

		// Log in to the ACP
		$this->login();
		$this->admin_login();

		// Load the Extension Manager module and re-check all versions
		$crawler = self::request('GET', "adm/index.php?i=acp_extensions&mode=main&action=list&versioncheck_force=1&sid={$this->sid}");

		// Assert that the name of our extension is in the extension manager list
		$this->assertContains(strtolower($this->lang('ACP_PAGES')), strtolower($crawler->filter('tr.ext_enabled td')->eq(0)->text()));

		// Assert that the version check feature is working
		// The extension name is always strong, but the extension version will also be strong
		// if the version check feature is working, so we test for more than one strong tag.
		$this->assertGreaterThan(1, $crawler->filter('tr.ext_enabled td strong')->count());
	}
}
