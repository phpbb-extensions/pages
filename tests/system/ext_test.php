<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\tests\system;

class ext_test extends \phpbb_test_case
{
	public function test_extension_is_enableable_on_supported_phpbb()
	{
		$container = $this->createMock(\Symfony\Component\DependencyInjection\ContainerInterface::class);
		$finder = $this->getMockBuilder(\phpbb\finder::class)->disableOriginalConstructor()->getMock();
		$migrator = $this->getMockBuilder(\phpbb\db\migrator::class)->disableOriginalConstructor()->getMock();
		$extension = new \phpbb\pages\ext($container, $finder, $migrator, 'phpbb/pages', '');

		self::assertTrue($extension->is_enableable());
	}
}
