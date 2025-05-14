<?php get_header(); ?>

<div class="blog-section">
  <h1>A blog about <span>puppies</span> & <span>kitties</span></h1>
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