<?php

require get_theme_file_path('/inc/search-route.php');

// Load CSS and JS files

function pet_files() {
  wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,100;9..40,200;9..40,300;9..40,400;9..40,500;9..40,600;9..40,700;9..40,800;9..40,900;9..40,1000&family=Mulish:wght@200;300;400;500;600;700;800;900;1000&display=swap', array(), null);
  wp_enqueue_script('pet-js', get_theme_file_uri('/src/index.js'), NULL, '1.0', true);
  wp_enqueue_style('pet_styles', get_stylesheet_uri());
  
  wp_localize_script('pet-js', 'petData', array(
    'root_url' => get_site_url()
  ));
}
add_action('wp_enqueue_scripts', 'pet_files');

/* 
Make nav menu controllable from WP admin 
and set browser title
*/

function pet_features() {
  register_nav_menu('headerMenuLocation', 'Header Menu Location');
  register_nav_menu('footerLocation', 'Footer Location');
  add_theme_support('title-tag');
}
add_action('after_setup_theme', 'pet_features');

// Add new custom field to rest API

function pet_custom_rest() {
  register_rest_field('post', 'authorName', array(
    'get_callback' => function() {return get_the_author();}
  ));
}
add_action('rest_api_init', 'pet_custom_rest');

?>






