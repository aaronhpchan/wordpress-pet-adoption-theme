<?php

// create custom post type
function pet_post_types() {
  // Content post type
  register_post_type('content', array(
    'show_in_rest' => true, 
    'supports' => array('title', 'excerpt'),
    'rewrite' => array('slug' => 'contents'),
    'has_archive' => true,
    'public' => true,
    'menu_icon' => 'dashicons-format-aside',
    'labels' => array(
      'name' => 'Contents',
      'singular_name' => 'Content', 
      'add_new' => 'Add New Content',
      'add_new_item' => 'Add New Content',
      'edit_item' => 'Edit Content',
      'all_items' => 'All Contents'
    )
  ));
  
  // Story post type
  register_post_type('story', array(
    'show_in_rest' => true, 
    'supports' => array('title', 'editor', 'excerpt'),
    'rewrite' => array('slug' => 'success-stories'),
    'has_archive' => true,
    'public' => true,
    'menu_icon' => 'dashicons-testimonial',
    'labels' => array(
      'name' => 'Stories',
      'singular_name' => 'Story', 
      'add_new' => 'Add New Story',
      'add_new_item' => 'Add New Story',
      'edit_item' => 'Edit Story',
      'all_items' => 'All Stories'
    )
  ));

  // Pet post type
  register_post_type('pet', array(
    'show_in_rest' => true, 
    'supports' => array('title', 'editor', 'excerpt'),
    'rewrite' => array('slug' => 'pets'),
    'has_archive' => true,
    'public' => true,
    'menu_icon' => 'dashicons-pets',
    'labels' => array(
      'name' => 'Pets',
      'singular_name' => 'Pet', 
      'add_new' => 'Add New Pet',
      'add_new_item' => 'Add New Pet',
      'edit_item' => 'Edit Pet',
      'all_items' => 'All Pets'
    )
  ));

  // Shelter post type
  register_post_type('shelter', array(
    'show_in_rest' => true, 
    'supports' => array('title', 'excerpt'),
    'rewrite' => array('slug' => 'shelters'),
    'has_archive' => true,
    'public' => true,
    'menu_icon' => 'dashicons-store',
    'labels' => array(
      'name' => 'Shelters',
      'singular_name' => 'Shelter', 
      'add_new' => 'Add New Shelter',
      'add_new_item' => 'Add New Shelter',
      'edit_item' => 'Edit Shelter',
      'all_items' => 'All Shelters'
    )
  ));
}

add_action('init', 'pet_post_types');

?>