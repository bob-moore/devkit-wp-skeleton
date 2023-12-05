<?php
/**
 * Plugin bootstrap file
 *
 * @package App
 *
 * @wordpress-plugin
 * Plugin Name: Devkit Plugin Skeleton
 * Plugin URI:  https://github.com/bob-moore/WP-Plugin-Skeleton
 * Description: Custom Description
 * Version:     1.0.0
 * Author:      Bob Moore
 * Author URI:  https://www.bobmoore.dev
 * Donate link: https://midwestfamilymadison.com
 * Tags: framework, sample
 * Requires at least: 6.0
 * Tested up to: 6.3
 * Requires PHP: 8.0.28
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: devkit-skeleton
 */

namespace Devkit\Skeleton;

defined( 'ABSPATH' ) || exit;

require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'vendor/autoload.php';

$plugin = new Main( 'skeleton', __FILE__ );

$plugin->mount();