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
      <link rel="icon" type="image/svg+xml" href="<?php echo get_theme_file_uri('meta/favicon.svg'); ?>" />
      <link rel="shortcut icon" href="<?php echo get_theme_file_uri('meta/favicon.ico'); ?>" />
      <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_theme_file_uri('/meta/apple-touch-icon.png'); ?>" />
      <meta name="apple-mobile-web-app-title" content="AllYouCanEat" />
      <?php wp_head(); ?>
      <!--[if lt IE 10]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script>
        <![endif]-->
      <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/livingston-css3-mediaqueries-js/1.0.0/css3-mediaqueries.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
        <![endif]-->
</head>

<body <?php body_class(); ?>>

      <!-- Normal front-end render -->
      <?php
