<?php
/**
 * Enabling Child Theme
 */
function child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-theme', get_stylesheet_directory_uri() .'/css/style.css' , array('parent-style') );
}
add_action( 'wp_enqueue_scripts', 'child_theme_styles', PHP_INT_MAX );

add_action( 'get_footer', function () {
    wp_enqueue_script( 'main-javascript',  get_stylesheet_directory_uri() . '/js/main.js' );
});


/**
 * Adding Favicon
 */
function wp_favicon() {
    ?>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/favicon-16x16.png">
<link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/site.webmanifest">
<link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
    <?php
}
add_action('wp_head', 'wp_favicon');


/**
 * Frontpage: Loading Calendar Icon
 */
function add_startseite_js() {
    if( is_front_page() ) {
        wp_enqueue_script( 'startseite-javascript',  get_stylesheet_directory_uri() . '/js/startseite.js' );
    }
}
add_action( 'get_footer', 'add_startseite_js' );


/**
 * Team Showcase: Loading Style & Script, if Shortcode is using
 */
add_action( 'get_footer', function () {
    global $post;
    if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'tmfshortcode' ) ) {
        wp_enqueue_style( 'team',  get_stylesheet_directory_uri() . '/css/team.css' );
        wp_enqueue_script( 'team',  get_stylesheet_directory_uri() . '/js/team.js' );
    }
} );


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

/**
 * Add Events Manager Placeholder
 */
add_filter( 'em_event_output_placeholder', 'my_em_styles_placeholders', 1, 3 );
function my_em_styles_placeholders($code, $EM_Event, $result) {
    if( $result == '#_DATA' ) {

        $data = array();
        // General
        $data['@context'] = 'http://schema.org';
        $data['@type'] = 'Event';
    
        // Event Name
        $data['name'] = $EM_Event->name;
        // Event URL
        $data['url'] = $EM_Event->output('#_EVENTURL');
        // Calculate Event Start
        $timezone = ( strtotime( $EM_Event->start()->getDateTime() ) - strtotime( $EM_Event->start(true)->getDateTime() ) ) / 60 / 60;
        if( $timezone > 0 && $timezone < 10 ) {
            $timezone = '+0' . $timezone . ':00';
        }       
        $data['startDate'] = $EM_Event->start()->getDate() . 'T' . $EM_Event->start()->getTime() . $timezone;

        // Generating Code
        $code = '<script type="application/ld+json">' . json_encode($data, JSON_UNESCAPED_SLASHES, JSON_UNESCAPED_UNICODE) . '</script>';

    }
    return $code;
}