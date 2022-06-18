<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2020 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\migrations\v20x;

/**
 * Migration stage 10: Add display description option
 */
class m10_display_description extends \phpbb\db\migration\migration
{
	/**
	 * (@inheritdoc)
	 */
	public static function depends_on()
	{
		return [
			'\phpbb\pages\migrations\v10x\m1_initial_schema',
			'\phpbb\pages\migrations\v20x\m9_page_title_switch',
		];
	}

	/**
	 * (@inheritdoc)
	 */
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists($this->table_prefix . 'pages', 'page_description_display');
	}

	/**
	 * (@inheritdoc)
	 */
	public function update_schema()
	{
		return [
			'add_columns'	=> [
				$this->table_prefix . 'pages'	=> [
					'page_description_display'	=> ['BOOL', 0],
				],
			],
		];
	}

	/**
	 * (@inheritdoc)
	 */
	public function revert_schema()
	{
		return [
			'drop_columns'	=> [
				$this->table_prefix . 'pages'	=> [
					'page_description_display',
				],
			],
		];
	}
}
