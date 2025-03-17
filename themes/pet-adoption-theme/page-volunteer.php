<?php get_header(); ?>

<div class="volunteer">
  <h1>Some ways <br/>you can <span>help</span></h1>
  <?php 
  $volunteer = new WP_Query(array(
    'posts_per_page' => -1,
    'post_type' => 'content',
    'meta_key' => 'content_name',
    'meta_value' => 'Volunteer your time'
  )); 
  $volunteer->the_post(); ?>
  <div class="volunteer-intro">
    <div class="volunteer-intro__img">
      <div class="volunteer-intro__img-container">
        <img src="<?php the_field("content_image"); ?>" alt="<?php the_field("content_name"); ?>">
      </div>
      <div class="volunteer-intro__img-bg">
        <div class="volunteer-intro__img-pattern"></div>
      </div>
    </div>
    <div class="volunteer-intro__text">
      <h2><?php the_field("content_name"); ?></h2>
      <p><?php the_field("main_body_content"); ?></p>
    </div>
  </div>

  <div class="volunteer-info">
    <h3>We're looking for people to:</h3>
    <div class="volunteer-info__cards">
      <?php 
      for ($volNum = 0; $volNum < 4; $volNum++) {
        switch ($volNum) {
          case 0:
            $volText = 'Ensure animal housing is clean, sanitary, and comfortable';
            $volIcon = 'water-white';
            break;
          case 1:
            $volText = 'Provide care through implementation of positive reinforcement training and socialization';
            $volIcon = 'leash-white';
            break;
          case 2:
            $volText = 'Write creative bios and content for our website and social channels';
            $volIcon = 'pen-white';
            break;
          case 3:
            $volText = 'Photograph our new cats and dogs to share them with prospective owners';
            $volIcon = 'camera-white';
            break;
        } ?>
        <div class="volunteer-info__card">
          <div class="volunteer-info__card-icon">
            <img src="<?php echo get_theme_file_uri('/images/icon_' . $volIcon . '.svg'); ?>" alt="<?php echo 'icon-' . $volIcon; ?>">
          </div>
          <p><?php echo $volText ?></p>
        </div>
      <?php } ?>    
    </div>
  </div>

  <?php 
  $volunteer = new WP_Query(array(
    'posts_per_page' => -1,
    'post_type' => 'content',
    'meta_key' => 'content_name',
    'meta_value' => 'Foster an animal in need'
  )); 
  $volunteer->the_post(); ?>
  <div class="volunteer-intro">    
    <div class="volunteer-intro__text">
      <h2><?php the_field("content_name"); ?></h2>
      <p><?php the_field("main_body_content"); ?></p>
    </div>
    <div class="volunteer-intro__img">
      <div class="volunteer-intro__img-container">
        <img src="<?php the_field("content_image"); ?>" alt="<?php the_field("content_name"); ?>">
      </div>
      <div class="volunteer-intro__img-bg">
        <div class="volunteer-intro__img-pattern"></div>
      </div>
    </div>
  </div>

  <div class="volunteer-info">
    <h3>The Process:</h3>
    <div class="volunteer-info__cards">
      <?php 
      for ($fosNum = 0; $fosNum < 4; $fosNum++) {
        switch ($fosNum) {
          case 0:
            $fosText = 'Contact us to apply for the Foster Care program';
            $fosIcon = 'speech-bubble';
            break;
          case 1:
            $fosText = 'Attend an information session and complete your application form';
            $fosIcon = 'form';
            break;
          case 2:
            $fosText = 'Have your property inspected for suitability';
            $fosIcon = 'house';
            break;
          case 3:
            $fosText = 'Become a foster carer and make a difference to animals in need';
            $fosIcon = 'heart';
            break;
        } ?>
        <div class="foster-info__card">
          <div class="foster-info__card-icon">
            <div>
              <img src="<?php echo get_theme_file_uri('/images/icon_' . $fosIcon . '.svg'); ?>" alt="<?php echo 'icon-' . $fosIcon; ?>">
              <div><?php echo $fosNum + 1; ?></div>
            </div>
          </div>
          <p><?php echo $fosText ?></p>
        </div>
      <?php } ?>    
    </div>
  </div>
</div>

<?php  get_footer();

?>