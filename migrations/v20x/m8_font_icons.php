<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2016 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\migrations\v20x;

/**
 * Migration stage 8: Add font icon support
 */
class m8_font_icons extends \phpbb\db\migration\migration
{
	/**
	 * (@inheritdoc)
	 */
	static public function depends_on()
	{
		return array('\phpbb\pages\migrations\v10x\m7_reparser_cron_update');
	}

	/**
	 * (@inheritdoc)
	 */
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists($this->table_prefix . 'pages', 'page_icon_font');
	}

	/**
	 * (@inheritdoc)
	 */
	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'pages'	=> array(
					'page_icon_font'	=> array('VCHAR:255', ''),
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
					'page_icon_font',
				),
			),
		);
	}
}
