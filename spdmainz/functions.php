<?php
/**
 * Enabling Child Theme
 */
add_action( 'wp_enqueue_scripts', 'child_theme_styles', PHP_INT_MAX );
function child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() .'/css/style.css' , array('parent-style'));
}

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
 * Remove WP-Manifest Link
 */
remove_action( 'wp_head', 'wlwmanifest_link' );  