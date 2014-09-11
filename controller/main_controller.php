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
* Main controller
*/
class main_controller implements main_interface
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var ContainerInterface */
	protected $container;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\auth\auth            $auth         Authentication object
	* @param ContainerInterface          $container    Service container interface
	* @param \phpbb\controller\helper    $helper       Controller helper object
	* @param \phpbb\template\template    $template     Template object
	* @param \phpbb\user                 $user         User object
	* @return \phpbb\pages\controller\main_controller
	* @access public
	*/
	public function __construct(\phpbb\auth\auth $auth, ContainerInterface $container, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->auth = $auth;
		$this->container = $container;
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* Display the page
	*
	* @param string $route The route name for a page
	* @return Symfony\Component\HttpFoundation\Response A Symfony Response object
	* @access public
	*/
	public function display($route)
	{
		// Add the pages controller language file
		$this->user->add_lang_ext('phpbb/pages', 'pages_controller');

		// Load the page data to display
		$display = $this->load_page_data($route);

		// Set the page title to use
		$page_title = ($display) ? $display->get_title() : $this->user->lang('INFORMATION');

		// Assign the page data to template variables
		$this->template->assign_vars(array(
			'PAGE_TITLE'	=> $page_title,
			'PAGE_CONTENT'	=> ($display) ? $display->get_content_for_display() : $this->user->lang('PAGE_NOT_AVAILABLE', $route),
		));

		// Create breadcrumbs
		if ($display)
		{
			$this->template->assign_block_vars('navlinks', array(
				'FORUM_NAME'	=> $page_title,
				'U_VIEW_FORUM'	=> $this->helper->route('phpbb_pages_main_controller', array('route' => $route)),
			));
		}

		// Send all data to the template file
		return $this->helper->render('pages_default.html', $page_title);
	}

	/**
	* Load the page data
	*
	* @param string $route The route name for a page
	* @return object $entity The entity object, or false if page can't be displayed
	* @access public
	*/
	protected function load_page_data($route)
	{
		// Initiate the page entity
		$entity = $this->container->get('phpbb.pages.entity');

		// Load the requested page by route
		try
		{
			$entity->load(0, $route);
		}
		catch (\phpbb\pages\exception\base $e)
		{
			return false;
		}

		// Return false if page display to guests is disabled
		if ($this->user->data['user_id'] == ANONYMOUS && !$entity->get_page_display_to_guests())
		{
			return false;
		}

		// Return false if page display is disabled and user is not an admin
		if (!$this->auth->acl_get('a_') && !$entity->get_page_display())
		{
			return false;
		}

		return $entity;
	}
}
