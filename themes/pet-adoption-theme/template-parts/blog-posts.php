<?php 
  $is_front_page = is_front_page();
  $is_index = is_home();
  $is_archive_story = is_post_type_archive('story');
  $is_general_archive = is_archive() && !$is_archive_story;
  $title = get_the_title();
  $permalink = get_the_permalink(); 
  $image_field_name = $args['image_field_name'] ?? 'post_image'; 
  $post_type = $args['post_type'] ?? 'Blog Post'; 
  $post_date = get_the_time('M j, Y'); 

  $post_class = 'blog-post';
  $img_class = 'blog-post__img';
  $info_class = 'blog-post__info';
  if ($is_front_page) {
    $post_class = 'home-post';
    $img_class = 'home-post__img';
    $info_class = 'home-post__info';
  }
  
  ?>
  <div class="<?php echo $post_class; ?>">
    <div class="<?php echo $img_class; ?>">
      <a href="<?php echo $permalink; ?>">
        <img src="<?php echo get_field($image_field_name); ?>" alt="<?php echo $title; ?>">
      </a>
    </div>
    <div class="<?php echo $info_class ?>">
      <div>
        <p><?php echo $post_type; ?></p>
        <p><?php echo $post_date; ?></p>
      </div>
      <div>
        <?php 
          $heading_tag = $is_front_page ? 'h3' : 'h2';
          echo '<' . $heading_tag . '><a href="' . $permalink . '">' . $title . '</a></' . $heading_tag . '>';
        ?>
      </div>
      <div>
        <?php 
          if (!$is_archive_story) {
            $post_category = get_the_category_list(', ');
            $post_category_class = $is_front_page ? '' : ' class="blog-post__category"';
            echo '<p' . $post_category_class . '>' . $post_category . '</p>';    
          }
        ?>
      </div>
    </div>      
  </div>
<?php 
  if ($is_general_archive || $is_index) echo paginate_links();
?>
