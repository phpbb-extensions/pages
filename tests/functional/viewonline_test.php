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
		$this->create_user('user1');
		$this->login('user1');
		$crawler = self::request('GET', "viewonline.php?sid={$this->sid}");

		// Is admin still viewing the test page
		self::assertStringContainsString('admin', $crawler->filter('#page-body table.table1')->text());

		$session_entries = $crawler->filter('#page-body table.table1 tr')->count();
		self::assertGreaterThanOrEqual(3, $session_entries, 'Too few session entries found');

		// Check each entry in the viewonline table
		// Skip the first row (header)
		for ($i = 1; $i < $session_entries; $i++)
		{
			// If we found the admin, we check his page info and leave
			$subcrawler = $crawler->filter('#page-body table.table1 tr')->eq($i);
			if (strpos($subcrawler->filter('td')->text(), 'admin') !== false)
			{
				self::assertStringContainsString($this->lang('PAGES_VIEWONLINE', $page_title), $subcrawler->filter('td.info')->text());
				return;
			}
		}

		// If we did not find the admin, we fail
		self::fail('User "admin" was not found on viewonline page.');
	}
}
