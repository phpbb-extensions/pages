<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\tests\textformatter;

class cache_test extends \phpbb_test_case
{
	public function test_invalidate_invalidates_core_and_pages_caches()
	{
		$core_cache = $this->createMock(\phpbb\textformatter\cache_interface::class);
		$pages_cache = $this->createMock(\phpbb\textformatter\cache_interface::class);
		$core_cache->expects(self::once())->method('invalidate');
		$pages_cache->expects(self::once())->method('invalidate');

		$cache = new \phpbb\pages\textformatter\cache($core_cache, $pages_cache);
		$cache->invalidate();
	}

	public function test_tidy_tidies_core_and_regenerates_pages_cache()
	{
		$core_cache = $this->createMock(\phpbb\textformatter\cache_interface::class);
		$pages_cache = $this->createMock(\phpbb\textformatter\cache_interface::class);
		$core_cache->expects(self::once())->method('tidy');
		$pages_cache->expects(self::once())->method('invalidate');

		$cache = new \phpbb\pages\textformatter\cache($core_cache, $pages_cache);
		$cache->tidy();
	}
}
