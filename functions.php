<?php

require_once ( get_theme_file_path('/inc/tgm.php') );
require_once ( get_theme_file_path('/inc/attachments.php') );

if(site_url() == 'http://localhost/wtd/') {
    define('VERSION', time() );
} else {
    define('VERSION', wp_get_theme()->get('Version'));
}



// Main bootstrapping
function philosofy_theme_setup() {
    load_theme_textdomain('philosofy');
    add_theme_support( 'post-thumbnails' );
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'comment-list'));
    add_theme_support('post-formats', array('image', 'gallery', 'quote', 'audio', 'video', 'link'));
    add_editor_style('/assets/css/editor-style.css');

    register_nav_menu('topmenu',__('Top Menu', 'philosofy'));

    add_image_size('philosofy-image-square', 400, 400, true );
}
add_action('after_setup_theme', 'philosofy_theme_setup');


// All style and scripts files
function philosofy_assets() {
    wp_enqueue_style('fontawesome-css', get_theme_file_uri('/assets/css/font-awesome/css/font-awesome.css'),null, '1.0');
    wp_enqueue_style('fonts-css', get_theme_file_uri('/assets/css/fonts.css'),null, '1.0');
    wp_enqueue_style('base-css', get_theme_file_uri('/assets/css/base.css'),null, '1.0');
    wp_enqueue_style('vendor-css', get_theme_file_uri('/assets/css/vendor.css'),null, '1.0');
    wp_enqueue_style('main-css', get_theme_file_uri('/assets/css/main.css'),null, 'VERSION');
    wp_enqueue_style('philosofy-css', get_stylesheet_uri(),null, VERSION);

    wp_enqueue_script('modernizr', get_theme_file_uri('/assets/js/modernizr.js'),null, 1.0);
    wp_enqueue_script('pace-min-js', get_theme_file_uri('/assets/js/pace.min.js'),null, 1.0);
    wp_enqueue_script('plugins-js', get_theme_file_uri('/assets/js/plugins.js'),array('jquery'), 1.0, true);
    wp_enqueue_script('main-js', get_theme_file_uri('/assets/js/main.js'),array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'philosofy_assets');


// Pagination 
function philosofy_pagination() {
    global $wp_query;
    $links = paginate_links(array(
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query -> max_num_pages,
        'type' => 'list',
        'mid_size' => 3
    ));
    $links = str_replace('page-numbers', 'pgn__num', $links);
    $links = str_replace("<ul class ='pgn__num'>", "<ul>", $links);
    $links = str_replace("next pgn__num", "pgn__next", $links);
    $links = str_replace("prev pgn__num", "pgn__prev", $links);
    echo $links;
}


