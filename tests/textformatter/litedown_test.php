<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\tests\textformatter;

class litedown_test extends \phpbb_test_case
{
	/**
	 * Parser is resolved lazily and configured for Pages content
	 */
	public function test_parse()
	{
		$parser = $this->getMockBuilder('\phpbb\textformatter\s9e\parser')
			->disableOriginalConstructor()
			->getMock();
		$parser->expects(self::once())->method('enable_bbcodes');
		$parser->expects(self::once())->method('disable_magic_url');
		$parser->expects(self::once())->method('enable_smilies');
		$parser->expects(self::exactly(4))->method('enable_bbcode');
		$parser->expects(self::once())->method('set_vars');
		$parser->expects(self::once())
			->method('parse')
			->with('**Markdown**')
			->willReturn('<r><STRONG>Markdown</STRONG></r>');

		$container = $this->createMock('\Symfony\Component\DependencyInjection\ContainerInterface');
		$container->expects(self::once())
			->method('get')
			->with('phpbb.pages.text_formatter.parser')
			->willReturn($parser);

		$litedown = new \phpbb\pages\textformatter\litedown($container, new \phpbb\config\config(array()));
		self::assertSame('<r><STRONG>Markdown</STRONG></r>', $litedown->parse('**Markdown**', true, false, true));
	}

	/**
	 * Entity decoding can be skipped for text already recovered from stored XML
	 */
	public function test_parse_without_entity_decoding()
	{
		$parser = $this->getMockBuilder('\phpbb\textformatter\s9e\parser')
			->disableOriginalConstructor()
			->getMock();
		$parser->expects(self::once())
			->method('parse')
			->with('&lt;script&gt;')
			->willReturn('<t>&amp;lt;script&amp;gt;</t>');

		$container = $this->createMock('\Symfony\Component\DependencyInjection\ContainerInterface');
		$container->method('get')->willReturn($parser);

		$litedown = new \phpbb\pages\textformatter\litedown($container, new \phpbb\config\config(array()));
		self::assertSame(
			'<t>&amp;lt;script&amp;gt;</t>',
			$litedown->parse('&lt;script&gt;', false, false, false, false)
		);
	}

	/**
	 * Renderer is resolved lazily and restores censor state
	 */
	public function test_render()
	{
		$renderer = $this->getMockBuilder('\phpbb\textformatter\s9e\renderer')
			->disableOriginalConstructor()
			->getMock();
		$renderer->method('get_viewcensors')->willReturn(true);
		$renderer->expects(self::exactly(2))->method('set_viewcensors')->withConsecutive(array(false), array(true));
		$renderer->expects(self::once())->method('render')->with('<r/>')->willReturn('<p>Page</p>');

		$container = $this->createMock('\Symfony\Component\DependencyInjection\ContainerInterface');
		$container->expects(self::once())
			->method('get')
			->with('phpbb.pages.text_formatter.renderer')
			->willReturn($renderer);

		$litedown = new \phpbb\pages\textformatter\litedown($container, new \phpbb\config\config(array()));
		self::assertSame('<p>Page</p>', $litedown->render('<r/>', false));
	}

	/**
	 * Censor state is restored when rendering fails
	 */
	public function test_render_restores_censor_state_after_exception()
	{
		$renderer = $this->getMockBuilder('\phpbb\textformatter\s9e\renderer')
			->disableOriginalConstructor()
			->getMock();
		$renderer->method('get_viewcensors')->willReturn(true);
		$renderer->expects(self::exactly(2))->method('set_viewcensors')->withConsecutive(array(false), array(true));
		$renderer->method('render')->willThrowException(new \RuntimeException('Rendering failed'));

		$container = $this->createMock('\Symfony\Component\DependencyInjection\ContainerInterface');
		$container->method('get')->willReturn($renderer);

		$litedown = new \phpbb\pages\textformatter\litedown($container, new \phpbb\config\config(array()));

		$this->expectException('\RuntimeException');
		$this->expectExceptionMessage('Rendering failed');
		$litedown->render('<r/>', false);
	}
}
