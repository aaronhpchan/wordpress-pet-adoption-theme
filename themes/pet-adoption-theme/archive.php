<?php get_header(); ?>

<div class="blog-section">
  <?php 
    $blog_cat = strip_tags(get_the_category_list(', ')); 
    $blog_cat_words = explode(" ", $blog_cat);
    $blog_cat_last_word = implode(" ",array_splice($blog_cat_words, -1));
    $blog_cat_except_last_word = implode(" ", $blog_cat_words);
    echo '<h1>' . $blog_cat_except_last_word . ' <span class="someclass">' . $blog_cat_last_word . '</span></h1>';
  ?>
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

<?php get_footer(); ?>