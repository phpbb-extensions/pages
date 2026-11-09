<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\textformatter;

/**
 * Keeps the core and Pages text formatter caches synchronized
 */
class cache implements \phpbb\textformatter\cache_interface
{
	/** @var \phpbb\textformatter\cache_interface */
	protected $core_cache;

	/** @var \phpbb\textformatter\cache_interface */
	protected $pages_cache;

	/**
	 * Constructor
	 *
	 * @param \phpbb\textformatter\cache_interface $core_cache  Core text formatter cache
	 * @param \phpbb\textformatter\cache_interface $pages_cache Pages text formatter cache
	 */
	public function __construct(\phpbb\textformatter\cache_interface $core_cache, \phpbb\textformatter\cache_interface $pages_cache)
	{
		$this->core_cache = $core_cache;
		$this->pages_cache = $pages_cache;
	}

	/**
	 * {@inheritdoc}
	 */
	public function invalidate()
	{
		$this->core_cache->invalidate();
		$this->pages_cache->invalidate();
	}

	/**
	 * {@inheritdoc}
	 */
	public function tidy()
	{
		$this->core_cache->tidy();

		// Core and Pages renderers share a directory. Core tidy removes the
		// Pages renderer, so regenerate both Pages cache entries together.
		$this->pages_cache->invalidate();
	}
}
