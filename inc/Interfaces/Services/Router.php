<?php
/**
 * Router Service interface definition
 *
 * PHP Version 8.1
 *
 * @package WP Plugin Skeleton
 * @author  Bob Moore <bob@bobmoore.dev>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/WP-Plugin-Skeleton
 * @since   1.0.0
 */

namespace Devkit\Skeleton\Interfaces\Services;

/**
 * Services\Router interface
 *
 * Used to type hint against Devkit\Skeleton\Interfaces\Services\Router.
 *
 * @subpackage Interfaces
 */
interface Router
{
	/**
	 * Getter for views
	 *
	 * @return array<int, string>
	 */
	public function getRoutes(): array;
	/**
	 * Load route specific functionality
	 *
	 * @return void
	 */
	public function loadRoute(): void;
}
