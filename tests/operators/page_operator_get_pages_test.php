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

class page_operator_get_pages_test extends page_operator_base
{
	/**
	* Test data for the test_get_pages() function
	*
	* @return array Array of test page entities
	*/
	public function get_pages_test_data()
	{
		return [
			[
				0,
				0,
				[
					[
						'page_id' => 1,
						'page_order' => 1,
						'page_description' => 'description_1',
						'page_description_display' => 0,
						'page_route' => 'page_1',
						'page_title' => 'title_1',
						'page_content' => 'message_1',
						'page_display' => 1,
						'page_display_to_guests' => 1,
						'page_title_switch' => 0,
						'page_icon_font' => 'foo-1',
					],
					[
						'page_id' => 2,
						'page_order' => 2,
						'page_description' => 'description_2',
						'page_description_display' => 0,
						'page_route' => 'page_2',
						'page_title' => 'title_2',
						'page_content' => 'message_2',
						'page_display' => 1,
						'page_display_to_guests' => 1,
						'page_title_switch' => 0,
						'page_icon_font' => '',
					],
					[
						'page_id' => 3,
						'page_order' => 3,
						'page_description' => 'description_3',
						'page_description_display' => 0,
						'page_route' => 'page_3',
						'page_title' => 'title_3',
						'page_content' => 'message_3',
						'page_display' => 1,
						'page_display_to_guests' => 0,
						'page_title_switch' => 0,
						'page_icon_font' => '',
					],
					[
						'page_id' => 4,
						'page_order' => 4,
						'page_description' => 'description_4',
						'page_description_display' => 0,
						'page_route' => 'page_4',
						'page_title' => 'title_4',
						'page_content' => 'message_4',
						'page_display' => 0,
						'page_display_to_guests' => 0,
						'page_title_switch' => 0,
						'page_icon_font' => '',
					],
				],
			],
			[
				2,
				1,
				[
					[
						'page_id' => 3,
						'page_order' => 3,
						'page_description' => 'description_3',
						'page_description_display' => 0,
						'page_route' => 'page_3',
						'page_title' => 'title_3',
						'page_content' => 'message_3',
						'page_display' => 1,
						'page_display_to_guests' => 0,
						'page_title_switch' => 0,
						'page_icon_font' => '',
					],
				],
			],
		];
	}

	/**
	* Test getting pages from the database
	*
	* @dataProvider get_pages_test_data
	*/
	public function test_get_pages($start, $limit, $expected)
	{
		// Set up the operator class
		$operator = $this->get_page_operator();

		// Grab the page data as an array of entities
		$entities = $operator->get_pages($limit, $start);

		// Map the fields to the getters
		$map = [
			'page_id'					=> 'get_id',
			'page_order' 				=> 'get_order',
			'page_description'			=> 'get_description',
			'page_description_display'	=> 'get_description_display',
			'page_route'				=> 'get_route',
			'page_title'				=> 'get_title',
			'page_content'				=> 'get_content_for_edit',
			'page_display'				=> 'get_page_display',
			'page_display_to_guests'	=> 'get_page_display_to_guests',
			'page_title_switch'			=> 'get_page_title_switch',
			'page_icon_font'			=> 'get_icon_font',
		];

		// Test through each entity in the array of entities
		$i = 0;
		foreach ($entities as $entity)
		{
			// Go through each field in the data and make sure the function returns
			// what we saved
			foreach ($map as $field => $function)
			{
				self::assertEquals($expected[$i][$field], $entity->$function());
			}

			$i++;
		}
	}
}
