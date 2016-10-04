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
* Migration stage 2: Initial data
*/
class m2_initial_data extends \phpbb\db\migration\migration
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
		return array('\phpbb\pages\migrations\v10x\m1_initial_schema');
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
			array('custom', array(array($this, 'add_page_link_location_data'))),
		);
	}

	/**
	* Add pages link locations to the database
	*
	* @return void
	* @access public
	*/
	public function add_page_link_location_data()
	{
		// Load the insert buffer class to perform a buffered multi insert
		$insert_buffer = new \phpbb\db\sql_insert_buffer($this->db, $this->table_prefix . 'pages_links');

		// Define our default page link locations/events
		// NOTE: These names are updated in m5_update_link_names.php
		$page_link_locations = array(
			// event name						=>	// description
			'overall_header_navigation_prepend'	=> 'Nav Bar Before Links',
			'overall_header_navigation_append'	=> 'Nav Bar After Links',
			'overall_header_breadcrumbs_before'	=> 'Nav Bar Before Breadcrumbs',
			'overall_header_breadcrumbs_after'	=> 'Nav Bar After Breadcrumbs',
			'overall_footer_timezone_before'	=> 'Footer Before Time Zone',
			'overall_footer_timezone_after'		=> 'Footer After Time Zone',
			'overall_footer_teamlink_before'	=> 'Footer Before Team Link',
			'overall_footer_teamlink_after'		=> 'Footer After Team Link',
			'navbar_header_quick_links_before'	=> 'Quick links Menu Top',
			'navbar_header_quick_links_after'	=> 'Quick Links Menu Bottom',
		);

		// Insert data
		foreach ($page_link_locations as $event => $location)
		{
			$insert_buffer->insert(array(
				'page_link_location'	=> $location,
				'page_link_event_name'	=> $event,
			));
		}

		// Flush the buffer
		$insert_buffer->flush();
	}
}
