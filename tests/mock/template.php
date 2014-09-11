<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\mock;

/**
* Mock template class.
* This class has a minimum amount of functionality, just to make tests work.
* (Credit to nickvergessen for desigining this mock class.)
*/
class template implements \phpbb\template\template
{
	protected $template_data;

	public function __construct()
	{
	}

	public function get_template_vars()
	{
		return $this->template_data;
	}

	public function clear_cache()
	{
	}

	public function set_filenames(array $filename_array)
	{
	}

	public function get_user_style()
	{
	}

	public function set_style($style_directories = array('styles'))
	{
	}

	public function set_custom_style($names, $paths)
	{
	}

	public function destroy()
	{
	}

	public function destroy_block_vars($blockname)
	{
	}

	public function display($handle)
	{
	}

	public function assign_display($handle, $template_var = '', $return_content = true)
	{
	}

	public function assign_vars(array $vararray)
	{
		foreach ($vararray as $varname => $varval)
		{
			$this->assign_var($varname, $varval);
		}
	}

	public function assign_var($varname, $varval)
	{
		$this->template_data[$varname] = $varval;
	}

	public function append_var($varname, $varval)
	{
	}

	public function assign_block_vars($blockname, array $vararray)
	{
		foreach ($vararray as $varname => $varval)
		{
			$this->template_data[$blockname][$varname] = $varval;
		}
	}

	public function assign_block_vars_array($blockname, array $block_vars_array)
	{
	}

	public function alter_block_array($blockname, array $vararray, $key = false, $mode = 'insert')
	{
	}

	public function get_source_file_for_handle($handle)
	{
	}
}
