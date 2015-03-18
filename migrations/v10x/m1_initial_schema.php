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
* Migration stage 1: Initial schema
*/
class m1_initial_schema extends \phpbb\db\migration\migration
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
	* Add the pages table schema to the database:
	*	pages:
	*		page_id
	*		page_title
	*		page_description
	*		page_route
	*		page_order
	*		page_content
	*		page_content_bbcode_uid
	*		page_content_bbcode_bitfield
	*		page_content_bbcode_options
	*		page_content_allow_html
	*
	* @return array Array of table schema
	* @access public
	*/
	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'pages'	=> array(
					'COLUMNS'	=> array(
						'page_id'						=> array('UINT', null, 'auto_increment'),
						'page_title'					=> array('VCHAR:200', ''),
						'page_description'				=> array('VCHAR:255', ''),
						'page_route'					=> array('VCHAR:100', ''),
						'page_order'					=> array('UINT', 0),
						'page_content'					=> array('MTEXT_UNI', ''),
						'page_content_bbcode_uid'		=> array('VCHAR:8', ''),
						'page_content_bbcode_bitfield'	=> array('VCHAR:255', ''),
						'page_content_bbcode_options'	=> array('UINT:11', 7),
						'page_content_allow_html'		=> array('BOOL', 0),
						'page_display'					=> array('BOOL', 0),
						'page_display_to_guests'		=> array('BOOL', 0),
						'page_template'					=> array('VCHAR:255', ''),
					),
					'PRIMARY_KEY'	=> 'page_id',
				),
				$this->table_prefix . 'pages_links'	=> array(
					'COLUMNS'	=> array(
						'page_link_id'					=> array('UINT', null, 'auto_increment'),
						'page_link_location'			=> array('VCHAR:255', ''),
						'page_link_event_name'			=> array('VCHAR:255', ''),
					),
					'PRIMARY_KEY'	=> 'page_link_id',
				),
				$this->table_prefix . 'pages_pages_links'	=> array(
					'COLUMNS'	=> array(
						'page_id'						=> array('UINT', 0),
						'page_link_id'					=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> array('page_id', 'page_link_id'),
				),
			),
		);
	}

	/**
	* Drop the pages table schema from the database
	*
	* @return array Array of table schema
	* @access public
	*/
	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'pages',
				$this->table_prefix . 'pages_links',
				$this->table_prefix . 'pages_pages_links',
			),
		);
	}
}
