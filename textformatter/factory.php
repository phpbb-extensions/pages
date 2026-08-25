<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\textformatter;

/**
 * Creates a Pages-only text formatter with LiteDown support
 */
class factory extends \phpbb\textformatter\s9e\factory
{
	/**
	 * {@inheritdoc}
	 */
	public function get_configurator()
	{
		$configurator = parent::get_configurator();

		if (!isset($configurator->Litedown))
		{
			$configurator->Litedown;
		}

		return $configurator;
	}
}
