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

	/** @var \phpbb\language\language */
	protected $lang;

	/** @var \phpbb\pages\operators\page */
	protected $page_operator;

	/** @var \phpbb\routing\router */
	protected $router;

	/** @var array|null Page route paths mapped to page IDs */
	protected $page_route_ids;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpEx */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \phpbb\auth\auth            $auth            Authentication object
	* @param \phpbb\controller\helper    $helper          Controller helper object
	* @param \phpbb\language\language    $lang            Language object
	* @param \phpbb\pages\operators\page $page_operator   Pages operator object
	* @param \phpbb\routing\router        $router          Router object
	* @param \phpbb\template\template    $template        Template object
	* @param \phpbb\user                 $user            User object
	* @param string                      $php_ext         phpEx
	* @access public
	*/
	public function __construct(\phpbb\auth\auth $auth, \phpbb\controller\helper $helper, \phpbb\language\language $lang, \phpbb\pages\operators\page $page_operator, \phpbb\routing\router $router, \phpbb\template\template $template, \phpbb\user $user, $php_ext)
	{
		$this->auth = $auth;
		$this->helper = $helper;
		$this->lang = $lang;
		$this->page_operator = $page_operator;
		$this->router = $router;
		$this->template = $template;
		$this->user = $user;
		$this->php_ext = $php_ext;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	public static function getSubscribedEvents()
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
	* @param \phpbb\event\data $event The event object
	* @return void
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
	* @return void
	* @access public
	*/
	public function show_page_links()
	{
		// Get all page link data
		$rowset = $this->page_operator->get_page_links();

		foreach ($rowset as $row)
		{
			// Skip page if it should not be displayed (admins always have access to a page)
			if ((!$row['page_display_to_guests'] && $this->user->data['user_id'] == ANONYMOUS) || (!$row['page_display'] && !$this->auth->acl_get('a_')))
			{
				continue;
			}

			// Assign template var data
			$this->template->assign_block_vars($row['page_link_event_name'] . '_links', array(
				'U_LINK_URL' => $this->helper->route('phpbb_pages_dynamic_route_' . $row['page_id']),
				'LINK_TITLE' => $row['page_title'],
				'LINK_DESC'  => $row['page_description'] && $row['page_description_display'] ? $row['page_description'] : '',
				'ICON_FONT'  => $row['page_icon_font'],
			));

			// Set a boolean switch to enable the chosen template event
			$this->template->assign_var('S_' . strtoupper($row['page_link_event_name']), true);
		}
	}

	/**
	* Show users as viewing Pages on Who Is Online page
	*
	* @param \phpbb\event\data $event The event object
	* @return void
	* @access public
	*/
	public function viewonline_page($event)
	{
		if (!isset($event['row']['session_page']))
		{
			return;
		}

		$session_path = parse_url($event['row']['session_page'], PHP_URL_PATH);
		if (!is_string($session_path))
		{
			return;
		}

		// Session pages include the front controller, whose name differs between
		// phpBB versions. Router paths do not include the front controller.
		$session_path = preg_replace('#^.*\.' . preg_quote($this->php_ext, '#') . '(?=/)#', '', $session_path);

		if ($this->page_route_ids === null)
		{
			$this->page_route_ids = array();
			foreach ($this->router->getRouteCollection()->all() as $route_name => $route)
			{
				if (strpos($route_name, 'phpbb_pages_dynamic_route_') === 0)
				{
					$this->page_route_ids[$route->getPath()] = (int) substr($route_name, strlen('phpbb_pages_dynamic_route_'));
				}
			}
		}

		if (!isset($this->page_route_ids[$session_path]))
		{
			return;
		}

		$page_id = $this->page_route_ids[$session_path];
		$page_routes = $this->page_operator->get_page_routes();
		if (!isset($page_routes[$page_id]))
		{
			return;
		}

		$this->lang->add_lang('pages_common', 'phpbb/pages');
		$event['location'] = $this->lang->lang('PAGES_VIEWONLINE', $page_routes[$page_id]['title']);
		$event['location_url'] = $this->helper->route('phpbb_pages_dynamic_route_' . $page_id);
	}
}
