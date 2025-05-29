<?php get_header(); ?>

<div>
  <?php 
    $shelter_name = get_the_title();
    $shelter_policy = get_field('shelter_policy');

    while(have_posts()) {
      the_post(); ?>
      <div class="pet">
        <h1><?php echo $shelter_name; ?></h1>
        <div class="pet-info">
          <div class="pet-info__content">   
            <div>
              <p>About <?php echo $shelter_name; ?></p>
              <?php echo get_field('main_body_content'); ?>
            </div>
            <?php if($shelter_policy) {
              echo '<div>' . '<p>Adoption Policy</p>' . $shelter_policy . '</div>';
            } ?>
          </div>
          <div class="pet-info__shelter">
            <p>Contact Info</p>
            <div class="pet-info__shelter-map"><?php echo get_field('shelter_map'); ?></div>
            <p><span>Location:</span> <?php echo get_field('shelter_location'); ?></p>
            <p><span>Email:</span> <?php echo get_field('shelter_email'); ?></p>
            <p><span>Phone:</span> <?php echo get_field('shelter_phone'); ?></p>
          </div>
        </div>
      </div>
    <?php }
  ?>
</div>

<?php
  $pets_query = new WP_Query(array(
    'posts_per_page' => 3,
    'post_type' => 'pet',
    'meta_query' => array(
      array(
        'key' => 'pet_shelter',
        'compare' => 'LIKE',
        'value' => '"' . get_the_ID() . '"'
      )
    )
  ));
  if ($pets_query->have_posts()) { ?>
    <h2>Pets from <?php echo $shelter_name; ?></h2>
    <?php include(locate_template('template-parts/pet-cards.php'));
  }
?>

<?php get_footer(); ?>