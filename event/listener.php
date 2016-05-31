<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\pages\operators\page */
	protected $page_operator;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpbb_root_path */
	protected $phpbb_root_path;

	/** @var string phpEx */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \phpbb\auth\auth               $auth               Authentication object
	* @param \phpbb\controller\helper       $helper             Controller helper object
	* @param \phpbb\pages\operators\page    $page_operator      Pages operator object
	* @param \phpbb\template\template       $template           Template object
	* @param \phpbb\user                    $user               User object
	* @param string                         $phpbb_root_path    phpbb_root_path
	* @param string                         $php_ext            phpEx
	* @access public
	*/
	public function __construct(\phpbb\auth\auth $auth, \phpbb\controller\helper $helper, \phpbb\pages\operators\page $page_operator, \phpbb\template\template $template, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->helper = $helper;
		$this->page_operator = $page_operator;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header'						=> 'show_page_links',
			'core.permissions'						=> 'add_permission',
			'core.viewonline_overwrite_location'	=> 'viewonline_page',
		);
	}

	/**
	* Add administrative permissions to manage Pages
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function add_permission($event)
	{
		$permissions = $event['permissions'];
		$permissions['a_pages'] = array('lang' => 'ACL_A_PAGES', 'cat' => 'misc');
		$event['permissions'] = $permissions;
	}

	/**
	* Display links to pages in the specified page link locations
	*
	* @return null
	* @access public
	*/
	public function show_page_links()
	{
		// Get all page link data
		$rowset = $this->page_operator->get_page_links();

		// Get custom page link icons
		$pages_icons = $this->page_operator->get_page_icons();

		foreach ($rowset as $row)
		{
			// Skip page if it should not be displayed (admins always have access to a page)
			if ((!$row['page_display'] && !$this->auth->acl_get('a_')) || (!$row['page_display_to_guests'] && $this->user->data['user_id'] == ANONYMOUS))
			{
				continue;
			}

			// Assign any available custom icons for the current link in the user's style
			$custom_icon = '';
			foreach ($pages_icons as $icon_path => $ext_name)
			{
				if (strpos($icon_path, $this->user->style['style_path'] . '/theme/images/pages_' . $row['page_route'] . '.gif') !== false)
				{
					$custom_icon = 'pages_' . $row['page_route'] . '.gif';
					break;
				}
			}

			// Assign template var data
			$this->template->assign_block_vars($row['page_link_event_name'] . '_links', array(
				'U_LINK_URL' => $this->helper->route('phpbb_pages_main_controller', array('route' => $row['page_route'])),
				'LINK_ROUTE' => $row['page_route'],
				'LINK_TITLE' => $row['page_title'],
				'ICON_LINK' => $custom_icon,
			));

			$this->template->assign_var('S_' . strtoupper($row['page_link_event_name']), true);
		}
	}

	/**
	* Show users as viewing Pages on Who Is Online page
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function viewonline_page($event)
	{
		// Are any users on app.php?
		if ($event['on_page'][1] == 'app')
		{
			// Load our language file
			$this->user->add_lang_ext('phpbb/pages', 'pages_common');

			// Load our page routes and titles
			$routes = $this->page_operator->get_page_routes();

			// If any of our pages are being viewed, update the event vars with our routes and titles
			foreach ($routes as $route => $page_title)
			{
				if ($event['row']['session_page'] == 'app.' . $this->php_ext . '/page/' . $route)
				{
					$event['location'] = $this->user->lang('PAGES_VIEWONLINE', $page_title);
					$event['location_url'] = $this->helper->route('phpbb_pages_main_controller', array('route' => $route));
					break;
				}
			}
		}
	}
}
