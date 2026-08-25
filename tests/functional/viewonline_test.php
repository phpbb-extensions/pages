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

		// Viewonline only displays the first session for each registered user,
		// ordered by second-resolution session times. Ensure the page session is
		// newer than the admin's ACP session so database tie ordering cannot win.
		sleep(1);

		// Send the admin to the test page
		$crawler = self::request('GET', "index.php/{$route}?sid={$this->sid}");
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

		self::assertStringContainsString(
			$this->lang('PAGES_VIEWONLINE', $page_title),
			$crawler->filter('#page-body table.table1')->text()
		);
	}
}
