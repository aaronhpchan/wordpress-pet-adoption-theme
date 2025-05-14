<?php get_header(); ?>

<div>
  <?php 
    $shelterName = get_the_title();
    while(have_posts()) {
      the_post(); ?>
      <div class="pet">
        <h1><?php echo $shelterName; ?></h1>
        <div class="pet-info">
          <div class="pet-info__content">   
            <div>
              <p>About <?php echo $shelterName; ?></p>
              <?php echo get_field('main_body_content'); ?>
            </div>
            <?php if(get_field('shelter_policy')) {
              echo '<div>' . '<p>Adoption Policy</p>' . get_field('shelter_policy') . '</div>';
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
  $shelterPets = new WP_Query(array(
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
  if ($shelterPets->have_posts()) { ?>
    <h2>Pets from <?php echo $shelterName; ?></h2>
    <div class="pet-cards">
    <?php 
      for ($petNum = 0; $petNum < 3; $petNum++) { 
        switch ($petNum) {
          case 0:
            $petBg = '#7be0c6';
            $petIcon = 'climbing-toy';
            break;
          case 1:
            $petBg = '#a2def6';
            $petIcon = 'fish';
            break;
          case 2:
            $petBg = '#ffccb0';
            $petIcon = 'ribbon';
            break;
        }
        $shelterPets->the_post(); ?>
        <div class="pet-card">
          <a href="<?php the_permalink(); ?>">
            <div class="pet-card__info" style="background-color: <?php echo $petBg; ?>">
              <img src="<?php echo get_theme_file_uri('/images/icon_' . $petIcon . '.svg'); ?>" alt="<?php echo 'icon-' . $petIcon; ?>">
              <p>Hello, I am <br><?php echo get_field('pet_name'); ?></p>
              <div style="background-color: <?php echo $petBg; ?>"><?php echo get_field('pet_age'); ?></div>
            </div>
            <div class="pet-card__bg"></div>
            <div class="pet-card__img">
              <img src="<?php echo get_field('pet_image'); ?>" alt="<?php echo get_field('pet_name'); ?>">
            </div>
          </a>
        </div>
      <?php }
    ?>
    </div>
  <?php }
?>

<?php get_footer();

?>