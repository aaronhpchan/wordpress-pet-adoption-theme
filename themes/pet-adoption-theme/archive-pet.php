<?php get_header(); ?>

<div>
<div class="pet">
  <h1><span>Loveable</span> Cats & Dogs</h1>
</div>
<?php 
  $archivePets = new WP_Query(array(
    'posts_per_page' => 12,
    'post_type' => 'pet'
  ));
  for ($petNum = 0; $petNum < 12; $petNum++) { 
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
      case 3:
        $petBg = '#ffd986';
        $petIcon = 'bone';
        break;
      case 4:
        $petBg = '#e0c4c8';
        $petIcon = 'tree';
        break;
      case 5:
        $petBg = '#ecc3ee';
        $petIcon = 'trophy';
        break;
      case 6;
        $petBg = '#ff8d7b';
        $petIcon = 'climbing-toy';
        break;
      case 7:
        $petBg = '#ffdbe0';
        $petIcon = 'fish';
        break;
      case 8:
        $petBg = '#e6f4a2';
        $petIcon = 'ribbon';
        break;
      case 9:
        $petBg = '#fddbff';
        $petIcon = 'bone';
        break;
      case 10:
        $petBg = '#9ffebe';
        $petIcon = 'tree';
        break;
      case 11:
        $petBg = '#c9f2fd';
        $petIcon = 'trophy';
        break;
    }
    $archivePets->the_post(); 
    if ($petNum === 0) {
      echo "<div class='pet-cards'>";
    }
    if ($petNum === 3 || $petNum === 6 || $petNum === 9) {
      echo "</div><div class='pet-cards'>";
    } ?>
    
    <div class="pet-card">
      <a href="<?php the_permalink(); ?>">
        <div class="pet-card__info" style="background-color: <?php echo $petBg; ?>">
          <img src="<?php echo get_theme_file_uri('/images/icon_' . $petIcon . '.svg'); ?>" alt="<?php echo 'icon-' . $petIcon; ?>">
          <p>Hello, I am <br><?php the_field('pet_name'); ?></p>
          <div style="background-color: <?php echo $petBg; ?>"><?php the_field('pet_age'); ?></div>
        </div>
        <div class="pet-card__bg"></div>
        <div class="pet-card__img">
          <img src="<?php the_field('pet_image'); ?>" alt="<?php the_field('pet_name'); ?>">
        </div>
      </a>
    </div>
    <?php if ($petNum === 5 || $petNum === 11) {
      echo "</div>";
    }
  } ?> 
</div>

<?php get_footer(); ?>