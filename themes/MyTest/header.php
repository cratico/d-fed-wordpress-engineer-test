<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>        
    <meta charset="<?php bloginfo('charset'); ?>" />        
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Header =========================================== -->
<header id="header" class="header__wrapper">
    <div class="container">
        <!-- Logo -->
        <?php if($logo_url = get_theme_mod('mytest_logo')): ?>
            <a class="header__logo" href="<?php echo site_url(); ?>"><img src="<?php echo esc_url(get_theme_mod('mytest_logo')) ?>" alt="<?php _e('Logo', THEME_DOMAIN); ?>"></a>
        <?php else: ?>
            <h1 class="header__logo--text"><a href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?>.<sup>®</sup></a></h1>
        <?php endif ?>


        <!-- Menu -->
        <nav class="header__navigation" id="navigation">
            <?php wp_nav_menu(array(
                'theme_location' => 'header-menu', 
                'menu_class' => 'menu header__menu',
                'container'  => '',
                'depth' => 2
            )); ?>
        </nav>

        <!-- Bars -->
        <button class="header__burger" id="navigation-trigger"><span></span></button>
    </div>
</header>
<div class="header--space"></div>


<!-- Responsive Menu ================================== -->
<div class="menu__overlay"></div>
<div class="responsive__menu" id="responsive-menu">
    <!-- Menu -->
    <nav class="responsive__navigation" id="responsive-navigation">
        <button class="close" id="close-navigation"></button>

        <?php wp_nav_menu(array(
            'theme_location' => 'header-menu', 
            'menu_class' => 'menu',
            'container'  => '',
            'depth' => 2
        )); ?>
    </nav>
</div>