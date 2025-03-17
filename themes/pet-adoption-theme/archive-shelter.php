<?php get_header(); ?>

<div class="page-section">
  <h1>Shelters</h1>
  <div class="page-map">
    <?php 
      while (have_posts()) {
        the_post(); ?>
        <h2><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div><?php echo get_field('shelter_map'); ?></div>
    <?php } 
    echo paginate_links(); ?>
  </div>
</div>

<?php get_footer();

?>