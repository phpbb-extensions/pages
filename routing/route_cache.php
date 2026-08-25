<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2026 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\routing;

/**
* Removes compiled routing files without purging unrelated caches.
*/
class route_cache
{
	/** @var \phpbb\filesystem\filesystem_interface */
	protected $filesystem;

	/** @var string */
	protected $cache_dir;

	/** @var string */
	protected $php_ext;

	/**
	* Constructor.
	*
	* @param \phpbb\filesystem\filesystem_interface $filesystem phpBB filesystem
	* @param string                                  $cache_dir  phpBB cache directory
	* @param string                                  $php_ext    PHP file extension
	*/
	public function __construct(\phpbb\filesystem\filesystem_interface $filesystem, $cache_dir, $php_ext)
	{
		$this->filesystem = $filesystem;
		$this->cache_dir = $cache_dir;
		$this->php_ext = $php_ext;
	}

	/**
	* Purge compiled URL matcher and generator files.
	*
	* @return void
	*/
	public function purge()
	{
		$route_files = array(
			$this->cache_dir . 'url_matcher.' . $this->php_ext,
			$this->cache_dir . 'url_generator.' . $this->php_ext,
		);

		if (function_exists('opcache_invalidate'))
		{
			foreach ($route_files as $route_file)
			{
				if ($this->filesystem->exists($route_file))
				{
					@opcache_invalidate($route_file, true);
				}
			}
		}

		$this->filesystem->remove(array(
			$route_files[0],
			$route_files[0] . '.meta',
			$route_files[1],
			$route_files[1] . '.meta',
		));
	}
}
