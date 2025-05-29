<?php

if (!isset($pets_query) || !($pets_query instanceof WP_Query) || !$pets_query->have_posts()) return;

$colors_and_icons_default = [
  ['#7be0c6', 'climbing-toy'],
  ['#a2def6', 'fish'],
  ['#ffccb0', 'ribbon'],
  ['#ffd986', 'bone'],
  ['#e0c4c8', 'tree'],
  ['#ecc3ee', 'trophy'],
  ['#ff8d7b', 'climbing-toy'],
  ['#ffdbe0', 'fish'],
  ['#e6f4a2', 'ribbon'],
  ['#fddbff', 'bone'],
  ['#9ffebe', 'tree'],
  ['#c9f2fd', 'trophy'],
];

$colors_and_icons = $colors_and_icons ?? $colors_and_icons_default;
$cards_per_row = $cards_per_row ?? 3;
$total = $pets_query->post_count;

for ($i = 0; $i < $total; $i++) {
  $pets_query->the_post();
  [$bg_color, $icon] = $colors_and_icons[$i % count($colors_and_icons)];

  if ($i % $cards_per_row === 0) echo "<div class='pet-cards'>"; 
  ?>
  <div class="pet-card">
    <a href="<?php the_permalink(); ?>">
      <div class="pet-card__info" style="background-color: <?php echo $bg_color; ?>">
        <img src="<?php echo get_theme_file_uri('/images/icon_' . $icon . '.svg'); ?>" alt="icon-<?php echo esc_attr($icon); ?>">
        <p>Hello, I am <br><?php echo esc_html(get_field('pet_name')); ?></p>
        <div style="background-color: <?php echo $bg_color; ?>"><?php echo esc_html(get_field('pet_age')); ?></div>
      </div>
      <div class="pet-card__bg"></div>
      <div class="pet-card__img">
        <img src="<?php echo esc_url(get_field('pet_image')); ?>" alt="<?php echo esc_attr(get_field('pet_name')); ?>">
      </div>
    </a>
  </div>
  <?php if (($i + 1) % $cards_per_row === 0 || $i === $total - 1) echo "</div>";
}

wp_reset_postdata();

?>
