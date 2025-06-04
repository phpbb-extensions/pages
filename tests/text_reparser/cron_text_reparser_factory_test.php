<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2025 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\tests\text_reparser;

use phpbb\pages\textreparser\cron_text_reparser_factory;
use Symfony\Component\DependencyInjection\ContainerInterface;

class cron_text_reparser_factory_test extends \phpbb_test_case
{
	/** @var \PHPUnit\Framework\MockObject\MockObject|ContainerInterface */
	protected $container;

	/** @var cron_text_reparser_factory */
	protected $factory;

	protected function setUp(): void
	{
		$this->container = $this->createMock(ContainerInterface::class);
		$this->factory = new cron_text_reparser_factory();
	}

	public function test_create_reparser()
	{
		// Mock the necessary services
		$config = $this->createMock(\phpbb\config\config::class);
		$config_text = $this->createMock(\phpbb\config\db_text::class);
		$reparse_lock = $this->createMock(\phpbb\lock\db::class);
		$reparser_manager = $this->createMock(\phpbb\textreparser\manager::class);
		$reparsers = $this->createMock(\phpbb\di\service_collection::class);

		// Configure a container to return our mocked services
		$this->container->method('has')
			->willReturnCallback(function($service) {
				$valid_services = [
					'config' => true,
					'config_text' => true,
					'text_reparser.lock' => true,
					'text_reparser.manager' => true,
					'text_reparser_collection' => true,
				];
				return $valid_services[$service] ?? false;
			});

		$this->container->method('get')
			->willReturnCallback(function($service) use ($config, $config_text, $reparse_lock, $reparser_manager, $reparsers) {
				$services = [
					'config' => $config,
					'config_text' => $config_text,
					'text_reparser.lock' => $reparse_lock,
					'text_reparser.manager' => $reparser_manager,
					'text_reparser_collection' => $reparsers,
				];
				return $services[$service] ?? null;
			});

		$reparser = $this->factory->create($this->container);

		// Assert the reparser was created successfully
		$this->assertInstanceOf(\phpbb\cron\task\text_reparser\reparser::class, $reparser);
		$this->assertEquals('cron.task.text_reparser.phpbb_pages', $reparser->get_name());
	}

	public function test_missing_required_service()
	{
		// Mock container to simulate missing service
		$this->container->method('has')
			->willReturn(false);

		$this->container->method('get')
			->willReturn(null);

		$this->expectException(\ArgumentCountError::class);
		$this->expectExceptionMessage('Too few arguments to function phpbb\cron\task\text_reparser\reparser::__construct(), 0 passed and exactly 5 expected');

		$this->factory->create($this->container);
	}

	public function test_service_name_mapping()
	{
		$reflection = new \ReflectionClass(cron_text_reparser_factory::class);
		$method = $reflection->getMethod('get_service_name');
		$method->setAccessible(true);

		$expected_mappings = [
			'config' => 'config',
			'config_text' => 'config_text',
			'reparse_lock' => 'text_reparser.lock',
			'reparser_manager' => 'text_reparser.manager',
			'reparsers' => 'text_reparser_collection',
			'unknown_param' => 'unknown_param',
		];

		foreach ($expected_mappings as $param => $expected)
		{
			$this->assertEquals(
				$expected,
				$method->invoke($this->factory, $param),
				"Service mapping failed for parameter '$param'"
			);
		}
	}
}
