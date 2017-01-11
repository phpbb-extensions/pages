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
 * Migration stage 7: Rename reparser cron configs
 */
class m7_reparser_cron_update extends \phpbb\db\migration\migration
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
		return array('\phpbb\pages\migrations\v10x\m6_reparser_cron');
	}

	/**
	 * Check if the migration is effectively installed (entirely optional)
	 *
	 * @return bool True if this migration is installed, False if this migration is not installed
	 */
	public function effectively_installed()
	{
		return $this->config->offsetExists('phpbb.pages.text_reparser.page_text_cron_interval');
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
			array('config.add', array('phpbb.pages.text_reparser.page_text_cron_interval', $this->config['text_reparser.phpbb_pages_text_cron_interval'])),
			array('config.add', array('phpbb.pages.text_reparser.page_text_last_cron', $this->config['text_reparser.phpbb_pages_text_last_cron'])),

			array('config.remove', array('text_reparser.phpbb_pages_text_cron_interval')),
			array('config.remove', array('text_reparser.phpbb_pages_text_last_cron')),
		);
	}
}
