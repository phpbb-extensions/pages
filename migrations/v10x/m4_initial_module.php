<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\migrations\v10x;

/**
* Migration stage 4: Initial module
*/
class m4_initial_module extends \phpbb\db\migration\migration
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
		return array(
			'\phpbb\pages\migrations\converter\c3_convert_module',
			'\phpbb\pages\migrations\v10x\m3_initial_permission',
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
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_PAGES')),
			array('module.add', array(
				'acp', 'ACP_PAGES', array(
					'module_basename'	=> '\phpbb\pages\acp\pages_module',
					'modes'				=> array('manage'),
				),
			)),
		);
	}
}
