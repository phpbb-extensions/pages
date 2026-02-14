<?php
/**
 *
 * Pages extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2015, 2025 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */
// phpcs:disable PSR1.Files.SideEffects

namespace phpbb\pages\routing;

use Symfony\Component\HttpKernel\Kernel;

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * This code determines which page_loader class to use based on the Symfony version.
 * Symfony 7+ (phpBB4) uses page_loader_phpbb4, otherwise page_loader_phpbb3.
 *
 * @noinspection PhpMultipleClassDeclarationsInspection
 */
if (!class_exists(page_loader::class, false))
{
	// phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses
	if (version_compare(Kernel::VERSION, '7.0.0', '>='))
	{
		class page_loader extends page_loader_phpbb4 {}
	}
	else
	{
		class page_loader extends page_loader_phpbb3 {}
	}
	// phpcs:enable PSR1.Classes.ClassDeclaration.MultipleClasses
}
// phpcs:enable PSR1.Files.SideEffects
