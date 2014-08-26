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
* Main controller
*/
class main_controller implements main_interface
{
	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var Container */
	protected $phpbb_container;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var array */
	protected $output;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper    $helper             Controller helper object
	* @param Container                   $phpbb_container    Service container
	* @param \phpbb\template\template    $template           Template object
	* @param \phpbb\user                 $user               User object
	* @return \phpbb\pages\controller\main_controller
	* @access public
	*/
	public function __construct(\phpbb\controller\helper $helper, Container $phpbb_container, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->helper = $helper;
		$this->phpbb_container = $phpbb_container;
		$this->template = $template;
		$this->user = $user;
		$this->output = array();
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
		// Add pages controller language file
		$this->user->add_lang_ext('phpbb/pages', 'pages_controller');

		// Load the page data to display
		$display = $this->load_page_data($route);

		// Store the page data in the output array
		$this->output['page_route'] = $route;
		$this->output['page_title'] = ($display) ? $display->get_title() : $this->user->lang('INFORMATION');
		$this->output['page_content'] = ($display) ? $display->get_content_for_display() : $this->user->lang('PAGE_NOT_AVAILABLE', $route);

		// Assign all page template vars
		$this->assign_template_vars();
		$this->assign_breadcrumbs($display);

		// Send all data to the template file
		return $this->helper->render('pages_controller.html', $this->output['page_title']);
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
		$entity = $this->phpbb_container->get('phpbb.pages.entity');

		// Load the requested page by route
		try
		{
			$entity->load(0, $route);
		}
		catch (\phpbb\pages\exception\base $e)
		{
			return false;
		}

		// If user is a guest and page is not set to display to guests
		if ($this->user->data['user_id'] == ANONYMOUS && !$entity->get_page_display_to_guests())
		{
			return false;
		}

		// If page display is disabled
		if (!$entity->get_page_display())
		{
			return false;
		}

		return $entity;
	}

	/**
	* Assign the page content to template variable
	*
	* @return null
	* @access protected
	*/
	protected function assign_template_vars()
	{
		$this->template->assign_vars(array(
			'PAGE_CONTENT'	=> (isset($this->output['page_content'])) ? $this->output['page_content'] : '',
			'PAGE_TITLE'	=> (isset($this->output['page_title'])) ? $this->output['page_title'] : '',
		));
	}

	/**
	* Create breadcrumbs
	*
	* @param object $display The display entity object
	* @return null
	* @access protected
	*/
	protected function assign_breadcrumbs($display = false)
	{
		if ($display)
		{
			$this->template->assign_block_vars('navlinks', array(
				'U_VIEW_FORUM'	=> $this->helper->route('phpbb_pages_main_controller', array('route' => $this->output['page_route'])),
				'FORUM_NAME'	=> (isset($this->output['page_title'])) ? $this->output['page_title'] : '',
			));
		}
	}
}
