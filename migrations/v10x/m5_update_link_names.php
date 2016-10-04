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
* Migration stage 5: Update link location names
*/
class m5_update_link_names extends \phpbb\db\migration\migration
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
		return array('\phpbb\pages\migrations\v10x\m2_initial_data');
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
			array('custom', array(array($this, 'update_page_link_location_data'))),
		);
	}

	/**
	* Update link location names in the database
	*
	* @return void
	* @access public
	*/
	public function update_page_link_location_data()
	{
		// Map the old names to new names
		$map_names = array(
			'Nav Bar Before Links'			=> 'NAV_BAR_LINKS_BEFORE',
			'Nav Bar After Links'			=> 'NAV_BAR_LINKS_AFTER',
			'Nav Bar Before Breadcrumbs'	=> 'NAV_BAR_CRUMBS_BEFORE',
			'Nav Bar After Breadcrumbs'		=> 'NAV_BAR_CRUMBS_AFTER',
			'Footer Before Time Zone'		=> 'FOOTER_TIMEZONE_BEFORE',
			'Footer After Time Zone'		=> 'FOOTER_TIMEZONE_AFTER',
			'Footer Before Team Link'		=> 'FOOTER_TEAMS_BEFORE',
			'Footer After Team Link'		=> 'FOOTER_TEAMS_AFTER',
			'Quick links Menu Top'			=> 'QUICK_LINK_MENU_BEFORE',
			'Quick Links Menu Bottom'		=> 'QUICK_LINK_MENU_AFTER',
		);

		foreach ($map_names as $old_name => $new_name)
		{
			$sql = 'UPDATE ' . $this->table_prefix . 'pages_links' . "
				SET page_link_location = '{$new_name}'
				WHERE page_link_location = '{$old_name}'";
			$this->db->sql_query($sql);
		}
	}
}
