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
* Converter stage 1: Convert table name
*/
class c1_convert_table extends \phpbb\db\migration\migration
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
		return array('\phpbb\db\migration\data\v310\gold');
	}

	/**
	* Skip this migration if a previous pages table does not
	* exist, or our pages table is already installed
	*
	* @return bool True to skip this migration, false to run it
	* @access public
	*/
	public function effectively_installed()
	{
		return !$this->db_tools->sql_table_exists($this->table_prefix . 'pages') || $this->db_tools->sql_column_exists($this->table_prefix . 'pages', 'page_route');
	}

	/**
	* Update the table name
	*
	* @return array Array of table schema
	* @access public
	*/
	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'rename_pages_table'))),
		);
	}

	/**
	* Rename the previous pages table
	*
	* @return void
	* @access public
	*/
	public function rename_pages_table()
	{
		switch ($this->db->get_sql_layer())
		{
			// SQL Server dbms support this syntax
			case 'mssql':
			case 'mssql_odbc':
			case 'mssqlnative':
				$sql = "EXEC sp_rename '{$this->table_prefix}pages', '{$this->table_prefix}pages_mod_backup'";
			break;

			// All other dbms support this syntax
			default:
				$sql = "ALTER TABLE {$this->table_prefix}pages RENAME TO {$this->table_prefix}pages_mod_backup";
			break;
		}

		$this->db->sql_query($sql);
	}
}
