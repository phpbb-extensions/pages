<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2025 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\pages\textreparser;

/**
 * Factory for creating cron text reparser task instances
 *
 * This factory handles the dynamic creation of text reparser tasks,
 * ensuring compatibility with different phpBB versions by using reflection
 * to determine and provide the correct constructor arguments.
 */
class cron_text_reparser_factory
{
	/**
	 * Creates a new instance of the text reparser cron task
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface $container Service container
	 * @return \phpbb\cron\task\text_reparser\reparser Configured a text reparser cron task
	 * @throws \ReflectionException If the reparser class cannot be reflected
	 */
	public function create($container)
	{
		$args = $this->get_constructor_arguments($container);

		// Using ReflectionClass to instantiate with a variable number of arguments
		$reflection = new \ReflectionClass(\phpbb\cron\task\text_reparser\reparser::class);
		$reparser = $reflection->newInstanceArgs($args);

		$reparser->set_name('cron.task.text_reparser.phpbb_pages');
		$reparser->set_reparser('phpbb.pages.text_reparser.page_text');
		return $reparser;
	}

	/**
	 * Gets the constructor arguments for the reparser based on reflection
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerInterface $container Service container
	 * @return array Array of constructor arguments
	 * @throws \ReflectionException If the reparser class cannot be reflected
	 */
	private function get_constructor_arguments($container)
	{
		$reflection = new \ReflectionClass(\phpbb\cron\task\text_reparser\reparser::class);
		$constructor = $reflection->getConstructor();
		$params = $constructor->getParameters();

		$arguments = array();
		foreach ($params as $param)
		{
			$service_name = $this->get_service_name($param->getName());
			if ($container->has($service_name))
			{
				$arguments[] = $container->get($service_name);
			}
			else if ($param->isOptional())
			{
				$arguments[] = $param->getDefaultValue();
			}
		}

		return $arguments;
	}

	/**
	 * Maps parameter names to their corresponding service IDs
	 *
	 * @param string $param_name Name of the parameter from the constructor
	 * @return string Service ID corresponding to the parameter
	 */
	private function get_service_name($param_name)
	{
		$serviceMap = [
			'config'				=> 'config',
			'config_text'		=> 'config_text',
			'reparse_lock'		=> 'text_reparser.lock',
			'reparser_manager'	=> 'text_reparser.manager',
			'reparsers'			=> 'text_reparser_collection'
		];

		return $serviceMap[$param_name] ?? $param_name;
	}
}
