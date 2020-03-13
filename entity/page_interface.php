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
* Interface for a page
*
* This describes all of the methods we'll have for a single page
*/
interface page_interface
{
	/**
	* Load the data from the database for a page
	*
	* @param int $id Page identifier
	* @param string $route Page route
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\out_of_bounds
	*/
	public function load($id = 0, $route = '');

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
	public function import($data);

	/**
	* Insert the page data for the first time
	*
	* Will throw an exception if the page was already inserted (call save() instead)
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\out_of_bounds
	*/
	public function insert();

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
	public function save();

	/**
	* Get id
	*
	* @return int Page identifier
	* @access public
	*/
	public function get_id();

	/**
	* Get title
	*
	* @return string Title
	* @access public
	*/
	public function get_title();

	/**
	* Set title
	*
	* @param string $title
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\unexpected_value
	*/
	public function set_title($title);

	/**
	* Get description
	*
	* @return string description
	* @access public
	*/
	public function get_description();

	/**
	* Set description
	*
	* @param string $description Description text
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\unexpected_value
	*/
	public function set_description($description);

	/**
	* Get route
	*
	* @return string route
	* @access public
	*/
	public function get_route();

	/**
	* Set route
	*
	* @param string $route Route text
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\unexpected_value
	*/
	public function set_route($route);

	/**
	* Get order
	*
	* @return int order
	* @access public
	*/
	public function get_order();

	/**
	* Set order
	*
	* @param int $order Page sort order
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\out_of_bounds
	*/
	public function set_order($order);

	/**
	* Get page template
	*
	* @return string page template
	* @access public
	*/
	public function get_template();

	/**
	* Set page template
	*
	* @param string $template Page template name
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\unexpected_value
	*/
	public function set_template($template);

	/**
	* Get page icon font name
	*
	* @return string page icon font name
	* @access public
	*/
	public function get_icon_font();

	/**
	* Set page icon font name
	*
	* @param string $name icon font name
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	* @throws \phpbb\pages\exception\unexpected_value
	*/
	public function set_icon_font($name);

	/**
	* Get content for edit
	*
	* @return string
	* @access public
	*/
	public function get_content_for_edit();

	/**
	* Get content for display
	*
	* @param bool $censor_text True to censor the text (Default: true)
	* @return string
	* @access public
	*/
	public function get_content_for_display($censor_text = true);

	/**
	* Set content
	*
	* @param string $content
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function set_content($content);

	/**
	* Check if bbcode is enabled on the content
	*
	* @return bool
	* @access public
	*/
	public function content_bbcode_enabled();

	/**
	* Enable bbcode on the content
	* This should be called before set_content(); content_enable_bbcode()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_enable_bbcode();

	/**
	* Disable bbcode on the content
	* This should be called before set_content(); content_disable_bbcode()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_disable_bbcode();

	/**
	* Check if magic_url is enabled on the content
	*
	* @return bool
	* @access public
	*/
	public function content_magic_url_enabled();

	/**
	* Enable magic url on the content
	* This should be called before set_content(); content_enable_magic_url()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_enable_magic_url();

	/**
	* Disable magic url on the content
	* This should be called before set_content(); content_disable_magic_url()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_disable_magic_url();

	/**
	* Check if smilies are enabled on the content
	*
	* @return bool
	* @access public
	*/
	public function content_smilies_enabled();

	/**
	* Enable smilies on the content
	* This should be called before set_content(); content_enable_smilies()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_enable_smilies();

	/**
	* Disable smilies on the content
	* This should be called before set_content(); content_disable_smilies()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_disable_smilies();

	/**
	* Check if HTML is allowed on the content
	*
	* @return bool allow html
	* @access public
	*/
	public function content_html_enabled();

	/**
	* Enable HTML on the content
	* This should be called before set_content(); content_enable_html()->set_content()
	* This should also be called after the bbcode, smilies and magic url setters
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_enable_html();

	/**
	* Disable HTML on the content
	* This should be called before set_content(); content_disable_html()->set_content()
	*
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function content_disable_html();

	/**
	* Get page display setting
	*
	* @return bool display page
	* @access public
	*/
	public function get_page_display();

	/**
	* Set page display setting
	*
	* @param bool $option Page display setting
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function set_page_display($option);

	/**
	* Get page display to guests setting
	*
	* @return bool display page to guests
	* @access public
	*/
	public function get_page_display_to_guests();

	/**
	* Set page display to guests setting
	*
	* @param bool $option Page display to guests setting
	* @return page_interface $this object for chaining calls; load()->set()->save()
	* @access public
	*/
	public function set_page_display_to_guests($option);

	/**
	 * Get page title switch setting
	 *
	 * @return bool Switch the way the page title is displayed (site name first instead of page name first)
	 * @access public
	 */
	public function get_page_title_switch();

	/**
	 * Set page title switch setting
	 *
	 * @param bool $option Page title switch setting
	 * @return page_interface $this object for chaining calls; load()->set()->save()
	 * @access public
	 */
	public function set_page_title_switch($option);
}
