<?php 

// create new custom url for custom post type
function petRegisterSearch() {
  register_rest_route('pet/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE, // 'GET'
    'callback' => 'petSearchResults',
    'permission_callback' => '__return_true'
  ));
}

function petSearchResults($searchData) {
  $mainQuery = new WP_Query(array(
    'post_type' => array('post', 'page', 'pet', 'shelter', 'story'),
    's' => sanitize_text_field($searchData['term'])
  ));
  
  $queryResults = array(
    'pages' => array(),
    'posts' => array(),
    'pets' => array(),
    'shelters' => array(),
    'stories' => array()
  );

  while($mainQuery->have_posts()) {
    $mainQuery->the_post();
    
    if(get_post_type() === 'page') {
      array_push($queryResults['pages'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
      ));
    }
    if(get_post_type() === 'post') {
      array_push($queryResults['posts'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
      ));
    }
    if(get_post_type() === 'pet') {
      array_push($queryResults['pets'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
      ));
    }
    if(get_post_type() === 'shelter') {
      array_push($queryResults['shelters'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'id' => get_the_id()
      ));
    }
    if(get_post_type() === 'story') {
      array_push($queryResults['stories'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
      ));
    }
  }

  if($queryResults['shelters']) {
    $shelterRelationshipQuery = new WP_Query(array(
      'post_type' => 'pet',
      'meta_query' => array(
        'relation' => 'OR',
        array(
          'key' => 'pet_shelter',
          'compare' => 'LIKE',
          'value' => '"' . $queryResults['shelters'][0]['id'] . '"'
        )
      )
    ));

    while($shelterRelationshipQuery->have_posts()) {
      $shelterRelationshipQuery->the_post();

      if(get_post_type() === 'pet') {
        array_push($queryResults['pets'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
        ));
      }
    }

    $queryResults['pets'] = array_values(array_unique($queryResults['pets'], SORT_REGULAR));
  }
  
  return $queryResults;
}

add_action('rest_api_init', 'petRegisterSearch');