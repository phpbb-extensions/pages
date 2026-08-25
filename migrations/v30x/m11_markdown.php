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
 * Migration stage 11: Add Markdown content option
 */
class m11_markdown extends \phpbb\db\migration\migration
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return array(
			'\phpbb\pages\migrations\v10x\m1_initial_schema',
			'\phpbb\pages\migrations\v20x\m10_display_description'
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists($this->table_prefix . 'pages', 'page_content_markdown');
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_schema()
	{
		return array(
			'add_columns' => array(
				$this->table_prefix . 'pages' => array(
					'page_content_markdown' => array('BOOL', 0),
				),
			),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function revert_schema()
	{
		return array(
			'drop_columns' => array(
				$this->table_prefix . 'pages' => array(
					'page_content_markdown',
				),
			),
		);
	}
}
