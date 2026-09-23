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
class viewonline_test extends pages_functional_base
{
	/**
	* Visit a page as user "admin"
	*/
	public function test_viewonline_setup()
	{
		$this->login();
		$this->admin_login();

		// Store some of our data in variables
		$page_title = 'Viewonline Test Page';
		$page_content = 'This is a functional test page for Viewonline';

		// Create a test page
		$route = $this->create_page($page_title, $page_content);

		// Viewonline displays only the newest session for each registered user.
		// Session timestamps have one-second resolution, so ensure this page visit
		// is newer than the admin session used to create the page.
		sleep(1);

		// Send the admin to the test page
		$crawler = self::request('GET', "app.php/{$route}?sid={$this->sid}");
		self::assertStringContainsString($page_title, $crawler->filter('h2')->text());

		return $page_title;
	}

	/**
	* Test viewonline page for admin
	*
	* We use a second function here, so we get a new session and can login
	* without having to log out "admin" first.
	*
	* @depends test_viewonline_setup
	*/
	public function test_viewonline_check($page_title)
	{
		// Create user1 and send them to the Viewonline
		self::$client->restart();
		$this->create_user('user1');
		$this->login('user1');
		// PHP goes faster than DBMS, make sure session data got written to the database.
		sleep(1);
		$crawler = self::request('GET', "viewonline.php?sid={$this->sid}");

		// Is admin still viewing the test page?
		self::assertStringContainsString('admin', $crawler->filter('#page-body table.table1')->text());

		$session_entries = $crawler->filter('#page-body table.table1 tr')->count();
		self::assertGreaterThanOrEqual(3, $session_entries, 'Too few session entries found');

		// Check each entry in the viewonline table
		// Skip the first row (header)
		$admin_found = false;
		$expected_location = $this->lang('PAGES_VIEWONLINE', $page_title);
		$matching_session_found = false;
		for ($i = 1; $i < $session_entries; $i++)
		{
			// Multiple admin sessions can exist from earlier functional tests.
			// Look for the session visiting this test page rather than relying
			// on database row order.
			$subcrawler = $crawler->filter('#page-body table.table1 tr')->eq($i);
			if (strpos($subcrawler->filter('td')->text(), 'admin') !== false)
			{
				$admin_found = true;
				if (strpos($subcrawler->filter('td.info')->text(), $expected_location) !== false)
				{
					$matching_session_found = true;
					break;
				}
			}
		}

		self::assertTrue($admin_found, 'User "admin" was not found on viewonline page.');
		self::assertTrue($matching_session_found, 'The admin session for the Viewonline test page was not found.');
	}
}
