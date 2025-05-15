<?php get_header(); ?>

<div class="blog-section">
  <h1><span>Success</span> Stories</h1>
  <div class="blog-container">
    <div class="blog-posts">
      <?php 
        while (have_posts()) {
          the_post(); 
          get_template_part('template-parts/blog-posts', null, [
            'image_field_name' => 'story_image',
            'post_type' => 'Success Story'
          ]);
        }
      ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>