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
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var Container */
	protected $phpbb_container;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string phpEx */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \phpbb\config\config                $config             Config object
	* @param \phpbb\controller\helper            $helper             Controller helper object
	* @param Container                           $phpbb_container
	* @param \phpbb\template\template            $template           Template object
	* @param \phpbb\user                         $user               User object
	* @param string                              $root_path          phpBB root path
	* @param string                              $php_ext            phpEx
	* @return \phpbb\pages\controller\main_controller
	* @access public
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $helper, Container $phpbb_container, \phpbb\template\template $template, \phpbb\user $user, $root_path, $php_ext)
	{
		$this->config = $config;
		$this->helper = $helper;
		$this->phpbb_container = $phpbb_container;
		$this->template = $template;
		$this->user = $user;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
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

		$display = true;

		// Initiate the page entity
		$entity = $this->phpbb_container->get('phpbb.pages.entity');
		try
		{
			// Load the requested page by route
			$entity->load(0, $route);
		}
		catch (\phpbb\pages\exception\base $e)
		{
			$display = false;
		}

		// If user is a guest and page is not set to display to guests
		if ($this->user->data['user_id'] == ANONYMOUS && !$entity->get_page_display_to_guests())
		{
			$display = false;
		}

		// If page display is disabled
		if (!$entity->get_page_display())
		{
			$display = false;
		}

		// Set the page title
		$page_title = ($display) ? $entity->get_title() : $this->user->lang('INFORMATION');

		// Display the page content
		$this->template->assign_vars(array(
			'PAGE_CONTENT'			=> ($display) ? $entity->get_content_for_display() : $this->user->lang('PAGE_NOT_AVAILABLE', $route),
			'PAGE_TITLE'			=> $page_title,
		));

		// Assign breadcrumb template vars for the page if displayed
		if ($display)
		{
			$this->template->assign_block_vars('navlinks', array(
				'U_VIEW_FORUM'		=> $this->helper->route('phpbb_pages_main_controller', array('route' => $route)),
				'FORUM_NAME'		=> $page_title,
			));
		}

		// Send all data to the template file
		return $this->helper->render('pages_controller.html', $page_title);
	}
}
