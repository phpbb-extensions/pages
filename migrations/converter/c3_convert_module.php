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
* Converter stage 3: Convert module
*/
class c3_convert_module extends \phpbb\db\migration\container_aware_migration
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
		return array('\phpbb\pages\migrations\converter\c1_convert_table');
	}

	/**
	* Skip this migration if an ACP_PAGES module does not exist
	*
	* @return bool True if table does not exist
	* @access public
	*/
	public function effectively_installed()
	{
		$sql = 'SELECT module_id
			FROM ' . $this->table_prefix . "modules
			WHERE module_class = 'acp'
				AND module_langname = 'ACP_PAGES'";
		$result = $this->db->sql_query($sql);
		$module_id = (int) $this->db->sql_fetchfield('module_id');
		$this->db->sql_freeresult($result);

		// Skip migration if ACP_PAGES module does not exist
		return !$module_id;
	}

	/**
	* Add or update data in the database
	*
	* @return array Array of table data
	* @access public
	*/
	public function update_data()
	{
		// use module tool explicitly since module.exists does not work in 'if'
		$module_tool = $this->container->get('migrator.tool.module');

		return array(
			// Remove old ACP_PAGES module if it exists
			array('if', array(
				$module_tool->exists('acp', false, 'ACP_PAGES', true),
				array('module.remove', array('acp', false, 'ACP_PAGES')),
			)),
		);
	}
}
