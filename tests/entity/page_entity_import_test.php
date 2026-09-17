<?php
/**
*
* Pages extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbb\pages\tests\entity;

/**
* Tests related to import on page entity
*/
class page_entity_import_test extends page_entity_base
{
	/**
	* Test data for the test_import() function
	*
	* @return array Array of test data
	*/
	public function import_test_data()
	{
		$import_data = $this->get_import_data();
		$import_data[1]['page_title'] = str_repeat('К', 200);
		$import_data[1]['page_description'] = str_repeat('Ж', 255);

		return array(
			array($import_data[1]),
			array($import_data[2]),
			array($import_data[3]),
			array($import_data[4]),
			array($import_data[5]),
		);
	}

	/**
	* Test importing data
	*
	* @dataProvider import_test_data
	*/
	public function test_import($data)
	{
		// Setup the entity class
		$entity = $this->get_page_entity();

		// Set the data
		$result = $entity->import($data);

		// Assert the returned value is what we expect
		self::assertInstanceOf('\phpbb\pages\entity\page', $result);

		// Map the fields to the getters
		$map = array(
			'page_id'					=> 'get_id',
			'page_order' 				=> 'get_order',
			'page_route'				=> 'get_route',
			'page_title'				=> 'get_title',
			'page_description'			=> 'get_description',
			'page_description_display'	=> 'get_description_display',
			'page_display'				=> 'get_page_display',
			'page_display_to_guests'	=> 'get_page_display_to_guests',
			'page_title_switch'			=> 'get_page_title_switch',
			'page_icon_font'			=> 'get_icon_font',
		);

		// Go through each field in the data and make sure the function returns
		// what we saved
		foreach ($map as $field => $function)
		{
			self::assertEquals($data[$field], $entity->$function());
		}
	}

	/**
	 * Stored values bypass write-time validation and remain unchanged.
	 */
	public function test_import_preserves_storage_values()
	{
		$data = $this->get_import_data()[1];
		$data['page_title'] = 'Emoji &#128512; title';
		$data['page_route'] = str_repeat('a', 101);
		$data['page_template'] = 'legacy-template';
		$data['page_icon_font'] = 'legacy_icon';

		$entity = $this->get_page_entity()->import($data);

		self::assertSame('Emoji &#128512; title', $entity->get_data()['page_title']);
		self::assertSame('Emoji 😀 title', $entity->get_title());
		self::assertSame($data['page_route'], $entity->get_route());
		self::assertSame($data['page_template'], $entity->get_template());
		self::assertSame($data['page_icon_font'], $entity->get_icon_font());
		self::assertSame(array(), $entity->get_changes());

		$entity->set_title('Changed title');
		self::assertSame(array('page_title' => 'Changed title'), $entity->get_changes());
	}

	/**
	 * Failed hydration does not leave partially replaced entity state.
	 */
	public function test_import_is_atomic()
	{
		$data = $this->get_import_data()[1];
		$entity = $this->get_page_entity()->import($data);
		unset($data['page_route']);

		try
		{
			$entity->import($data);
			self::fail('Expected invalid_argument exception was not thrown.');
		}
		catch (\phpbb\pages\exception\invalid_argument $e)
		{
			self::assertSame(1, $entity->get_id());
			self::assertSame('route1', $entity->get_route());
		}
	}

	/**
	* Test data for the test_import_fail() function
	*
	* @return array Array of test data
	*/
	public function import_test_fail_data()
	{
		$import_data = $this->get_import_data();

		$data = array();

		// Out of range
		$data[] = array_merge($import_data[1], array(
			'page_id'	=> -1,
		));

		// Out of range
		$data[] = array_merge($import_data[1], array(
			'page_order'	=> -1,
		));

		// Out of range
		$data[] = array_merge($import_data[1], array(
			'page_content_bbcode_options'	=> -1,
		));

		// Go through every field and unset it while submitting everything else
		foreach ($import_data[1] as $field => $value)
		{
			$incomplete = $import_data[1];

			// Unset the one field while keeping everything else
			unset($incomplete[$field]);

			$data[] = $incomplete;
		}

		// Make each $data array a proper test array
		foreach ($data as $key => $array)
		{
			$data[$key] = array($array);
		}

		return $data;
	}

	/**
	* Test importing data which will cause exceptions
	*
	* @dataProvider import_test_fail_data
	*/
	public function test_import_fail($data)
	{
		$this->expectException(\phpbb\pages\exception\base::class);

		// Setup the entity class
		$entity = $this->get_page_entity();

		// Set the data
		$entity->import($data);
	}
}
