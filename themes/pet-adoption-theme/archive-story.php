<?php get_header(); ?>

<div class="blog-section">
  <h1><span>Success</span> Stories</h1>
  <div class="blog-container">
    <div class="blog-posts">
      <?php 
        while(have_posts()) {
          the_post(); ?>
          <div class="blog-post">
            <div class="blog-post__img">
              <a href="<?php the_permalink(); ?>">
                <img src="<?php the_field('story_image'); ?>" alt="<?php the_title(); ?>">
              </a>
            </div>
            <div class="blog-post__info">
              <div>
                <p>Success Story</p>
                <p><?php the_time('M j, Y'); ?></p>
              </div>
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>          
              <div><p class="blog-post__category"><?php echo get_the_category_list(', '); ?></p></div>
            </div>      
          </div>
        <?php } ?>
    </div>
  </div>
</div>

<?php get_footer();

?>