<?php get_header(); ?>

<div>
  <div class="pet">
    <h1><span>Loveable</span> Cats & Kittens</h1>
  </div>
  <?php 
    $pets_query = new WP_Query(array(
      'posts_per_page' => 6,
      'post_type' => 'pet',
      'meta_key' => 'pet_species',
      'meta_value' => 'cat'
    ));
    include(locate_template('template-parts/pet-cards.php'));
  ?> 
</div>

<?php get_footer(); ?>