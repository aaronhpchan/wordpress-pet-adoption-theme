<?php get_header(); ?>

<div>
  <div class="pet">
    <h1><span>Loveable</span> Dogs & Puppies</h1>
  </div>
  <?php 
    $pets_query = new WP_Query(array(
      'posts_per_page' => 6,
      'post_type' => 'pet',
      'meta_key' => 'pet_species',
      'meta_value' => 'dog'
    ));
    include(locate_template('template-parts/pet-cards.php'));
  ?> 
</div>

<?php get_footer(); ?>