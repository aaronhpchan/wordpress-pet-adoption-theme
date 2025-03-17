<?php get_header();

while (have_posts()) {
  the_post(); ?>
  <div class="page-section">
    <h1><?php the_title(); ?></h1>
    <div class="page-section__content">
      <?php the_content(); ?>
    </div>
    <?php 
      $parentPage = wp_get_post_parent_id(get_the_ID());
      if ($parentPage) { ?>
        <p>
          <a href="<?php echo get_permalink($parentPage); ?>">« Back to <?php echo get_the_title($parentPage); ?></a> 
        </p>
      <?php }
    ?>
  </div>
<?php }

get_footer();

?>

