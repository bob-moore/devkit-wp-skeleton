<?php
/**
 * Directory Handler interface definition
 *
 * PHP Version 8.1
 *
 * @package WP Plugin Skeleton
 * @author  Bob Moore <bob@bobmoore.dev>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/WP-Plugin-Skeleton
 * @since   1.0.0
 */

namespace Devkit\Skeleton\Interfaces\Handlers;

/**
 * Handlers\Directory interface
 *
 * Used to type hint against Devkit\Skeleton\Interfaces\Handlers\Directory.
 *
 * @subpackage Interfaces
 */
interface Directory
{
	/**
	 * Set the base directory - relative to the main plugin file
	 *
	 * Can include an additional string, to make it relative to a different file
	 *
	 * @param string $dir : root path of the plugin.
	 * @param string $append : string to append to the directory path.
	 *
	 * @return void
	 */
	public function setDir( string $dir, string $append = '' ): void;
	/**
	 * Get the directory path with string appended
	 *
	 * @param string $append : string to append to the directory path.
	 *
	 * @return string complete url
	 */
	public function dir( string $append = '' ): string;
}
