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
			'page_title_switch' => true,
			'page_description'	=> $page_description,
			'page_description_display' => true,
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

	/**
	 * Test each breadcrumb list maintains its own position sequence
	 */
	public function test_breadcrumb_positions()
	{
		$this->login();
		$this->admin_login();

		$this->create_page('First Breadcrumb Page', 'First breadcrumb page', array(
			'page_links' => array(3),
			'page_order' => 1,
		));
		$this->create_page('Second Breadcrumb Page', 'Second breadcrumb page', array(
			'page_links' => array(3),
			'page_order' => 2,
		));
		$this->create_page('Third Breadcrumb Page', 'Third breadcrumb page', array(
			'page_links' => array(4),
			'page_order' => 3,
		));
		$this->create_page('Fourth Breadcrumb Page', 'Fourth breadcrumb page', array(
			'page_links' => array(4),
			'page_order' => 4,
		));

		$crawler = self::request('GET', "index.php?sid={$this->sid}");
		$page_positions = $crawler->filter('#nav-breadcrumbs > li.icon-pages')->each(function ($node) {
			return $node->filter('meta[itemprop="position"]')->each(function ($position) {
				return (int) $position->attr('content');
			});
		});
		$core_positions = $crawler->filter('#nav-breadcrumbs > li.breadcrumbs:not(.icon-pages) meta[itemprop="position"]')->each(function ($node) {
			return (int) $node->attr('content');
		});

		self::assertSame(array(array(1), array(1), array(1), array(1)), $page_positions);
		self::assertSame(range(1, count($core_positions)), $core_positions);
	}
}
