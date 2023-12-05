<?php
/**
 * Handler Controller
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
	DI\Attribute\Inject,
	Devkit\Skeleton\DI\OnMount,
	Devkit\Skeleton\Services as Service,
	Devkit\Skeleton\Interfaces,
	Devkit\Skeleton\Traits,
	Devkit\Skeleton\Abstracts,
	Devkit\Skeleton\Helpers;

use Psr\Container\ContainerInterface;

/**
 * Controls the registration and execution of services
 *
 * @subpackage Controllers
 */
class Entities extends Abstracts\Mountable implements Interfaces\Controller
{
	use Traits\Handlers\Directory;
	/**
	 * Array of custom taxonomies
	 *
	 * @var array<Interfaces\Entities\Taxonomy>
	 */
	protected array $taxonomies = [];
	/**
	 * Array of custom post types
	 *
	 * @var array<Interfaces\Entities\Taxonomy>
	 */
	protected array $post_types = [];
	/**
	 * Collection of blocks to register
	 *
	 * @var array<string, string>
	 */
	protected array $blocks = [];
	/**
	 * Get definitions that should be added to the service container
	 *
	 * @return array<string, mixed>
	 */
	public static function getServiceDefinitions(): array
	{
		return [
			// Entity\PageCategories::class => ContainerBuilder::autowire(),
			// Entity\SamplePostType::class => ContainerBuilder::autowire(),
			static::class                => ContainerBuilder::decorate(
				[
					static::class,
					'decorateInstance',
				]
			),
		];
	}
	/**
	 * Class decorator
	 *
	 * Injects setters for taxonomies, post types, and blocks.
	 *
	 * @param self               $instance : instance of this class.
	 * @param ContainerInterface $container : container instance.
	 *
	 * @return self
	 */
	public static function decorateInstance( self $instance, ContainerInterface $container ): self
	{
		// $instance->setTaxonomies(
		// 	$container->get( Entity\PageCategories::class )
		// );
		// $instance->setPostTypes(
		// 	$container->get( Entity\SamplePostType::class )
		// );
		foreach ( glob( $instance->dir( 'blocks/*/block.json' ) ) as $block_file ) {
			$instance->setBlocks( $block_file );
		}
		return $instance;
	}
	/**
	 * Set the base directory referenced by this class
	 *
	 * @param string $dir : path to directory containing blocks.
	 *
	 * @return void
	 */
	#[Inject]
	public function setDir( #[Inject( 'app.dir' )] string $dir, #[Inject( 'assets.dir' )] string $append ): void
	{
		$this->dir = $this->appendDir( $dir, $append );
	}
	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	#[OnMount]
	public function mount(): void
	{
		add_action( 'init', [ $this, 'registerTaxonomies' ] );
		add_action( 'init', [ $this, 'registerPostTypes' ] );
		add_action( 'init', [ $this, 'registerBlocks' ] );
	}
	/**
	 * Taxonomies setter
	 *
	 * @param Interfaces\Entities\Taxonomy ...$taxonomies : array of taxonomy objects.
	 *
	 * @return void
	 */
	public function setTaxonomies( Interfaces\Entities\Taxonomy ...$taxonomies ): void
	{
		$this->taxonomies = array_merge( $this->taxonomies, $taxonomies );
	}
	/**
	 * Register custom taxonomies
	 *
	 * @return void
	 */
	public function registerTaxonomies(): void
	{
		foreach ( $this->taxonomies as $taxonomy ) {
			if ( ! Helpers::implements( $taxonomy, Interfaces\Entities\Taxonomy::class ) ) {
				continue;
			}
			register_taxonomy(
				$taxonomy->getName(),
				$taxonomy->getPostTypes(),
				$taxonomy->getDefinition()
			);

			foreach ( $taxonomy->getPostTypes() as $post_type ) {
				register_taxonomy_for_object_type( $taxonomy->getName(), $post_type );
			}
		}
	}
	/**
	 * Post Type Setter
	 *
	 * @param Interfaces\Entities\PostType ...$post_types : array of post type objects.
	 *
	 * @return void
	 */
	public function setPostTypes( Interfaces\Entities\PostType ...$post_types ): void
	{
		$this->post_types = array_merge( $this->post_types, $post_types );
	}
	/**
	 * Register custom post types
	 *
	 * @return void
	 */
	public function registerPostTypes(): void
	{
		foreach ( $this->post_types as $post_type ) {
			if ( ! Helpers::implements( $post_type, Interfaces\Entities\PostType::class ) ) {
				continue;
			}
			register_post_type( $post_type->getName(), $post_type->getDefinition() );
		}
	}
	/**
	 * Blocks setter
	 *
	 * @param string ...$blocks : paths to block.json file(s).
	 *
	 * @return void
	 */
	public function setBlocks( string ...$blocks ): void
	{
		$this->blocks = array_merge( $this->blocks, $blocks );
	}
	/**
	 * Register custom blocks
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 *
	 * @return void
	 */
	public function registerBlocks(): void
	{
		foreach ( $this->blocks as $block_file ) {
			if ( is_string( $block_file ) && is_file( $block_file ) ) {
				register_block_type( $block_file );
			}
		}
	}
}
