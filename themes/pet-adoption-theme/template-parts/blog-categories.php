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