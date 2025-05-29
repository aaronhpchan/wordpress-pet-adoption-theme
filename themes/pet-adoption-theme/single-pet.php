<?php 

get_header();
  
$pet_id = get_the_ID();
$pet_species = get_field('pet_species');
$pet_name = get_field('pet_name');
$pet_breed = get_field('pet_breed');
$pet_trained = get_field('pet_trained');
$pet_health = get_field('pet_health');
$pet_good_with = get_field('pet_good_with');
$pet_fee = get_field('pet_adoption_fee');
$pet_shelter = new WP_Query(array(
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
$pets_query = null;
$colors_and_icons = [];

while (have_posts()) {
  the_post(); ?>
  <div class="pet">
    <h1>Hi, I'm <?php echo $pet_name; ?></h1>
    <div class="pet-bg">
      <img class="pet-img" src="<?php echo get_field('pet_image'); ?>">
      <div class="pet-bg__pattern"></div>
    </div>
    <div class="pet-info">
      <div class="pet-info__content"> 
        <div class="pet-info__content-cap">
          <p>About <?php echo $pet_name; ?></p>
          <p><span>Gender:</span> <?php echo get_field('pet_gender'); ?></p>
          <p><span>Age:</span> <?php echo get_field('pet_age'); ?></p>
          <?php 
            if ($pet_breed) echo '<p><span>Breed:</span> ' . $pet_breed . '</p>'; 
            if ($pet_trained) echo '<p><span>House Trained:</span> Yes</p>'; 
            if ($pet_health) echo '<p><span>Health Info:</span> ' . implode(", ", $pet_health) . '</p>'; 
            if ($pet_good_with) echo '<p><span>Good With:</span> ' . implode(", ", $pet_good_with) . '</p>'; 
            if ($pet_fee) echo '<p><span>Adoption Fee:</span> $' . number_format((float)$pet_fee, 2) . '</p>';
          ?>
        </div>   
        <div>
          <p>Meet <?php echo $pet_name; ?></p>
          <?php echo get_the_content(); ?>
        </div>
      </div>
      <?php
        if ($pet_shelter->have_posts()) { 
          $pet_shelter->the_post(); ?>
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

if ($pet_species === 'cat') {
  $related_pets_query = new WP_Query(array(
    'posts_per_page' => 3,
    'post_type' => 'pet',
    'meta_key' => 'pet_species',
    'meta_value' => 'cat',
    'post__not_in' => array($pet_id) // exclude current pet
  ));
  $pets_query = $related_pets_query;

  $colors_and_icons = [
    ['#7be0c6', 'climbing-toy'],
    ['#a2def6', 'fish'],
    ['#ffccb0', 'ribbon']
  ];
} elseif ($pet_species === 'dog') {
  $related_pets_query = new WP_Query(array(
    'posts_per_page' => 3,
    'post_type' => 'pet',
    'meta_key' => 'pet_species',
    'meta_value' => 'dog',
    'post__not_in' => array($pet_id) // exclude current pet
  ));
  $pets_query = $related_pets_query;

  $colors_and_icons = [
    ['#ffd986', 'bone'],
    ['#e0c4c8', 'tree'],
    ['#ecc3ee', 'trophy']
  ];
}
include(locate_template('template-parts/pet-cards.php'));

get_footer(); 

?>