<?php
/**
 * Route Controller
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
	Devkit\Skeleton\Abstracts,
	Devkit\Skeleton\Interfaces,
	Devkit\Skeleton\Routes as Route;

/**
 * Controls the registration and execution of Routes
 *
 * @subpackage Controllers
 */
class Routes extends Abstracts\Mountable implements Interfaces\Controller
{
	/**
	 * Get definitions that should be added to the service container
	 *
	 * @return array<string, mixed>
	 */
	public static function getServiceDefinitions(): array
	{
		return [
			'route.frontend' => ContainerBuilder::autowire( Route\Frontend::class ),
			'route.admin'    => ContainerBuilder::autowire( Route\Frontend::class ),
			'route.login'    => ContainerBuilder::autowire( Route\Frontend::class ),
		];
	}
}
