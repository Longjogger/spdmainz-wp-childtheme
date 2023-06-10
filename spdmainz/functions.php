<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'child-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'child-stylescss', get_template_directory_uri().'/css/style.css' );
}