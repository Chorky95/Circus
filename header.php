<!DOCTYPE html>
<!--[if IE 8]><html <?php language_attributes(); ?> class="ie8"><![endif]-->
<!--[if lte IE 9]><html <?php language_attributes(); ?> class="ie9"><![endif]-->
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5.0">
  <link rel="dns-prefetch" href="//google-analytics.com">
  <link rel="icon" type="image/png" href="<?php echo get_theme_file_uri('meta/favicon-96x96.png'); ?>" sizes="96x96" />
  <link rel="shortcut icon" href="<?php echo get_theme_file_uri('meta/favicon.ico'); ?>" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_theme_file_uri('/meta/apple-touch-icon.png'); ?>" />
  <meta name="apple-mobile-web-app-title" content="CircusCircus" />
  <title>Circus Circus Las Vegas</title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php
  $header_logo = get_field('header_logo', 'option');
  $header_menu = get_field('header_menu', 'option');
  $button_link = get_field('button_link', 'option');
  $sticky_header = get_field('sticky_header', 'option');
  $header_class = $sticky_header ? 'header header--sticky' : 'header';
  ?>

  <header class="<?php echo esc_attr($header_class); ?>">
    <div class="header__container container">
      <?php ?>

      <?php if ($header_logo): ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo-link">
          <img class="header__logo" src="<?php echo esc_url($header_logo['url']); ?>" alt="<?php echo esc_attr($header_logo['alt'] ?: get_bloginfo('name')); ?>">
        </a>
      <?php endif; ?>

      <div class="header__right">
        <nav class="header__nav">
          <?php if ($header_menu): ?>
            <ul class="header__menu">
              <?php foreach ($header_menu as $menu_item): ?>
                <?php $link = $menu_item['header_menu_link']; ?>
                <?php if ($link): ?>
                  <li class="header__menu-item">
                    <a href="<?php echo esc_url($link['url']); ?>" class="header__menu-link" <?php echo $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
                      <?php echo esc_html($link['title']); ?>
                    </a>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </nav>

        <?php if ($button_link): ?>
          <a href="<?php echo esc_url($button_link['url']); ?>" class="header__button button" <?php echo $button_link['target'] ? 'target="' . esc_attr($button_link['target']) . '"' : ''; ?>>
            <?php echo esc_html($button_link['title']); ?>
          </a>
        <?php endif; ?>
      </div>

      <button class="header__hamburger" aria-label="Toggle menu" aria-expanded="false">
        <div class="header__hamburger__container">
          <span class="header__hamburger-line"></span>
          <span class="header__hamburger-line"></span>
          <span class="header__hamburger-line"></span>
        </div>
      </button>
    </div>

    <div class="header__mobile-menu">
      <?php if ($header_menu): ?>
        <ul class="header__mobile-list">
          <?php foreach ($header_menu as $menu_item): ?>
            <?php $link = $menu_item['header_menu_link']; ?>
            <?php if ($link): ?>
              <li class="header__mobile-item">
                <a href="<?php echo esc_url($link['url']); ?>" class="header__mobile-link" <?php echo $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
                  <?php echo esc_html($link['title']); ?>
                </a>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <?php if ($button_link): ?>
        <a href="<?php echo esc_url($button_link['url']); ?>" class="header__mobile-button button" <?php echo $button_link['target'] ? 'target="' . esc_attr($button_link['target']) . '"' : ''; ?>>
          <?php echo esc_html($button_link['title']); ?>
        </a>
      <?php endif; ?>
    </div>
  </header>

  <!-- Normal front-end render -->
  <?php
