<?php get_header(); ?>

<div>
  <div class="pet">
    <h1><span>Loveable</span> Cats & Dogs</h1>
  </div>
  <?php 
    $pets_query = new WP_Query(array(
      'posts_per_page' => 12,
      'post_type' => 'pet'
    ));
    include(locate_template('template-parts/pet-cards.php'));
  ?> 
</div>

<?php get_footer(); ?>