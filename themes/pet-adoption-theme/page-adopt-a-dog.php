<?php get_header(); ?>

<div>
<div class="pet">
  <h1><span>Loveable</span> Dogs & Puppies</h1>
</div>
<?php 
  $homeDogs = new WP_Query(array(
    'posts_per_page' => 6,
    'post_type' => 'pet',
    'meta_key' => 'pet_species',
    'meta_value' => 'dog'
  ));
  for ($dogNum = 0; $dogNum < 6; $dogNum++) { 
    switch ($dogNum) {
      case 0:
        $dogBg = '#7be0c6';
        $dogIcon = 'climbing-toy';
        break;
      case 1:
        $dogBg = '#a2def6';
        $dogIcon = 'fish';
        break;
      case 2:
        $dogBg = '#ffccb0';
        $dogIcon = 'ribbon';
        break;
      case 3:
        $dogBg = '#ffd986';
        $dogIcon = 'bone';
        break;
      case 4:
        $dogBg = '#e0c4c8';
        $dogIcon = 'tree';
        break;
      case 5:
        $dogBg = '#ecc3ee';
        $dogIcon = 'trophy';
        break;
    }
    $homeDogs->the_post(); 
    if ($dogNum === 0) {
      echo "<div class='pet-cards'>";
    }
    if ($dogNum === 3 ) {
      echo "</div><div class='pet-cards'>";
    } ?>
    
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
    <?php if ($dogNum === 5) {
      echo "</div>";
    }
  } ?> 
</div>

<?php get_footer(); ?>