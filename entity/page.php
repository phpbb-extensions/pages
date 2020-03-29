<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\entity;

/**
* Entity for a page
*/
class page implements page_interface
{
	/**
	* Data for this entity
	*
	* @var array
	*	page_id
	*	page_title
	*	page_description
	*	page_route
	*	page_order
	*	page_content
	*	page_content_bbcode_uid
	*	page_content_bbcode_bitfield
	*	page_content_bbcode_options
	*	page_content_allow_html
	*	page_display
	*	page_display_to_guests
	*	page_title_switch
	*	page_template
	*	page_icon_font
	* @access protected
	*/
	protected $data;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\event\dispatcher_interface */
	protected $dispatcher;

	/** @var \phpbb\textformatter\s9e\utils */
	protected $text_formatter_utils;

	/**
	* The database table the page data is stored in
	*
	* @var string
	*/
	protected $pages_table;

	/**
	* Constructor
	*
	* @param \phpbb\db\driver\driver_interface   $db                    Database object
	* @param \phpbb\config\config                $config                Config object
	* @param \phpbb\event\dispatcher_interface   $phpbb_dispatcher      Event dispatcher
	* @param string                              $pages_table           Name of the table used to store page data
	* @param \phpbb\textformatter\s9e\utils      $text_formatter_utils  Text manipulation utilities
	* @access public
	*/
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\event\dispatcher_interface $phpbb_dispatcher, $pages_table, \phpbb\textformatter\s9e\utils $text_formatter_utils)
	{
		$this->db = $db;
		$this->config = $config;
		$this->dispatcher = $phpbb_dispatcher;
		$this->pages_table = $pages_table;
		$this->text_formatter_utils = $text_formatter_utils;
	}

	/**
	* Load the data from the database for a page
	*
	* @param int $id Page identifier
	* @param string $route Page route
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\out_of_bounds
	*/
	public function load($id = 0, $route = '')
	{
		// Load by id if provided, otherwise default to load by page route
		$sql_where = ($id <> 0) ? 'page_id = ' . (int) $id : "page_route = '" . $this->db->sql_escape($route) . "'";

		// Get page from the database
		$sql = 'SELECT *
			FROM ' . $this->pages_table . '
			WHERE ' . $sql_where;
		$result = $this->db->sql_query($sql);
		$this->data = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		if ($this->data === false)
		{
			// The page does not exist
			throw new \phpbb\pages\exception\out_of_bounds('page_id');
		}

		return $this;
	}

	/**
	* Import data for a page
	*
	* Used when the data is already loaded externally.
	* Any existing data on this page is over-written.
	* All data is validated and an exception is thrown if any data is invalid.
	*
	* @param array $data Data array, typically from the database
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\base
	*/
	public function import($data)
	{
		// Clear out any saved data
		$this->data = array();

		// All of our fields
		$fields = array(
			// column						=> data type (see settype())
			'page_id'						=> 'integer',
			'page_order'					=> 'set_order', // call set_order()
			'page_title'					=> 'set_title', // call set_title()
			'page_description'				=> 'set_description', // call set_description()
			'page_route'					=> 'set_route', // call set_route()
			'page_display'					=> 'set_page_display', // call set_page_display()
			'page_display_to_guests'		=> 'set_page_display_to_guests', // call set_page_display_to_guests()
			'page_title_switch'				=> 'set_page_title_switch', // call set_page_title_switch()
			'page_template'					=> 'set_template', // call set_template()
			'page_icon_font'				=> 'set_icon_font', // call set_icon_font()

			// We do not pass to set_content() as generate_text_for_storage would run twice
			'page_content'					=> 'string',
			'page_content_bbcode_uid'		=> 'string',
			'page_content_bbcode_bitfield'	=> 'string',
			'page_content_bbcode_options'	=> 'integer',
			'page_content_allow_html'		=> 'bool',
		);

		// Go through the basic fields and set them to our data array
		foreach ($fields as $field => $type)
		{
			// If the data wasn't sent to us, throw an exception
			if (!isset($data[$field]))
			{
				throw new \phpbb\pages\exception\invalid_argument(array($field, 'FIELD_MISSING'));
			}

			// If the type is a method on this class, call it
			if (method_exists($this, $type))
			{
				$this->$type($data[$field]);
			}
			else
			{
				// settype passes values by reference
				$value = $data[$field];

				// We're using settype to enforce data types
				settype($value, $type);

				$this->data[$field] = $value;
			}
		}

		// Some fields must be unsigned (>= 0)
		$validate_unsigned = array(
			'page_id',
			'page_content_bbcode_options',
		);

		foreach ($validate_unsigned as $field)
		{
			// If the data is less than 0, it's not unsigned and we'll throw an exception
			if ($this->data[$field] < 0)
			{
				throw new \phpbb\pages\exception\out_of_bounds($field);
			}
		}

		return $this;
	}

	/**
	* Insert the page data for the first time
	*
	* Will throw an exception if the page was already inserted (call save() instead)
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\out_of_bounds
	*/
	public function insert()
	{
		if (!empty($this->data['page_id']))
		{
			// The page already exists
			throw new \phpbb\pages\exception\out_of_bounds('page_id');
		}

		// Insert the page data to the database
		$sql = 'INSERT INTO ' . $this->pages_table . ' ' . $this->db->sql_build_array('INSERT', $this->data);
		$this->db->sql_query($sql);

		// Set the page_id using the id created by the SQL insert
		$this->data['page_id'] = (int) $this->db->sql_nextid();

		return $this;
	}

	/**
	* Save the current settings to the database
	*
	* This must be called before closing or any changes will not be saved!
	* If adding a page (saving for the first time), you must call insert() or an exeception will be thrown
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\out_of_bounds
	*/
	public function save()
	{
		if (empty($this->data['page_id']))
		{
			// The page does not exist
			throw new \phpbb\pages\exception\out_of_bounds('page_id');
		}

		// Copy the data array, filtering out the page_id identifier
		// so we do not attempt to update the row's identity column.
		$sql_array = array_diff_key($this->data, array('page_id' => null));

		// Update the page data in the database
		$sql = 'UPDATE ' . $this->pages_table . '
			SET ' . $this->db->sql_build_array('UPDATE', $sql_array) . '
			WHERE page_id = ' . $this->get_id();
		$this->db->sql_query($sql);

		return $this;
	}

	/**
	* Get id
	*
	* @return int Page identifier
	* @access public
	*/
	public function get_id()
	{
		return isset($this->data['page_id']) ? (int) $this->data['page_id'] : 0;
	}

	/**
	* Get title
	*
	* @return string Title
	* @access public
	*/
	public function get_title()
	{
		return isset($this->data['page_title']) ? (string) $this->data['page_title'] : '';
	}

	/**
	* Set title
	*
	* @param string $title
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\unexpected_value
	*/
	public function set_title($title)
	{
		// Enforce a string
		$title = (string) $title;

		// Title is a required field
		if ($title === '')
		{
			throw new \phpbb\pages\exception\unexpected_value(array('title', 'FIELD_MISSING'));
		}

		// We limit the title length to 200 characters
		if (truncate_string($title, 200) !== $title)
		{
			throw new \phpbb\pages\exception\unexpected_value(array('title', 'TOO_LONG'));
		}

		// Set the title on our data array
		$this->data['page_title'] = $title;

		return $this;
	}

	/**
	* Get description
	*
	* @return string description
	* @access public
	*/
	public function get_description()
	{
		return isset($this->data['page_description']) ? (string) $this->data['page_description'] : '';
	}

	/**
	* Set description
	*
	* @param string $description Description text
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\unexpected_value
	*/
	public function set_description($description)
	{
		// Enforce a string
		$description = (string) $description;

		// We limit the title length to 255 characters
		if (truncate_string($description, 255) !== $description)
		{
			throw new \phpbb\pages\exception\unexpected_value(array('description', 'TOO_LONG'));
		}

		// Set the title on our data array
		$this->data['page_description'] = $description;

		return $this;
	}

	/**
	* Get route
	*
	* @return string route
	* @access public
	*/
	public function get_route()
	{
		return isset($this->data['page_route']) ? (string) $this->data['page_route'] : '';
	}

	/**
	* Set route
	*
	* @param string $route Route text
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\unexpected_value
	*/
	public function set_route($route)
	{
		// Enforce a string
		$route = (string) $route;

		// Route is a required field
		if ($route === '')
		{
			throw new \phpbb\pages\exception\unexpected_value(array('route', 'FIELD_MISSING'));
		}

		// Route should not contain any unexpected special characters
		if (!preg_match('/^[^!"#$%&*\'()+,.\/\\\\:;<=>?@\\[\\]^`{|}~ ]*$/', $route))
		{
			throw new \phpbb\pages\exception\unexpected_value(array('route', 'ILLEGAL_CHARACTERS'));
		}

		// We limit the route length to 100 characters
		if (truncate_string($route, 100) !== $route)
		{
			throw new \phpbb\pages\exception\unexpected_value(array('route', 'TOO_LONG'));
		}

		// Routes must be unique
		if (!$this->get_id() || ($this->get_id() && $this->get_route() !== '' && $this->get_route() !== $route))
		{
			$sql = 'SELECT 1
				FROM ' . $this->pages_table . "
				WHERE page_route = '" . $this->db->sql_escape($route) . "'
					AND page_id <> " . $this->get_id();
			$result = $this->db->sql_query_limit($sql, 1);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if ($row)
			{
				throw new \phpbb\pages\exception\unexpected_value(array('route', 'NOT_UNIQUE'));
			}
		}

		// Set the route on our data array
		$this->data['page_route'] = $route;

		return $this;
	}

	/**
	* Get order
	*
	* @return int order
	* @access public
	*/
	public function get_order()
	{
		return isset($this->data['page_order']) ? (int) $this->data['page_order'] : 0;
	}

	/**
	* Set order
	*
	* @param int $order Page sort order
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\out_of_bounds
	*/
	public function set_order($order)
	{
		// Enforce an integer
		$order = (int) $order;

		/*
		* If the data is out of range we'll throw an exception. We use 16777215 as a
		* maximum because it matches the MySQL unsigned mediumint maximum value which
		* is the lowest amongst the DBMS supported by phpBB.
		*/
		if ($order < 0 || $order > 16777215)
		{
			throw new \phpbb\pages\exception\out_of_bounds('page_order');
		}

		// Set the route on our data array
		$this->data['page_order'] = $order;

		return $this;
	}

	/**
	* Get page template
	*
	* @return string page template
	* @access public
	*/
	public function get_template()
	{
		return (!empty($this->data['page_template'])) ? (string) $this->data['page_template'] : 'pages_default.html';
	}

	/**
	* Set page template
	*
	* @param string $template Page template name
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\unexpected_value
	*/
	public function set_template($template)
	{
		// Enforce a string
		$template = (string) $template;

		// Template name should follow pages_*.html naming convention
		// and contain only letters, numbers, hyphens and underscores
		if ($template !== '' && !preg_match('/^pages_[A-Za-z0-9-_]+\.html$/', $template))
		{
			throw new \phpbb\pages\exception\unexpected_value(array('template', 'ILLEGAL_CHARACTERS'));
		}

		// We limit the template name length to 255 characters
		if (truncate_string($template, 255) !== $template)
		{
			throw new \phpbb\pages\exception\unexpected_value(array('template', 'TOO_LONG'));
		}

		// Set the title on our data array
		$this->data['page_template'] = $template;

		return $this;
	}

	/**
	* Get page icon font name
	*
	* @return string page icon font name
	* @access public
	*/
	public function get_icon_font()
	{
		return isset($this->data['page_icon_font']) ? (string) $this->data['page_icon_font'] : '';
	}

	/**
	* Set page icon font name
	*
	* @param string $name icon font name
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\unexpected_value
	*/
	public function set_icon_font($name)
	{
		// Enforce a string
		$name = (string) $name;

		// Validate icon font name
		if ($name !== '' && !preg_match('/^[a-z]+[a-z0-9-]+$/', $name))
		{
			throw new \phpbb\pages\exception\unexpected_value(array('icon_font', 'ILLEGAL_CHARACTERS'));
		}

		// We limit the icon font name length to 255 characters
		if (truncate_string($name, 255) !== $name)
		{
			throw new \phpbb\pages\exception\unexpected_value(array('icon_font', 'TOO_LONG'));
		}

		// Set the title on our data array
		$this->data['page_icon_font'] = $name;

		return $this;
	}

	/**
	* Get content for edit
	*
	* @return string
	* @access public
	*/
	public function get_content_for_edit()
	{
		// Use defaults if these haven't been set yet
		$content = isset($this->data['page_content']) ? $this->data['page_content'] : '';
		$uid = isset($this->data['page_content_bbcode_uid']) ? $this->data['page_content_bbcode_uid'] : '';
		$options = isset($this->data['page_content_bbcode_options']) ? (int) $this->data['page_content_bbcode_options'] : 0;

		// Generate for edit
		$content_data = generate_text_for_edit($content, $uid, $options);

		return $content_data['text'];
	}

	/**
	* Get content for display
	*
	* @param bool $censor_text True to censor the text (Default: true)
	* @return string
	* @access public
	*/
	public function get_content_for_display($censor_text = true)
	{
		// If these haven't been set yet; use defaults
		$content = isset($this->data['page_content']) ? $this->data['page_content'] : '';
		$uid = isset($this->data['page_content_bbcode_uid']) ? $this->data['page_content_bbcode_uid'] : '';
		$bitfield = isset($this->data['page_content_bbcode_bitfield']) ? $this->data['page_content_bbcode_bitfield'] : '';
		$options = isset($this->data['page_content_bbcode_options']) ? (int) $this->data['page_content_bbcode_options'] : 0;

		$content_html_enabled = $this->content_html_enabled();
		$route = $this->get_route();

		// Generate for display
		if ($content_html_enabled)
		{
			// This is required by s9e text formatter to
			// remove extra xml formatting from the content.
			$content = $this->text_formatter_utils->unparse($content);

			$content = htmlspecialchars_decode($content, ENT_COMPAT);
		}
		else
		{
			$content = generate_text_for_display($content, $uid, $bitfield, $options, $censor_text);
		}

		/**
		* Event to modify page content
		*
		* @event phpbb.pages.modify_content_for_display
		* @var string content               Page content
		* @var string route                 Page route
		* @var string uid                   Page content bbcode uid
		* @var string bitfield              Page content bbcode bitfield
		* @var int    options               Page content bbcode options
		* @var bool   content_html_enabled  Is HTML allowed in page content
		* @since 1.0.0-RC1
		*/
		$vars = array('content', 'route', 'uid', 'bitfield', 'options', 'content_html_enabled');
		extract($this->dispatcher->trigger_event('phpbb.pages.modify_content_for_display', compact($vars)));

		return $content;
	}

	/**
	* Set content
	*
	* @param string $content
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function set_content($content)
	{
		// Override maximum post characters limit
		$this->config['max_post_chars'] = 0;

		// Prepare the text for storage
		$uid = $bitfield = $flags = '';
		generate_text_for_storage($content, $uid, $bitfield, $flags, $this->content_bbcode_enabled(), $this->content_magic_url_enabled(), $this->content_smilies_enabled());

		// Set the content to our data array
		$this->data['page_content'] = $content;
		$this->data['page_content_bbcode_uid'] = $uid;
		$this->data['page_content_bbcode_bitfield'] = $bitfield;
		// Flags are already set

		return $this;
	}

	/**
	* Check if bbcode is enabled on the content
	*
	* @return bool
	* @access public
	*/
	public function content_bbcode_enabled()
	{
		return ($this->data['page_content_bbcode_options'] & OPTION_FLAG_BBCODE);
	}

	/**
	* Enable bbcode on the content
	* This should be called before set_content(); content_enable_bbcode()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_enable_bbcode()
	{
		$this->set_content_option(OPTION_FLAG_BBCODE);

		return $this;
	}

	/**
	* Disable bbcode on the content
	* This should be called before set_content(); content_disable_bbcode()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_disable_bbcode()
	{
		$this->set_content_option(OPTION_FLAG_BBCODE, true);

		return $this;
	}

	/**
	* Check if magic_url is enabled on the content
	*
	* @return bool
	* @access public
	*/
	public function content_magic_url_enabled()
	{
		return ($this->data['page_content_bbcode_options'] & OPTION_FLAG_LINKS);
	}

	/**
	* Enable magic url on the content
	* This should be called before set_content(); content_enable_magic_url()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_enable_magic_url()
	{
		$this->set_content_option(OPTION_FLAG_LINKS);

		return $this;
	}

	/**
	* Disable magic url on the content
	* This should be called before set_content(); content_disable_magic_url()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_disable_magic_url()
	{
		$this->set_content_option(OPTION_FLAG_LINKS, true);

		return $this;
	}

	/**
	* Check if smilies are enabled on the content
	*
	* @return bool
	* @access public
	*/
	public function content_smilies_enabled()
	{
		return ($this->data['page_content_bbcode_options'] & OPTION_FLAG_SMILIES);
	}

	/**
	* Enable smilies on the content
	* This should be called before set_content(); content_enable_smilies()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_enable_smilies()
	{
		$this->set_content_option(OPTION_FLAG_SMILIES);

		return $this;
	}

	/**
	* Disable smilies on the content
	* This should be called before set_content(); content_disable_smilies()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_disable_smilies()
	{
		$this->set_content_option(OPTION_FLAG_SMILIES, true);

		return $this;
	}

	/**
	* Check if HTML is allowed on the content
	*
	* @return bool allow html
	* @access public
	*/
	public function content_html_enabled()
	{
		return isset($this->data['page_content_allow_html']) ? (bool) $this->data['page_content_allow_html'] : false;
	}

	/**
	* Enable HTML on the content
	* This should be called before set_content(); content_enable_html()->set_content()
	* This should also be called after the bbcode, smilies and magic url setters
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_enable_html()
	{
		// Disable bbcode, magic url and smiley flags
		$this->content_disable_bbcode()
			->content_disable_smilies()
			->content_disable_magic_url();

		$this->data['page_content_allow_html'] = true;

		return $this;
	}

	/**
	* Disable HTML on the content
	* This should be called before set_content(); content_disable_html()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_disable_html()
	{
		$this->data['page_content_allow_html'] = false;

		return $this;
	}

	/**
	* Get page display setting
	*
	* @return bool display page
	* @access public
	*/
	public function get_page_display()
	{
		return isset($this->data['page_display']) ? (bool) $this->data['page_display'] : false;
	}

	/**
	* Set page display setting
	*
	* @param bool $option Page display setting
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function set_page_display($option)
	{
		// Enforce boolean
		$option = (bool) $option;

		// Set the route on our data array
		$this->data['page_display'] = $option;

		return $this;
	}

	/**
	* Get page display to guests setting
	*
	* @return bool display page to guests
	* @access public
	*/
	public function get_page_display_to_guests()
	{
		return isset($this->data['page_display_to_guests']) ? (bool) $this->data['page_display_to_guests'] : false;
	}

	/**
	* Set page display to guests setting
	*
	* @param bool $option Page display to guests setting
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function set_page_display_to_guests($option)
	{
		// Enforce boolean
		$option = (bool) $option;

		// Set the route on our data array
		$this->data['page_display_to_guests'] = $option;

		return $this;
	}

	/**
	 * Get page title switch setting
	 *
	 * @return bool Switch the way the page title is displayed (site name first instead of page name first)
	 * @access public
	 */
	public function get_page_title_switch()
	{
		return isset($this->data['page_title_switch']) ? (bool) $this->data['page_title_switch'] : false;
	}

	/**
	 * Set page title switch setting
	 *
	 * @param bool $option Page title switch setting
	 * @return page_interface $this object for chaining calls; load()->set()->save()
	 * @access public
	 */
	public function set_page_title_switch($option)
	{
		// Enforce boolean
		$option = (bool) $option;

		// Set the route on our data array
		$this->data['page_title_switch'] = $option;

		return $this;
	}

	/**
	* Set option helper
	*
	* @param int $option_value Value of the option
	* @param bool $negate Negate (unset) option (Default: False)
	* @param bool $reparse_content Reparse the content after setting option (Default: True)
	* @return void
	* @access protected
	*/
	protected function set_content_option($option_value, $negate = false, $reparse_content = true)
	{
		// Set page_content_bbcode_options to 0 if it does not yet exist
		$this->data['page_content_bbcode_options'] = isset($this->data['page_content_bbcode_options']) ? $this->data['page_content_bbcode_options'] : 0;

		// If we're setting the option and the option is not already set
		if (!$negate && !($this->data['page_content_bbcode_options'] & $option_value))
		{
			// Add the option to the options
			$this->data['page_content_bbcode_options'] += $option_value;
		}

		// If we're unsetting the option and the option is already set
		if ($negate && $this->data['page_content_bbcode_options'] & $option_value)
		{
			// Subtract the option from the options
			$this->data['page_content_bbcode_options'] -= $option_value;
		}

		// Reparse the content
		if ($reparse_content && !empty($this->data['page_content']))
		{
			$content = $this->data['page_content'];

			decode_message($content, $this->data['page_content_bbcode_uid']);

			$this->set_content($content);
		}
	}
}
