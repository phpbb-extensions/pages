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

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Enables LiteDown only while parsing Pages content
 */
class litedown
{
	/** @var ContainerInterface */
	protected $container;

	/** @var \phpbb\config\config */
	protected $config;

	/**
	 * @param ContainerInterface    $container Service container
	 * @param \phpbb\config\config $config    Configuration
	 */
	public function __construct(ContainerInterface $container, \phpbb\config\config $config)
	{
		$this->container = $container;
		$this->config = $config;
	}

	/**
	 * Parse Pages content with LiteDown
	 *
	 * @param string $text          Unparsed content
	 * @param bool   $allow_bbcode  Allow BBCode
	 * @param bool   $allow_urls    Allow magic URLs
	 * @param bool   $allow_smilies Allow smilies
	 * @param bool   $decode_entities Decode request-escaped HTML entities
	 * @return string Parsed XML
	 */
	public function parse($text, $allow_bbcode, $allow_urls, $allow_smilies, $decode_entities = true)
	{
		/** @var \phpbb\textformatter\s9e\parser $parser */
		$parser = $this->container->get('phpbb.pages.text_formatter.parser');

		$allow_bbcode ? $parser->enable_bbcodes() : $parser->disable_bbcodes();
		$allow_urls ? $parser->enable_magic_url() : $parser->disable_magic_url();
		$allow_smilies ? $parser->enable_smilies() : $parser->disable_smilies();
		$parser->enable_bbcode('img');
		$parser->enable_bbcode('flash');
		$parser->enable_bbcode('quote');
		$parser->enable_bbcode('url');
		$parser->set_vars(array(
			'max_font_size'  => $this->config['max_post_font_size'],
			'max_img_height' => $this->config['max_post_img_height'],
			'max_img_width'  => $this->config['max_post_img_width'],
			'max_smilies'    => $this->config['max_post_smilies'],
			'max_urls'       => $this->config['max_post_urls'],
		));

		return $parser->parse($decode_entities ? html_entity_decode($text, ENT_QUOTES) : $text);
	}

	/**
	 * Render parsed Pages Markdown
	 *
	 * @param string $xml         Parsed XML
	 * @param bool   $censor_text Whether to apply word censors
	 * @return string Rendered HTML
	 */
	public function render($xml, $censor_text = true)
	{
		/** @var \phpbb\textformatter\s9e\renderer $renderer */
		$renderer = $this->container->get('phpbb.pages.text_formatter.renderer');
		$old_censor = $renderer->get_viewcensors();

		if (!$censor_text && $old_censor)
		{
			$renderer->set_viewcensors(false);
		}

		try
		{
			return $renderer->render($xml);
		}
		finally
		{
			if (!$censor_text && $old_censor)
			{
				$renderer->set_viewcensors($old_censor);
			}
		}
	}
}
