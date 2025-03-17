<?php get_header();

while (have_posts()) {
  the_post(); ?>
  <div class="post">
    <h5>Success Story</h5>
    <h1><?php the_title(); ?></h1>
    <div class="post-content">
      <div class="post-content__img">
        <img src="<?php the_field("story_image"); ?>" alt="<?php the_title(); ?>">
      </div>
      <?php the_content(); ?>
    </div>
  </div>
<?php }

get_footer();

?>