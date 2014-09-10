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
		// Grab all the pages from the db
		$entities = $this->page_operator->get_pages();

		// Process each page entity for display
		foreach ($entities as $entity)
		{
			// Set output block vars for display in the template
			$this->template->assign_block_vars('pages', array(
				'PAGE_TITLE'		=> $entity->get_title(),
				'PAGE_DESCRIPTION'	=> $entity->get_description(),
				'PAGE_ROUTE'		=> $entity->get_route(),
				'PAGE_TEMPLATE'		=> $entity->get_template(),
				'PAGE_ORDER'		=> $entity->get_order(),

				'U_DELETE'			=> "{$this->u_action}&amp;action=delete&amp;page_id=" . $entity->get_id(),
				'U_EDIT'			=> "{$this->u_action}&amp;action=edit&amp;page_id=" . $entity->get_id(),
				'U_PAGE_ROUTE'		=> $this->helper->route('phpbb_pages_main_controller', array('route' => $entity->get_route())),
			));
		}

		// Set output vars for display in the template
		$this->template->assign_vars(array(
			'U_ACTION'		=> $this->u_action,
			'U_ADD_PAGE'	=> "{$this->u_action}&amp;action=add",
		));
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
		// Initiate and load the page entity
		$entity = $this->container->get('phpbb.pages.entity')->load($page_id);

		// Use a confirmation box routine when deleting a page
		if (confirm_box(true))
		{
			// Default confirmation message of deleted page and link back to the previous screen
			$message = $this->user->lang('ACP_PAGE_DELETE_SUCCESS') . adm_back_link($this->u_action);
			$errors = false;

			try
			{
				// Delete the page on confirmation
				$this->page_operator->delete_page($page_id);
			}
			catch (\phpbb\pages\exception\base $e)
			{
				// Display an error message if unable to delete successfully
				$message = $this->user->lang('ACP_PAGE_DELETE_ERRORED') . adm_back_link($this->u_action);
				$errors = true;
			}

			// Log the action
			if (!$errors)
			{
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'ACP_PAGE_DELETED_LOG', time(), array($entity->get_title()));
			}

			// Show user result message
			trigger_error($message);
		}
		else
		{
			// Request confirmation from the user to delete the page
			confirm_box(false, $this->user->lang('ACP_PAGE_DELETE_CONFIRM'));

			// Use a redirect to take the user back to the previous screen
			// if the user chose not delete the page from the confirmation page.
			redirect($this->u_action);
		}
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
