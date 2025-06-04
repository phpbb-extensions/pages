<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2025 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace functional;

use phpbb\pages\tests\functional\pages_functional_base;

/**
 * @group functional
 */
class cron_reparser_test extends pages_functional_base
{
	/**
	 * Test the cron reparser functionality
	 */
	public function test_cron_reparser()
	{
		$this->login();
		$this->admin_login();

		// Store some of our data in variables
		$page_title = 'Cron Reparser Test Page';
		$page_content = '[b]This is a functional test page for the cron task reparser.[/b]';

		// Create a test page
		$route = $this->create_page($page_title, $page_content);

		// Go to the test page
		$crawler = self::request('GET', "app.php/$route?sid=$this->sid");
		$this->assertStringContainsString($page_title, $crawler->filter('h2')->text());

		// Assert no reparsers have run yet
		$this->assertEmpty($this->get_reparser_resume());

		// Run the cron task to reparse pages
		self::request('GET', "app.php/cron/cron.task.text_reparser.phpbb_pages", [], false);

		// Try to ensure that the cron can actually run before we start to wait for it
		sleep(1);
		$cron_lock = new \phpbb\lock\db(
			'cron_lock',
			new \phpbb\config\db(
				$this->db,
				new \phpbb\cache\driver\dummy(),
				'phpbb_config'
			),
			$this->db
		);

		// Add timeout to prevent infinite loop
		$timeout = time() + 30; // 30-second timeout
		while (!$cron_lock->acquire())
		{
			if (time() > $timeout)
			{
				$this->fail('Cron lock could not be acquired within 30 seconds');
			}
			usleep(100000); // Sleep for 100 ms between attempts
		}
		$cron_lock->release();

		// Assert there's now a record of reparsing pages in the database
		$this->assertEquals(
			['phpbb.pages.text_reparser.page_text'],
			array_keys(unserialize($this->get_reparser_resume(), ['allowed_classes' => false]))
		);
	}

	/**
	 * Get the reparser resume data from the database
	 *
	 * @return string|null The config value or null if not found
	 */
	private function get_reparser_resume()
	{
		$sql = "SELECT config_value
			FROM " . CONFIG_TEXT_TABLE . "
			WHERE config_name = 'reparser_resume'";
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return $row['config_value'] ?? null;
	}
}
