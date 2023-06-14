<?php
/**
 * Enabling Child Theme
 */
function child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() .'/css/style.css' , array('parent-style'));
}
add_action( 'wp_enqueue_scripts', 'child_theme_styles', PHP_INT_MAX );

/**
 * Adjustment Team Showcase
 */
function team_styles() {
    global $post;
    if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'tmfshortcode') ) {
        wp_enqueue_style( 'team-stylesheet',  get_stylesheet_directory_uri() . '/css/team.css' );
        wp_enqueue_script( 'team-javascript',  get_stylesheet_directory_uri() . '/js/team.css' );
    }
}
add_action( 'get_footer', 'team_styles');

/**
 * Disabling Author Page
 */
function rn_author_page_redirect() {
    if ( is_author() ) {
        wp_redirect( home_url() );
    }
}
add_action( 'template_redirect', 'rn_author_page_redirect' );

/**
 * Remove Meta-Tag Generator
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Remove Generator Meta-Tag
 */
remove_action( 'wp_head', 'wp_generator' );  

/**
 * Remove DNS-Prefetch
 */
remove_action( 'wp_head', 'wp_resource_hints', 2 );

/**
 * Remove RSD Link
 */
remove_action( 'wp_head', 'rsd_link' );

/**
 * Remove WP-Manifest Link
 */
remove_action( 'wp_head', 'wlwmanifest_link' );

/**
 * Remove Emojis
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Disable Users Rest Endpoint
 */
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
add_filter( 'rest_endpoints', function( $endpoints ) {
    if ( isset( $endpoints['/wp/v2/users'] ) ) {
        unset( $endpoints['/wp/v2/users'] );
    }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
});
