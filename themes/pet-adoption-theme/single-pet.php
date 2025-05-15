<?php get_header();
  
  $petBreed = get_field('pet_breed');
  $petTrained = get_field('pet_trained');
  $petHealth = get_field('pet_health');
  $petGoodwith = get_field('pet_good_with');
  $petFee = get_field('pet_adoption_fee');
  $petShelter = new WP_Query(array(
    'posts_per_page' => -1,
    'post_type' => 'shelter',
    'meta_query' => array(
      array(
        'key' => 'shelter_name',
        'compare' => 'LIKE',
        'value' => get_the_title(get_field('pet_shelter')[0])
      )
    )
  ));
  
  while (have_posts()) {
    the_post(); ?>
    <div class="pet">
      <h1>Hi, I'm <?php echo get_field('pet_name'); ?></h1>
      <div class="pet-bg">
        <img class="pet-img" src="<?php echo get_field('pet_image'); ?>">
        <div class="pet-bg__pattern"></div>
      </div>
      <div class="pet-info">
        <div class="pet-info__content"> 
          <div class="pet-info__content-cap">
            <p>About <?php echo get_field('pet_name'); ?></p>
            <p><span>Gender:</span> <?php echo get_field('pet_gender'); ?></p>
            <p><span>Age:</span> <?php echo get_field('pet_age'); ?></p>
            <?php 
              if ($petBreed) echo '<p><span>Breed:</span> ' . $petBreed . '</p>'; 
              if ($petTrained) echo '<p><span>House Trained:</span> Yes</p>'; 
              if ($petHealth) echo '<p><span>Health Info:</span> ' . implode(", ", $petHealth) . '</p>'; 
              if ($petGoodwith) echo '<p><span>Good With:</span> ' . implode(", ", $petGoodwith) . '</p>'; 
              if ($petFee) echo '<p><span>Adoption Fee:</span> $' . number_format((float)$petFee, 2) . '</p>';
            ?>
          </div>   
          <div>
            <p>Meet <?php echo get_field('pet_name'); ?></p>
            <?php echo get_the_content(); ?>
          </div>
        </div>
        <?php
          if ($petShelter->have_posts()) { 
            $petShelter->the_post(); ?>
            <div class="pet-info__shelter">
              <p class="pet-info__shelter-name"><?php echo get_field('shelter_name'); ?></p>
              <div class="pet-info__shelter-map"><?php echo get_field('shelter_map'); ?></div>
              <p><span>Location:</span> <?php echo get_field('shelter_location'); ?></p>
              <p><span>Email:</span> <?php echo get_field('shelter_email'); ?></p>
              <p><span>Phone:</span> <?php echo get_field('shelter_phone'); ?></p>
              <a href="<?php echo get_the_permalink(); ?>"><div>More Info</div></a>
            </div>
          <?php }
        ?>
      </div>
    </div>
  <?php }
  wp_reset_postdata();

  $singlepageCats = new WP_Query(array(
    'posts_per_page' => 3,
    'post_type' => 'pet',
    'meta_query' => array(
      'relation' => 'AND',
        array(
          'key' => 'pet_species',
          'value' => 'cat',
          'compare' => 'LIKE',
        ),
        array(
          'key' => 'pet_name',
          'value' => get_field('pet_name'),
          'compare' => 'NOT LIKE',
        )
    )
  ));
  $singlepageDogs = new WP_Query(array(
    'posts_per_page' => 3,
    'post_type' => 'pet',
    'meta_query' => array(
      'relation' => 'AND',
        array(
          'key' => 'pet_species',
          'value' => 'dog',
          'compare' => 'LIKE',
        ),
        array(
          'key' => 'pet_name',
          'value' => get_field('pet_name'),
          'compare' => 'NOT LIKE',
        )
    )
  )); ?>

  <div class="pet-cards">
  <?php if (get_field('pet_species') == 'cat') {
    while ($singlepageCats->have_posts()) {
      for ($catNum = 0; $catNum < 3; $catNum++) { 
        switch ($catNum) {
          case 0:
            $catBg = '#7be0c6';
            $catIcon = 'climbing-toy';
            break;
          case 1:
            $catBg = '#a2def6';
            $catIcon = 'fish';
            break;
          case 2:
            $catBg = '#ffccb0';
            $catIcon = 'ribbon';
            break;
        }
        $singlepageCats->the_post(); ?>
        <div class="pet-card">
          <a href="<?php the_permalink(); ?>">
            <div class="pet-card__info" style="background-color: <?php echo $catBg; ?>">
              <img src="<?php echo get_theme_file_uri('/images/icon_' . $catIcon . '.svg'); ?>" alt="<?php echo 'icon-' . $catIcon; ?>">
              <p>Hello, I am <br><?php echo get_field('pet_name'); ?></p>
              <div style="background-color: <?php echo $catBg; ?>"><?php echo get_field('pet_age'); ?></div>
            </div>
            <div class="pet-card__bg"></div>
            <div class="pet-card__img">
              <img src="<?php echo get_field('pet_image'); ?>" alt="<?php echo get_field('pet_name'); ?>">
            </div>
          </a>
        </div>
      <?php }
    }
  } else {
    while ($singlepageDogs->have_posts()) {
      for ($dogNum = 0; $dogNum < 3; $dogNum++) { 
        switch ($dogNum) {
          case 0:
            $dogBg = '#ffd986';
            $dogIcon = 'bone';
            break;
          case 1:
            $dogBg = '#e0c4c8';
            $dogIcon = 'tree';
            break;
          case 2:
            $dogBg = '#ecc3ee';
            $dogIcon = 'trophy';
            break;
        }
        $singlepageDogs->the_post(); ?>
        <div class="pet-card">
          <a href="<?php the_permalink(); ?>">
            <div class="pet-card__info" style="background-color: <?php echo $dogBg; ?>">
              <img src="<?php echo get_theme_file_uri('/images/icon_' . $dogIcon . '.svg'); ?>" alt="<?php echo 'icon-' . $dogIcon; ?>">
              <p>Hello, I am <br><?php echo get_field('pet_name'); ?></p>
              <div style="background-color: <?php echo $dogBg; ?>"><?php echo get_field('pet_age'); ?></div>
            </div>
            <div class="pet-card__bg"></div>
            <div class="pet-card__img">
              <img src="<?php echo get_field('pet_image'); ?>" alt="<?php echo get_field('pet_name'); ?>">
            </div>
          </a>
        </div>
      <?php }
    }
  } ?>
  </div> 

  <?php get_footer();

?>