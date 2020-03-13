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
class main_controller_test extends pages_functional_base
{
	/**
	 * Test Page appears in front end
	 *
	 * @return string $route
	 */
	public function test_display()
	{
		$this->login();
		$this->admin_login();

		$page_title = 'Front End Test Page';
		$page_content = 'This is a functional test page for the front end';

		// Create a page
		$route = $this->create_page($page_title, $page_content, ['page_title_switch' => true]);

		// Load the page
		$crawler = self::request('GET', "app.php/{$route}?sid={$this->sid}");

		// Assert the expected page exists
		$this->assertContains($page_title, $crawler->filter('#page-body')->text());
		$this->assertContains($page_content, $crawler->filter('#page-body')->text());

		// Assert the page title switch is working
		$this->assertContains("$page_title - yourdomain.com", $crawler->filter('title')->text());

		// Assert the page's link appears
		$page_links = $crawler->filter('#nav-main > li.icon-pages')->count();
		$this->assertGreaterThan(0, $page_links, 'No navbar page links found');

		// Assert the page's link is using the correct route
		for ($i = 0; $i < $page_links; $i++)
		{
			$subcrawler = $crawler->filter('#nav-main > li.icon-pages')->eq($i);
			if (strpos($subcrawler->text(), $page_title) !== false)
			{
				$this->assertContains($route, $subcrawler->filter('a')->attr('href'));
				return $route;
			}
		}

		// If we did not find the page link, we fail
		$this->fail('The page link could not be found in the navbar');

		return null;
	}

	/**
	 * Test Page appears when using legacy /page/route URL paths
	 *
	 * @param string $route
	 * @depends test_display
	 */
	public function test_display_legacy($route)
	{
		// Load the page
		$crawler = self::request('GET', "app.php/page/{$route}?sid={$this->sid}");

		// Assert the expected page exists
		$this->assertContains('Front End Test Page', $crawler->filter('#page-body')->text());
	}
}
