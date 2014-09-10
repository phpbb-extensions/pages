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

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
* Admin controller
*/
class admin_controller implements admin_interface
{
	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \phpbb\pages\operators\page */
	protected $page_operator;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var ContainerInterface */
	protected $phpbb_container;

	/** string Custom form action */
	protected $u_action;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper             $helper          Controller helper object
	* @param \phpbb\log\log                       $log             The phpBB log system
	* @param \phpbb\pages\operators\page          $page_operator   Pages operator object
	* @param \phpbb\template\template             $template        Template object
	* @param \phpbb\user                          $user            User object
	* @param ContainerInterface                   $phpbb_container Service container interface
	* @return \phpbb\pages\controller\admin_controller
	* @access public
	*/
	public function __construct(\phpbb\controller\helper $helper, \phpbb\log\log $log, \phpbb\pages\operators\page $page_operator, \phpbb\template\template $template, \phpbb\user $user, ContainerInterface $phpbb_container)
	{
		$this->helper = $helper;
		$this->log = $log;
		$this->page_operator = $page_operator;
		$this->template = $template;
		$this->user = $user;
		$this->container = $phpbb_container;
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
