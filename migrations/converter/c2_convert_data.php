<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\migrations\converter;

/**
* Converter stage 2: Convert data
*/
class c2_convert_data extends \phpbb\db\migration\migration
{
	/**
	* Skip this migration if pages_mod_backup table does not exists
	*
	* @return bool True if table does not exist
	* @access public
	*/
	public function effectively_installed()
	{
		return !$this->db_tools->sql_table_exists($this->table_prefix . 'pages_mod_backup');
	}

	/**
	* Assign migration file dependencies for this migration
	*
	* @return array Array of migration files
	* @static
	* @access public
	*/
	static public function depends_on()
	{
		return array(
			'\phpbb\pages\migrations\converter\c1_convert_table',
			'\phpbb\pages\migrations\v10x\m1_initial_schema',
		);
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
			array('custom', array(array($this, 'convert_pages_data'))),
		);
	}

	/**
	* Custom function to convert and add Pages MOD data
	*
	* @return void
	* @access public
	*/
	public function convert_pages_data()
	{
		$import_data = array();

		// Load all the Pages MOD data
		$sql = 'SELECT * FROM ' . $this->table_prefix . 'pages_mod_backup';
		$result = $this->db->sql_query($sql);

		// Map the Pages MOD data to our import array, and perform any data changes as needed
		while ($row = $this->db->sql_fetchrow($result))
		{
			// Data to import
			$import_data[$row['page_id']]['page_title']						= isset($row['page_title']) ? substr($row['page_title'], 0, 200) : '';
			$import_data[$row['page_id']]['page_description']				= isset($row['page_desc']) ? substr($row['page_desc'], 0, 255) : '';
			$import_data[$row['page_id']]['page_route']						= isset($row['page_url']) ? substr($row['page_url'], 0, 100) : '';
			$import_data[$row['page_id']]['page_order']						= isset($row['page_order']) ? min($row['page_order'], 16777215) : 0;
			$import_data[$row['page_id']]['page_content']					= isset($row['page_content']) ? $row['page_content'] : '';
			$import_data[$row['page_id']]['page_content_bbcode_uid']		= isset($row['bbcode_uid']) ? $row['bbcode_uid'] : '';
			$import_data[$row['page_id']]['page_content_bbcode_bitfield']	= isset($row['bbcode_bitfield']) ? $row['bbcode_bitfield'] : '';
			$import_data[$row['page_id']]['page_display']					= isset($row['page_display']) ? $row['page_display'] : 0;
			$import_data[$row['page_id']]['page_display_to_guests']			= isset($row['page_display_guests']) ? $row['page_display_guests'] : 0;

			// Data added by Pages extension
			$import_data[$row['page_id']]['page_content_bbcode_options']	= 7;
			$import_data[$row['page_id']]['page_content_allow_html']		= 0;
			$import_data[$row['page_id']]['page_template']					= 'pages_default.html';

			// Data not imported
			// $row['page_time']
			// $row['page_author']
		}
		$this->db->sql_freeresult($result);

		// If we have data to import, let's go!! :)
		if (!empty($import_data))
		{
			// Load the insert buffer class to perform a buffered multi insert
			$insert_buffer = new \phpbb\db\sql_insert_buffer($this->db, $this->table_prefix . 'pages');

			// Insert imported data to our Pages table
			foreach ($import_data as $page_data)
			{
				$insert_buffer->insert($page_data);
			}

			// Flush the buffer
			$insert_buffer->flush();
		}
	}
}
