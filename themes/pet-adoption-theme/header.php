<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?php echo get_theme_file_uri('/images/logo_petfriend.svg'); ?>">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <nav class="navbar">
      <div class="navbar-logo">
        <a href="<?php echo home_url(); ?>">
          <span>Petfriend</span>
          <img src="<?php echo get_theme_file_uri('/images/logo_petfriend.svg'); ?>">
        </a>
      </div>
      <div class="navbar-menu">
        <?php 
          wp_nav_menu(array(
            'theme_location' => 'headerMenuLocation'
          ));
        ?>     
        <div class="navbar-menu__search">
          <img src="<?php echo get_theme_file_uri('/images/icon_search.svg'); ?>" alt="search_icon">
        </div>
        <div class="navbar-menu__icon">
          <img src="<?php echo get_theme_file_uri('/images/icon_hamburger-menu.svg'); ?>" alt="hamburger_menu">
        </div>
      </div>
    </nav>