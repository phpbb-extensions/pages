<?php
/**
<<<<<<< HEAD
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2015 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */
=======
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/
>>>>>>> master

namespace phpbb\pages;

/**
<<<<<<< HEAD
* This ext class is optional and can be omitted if left empty.
* However you can add special (un)installation commands in the
* methods enable_step(), disable_step() and purge_step(). As it is,
* these methods are defined in \phpbb\extension\base, which this
* class extends, but you can overwrite them to give special
* instructions for those cases.
=======
* Extension class for custom enable/disable/purge actions
>>>>>>> master
*/
class ext extends \phpbb\extension\base
{
	/**
<<<<<<< HEAD
	 * Check whether or not the extension can be enabled.
	 * The current phpBB version should meet or exceed
	 * the minimum version required by this extension:
	 *
	 * Requires phpBB 3.2.0-dev due to new faq controller route for bbcodes
	 *
	 * @return bool
	 * @access public
	 */
	public function is_enableable()
	{
		return phpbb_version_compare(PHPBB_VERSION, '3.2.0-dev', '>=');
=======
	* Check whether or not the extension can be enabled.
	* The current phpBB version should meet or exceed
	* the minimum version required by this extension:
	*
	* Requires phpBB 3.1.3 due to usage of http_exception.
	*
	* @return bool
	* @access public
	*/
	public function is_enableable()
	{
		$config = $this->container->get('config');
		return phpbb_version_compare($config['version'], '3.1.3', '>=');
>>>>>>> master
	}
}
