<?php 

$is_shelter_page = is_singular('shelter');
$is_pet_page = is_singular('pet');
$shelter_name = get_field('shelter_name'); 
$shelter_location = get_field('shelter_location');
$shelter_email = get_field('shelter_email');
$shelter_phone = get_field('shelter_phone');
$shelter_map = get_field('shelter_map');
$shelter_permalink = get_the_permalink();

?>

<div class="pet-info__shelter">
  <p class="pet-info__shelter-name"><?php echo $is_pet_page ? $shelter_name : 'Contact Info'; ?></p>
  <div class="pet-info__shelter-map"><?php echo $shelter_map; ?></div>
  <dl class="pet-info__shelter-list">
    <?php if ($shelter_location) { ?>
      <dt>Location:</dt>
      <dd><?php echo esc_html($shelter_location); ?></dd>
    <?php } ?>
    <?php if ($shelter_email) { ?>
      <dt>Email:</dt>
      <dd><a href="mailto:<?php echo esc_attr($shelter_email); ?>"><?php echo esc_html($shelter_email); ?></a></dd>
    <?php } ?>
    <?php if ($shelter_phone) { ?>
      <dt>Phone:</dt>
      <dd><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $shelter_phone)); ?>"><?php echo esc_html($shelter_phone); ?></a></dd>
    <?php } ?>
  </dl>
  <?php if ($is_pet_page) { ?>
    <a href="<?php echo $shelter_permalink ?>" class="pet-info__shelter-btn"><div>More Info</div></a>
  <?php } ?>
</div>