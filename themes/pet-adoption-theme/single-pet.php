<?php 

get_header();
  
$pet_id = get_the_ID();
$pet_species = get_field('pet_species');
$pet_name = get_field('pet_name');
$pet_gender = get_field('pet_gender');
$pet_age = get_field('pet_age');
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
          <dl>
            <?php if ($pet_gender) { ?>
              <dt>Gender:</dt>
              <dd><?php echo $pet_gender; ?></dd>
            <?php } ?>
            <?php if ($pet_age) { ?>
              <dt>Age:</dt>
              <dd><?php echo $pet_age; ?></dd>
            <?php } ?>
            <?php if ($pet_breed) { ?>
              <dt>Breed:</dt>
              <dd><?php echo $pet_breed; ?></dd>
            <?php } ?>
            <?php if ($pet_trained) { ?>
              <dt>House Trained:</dt>
              <dd>Yes</dd>
            <?php } ?>
            <?php if ($pet_health) { ?>
              <dt>Health Info:</dt>
              <dd><?php echo implode(", ", $pet_health); ?></dd>
            <?php } ?>
            <?php if ($pet_good_with) { ?>
              <dt>Good With:</dt>
              <dd><?php echo implode(", ", $pet_good_with); ?></dd>
            <?php } ?>
            <?php if ($pet_fee) { ?>
              <dt>Adoption Fee:</dt>
              <dd><?php echo number_format((float)$pet_fee, 2); ?></dd>
            <?php } ?>
          </dl>
        </div>   
        <div>
          <p>Meet <?php echo $pet_name; ?></p>
          <?php echo get_the_content(); ?>
        </div>
      </div>
      <?php
        if ($pet_shelter->have_posts()) { 
          $pet_shelter->the_post(); 
          get_template_part('template-parts/shelter-card');
        }
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