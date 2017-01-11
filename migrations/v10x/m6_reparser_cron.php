<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2016 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\migrations\v10x;

/**
 * Migration stage 6: Add reparser cron configs
 */
class m6_reparser_cron extends \phpbb\db\migration\migration
{
	/**
	 * Assign migration file dependencies for this migration
	 *
	 * @return array Array of migration files
	 * @static
	 * @access public
	 */
	static public function depends_on()
	{
		return array('\phpbb\pages\migrations\v10x\m5_update_link_names');
	}

	/**
	 * Check if the migration is effectively installed (entirely optional)
	 *
	 * @return bool True if this migration is installed, False if this migration is not installed
	 */
	public function effectively_installed()
	{
		return $this->config->offsetExists('text_reparser.phpbb_pages_text_cron_interval');
	}

	/**
	 * Add or update data in the database
	 *
	 * @return array Array of table data
	 * @access public
	 */
	public function update_data()
	{
		return array(
			array('config.add', array('text_reparser.phpbb_pages_text_cron_interval', 10)),
			array('config.add', array('text_reparser.phpbb_pages_text_last_cron', 0)),
		);
	}
}
