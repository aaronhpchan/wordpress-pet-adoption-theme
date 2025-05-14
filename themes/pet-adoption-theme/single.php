<?php get_header();

$post_category = get_the_category();
$post_category_id = $post_category[0]->cat_ID;
$post_category_name = $post_category[0]->cat_name;
$post_category_link = get_category_link($post_category_id);
$post_photo_credit = get_field("post_photo_credit");
$post_photo_link = get_field("post_photo_link");

while (have_posts()) {
  the_post(); ?>
  <div class="post">
    <h5>Blog Post</h5>
    <h1><?php the_title(); ?></h1>
    <div><a href="<?php echo $post_category_link; ?>" class="post-category"><?php echo $post_category_name; ?></a></div>
    <div class="post-content">
      <div class="post-content__img">
        <img src="<?php echo get_field("post_image"); ?>" alt="<?php the_title(); ?>">
        <?php if($post_photo_credit) {
          echo '<p>Photo Credit: <a href="' . $post_photo_link . '" target="_blank">' . $post_photo_credit . '</a></p>';
        } ?> 
      </div>
      <?php the_content(); ?>
    </div>
  </div>
<?php }

get_footer();

?>