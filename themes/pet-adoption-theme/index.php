<?php get_header(); ?>

<div class="blog-section">
  <h1>A blog about <span>puppies</span> & <span>kitties</span></h1>
  <div class="blog-container">
    <div class="blog-posts">
      <?php 
        while (have_posts()) {
          the_post();
          get_template_part('template-parts/blog-posts', null, [
            'image_field_name' => 'post_image',
            'post_type' => 'Blog Post'
          ]);
        }
      ?>
    </div>
    <?php get_template_part('template-parts/blog-categories'); ?>
  </div>
</div>

<?php get_footer();

?>