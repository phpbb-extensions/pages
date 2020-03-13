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
 * Migration stage 9: Add page title switch setting for pages
 */
class m9_page_title_switch extends \phpbb\db\migration\migration
{
	/**
	 * (@inheritdoc)
	 */
	static public function depends_on()
	{
		return array('\phpbb\pages\migrations\v20x\m8_font_icons');
	}

	/**
	 * (@inheritdoc)
	 */
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists($this->table_prefix . 'pages', 'page_title_switch');
	}

	/**
	 * (@inheritdoc)
	 */
	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'pages'	=> array(
					'page_title_switch'	=> array('BOOL', 0),
				),
			),
		);
	}

	/**
	 * (@inheritdoc)
	 */
	public function revert_schema()
	{
		return array(
			'drop_columns'	=> array(
				$this->table_prefix . 'pages'	=> array(
					'page_title_switch',
				),
			),
		);
	}
}
