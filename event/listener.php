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
	* @param \phpbb\template\template    $template        Template object
	* @param \phpbb\user                 $user            User object
	* @param string                      $php_ext         phpEx
	* @access public
	*/
	public function __construct(\phpbb\auth\auth $auth, \phpbb\controller\helper $helper, \phpbb\language\language $lang, \phpbb\pages\operators\page $page_operator, \phpbb\template\template $template, \phpbb\user $user, $php_ext)
	{
		$this->auth = $auth;
		$this->helper = $helper;
		$this->lang = $lang;
		$this->page_operator = $page_operator;
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
				'LINK_ROUTE' => $row['page_route'],
				'LINK_TITLE' => $row['page_title'],
				'ICON_FONT'  => $row['page_icon_font'],
				'ICON_LINK'  => !$row['page_icon_font'] ? $this->page_operator->get_page_icon($row['page_route']) : '',
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
		// Are any users on app.php?
		if ($event['on_page'][1] === 'app')
		{
			// Load our language file
			$this->lang->add_lang('pages_common', 'phpbb/pages');

			// Load our page routes and titles
			$page_routes = $this->page_operator->get_page_routes();

			// If any of our pages are being viewed, update the event vars with our routes and titles
			foreach ($page_routes as $page_id => $page_data)
			{
				if ($event['row']['session_page'] === 'app.' . $this->php_ext . DIRECTORY_SEPARATOR . $page_data['route'])
				{
					$event['location'] = $this->lang->lang('PAGES_VIEWONLINE', $page_data['title']);
					$event['location_url'] = $this->helper->route('phpbb_pages_dynamic_route_' . $page_id);
					break;
				}
			}
		}
	}
}
