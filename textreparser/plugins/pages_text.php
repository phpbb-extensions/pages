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
		if (!empty($record['markdown']))
		{
			$text = \s9e\TextFormatter\Unparser::unparse($record['text']);
			$text = $this->litedown->parse(
				$text,
				(bool) ($record['options'] & OPTION_FLAG_BBCODE) || $force_bbcode_reparsing,
				(bool) ($record['options'] & OPTION_FLAG_LINKS) || $force_bbcode_reparsing,
				(bool) ($record['options'] & OPTION_FLAG_SMILIES) || $force_bbcode_reparsing,
				false
			);
		}
		else
		{
			$text = $this->reparse_standard_content($record, $force_bbcode_reparsing);
		}

		if ($text !== $record['text'] && $this->save_changes)
		{
			$record['text'] = $text;
			$this->save_record($record);
		}
	}

	/**
	 * Reparse standard content safely
	 *
	 * @noinspection PhpParamsInspection
	 * @noinspection DuplicatedCode
	 */
	private function reparse_standard_content(array $record, bool $force_bbcode_reparsing): string
	{
		$record['enable_magic_url'] = $this->guess_magic_url($record);
		$record = $this->add_missing_fields($record);

		$flags = ($record['enable_bbcode'] || $force_bbcode_reparsing) ? OPTION_FLAG_BBCODE : 0;
		$flags |= ($record['enable_smilies'] || $force_bbcode_reparsing) ? OPTION_FLAG_SMILIES : 0;
		$flags |= ($record['enable_magic_url'] || $force_bbcode_reparsing) ? OPTION_FLAG_LINKS : 0;
		$unparsed = array_merge(
			$record,
			generate_text_for_edit($record['text'], $record['bbcode_uid'], $flags)
		);

		// Keep the edit helper's escaping. The storage parser decodes it once.
		$text = $unparsed['text'];
		$bitfield = $flags = null;
		generate_text_for_storage(
			$text,
			$unparsed['bbcode_uid'],
			$bitfield,
			$flags,
			$unparsed['enable_bbcode'] || $force_bbcode_reparsing,
			$unparsed['enable_magic_url'] || $force_bbcode_reparsing,
			$unparsed['enable_smilies'] || $force_bbcode_reparsing,
			$unparsed['enable_img_bbcode'] || $force_bbcode_reparsing,
			$unparsed['enable_quote_bbcode'] || $force_bbcode_reparsing,
			$unparsed['enable_url_bbcode'] || $force_bbcode_reparsing,
			'text_reparser.' . $this->get_name()
		);

		return $text;
	}
}
