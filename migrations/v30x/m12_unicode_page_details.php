<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\migrations\v30x;

/**
 * Migration stage 12: Add Unicode support to page titles and descriptions
 */
class m12_unicode_page_details extends \phpbb\db\migration\migration
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return array(
			'\phpbb\pages\migrations\v10x\m1_initial_schema',
			'\phpbb\pages\migrations\v30x\m11_markdown',
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_schema()
	{
		return array(
			'change_columns' => array(
				$this->table_prefix . 'pages' => array(
					'page_title' => array('VCHAR_UNI:200', ''),
					'page_description' => array('VCHAR_UNI:255', ''),
				),
			),
		);
	}

	/**
	 * Keep the changed columns until the initial schema migration drops the table.
	 * Reverting them could fail when existing data no longer fits the old types.
	 *
	 * @return array Array of table schema changes
	 */
	public function revert_schema()
	{
		return array();
	}
}
