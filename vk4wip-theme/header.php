<?php
/**
 * The header for VK4WIP Theme
 *
 * This displays the custom header with overlapping logo, gold menu bar,
 * and floating header actions.
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content">
        <?php esc_html_e( 'Skip to content', 'vk4wip-theme' ); ?>
    </a>

    <!-- ======= HEADER (overlap logo + right-aligned menu + floating links) ======= -->
    <header class="site-header full-width">
        <div class="wrapper header-top">
            <a class="brandmark" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <?php
                // Display custom logo or default VK4WIP logo
                if ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    ?>
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/VK4WIP.png' ); ?>" 
                         alt="<?php bloginfo( 'name' ); ?>" 
                         class="club-logo" />
                    <?php
                }
                ?>
            </a>

            <div class="site-branding">
                <?php
                if ( is_front_page() && is_home() ) :
                    ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    </h1>
                    <?php
                else :
                    ?>
                    <p class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    </p>
                    <?php
                endif;

                $vk4wip_description = get_bloginfo( 'description', 'display' );
                if ( $vk4wip_description || is_customize_preview() ) :
                    ?>
                    <p class="site-description"><?php echo $vk4wip_description; ?></p>
                    <?php
                endif;
                ?>
            </div><!-- .site-branding -->

            <nav class="header-actions" aria-label="<?php esc_attr_e( 'Header quick links', 'vk4wip-theme' ); ?>">
                <a href="<?php echo esc_url( home_url( '/news' ) ); ?>">
                    <?php esc_html_e( 'News', 'vk4wip-theme' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/events' ) ); ?>">
                    <?php esc_html_e( 'Events', 'vk4wip-theme' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
                    <?php esc_html_e( 'Contact', 'vk4wip-theme' ); ?>
                </a>
                <?php
                // Facebook link - can be made customizable via Customizer
                $facebook_url = get_theme_mod( 'vk4wip_facebook_url', 'https://www.facebook.com/vk4wip' );
                if ( $facebook_url ) :
                    ?>
                    <a href="<?php echo esc_url( $facebook_url ); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="social" 
                       aria-label="<?php esc_attr_e( 'Facebook', 'vk4wip-theme' ); ?>">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" 
                             alt="<?php esc_attr_e( 'Facebook', 'vk4wip-theme' ); ?>">
                    </a>
                    <?php
                endif;
                ?>
            </nav>
        </div><!-- .header-top -->

        <div class="menu-bar">
            <div class="wrapper">
                <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'vk4wip-theme' ); ?>">
                    <button class="menu-toggle" 
                            aria-controls="primary-menu" 
                            aria-expanded="false"
                            aria-label="<?php esc_attr_e( 'Toggle menu', 'vk4wip-theme' ); ?>">
                        <img width="24" height="24" 
                             src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/menu-icon.svg' ); ?>" 
                             alt="<?php esc_attr_e( 'Menu', 'vk4wip-theme' ); ?>"
                             onerror="this.style.display='none'; this.parentElement.innerHTML='☰ Menu';">
                    </button>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'menu_class'     => 'menu',
                            'container'      => false,
                            'fallback_cb'    => 'vk4wip_default_menu',
                        )
                    );
                    ?>
                </nav><!-- #site-navigation -->
            </div><!-- .wrapper -->
        </div><!-- .menu-bar -->
    </header><!-- .site-header -->

    <div id="content" class="site-content">
