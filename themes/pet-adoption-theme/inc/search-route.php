<?php 

// Create new custom url for custom post type
function pet_register_search() {
  register_rest_route('pet/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE, // 'GET'
    'callback' => 'pet_search_results',
    'permission_callback' => '__return_true'
  ));
}

function pet_search_results($search_data) {
  $main_query = new WP_Query(array(
    'post_type' => array('post', 'page', 'pet', 'shelter', 'story'),
    's' => sanitize_text_field($search_data['term'])
  ));
  
  $query_results = array(
    'page' => array(),
    'post' => array(),
    'pet' => array(),
    'shelter' => array(),
    'story' => array()
  );

  while($main_query->have_posts()) {
    $main_query->the_post();
    $post_type = get_post_type();
    $result = array(
      'title' => get_the_title(),
      'permalink' => get_the_permalink()
    );
    if ($post_type === 'shelter') {
      $result['id'] = get_the_id();
    }

    if (isset($query_results[$post_type])) {
      array_push($query_results[$post_type], $result);
    }
  }

  if($query_results['shelter']) {
    $shelter_relationship_query = new WP_Query(array(
      'post_type' => 'pet',
      'meta_query' => array(
        'relation' => 'OR',
        array(
          'key' => 'pet_shelter',
          'compare' => 'LIKE',
          'value' => '"' . $query_results['shelter'][0]['id'] . '"'
        )
      )
    ));

    while($shelter_relationship_query->have_posts()) {
      $shelter_relationship_query->the_post();

      array_push($query_results['pet'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
      ));   
    }

    $query_results['pet'] = array_values(array_unique($query_results['pet'], SORT_REGULAR));
  }
  wp_reset_postdata();

  return $query_results;
}

add_action('rest_api_init', 'pet_register_search');

?>