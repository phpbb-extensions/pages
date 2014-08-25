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
	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\pages\operators\page */
	protected $page_operator;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpEx */
	protected $php_ext;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper             $helper          Controller helper object
	* @param \phpbb\pages\operators\page          $page_operator   Pages operator object
	* @param \phpbb\user                          $user            User object
	* @param string                               $php_ext         phpEx
	* @return \phpbb\pages\event\listener
	* @access public
	*/
	public function __construct(\phpbb\controller\helper $helper, \phpbb\pages\operators\page $page_operator, \phpbb\user $user, $php_ext)
	{
		$this->helper = $helper;
		$this->page_operator = $page_operator;
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
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'						=> 'load_language_on_setup',
			'core.viewonline_overwrite_location'	=> 'viewonline_page',
		);
	}

	/**
	* Load common language files during user setup
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'phpbb/pages',
			'lang_set' => 'pages_common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
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
		if ($event['on_page'][1] == 'app')
		{
			$routes = $this->page_operator->get_page_routes();

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
