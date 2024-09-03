<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
     <!-- Font Awesome CDN -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body <?php body_class(); ?>>
<header style="background-color: <?php echo esc_attr( get_option('header_background_color', '#ffffff') ); ?> !important;">
        <div class="container">
            <div class="logo">
                <!-- Display Custom Logo -->
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Site Logo">
                    </a>
                <?php endif; ?>
            </div>

            <nav>
                <!-- Display the Primary Menu -->
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                ) );
                ?>
            </nav>

            <div class="search-bar">
    <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="text" class="search-field" value="<?php echo get_search_query(); ?>" name="s" placeholder="Search...">
       
    </form>
    <i class="fas fa-search search-icon"></i>
</div>

    </header>

    <?php wp_body_open(); ?>
