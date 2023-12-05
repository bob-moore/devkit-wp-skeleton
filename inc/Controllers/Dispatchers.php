<?php
/**
 * Dispatcher Controller
 *
 * PHP Version 8.1
 *
 * @package WP Plugin Skeleton
 * @author  Bob Moore <bob@bobmoore.dev>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/WP-Plugin-Skeleton
 * @since   1.0.0
 */

namespace Devkit\Skeleton\Controllers;

use Devkit\Skeleton\DI\ContainerBuilder,
	Devkit\Skeleton\Dispatchers as Dispatcher,
	Devkit\Skeleton\Interfaces,
	Devkit\Skeleton\Abstracts;

/**
 * Controls the registration and execution of Dispatchers
 *
 * @subpackage Controllers
 */
class Dispatchers extends Abstracts\Mountable implements Interfaces\Controller
{
	/**
	 * Get definitions that should be added to the service container
	 *
	 * @return array<string, mixed>
	 */
	public static function getServiceDefinitions(): array
	{
		return [
			/**
			 * Class Aliases
			 */
			Dispatcher\Styles::class              => ContainerBuilder::autowire(),
			Dispatcher\Scripts::class             => ContainerBuilder::autowire(),
			/**
			 * Interfaces
			 */
			Interfaces\Dispatchers\Styles::class  => ContainerBuilder::get( Dispatcher\Styles::class ),
			Interfaces\Dispatchers\Scripts::class => ContainerBuilder::get( Dispatcher\Scripts::class ),

		];
	}
}
