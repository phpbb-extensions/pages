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
use phpbb\exception\http_exception;

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

	/** @var \phpbb\language\language */
	protected $lang;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\auth\auth         $auth      Authentication object
	* @param ContainerInterface       $container Service container interface
	* @param \phpbb\controller\helper $helper    Controller helper object
	* @param \phpbb\language\language $lang      Language object
	* @param \phpbb\template\template $template  Template object
	* @param \phpbb\user              $user      User object
	* @access public
	*/
	public function __construct(\phpbb\auth\auth $auth, ContainerInterface $container, \phpbb\controller\helper $helper, \phpbb\language\language $lang, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->auth = $auth;
		$this->container = $container;
		$this->helper = $helper;
		$this->lang = $lang;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* Display the page
	*
	* @param string $route The route name for a page
	* @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	* @throws http_exception
	* @access public
	*/
	public function display($route)
	{
		// Add the pages controller language file
		$this->lang->add_lang('pages_controller', 'phpbb/pages');

		// Load the page data to display
		$page = $this->load_page_data($route);

		// Set the page title
		$page_title = $page->get_title();

		// Assign the page data to template variables
		$this->template->assign_vars(array(
			'PAGE_TITLE'	=> $page_title,
			'PAGE_CONTENT'	=> $page->get_content_for_display(),
			'S_VIEWTOPIC'	=> $page->get_page_title_switch(), // true will trick page title into showing page name before site name
		));

		// Create breadcrumbs
		$this->template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $page_title,
			'U_VIEW_FORUM'	=> $this->helper->route('phpbb_pages_dynamic_route_' . $page->get_id()),
		));

		// Send all data to the template file
		return $this->helper->render($page->get_template(), $page_title);
	}

	/**
	* Load the page data
	*
	* @param string $route The route name for a page
	* @return \phpbb\pages\entity\page_interface $entity The entity object
	* @throws http_exception
	* @access public
	*/
	protected function load_page_data($route)
	{
		// Initiate the page entity
		/* @var $entity \phpbb\pages\entity\page */
		$entity = $this->container->get('phpbb.pages.entity');

		// Load the requested page by route
		try
		{
			$entity->load(0, $route);
		}
		catch (\phpbb\pages\exception\base $e)
		{
			throw new http_exception(404, 'PAGE_NOT_AVAILABLE', array($route));
		}

		// Throw 404 error if page display to guests is disabled
		if ($this->user->data['user_id'] == ANONYMOUS && !$entity->get_page_display_to_guests())
		{
			throw new http_exception(404, 'PAGE_NOT_AVAILABLE', array($route));
		}

		// Throw 404 error if page display is disabled and user is not an admin
		if (!$this->auth->acl_get('a_') && !$entity->get_page_display())
		{
			throw new http_exception(404, 'PAGE_NOT_AVAILABLE', array($route));
		}

		return $entity;
	}
}
