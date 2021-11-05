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
		$page_description = 'Functional test page description';

		// Create a page
		$route = $this->create_page($page_title, $page_content, [
			'page_title_switch' => 1,
			'page_description'	=> $page_description,
			'page_description_display' => 1,
		]);

		// Load the page
		$crawler = self::request('GET', "app.php/{$route}?sid={$this->sid}");

		// Assert the expected page exists
		self::assertStringContainsString($page_title, $crawler->filter('#page-body')->text());
		self::assertStringContainsString($page_content, $crawler->filter('#page-body')->text());

		// Assert the page title switch is working
		self::assertStringContainsString("$page_title - yourdomain.com", $crawler->filter('title')->text());

		// Assert the page's link appears
		$page_links = $crawler->filter('#nav-main > li.icon-pages')->count();
		self::assertGreaterThan(0, $page_links, 'No navbar page links found');

		// Assert the page's link is using the correct href route and title
		for ($i = 0; $i < $page_links; $i++)
		{
			$subcrawler = $crawler->filter('#nav-main > li.icon-pages')->eq($i);
			if (strpos($subcrawler->text(), $page_title) !== false)
			{
				self::assertStringContainsString($route, $subcrawler->filter('a')->attr('href'));
				self::assertStringContainsString($page_description, $subcrawler->filter('a')->attr('title'));
				return $route;
			}
		}

		// If we did not find the page link, we fail
		self::fail('The page link could not be found in the navbar');

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
		self::assertStringContainsString('Front End Test Page', $crawler->filter('#page-body')->text());
	}
}
