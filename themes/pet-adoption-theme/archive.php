<?php get_header(); ?>

<div class="blog-section">
  <?php 
    $blog_cat = strip_tags(get_the_category_list(', ')); 
    $blog_cat_words = explode(" ", $blog_cat);
    $blog_cat_last_word = implode(" ",array_splice($blog_cat_words, -1));
    $blog_cat_except_last_word = implode(" ", $blog_cat_words);
    $blog_cat_title = '<h1>' . $blog_cat_except_last_word . ' <span class="someclass">' . $blog_cat_last_word . '</span></h1>';
    echo $blog_cat_title;
  ?>
  <div class="blog-container">
    <div class="blog-posts">
      <?php 
        while(have_posts()) {
          the_post(); ?>
          <div class="blog-post">
            <div class="blog-post__img">
              <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_field('post_image'); ?>" alt="<?php the_title(); ?>">
              </a>
            </div>
            <div class="blog-post__info">
              <div>
                <p>Blog Post</p>
                <p><?php the_time('M j, Y'); ?></p>
              </div>
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>          
              <div><p class="blog-post__category"><?php echo get_the_category_list(', '); ?></p></div>
            </div>      
          </div>
        <?php }
        echo paginate_links();
      ?>
    </div>
    <div class="blog-categories">
      <div class="blog-categories__dropdown">
        <div class="blog-categories__label" id="blog-categories__label">
          <p>Categories</p>
          <img src="<?php echo get_theme_file_uri('/images/icon_arrow-down.svg'); ?>">
        </div>
        <div class="blog-categories__items">
        <?php
          $categories = get_categories(array(
            'orderby' => 'name',
            'order'   => 'ASC'
          ));
          foreach($categories as $category) {
            echo '<p><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></p>';   
          } 
        ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer();

?>