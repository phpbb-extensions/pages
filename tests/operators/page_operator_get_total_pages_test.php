<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2024 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\operators;

class page_operator_get_total_pages_test extends page_operator_base
{
	public function test_get_total_pages()
	{
		// Set up the operator class
		$operator = $this->get_page_operator();

		self::assertEquals(4, $operator->get_total_pages());
	}
}
