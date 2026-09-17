<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\operators;

class page_operator_save_page_test extends page_operator_base
{
	public function test_get_and_save_page()
	{
		$operator = $this->get_page_operator();
		$entity = $operator->get_page(1);

		self::assertSame('page_1', $entity->get_route());
		$entity->set_title('Changed title');

		$saved = $operator->save_page($entity);

		self::assertSame('Changed title', $saved->get_title());
		self::assertSame(array(), $saved->get_changes());
		self::assertSame('Changed title', $operator->get_page(0, 'page_1')->get_title());
	}

	public function test_save_page_rejects_new_entity()
	{
		$this->expectException(\phpbb\pages\exception\out_of_bounds::class);
		$this->expectExceptionMessage('page_id');

		$this->get_page_operator()->save_page($this->entity_factory->create());
	}

	public function test_get_page_rejects_unknown_id()
	{
		$this->expectException(\phpbb\pages\exception\out_of_bounds::class);
		$this->expectExceptionMessage('page_id');

		$this->get_page_operator()->get_page(100);
	}

	public function test_save_unicode_page_details()
	{
		$operator = $this->get_page_operator();
		$entity = $operator->get_page(1);
		$entity
			->set_title('Emoji 😀 title')
			->set_description('中文 and Кириллица 😀 description');

		$saved = $operator->save_page($entity);

		$result = $this->db->sql_query('SELECT page_title, page_description
			FROM phpbb_pages
			WHERE page_id = 1');
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		self::assertSame('Emoji &#128512; title', $row['page_title']);
		$expected_description = strpos($this->db->get_sql_layer(), 'mssql') === 0
			? '&#20013;&#25991; and &#1050;&#1080;&#1088;&#1080;&#1083;&#1083;&#1080;&#1094;&#1072; &#128512; description'
			: '中文 and Кириллица &#128512; description';
		self::assertSame($expected_description, $row['page_description']);
		self::assertSame('Emoji 😀 title', $saved->get_title());
		self::assertSame('中文 and Кириллица 😀 description', $saved->get_description());
	}

	public function test_create_page_returns_fresh_entities()
	{
		$operator = $this->get_page_operator();

		self::assertNotSame($operator->create_page(), $operator->create_page());
	}
}
