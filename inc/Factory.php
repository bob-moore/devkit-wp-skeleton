<?php
/**
 * Factory definition
 *
 * PHP Version 8.1
 *
 * @package WP Plugin Skeleton
 * @author  Bob Moore <bob@bobmoore.dev>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/WP-Plugin-Skeleton
 * @since   1.0.0
 */

namespace Devkit\Skeleton;

/**
 * App Factory
 *
 * Used to bootstrap extended files.
 *
 * @subpackage Utilities
 */
class Factory
{
	/**
	 * Static function to create new instances of `main`
	 *
	 * @param string $class : name of the class to instantiate.
	 * @param string $package : package ID to pass to main.
	 * @param string $root_file : root file/dir location to use.
	 *
	 * @return Main|null
	 */
	public static function create( string $class, string $package = '', string $root_file = '' ): ?Main
	{
		// require_once trailingslashit( dirname( __DIR__, 1 ) ) . 'deps/autoload.php';

		if ( is_subclass_of( $class, Main::class ) ) {
			$app = new $class( $package, $root_file );
			$app->mount();
			return $app;
		}
		return null;
	}
}
