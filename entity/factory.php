<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2026 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\entity;

use phpbb\config\config;
use phpbb\db\driver\driver_interface;
use phpbb\event\dispatcher_interface;
use phpbb\pages\textformatter\litedown;
use phpbb\textformatter\s9e\utils;

/**
 * Factory for page entities.
 */
class factory
{
	/** @var driver_interface */
	protected $db;

	/** @var config */
	protected $config;

	/** @var dispatcher_interface */
	protected $dispatcher;

	/** @var string */
	protected $pages_table;

	/** @var utils */
	protected $text_formatter_utils;

	/** @var litedown */
	protected $litedown;

	/**
	 * Constructor.
	 *
	 * @param driver_interface $db
	 * @param config $config
	 * @param dispatcher_interface $dispatcher
	 * @param string $pages_table
	 * @param utils $text_formatter_utils
	 * @param litedown $litedown
	 */
	public function __construct(driver_interface $db, config $config, dispatcher_interface $dispatcher, string $pages_table, utils $text_formatter_utils, litedown $litedown)
	{
		$this->db = $db;
		$this->config = $config;
		$this->dispatcher = $dispatcher;
		$this->pages_table = $pages_table;
		$this->text_formatter_utils = $text_formatter_utils;
		$this->litedown = $litedown;
	}

	/**
	 * Create a fresh page entity.
	 *
	 * @return page_interface
	 */
	public function create()
	{
		return new page(
			$this->db,
			$this->config,
			$this->dispatcher,
			$this->pages_table,
			$this->text_formatter_utils,
			$this->litedown
		);
	}
}
