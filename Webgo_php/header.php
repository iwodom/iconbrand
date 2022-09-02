<!DOCTYPE HTML>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- <title>
    <?php if( is_front_page() ) {
        bloginfo('name');
        ?>
        -
        <?php
          bloginfo('description');
      } else if ( is_single() || is_page() ) {
            bloginfo('name');
            ?>
            -
            <?php the_title();
        } else if( is_tag() ) {
         bloginfo('name');
         ?>
         -
         <?php
         single_tag_title();
     } else if( is_category() || is_archive() ) {
         bloginfo('name');
         ?>
         -
         <?php
         single_cat_title();
     } else if( is_search() ) {
         bloginfo('name');
         ?>
         -
         <?php
          bloginfo('name');
     } else {
         bloginfo('name');
         ?>
         -
         <?php
         get_the_title();
     }
     ?>
    </title>
 -->

    <title><?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_title', true) ?: get_the_title(); ?></title>
    <meta name="description" content="<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>" />
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
       <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<header>
</header>
