<?php get_header(); ?>

<div>
<div class="pet">
  <h1><span>Loveable</span> Cats & Kittens</h1>
</div>
<?php 
  $homeCats = new WP_Query(array(
    'posts_per_page' => 6,
    'post_type' => 'pet',
    'meta_key' => 'pet_species',
    'meta_value' => 'cat'
  ));
  for ($catNum = 0; $catNum < 6; $catNum++) { 
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
      case 3:
        $catBg = '#ffd986';
        $catIcon = 'bone';
        break;
      case 4:
        $catBg = '#e0c4c8';
        $catIcon = 'tree';
        break;
      case 5:
        $catBg = '#ecc3ee';
        $catIcon = 'trophy';
        break;
    }
    $homeCats->the_post(); 
    if ($catNum === 0) {
      echo "<div class='pet-cards'>";
    }
    if ($catNum === 3 ) {
      echo "</div><div class='pet-cards'>";
    } ?>
    
    <div class="pet-card">
      <a href="<?php the_permalink(); ?>">
        <div class="pet-card__info" style="background-color: <?php echo $catBg; ?>">
          <img src="<?php echo get_theme_file_uri('/images/icon_' . $catIcon . '.svg'); ?>" alt="<?php echo 'icon-' . $catIcon; ?>">
          <p>Hello, I am <br><?php the_field('pet_name'); ?></p>
          <div style="background-color: <?php echo $catBg; ?>"><?php the_field('pet_age'); ?></div>
        </div>
        <div class="pet-card__bg"></div>
        <div class="pet-card__img">
          <img src="<?php the_field('pet_image'); ?>" alt="<?php the_field('pet_name'); ?>">
        </div>
      </a>
    </div>
    <?php if ($catNum === 5) {
      echo "</div>";
    }
  } ?> 
</div>

<?php get_footer(); ?>