<footer class="footer">
  <div class="footer-menu">
    <div class="footer-menu__items">
      <?php 
        wp_nav_menu(array(
          'theme_location' => 'headerMenuLocation'
        ));
      ?>
    </div>
    <div class="footer-icons">
      <div class="footer-icons__logo">
        <a href="<?php echo home_url(); ?>">
          <span>Petfriend</span>
          <img src="<?php echo get_theme_file_uri('/images/logo_petfriend.svg'); ?>">
        </a>
      </div>
      <div class="footer-icons__social">
        <a href="https://www.instagram.com/" target="_blank">
          <img src="<?php echo get_theme_file_uri('/images/icon_instagram.svg'); ?>">
        </a>
        <a href="https://www.facebook.com/" target="_blank">
          <img src="<?php echo get_theme_file_uri('/images/icon_facebook.svg'); ?>">
        </a>
        <a href="https://www.youtube.com/" target="_blank">
          <img src="<?php echo get_theme_file_uri('/images/icon_youtube.svg'); ?>">
        </a>
        <a href="https://www.snapchat.com/" target="_blank">
          <img src="<?php echo get_theme_file_uri('/images/icon_snapchat.svg'); ?>">
        </a>
      </div>
    </div>
  </div>
  
  <div class="footer-bg"></div>
</footer>

<div class="search-overlay">
  <div class="search-overlay__bg"></div>
  <div class="search-overlay__container">
    <div class="search-overlay__top">
      <img class="search-overlay__icon" src="<?php echo get_theme_file_uri('/images/icon_search.svg'); ?>" alt="search_icon">
      <div class="search-form">
        <input type="text" class="search-field" id="search-field" placeholder="What are you looking for?">
      </div>
      <img class="search-overlay__close" src="<?php echo get_theme_file_uri('/images/icon_close.svg'); ?>" alt="search_close">
    </div>
    <div class="search-overlay__results"></div>
  </div>
</div>

<div class="nav-overlay">
  <div class="nav-overlay__bg">
    <div class="nav-overlay__bg-pattern"></div>
  </div>
  <div class="nav-overlay__container">
    <div class="nav-overlay__top">
      <img class="nav-overlay__close" src="<?php echo get_theme_file_uri('/images/icon_close.svg'); ?>" alt="nav_close">
    </div>
    <div class="nav-overlay__items">
      <?php 
        wp_nav_menu(array(
          'theme_location' => 'headerMenuLocation'
        ));
      ?>
    </div>
  </div>
</div>

<div class="loader"></div>

<?php wp_footer(); ?>
</body>
</html>