<?php get_header(); ?>

<div class="home-banner">
  <div class="home-banner__heading">
    <h1>Connecting vulnerable animals <br/>with their <span>forever</span> <span>families</span>, <br/>one adoption at a time.</h1>
    <h6>ADOPT, DON'T SHOP</h6>
  </div>
  
  <div class="home-banner__bg">
    <?php 
      for ($n = 0; $n < 3; $n++) { 
        $bannerImgFile = '/images/banner_' . $n + 1 . '.jpg';
        $bannerImgUrl = get_theme_file_uri($bannerImgFile); ?>
        <div class="home-banner__bg-img">
          <img src="<?php echo $bannerImgUrl; ?>" alt="<?php echo 'Banner image ' . $n + 1 ?>">
        </div>
      <?php }
    ?>
    <div class="home-banner__bg-pattern"></div>
  </div>
</div>

<div class="home-links">
  <?php 
    $homeLinks = array('adopt-a-dog', 'adopt-a-cat', 'volunteer');
    foreach ($homeLinks as $link) { ?>
      <a class="home-links__item" href="<?php echo site_url('/' . $link); ?>">
        <div>        
          <div class="home-links__img">
            <img src="<?php echo get_theme_file_uri('/images/icon_' . $link . '.svg'); ?>" alt="<?php echo 'logo-' . $link; ?>">
          </div>
          <div class="home-links__text">
            <h3>I'd like to <?php echo str_replace('-', ' ' , $link); ?></h3>       
          </div>
        </div>
      </a>
    <?php }
  ?>
</div>

<div class="home-about">
  <?php 
    $homeAbout = new WP_Query(array(
      'posts_per_page' => -1,
      'post_type' => 'content',
      'meta_key' => 'content_name',
      'meta_value' => 'About us'
    ));
    $homeAbout->the_post(); ?>
    <h2><?php echo get_field('content_name'); ?></h2>
    <div><?php echo get_field('main_body_content'); ?></div>
</div>

<div class="home-pets">
  <div class="pet-cards">
  <?php 
    $homeCats = new WP_Query(array(
      'posts_per_page' => 3,
      'post_type' => 'pet',
      'meta_key' => 'pet_species',
      'meta_value' => 'cat'
    ));
    for ($catNum = 0; $catNum < 3; $catNum++) { 
      switch ($catNum) {
        case 0:
          $catBg = '#7be0c6';
          $catIcon = 'climbing-toy';
          break;
        case 1:
          $catBg = '#a2def6';
          $catIcon = 'fish';
          break;
        case 2:
          $catBg = '#ffccb0';
          $catIcon = 'ribbon';
          break;
      }
      $homeCats->the_post(); ?>
      <div class="pet-card">
        <a href="<?php the_permalink(); ?>">
          <div class="pet-card__info" style="background-color: <?php echo $catBg; ?>">
            <img src="<?php echo get_theme_file_uri('/images/icon_' . $catIcon . '.svg'); ?>" alt="<?php echo 'icon-' . $catIcon; ?>">
            <p>Hello, I am <br><?php echo get_field('pet_name'); ?></p>
            <div style="background-color: <?php echo $catBg; ?>"><?php echo get_field('pet_age'); ?></div>
          </div>
          <div class="pet-card__bg"></div>
          <div class="pet-card__img">
            <img src="<?php echo get_field('pet_image'); ?>" alt="<?php echo get_field('pet_name'); ?>">
          </div>
        </a>
      </div>
    <?php } 
  ?>
  </div>
  <div class="pet-cards">
  <?php 
    $homeDogs = new WP_Query(array(
      'posts_per_page' => 3,
      'post_type' => 'pet',
      'meta_key' => 'pet_species',
      'meta_value' => 'dog'
    ));
    for ($dogNum = 0; $dogNum < 3; $dogNum++) { 
      switch ($dogNum) {
        case 0:
          $dogBg = '#ffd986';
          $dogIcon = 'bone';
          break;
        case 1:
          $dogBg = '#e0c4c8';
          $dogIcon = 'tree';
          break;
        case 2:
          $dogBg = '#ecc3ee';
          $dogIcon = 'trophy';
          break;
      }
      $homeDogs->the_post(); ?>
      <div class="pet-card">
        <a href="<?php the_permalink(); ?>">
          <div class="pet-card__info" style="background-color: <?php echo $dogBg; ?>">
            <img src="<?php echo get_theme_file_uri('/images/icon_' . $dogIcon . '.svg'); ?>" alt="<?php echo 'icon-' . $dogIcon; ?>">
            <p>Hello, I am <br><?php echo get_field('pet_name'); ?></p>
            <div style="background-color: <?php echo $dogBg; ?>"><?php echo get_field('pet_age'); ?></div>
          </div>
          <div class="pet-card__bg"></div>
          <div class="pet-card__img">
            <img src="<?php echo get_field('pet_image'); ?>" alt="<?php echo get_field('pet_name'); ?>">
          </div>
        </a>
      </div>
    <?php }
  ?> 
  </div>
</div>

<div class="home-posts">
  <h2>Latest Blog Posts</h2>
  <div class="home-posts__section">
  <?php 
    $homePosts = new WP_Query(array(
      'posts_per_page' => 3
    ));
    while ($homePosts->have_posts()) {
      $homePosts->the_post(); 
      get_template_part('template-parts/blog-posts', null, [
        'image_field_name' => 'post_image',
        'post_type' => 'Blog Post'
      ]);
    }
    wp_reset_postdata();
  ?>
  </div>
  <p class="home-posts__link"><a href="<?php echo trailingslashit(site_url('/blog')); ?>">View All Blog Posts</a></p>
</div>

<div class="home-stories">
  <h2>Success Stories</h2>
  <div class="home-story">
    <?php
      $homeStories = new WP_Query(array(
        'posts_per_page' => 3,
        'post_type' => 'story'
      ));
      while ($homeStories->have_posts()) {
        $homeStories->the_post(); ?>
        <div class="home-story__content">         
          <div class="home-story__img">
            <img src="<?php echo get_field('story_image'); ?>" alt="<?php the_title(); ?>">
          </div>
          <div class="home-story__text">
            <strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong>
            <div>
              <img src="<?php echo get_theme_file_uri('/images/text_decoration_pink.svg'); ?>" alt="squiggle_line">
            </div>
            <p>
              <?php if (has_excerpt()) {
                echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 250); 
              } ?>
            </p>
          </div>
        </div>
      <?php }
      wp_reset_postdata();
    ?>
  </div>
  <a class="home-stories__prev">&#10094;</a>
  <a class="home-stories__next">&#10095;</a>
</div>

<?php get_footer(); ?>

