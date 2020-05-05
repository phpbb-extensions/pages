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
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\language\language */
	protected $lang;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \phpbb\pages\operators\page */
	protected $page_operator;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var ContainerInterface */
	protected $container;

	/** @var \phpbb\event\dispatcher_interface */
	protected $dispatcher;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string phpEx */
	protected $php_ext;

	/** @var string Custom form action */
	protected $u_action;

	/**
	* Constructor
	*
	* @param \phpbb\cache\driver\driver_interface $cache            Cache driver interface
	* @param \phpbb\controller\helper             $helper           Controller helper object
	* @param \phpbb\language\language             $lang             Language object
	* @param \phpbb\log\log                       $log              The phpBB log system
	* @param \phpbb\pages\operators\page          $page_operator    Pages operator object
	* @param \phpbb\request\request               $request          Request object
	* @param \phpbb\template\template             $template         Template object
	* @param \phpbb\user                          $user             User object
	* @param ContainerInterface                   $phpbb_container  Service container interface
	* @param \phpbb\event\dispatcher_interface    $phpbb_dispatcher Event dispatcher
	* @param string                               $root_path        phpBB root path
	* @param string                               $php_ext          phpEx
	* @access public
	*/
	public function __construct(\phpbb\cache\driver\driver_interface $cache, \phpbb\controller\helper $helper, \phpbb\language\language $lang, \phpbb\log\log $log, \phpbb\pages\operators\page $page_operator, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, ContainerInterface $phpbb_container, \phpbb\event\dispatcher_interface $phpbb_dispatcher, $root_path, $php_ext)
	{
		$this->cache = $cache;
		$this->helper = $helper;
		$this->lang = $lang;
		$this->log = $log;
		$this->page_operator = $page_operator;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->container = $phpbb_container;
		$this->dispatcher = $phpbb_dispatcher;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	/**
	* Display the pages
	*
	* @return void
	* @access public
	*/
	public function display_pages()
	{
		// Grab all the pages from the db
		$entities = $this->page_operator->get_pages();

		// Process each page entity for display
		/* @var $entity \phpbb\pages\entity\page */
		foreach ($entities as $entity)
		{
			// Set output block vars for display in the template
			$this->template->assign_block_vars('pages', array(
				'PAGES_TITLE'		=> $entity->get_title(),
				'PAGES_DESCRIPTION'	=> $entity->get_description(),
				'PAGES_ROUTE'		=> $entity->get_route(),
				'PAGES_TEMPLATE'	=> $entity->get_template(),
				'PAGES_ORDER'		=> $entity->get_order(),

				'S_PAGES_DISPLAY'		=> $entity->get_page_display(),
				'S_PAGES_GUEST_DISPLAY'	=> $entity->get_page_display_to_guests(),
				'S_PAGES_TITLE_SWITCH'	=> $entity->get_page_title_switch(),

				'U_DELETE'			=> "{$this->u_action}&amp;action=delete&amp;page_id=" . $entity->get_id(),
				'U_EDIT'			=> "{$this->u_action}&amp;action=edit&amp;page_id=" . $entity->get_id(),
				'U_PAGES_ROUTE'		=> $this->helper->route('phpbb_pages_dynamic_route_' . $entity->get_id()),
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
	 * @return void
	 * @access public
	 * @throws \phpbb\pages\exception\out_of_bounds
	 */
	public function add_page()
	{
		// Initiate a page entity
		/* @var $entity \phpbb\pages\entity\page */
		$entity = $this->container->get('phpbb.pages.entity');

		// Process the new page
		$this->add_edit_page_data($entity);

		// Set output vars for display in the template
		$this->template->assign_vars(array(
			'S_ADD_PAGE'	=> true,
			'U_ACTION'		=> "{$this->u_action}&amp;action=add",
		));
	}

	/**
	 * Edit a page
	 *
	 * @param int $page_id The page identifier to edit
	 * @return void
	 * @access public
	 * @throws \phpbb\pages\exception\out_of_bounds
	 */
	public function edit_page($page_id)
	{
		// Initiate and load the page entity
		/* @var $entity \phpbb\pages\entity\page */
		$entity = $this->container->get('phpbb.pages.entity')->load($page_id);

		// Process the edited page
		$this->add_edit_page_data($entity);

		// Set output vars for display in the template
		$this->template->assign_vars(array(
			'S_EDIT_PAGE'	=> true,
			'U_VIEW_PAGE'	=> $this->helper->route('phpbb_pages_dynamic_route_' . $entity->get_id()),
			'U_ACTION'		=> "{$this->u_action}&amp;page_id={$page_id}&amp;action=edit",
		));
	}

	/**
	 * Process page data to be added or edited
	 *
	 * @param \phpbb\pages\entity\page_interface $entity The page entity object
	 * @return void
	 * @access protected
	 * @throws \phpbb\pages\exception\out_of_bounds
	 */
	protected function add_edit_page_data($entity)
	{
		// Create an array to collect errors that will be output to the user
		$errors = array();

		// Is the form submitted
		$submit = $this->request->is_set_post('submit');

		// Load posting language file for the BBCode editor
		$this->lang->add_lang('posting');

		// Add form key for form validation checks
		add_form_key('add_edit_page');

		// Collect form data
		$data = array(
			'page_title'				=> $this->request->variable('page_title', '', true),
			'page_route'				=> $this->request->variable('page_route', ''),
			'page_description'			=> $this->request->variable('page_description', '', true),
			'page_content'				=> $this->request->variable('page_content', '', true),
			'bbcode'					=> $this->request->variable('parse_bbcode', false),
			'magic_url'					=> $this->request->variable('parse_magic_url', false),
			'smilies'					=> $this->request->variable('parse_smilies', false),
			'html'						=> $this->request->variable('parse_html', false),
			'page_template'				=> $this->request->variable('page_template', ''),
			'page_links'				=> $this->request->variable('page_links', array(0)),
			'page_order'				=> $this->request->variable('page_order', 0),
			'page_icon_font'			=> $this->request->variable('page_icon_font', ''),
			'page_display'				=> $this->request->variable('page_display', 0),
			'page_display_to_guests'	=> $this->request->variable('page_guest_display', 0),
			'page_title_switch'			=> $this->request->variable('page_title_switch', 0),
		);

		// Grab the form data's message parsing options (possible values: 1 or 0)
		// If submit use the data from the form
		// If page edit use data stored in the entity
		// If page add use default values
		$content_parse_options = array(
			'bbcode'	=> $submit ? $data['bbcode'] : ($entity->get_id() ? $entity->content_bbcode_enabled() : 1),
			'magic_url'	=> $submit ? $data['magic_url'] : ($entity->get_id() ? $entity->content_magic_url_enabled() : 1),
			'smilies'	=> $submit ? $data['smilies'] : ($entity->get_id() ? $entity->content_smilies_enabled() : 1),
			'html'		=> $submit ? $data['html'] : ($entity->get_id() ? $entity->content_html_enabled() : 0),
		);

		// Set the content parse options in the entity
		foreach ($content_parse_options as $function => $enabled)
		{
			$entity->{($enabled ? 'content_enable_' : 'content_disable_') . $function}();
		}

		// Purge temporary variable
		unset($content_parse_options);

		// If the form has been submitted, set all data and save it
		if ($submit)
		{
			// Test if the form is valid
			// Use -1 to allow unlimited time to submit form
			if (!check_form_key('add_edit_page', -1))
			{
				$errors[] = $this->lang->lang('FORM_INVALID');
			}

			// Map the form's page data fields to setters
			$map_fields = array(
				'set_title'						=> $data['page_title'],
				'set_route'						=> $data['page_route'],
				'set_description'				=> $data['page_description'],
				'set_content'					=> $data['page_content'],
				'set_template'					=> $data['page_template'],
				'set_order'						=> $data['page_order'],
				'set_icon_font'					=> $data['page_icon_font'],
				'set_page_display'				=> $data['page_display'],
				'set_page_display_to_guests'	=> $data['page_display_to_guests'],
				'set_page_title_switch'			=> $data['page_title_switch'],

			);

			// Set the mapped page data in the entity
			foreach ($map_fields as $entity_function => $page_data)
			{
				try
				{
					// Calling the $entity_function on the entity and passing it $page_data
					$entity->$entity_function($page_data);
				}
				catch (\phpbb\pages\exception\base $e)
				{
					// Catch exceptions and add them to errors array
					$errors[] = $e->get_message($this->lang);
				}
			}

			// Purge temporary variable
			unset($map_fields);

			// Insert or update page
			if (empty($errors))
			{
				if ($entity->get_id())
				{
					// Save the edited page entity to the database
					$entity->save();

					// Save the page link location data
					$this->page_operator->insert_page_links($entity->get_id(), $data['page_links']);

					// Log the action
					$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'ACP_PAGES_EDITED_LOG', time(), array($entity->get_title()));

					// The result message to use
					$message = 'ACP_PAGES_EDIT_SUCCESS';
				}
				else
				{
					// Add the new page entity to the database
					$entity = $this->page_operator->add_page($entity);

					// Save the page link location data (now that we can access the new id)
					$this->page_operator->insert_page_links($entity->get_id(), $data['page_links']);

					// Log the action
					$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'ACP_PAGES_ADDED_LOG', time(), array($entity->get_title()));

					// The result message to use
					$message = 'ACP_PAGES_ADD_SUCCESS';
				}

				// Purge the cache to refresh route collections
				$this->cache->purge();

				// Show user confirmation of the page and provide link back to the previous screen
				trigger_error($this->lang->lang($message) . adm_back_link($this->u_action));
			}
		}

		/**
		* Event to add to Pages ACP add/edit pages
		*
		* @event phpbb.pages.acp_add_edit_page
		* @since 1.0.0-RC1
		*/
		$this->dispatcher->dispatch('phpbb.pages.acp_add_edit_page');

		// Set template vars for Page Template select menu
		$this->create_page_template_options($entity->get_template());

		// Set template vars for Page Link Locations select menu
		$this->create_page_link_options($entity->get_id(), $data['page_links']);

		// Set output vars for display in the template
		$this->template->assign_vars(array(
			'S_ERROR'			=> (bool) count($errors),
			'ERROR_MSG'			=> count($errors) ? implode('<br />', $errors) : '',

			'PAGES_TITLE'		=> $entity->get_title(),
			'PAGES_ROUTE'		=> $entity->get_route(),
			'PAGES_CONTENT'		=> $entity->get_content_for_edit(),
			'PAGES_DESCRIPTION'	=> $entity->get_description(),
			'PAGES_ORDER'		=> $entity->get_order(),
			'PAGES_ICON_FONT'	=> $entity->get_icon_font(),

			'S_PAGES_DISPLAY'			=> $entity->get_page_display(),
			'S_PAGES_GUEST_DISPLAY'		=> $entity->get_page_display_to_guests(),
			'S_PAGES_TITLE_SWITCH'		=> $entity->get_page_title_switch(),

			'S_PARSE_BBCODE_CHECKED'	=> $entity->content_bbcode_enabled(),
			'S_PARSE_SMILIES_CHECKED'	=> $entity->content_smilies_enabled(),
			'S_PARSE_MAGIC_URL_CHECKED'	=> $entity->content_magic_url_enabled(),
			'S_PARSE_HTML_CHECKED'		=> $entity->content_html_enabled(),

			'BBCODE_STATUS'		=> $this->lang->lang('BBCODE_IS_ON', '<a href="' . $this->helper->route('phpbb_help_bbcode_controller') . '">', '</a>'),
			'SMILIES_STATUS'	=> $this->lang->lang('SMILIES_ARE_ON'),
			'IMG_STATUS'		=> $this->lang->lang('IMAGES_ARE_ON'),
			'FLASH_STATUS'		=> $this->lang->lang('FLASH_IS_ON'),
			'URL_STATUS'		=> $this->lang->lang('URL_IS_ON'),

			'S_BBCODE_ALLOWED'	=> true,
			'S_SMILIES_ALLOWED'	=> true,
			'S_BBCODE_IMG'		=> true,
			'S_BBCODE_FLASH'	=> true,
			'S_LINKS_ALLOWED'	=> true,

			'U_FONTAWESOME_ICONS'	=> 'https://fontawesome.com/' . (phpbb_version_compare(PHPBB_VERSION, '3.3.0', '>') ? 'icons?d=gallery&m=free' : 'v4.7.0/icons/'),
			'U_BACK'				=> $this->u_action,
		));

		// Build custom bbcodes array
		include_once $this->root_path . 'includes/functions_display.' . $this->php_ext;

		display_custom_bbcodes();
	}

	/**
	* Delete a page
	*
	* @param int $page_id The page identifier to delete
	* @return void
	* @access public
	*/
	public function delete_page($page_id)
	{
		// Initiate and load the page entity
		/* @var $entity \phpbb\pages\entity\page */
		$entity = $this->container->get('phpbb.pages.entity')->load($page_id);

		try
		{
			// Delete the page
			$this->page_operator->delete_page($page_id);
		}
		catch (\phpbb\pages\exception\base $e)
		{
			// Display an error message if delete failed
			trigger_error($this->lang->lang('ACP_PAGES_DELETE_ERRORED') . adm_back_link($this->u_action), E_USER_WARNING);
		}

		// Log the action
		$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'ACP_PAGES_DELETED_LOG', time(), array($entity->get_title()));

		// If AJAX was used, show user a result message
		if ($this->request->is_ajax())
		{
			$json_response = new \phpbb\json_response;
			$json_response->send(array(
				'MESSAGE_TITLE'	=> $this->lang->lang('INFORMATION'),
				'MESSAGE_TEXT'	=> $this->lang->lang('ACP_PAGES_DELETE_SUCCESS'),
				'REFRESH_DATA'	=> array(
					'time'	=> 3
				)
			));
		}
	}

	/**
	* Set page url
	*
	* @param string $u_action Custom form action
	* @return void
	* @access public
	*/
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}

	/**
	* Set template var options for page template select menus
	*
	* @param string	$current Name of the template currently stored in the database
	* @return void
	* @access protected
	*/
	protected function create_page_template_options($current)
	{
		// Grab all avaliable pages_*.html files
		$page_templates = $this->page_operator->get_page_templates();

		// Clean up template names and simplify the array
		$page_templates = array_map(function ($value) {
			return basename($value);
		}, array_keys($page_templates));

		// Remove duplicates array items
		$page_templates = array_unique($page_templates);

		// Set the options list template vars
		foreach ($page_templates as $page_template)
		{
			$this->template->assign_block_vars('page_template_options', array(
				'VALUE'			=> $page_template,
				'S_SELECTED'	=> $page_template == $current,
			));
		}
	}

	/**
	* Set template var options for page link location menus
	*
	* @param int $page_id Page identifier
	* @param array $current Currently selected link locations (from the form data)
	* @return void
	* @access protected
	*/
	protected function create_page_link_options($page_id = 0, $current = array())
	{
		// Get all page links assigned to the page (if it's being edited)
		if ($page_id && empty($current))
		{
			$page_links = $this->page_operator->get_page_links(array($page_id));

			foreach ($page_links as $page_link)
			{
				$current[] = $page_link['page_link_id'];
			}
		}

		// Get all link location names and identifiers
		$link_locations = $this->page_operator->get_link_locations();

		// Set the options list template vars
		foreach ($link_locations as $link)
		{
			$this->template->assign_block_vars('page_link_options', array(
				'VALUE'			=> $link['page_link_id'],
				'LABEL'			=> $this->lang->lang($link['page_link_location']),
				'S_SELECTED'	=> in_array($link['page_link_id'], $current),
			));
		}
	}
}
