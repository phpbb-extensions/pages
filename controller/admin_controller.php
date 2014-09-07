<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\controller;

use Symfony\Component\DependencyInjection\Container;

/**
* Admin controller
*/
class admin_controller implements admin_interface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var Container */
	protected $phpbb_container;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string phpEx */
	protected $php_ext;

	/** string Custom form action */
	protected $u_action;

	/**
	* Constructor
	*
	* @param \phpbb\config\config                 $config          Config object
	* @param \phpbb\db\driver\driver_interface    $db              Database object
	* @param \phpbb\request\request               $request         Request object
	* @param \phpbb\template\template             $template        Template object
	* @param \phpbb\user                          $user            User object
	* @param Container                            $phpbb_container Service container
	* @param string                               $root_path       phpBB root path
	* @param string                               $php_ext         phpEx
	* @return \phpbb\pages\controller\admin_controller
	* @access public
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, Container $phpbb_container, $root_path, $php_ext)
	{
		$this->config = $config;
		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->container = $phpbb_container
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	/**
	* Display the pages
	*
	* @return null
	* @access public
	*/
	public function display_pages()
	{
		// @todo
	}

	/**
	* Add a page
	*
	* @return null
	* @access public
	*/
	public function add_page()
	{
		// @todo
	}

	/**
	* Edit a page
	*
	* @param int $page_id The page identifier to edit
	* @return null
	* @access public
	*/
	public function edit_page($page_id)
	{
		// @todo
	}

	/**
	* Process page data to be added or edited
	*
	* @param object $entity The page entity object
	* @param array $data The form data to be processed
	* @return null
	* @access protected
	*/
	protected function add_edit_page_data($entity, $data)
	{
		// @todo
	}

	/**
	* Delete a page
	*
	* @param int $page_id The page identifier to delete
	* @return null
	* @access public
	*/
	public function delete_page($page_id)
	{
		// @todo
	}

	/**
	* Set page url
	*
	* @param string $u_action Custom form action
	* @return null
	* @access public
	*/
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
