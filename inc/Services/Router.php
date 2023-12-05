<?php
/**
 * Router Service Definition
 *
 * PHP Version 8.1
 *
 * @package WP Plugin Skeleton
 * @author  Bob Moore <bob@bobmoore.dev>
 * @license GPL-2.0+ <http://www.gnu.org/licenses/gpl-2.0.txt>
 * @link    https://github.com/bob-moore/WP-Plugin-Skeleton
 * @since   1.0.0
 */

namespace Devkit\Skeleton\Services;

use Devkit\Skeleton\Abstracts,
	Devkit\Skeleton\Interfaces;

/**
 * Service class for router actions
 *
 * @subpackage Services
 */
class Router extends Abstracts\Mountable implements Interfaces\Services\Router
{
	/**
	 * Routes available on current context
	 *
	 * @var array<int, string>
	 */
	protected array $routes = [];
	/**
	 * Define current route(s)
	 *
	 * Can't be run until 'wp' action when the query is available
	 *
	 * @return array<string>
	 */
	protected function defineRoutes(): array
	{
		$routes = match ( true ) {
			is_front_page() && ! is_home() => [ 'single', 'frontpage' ],
			is_home() => [ 'archive', 'blog' ],
			is_search() => [ 'archive', 'search' ],
			is_archive() => [ 'archive' ],
			is_singular() => [ 'single' ],
			is_404() => [ '404' ],
			is_login() => [ 'login' ],
			is_admin() => [ 'admin' ],
			default => []
		};
		return array_reverse( apply_filters( "{$this->package}_routes", $routes ) );
	}
	/**
	 * Getter for views
	 *
	 * @return array<string>
	 */
	public function getRoutes(): array
	{
		if ( empty( $this->routes ) ) {
			$this->routes = $this->defineRoutes();
		}
		return $this->routes;
	}
	/**
	 * Get routes via filter
	 *
	 * @param array<string> $default_routes : routes to prepend to the list.
	 *
	 * @return array<string>
	 */
	public function getRoutesByFilter( array $default_routes = [] ): array
	{
		$routes = $this->getRoutes();

		return ! empty( $default_routes )
			? array_merge( $default_routes, $this->getRoutes() )
			: $this->getRoutes();
	}
	/**
	 * Setter for $route
	 *
	 * @return void
	 */
	public function loadRoute(): void
	{
		foreach ( $this->getRoutes() as $route ) {
			$this->loadSingleRoute( $route );
		}
		/**
		 * Final check to load frontend if nothing has loaded at this point
		 */
		if ( ! $this->routeHasLoaded() && ! is_admin() && ! wp_doing_ajax() && ! wp_doing_cron() ) {
			$this->loadSingleRoute( 'frontend' );
		}
	}
	/**
	 * Load a singular route
	 *
	 * @param string $route : string route name.
	 *
	 * @return void
	 */
	protected function loadSingleRoute( string $route ): void
	{
		$alias = 'route.' . strtolower( $route );

		$has_route = apply_filters( "{$this->package}_has_route", false, $alias );

		if ( ! $this->routeHasLoaded() && $has_route ) {
			do_action( "{$this->package}_load_route", $alias, $route );
		}
		do_action( "{$this->package}_route_{$route}", $alias );
	}
	/**
	 * Determine if a route has already been loaded
	 *
	 * @return int
	 */
	public function routeHasLoaded(): int
	{
		return did_action( "{$this->package}_load_route" );
	}
}
