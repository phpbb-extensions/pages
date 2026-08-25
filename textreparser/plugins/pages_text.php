<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2016 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\textreparser\plugins;

class pages_text extends \phpbb\textreparser\row_based_plugin
{
	/** @var \phpbb\pages\textformatter\litedown */
	protected $litedown;

	/**
	 * @param \phpbb\db\driver\driver_interface   $db        Database connection
	 * @param string                                $table     Pages table
	 * @param \phpbb\pages\textformatter\litedown $litedown  LiteDown parser manager
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, $table, \phpbb\pages\textformatter\litedown $litedown)
	{
		parent::__construct($db, $table);
		$this->litedown = $litedown;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_columns()
	{
		return array(
			'id'			=> 'page_id',
			'text'			=> 'page_content',
			'bbcode_uid'	=> 'page_content_bbcode_uid',
			'options'		=> 'page_content_bbcode_options',
			'markdown'		=> 'page_content_markdown',
		);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function reparse_record(array $record, bool $force_bbcode_reparsing = false)
	{
		if (empty($record['markdown']))
		{
			parent::reparse_record($record, $force_bbcode_reparsing);
			return;
		}

		$text = \s9e\TextFormatter\Unparser::unparse($record['text']);
		$text = $this->litedown->parse(
			$text,
			(bool) ($record['options'] & OPTION_FLAG_BBCODE) || $force_bbcode_reparsing,
			(bool) ($record['options'] & OPTION_FLAG_LINKS) || $force_bbcode_reparsing,
			(bool) ($record['options'] & OPTION_FLAG_SMILIES) || $force_bbcode_reparsing,
			false
		);

		if ($text !== $record['text'] && $this->save_changes)
		{
			$record['text'] = $text;
			$this->save_record($record);
		}
	}
}
