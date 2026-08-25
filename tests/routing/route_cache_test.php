<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2026 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\routing;

class route_cache_test extends \phpbb_test_case
{
	public function test_purge_removes_only_compiled_route_files()
	{
		$filesystem = $this->createMock('\phpbb\filesystem\filesystem_interface');
		$filesystem->method('exists')->willReturn(false);
		$filesystem->expects(self::once())
			->method('remove')
			->with(array(
				'/cache/url_matcher.php',
				'/cache/url_matcher.php.meta',
				'/cache/url_generator.php',
				'/cache/url_generator.php.meta',
			));

		$route_cache = new \phpbb\pages\routing\route_cache($filesystem, '/cache/', 'php');
		$route_cache->purge();
	}
}
