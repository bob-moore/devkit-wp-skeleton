<?php
/**
 * Member definition file
 *
 * PHP Version 8.1
 *
 * @package WP Plugin Skeleton
 * @author  Bob Moore <bob@bobmoore.dev>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/WP-Plugin-Skeleton
 * @since   1.0.0
 */

namespace Devkit\Skeleton\Abstracts;

use Devkit\Skeleton\Interfaces;

use DI\Attribute\Inject;

/**
 * Abstract Member class
 *
 * @subpackage Abstracts
 */
abstract class Member implements Interfaces\Member
{
	/**
	 * Package this service belongs to
	 *
	 * $package defines a group of classes used together. For instance, classes
	 * outside of this plugin can extend this class, as part of a theme package.
	 *
	 * @var string
	 */
	protected string $package = '';
	/**
	 * Base constructor
	 */
	public function __construct()
	{
	}
	/**
	 * Setter for package field
	 *
	 * @param string $package : string to set package to, transformed to Underscore separated & lowercase.
	 *
	 * @return void
	 */
	#[Inject]
	public function setPackage( #[Inject( 'app.package' )] string $package ): void
	{
		$this->package = strtolower( str_replace( [ '\\', '/', ' ' ], '_', trim( $package ) ) );
	}
	/**
	 * Getter for package field
	 *
	 * @return string
	 */
	public function getPackage(): string
	{
		return $this->package;
	}
}
