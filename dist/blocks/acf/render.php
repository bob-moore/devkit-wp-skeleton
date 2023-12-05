<?php

/**
 * Render ACF block
 *
 * PHP Version 8.1
 *
 * @package    WP Plugin Skeleton
 * @subpackage Blocks
 * @since      1.0.0
 * 
 * @param array<string, mixed> $block : wp block data
 * @param string               $content : rendered content, should be blank for ACF blocks.
 * @param bool                 $is_preview : is block in preview mode.
 */
if ( function_exists( 'get_field_objects' ) )
{
    $fields = get_field_objects();

    $templates = [
        '@skeleton/blocks/acf/frontend.twig',
        '@skeleton/blocks/acf.twig'
    ];

    $context = [ 
        'fields' => $fields,
        'block' => $block,
        'is_preview' => $is_preview
    ];

    do_action( 'skeleton_render_template', $templates,  $context );
}