<?php
/**
 * VK4WIP Amateur Radio Club Theme Functions
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define Constants
 */
define( 'VK4WIP_THEME_VERSION', '1.0.0' );
define( 'VK4WIP_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );
define( 'VK4WIP_THEME_URI', trailingslashit( esc_url( get_stylesheet_directory_uri() ) ) );

/**
 * Enqueue Theme Styles
 */
function vk4wip_enqueue_styles() {
    // Enqueue Google Fonts
    wp_enqueue_style(
        'vk4wip-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Montserrat:wght@600;700;800&display=swap',
        array(),
        null
    );
    
    // Enqueue CSS Custom Properties
    wp_enqueue_style(
        'vk4wip-custom-properties',
        VK4WIP_THEME_URI . 'assets/css/custom-properties.css',
        array(),
        VK4WIP_THEME_VERSION
    );
    
    // Enqueue Header Styles
    wp_enqueue_style(
        'vk4wip-header',
        VK4WIP_THEME_URI . 'assets/css/header.css',
        array( 'vk4wip-custom-properties' ),
        VK4WIP_THEME_VERSION
    );
    
    // Enqueue Hero Styles
    wp_enqueue_style(
        'vk4wip-hero',
        VK4WIP_THEME_URI . 'assets/css/hero.css',
        array( 'vk4wip-custom-properties' ),
        VK4WIP_THEME_VERSION
    );
    
    // Enqueue Components Styles
    wp_enqueue_style(
        'vk4wip-components',
        VK4WIP_THEME_URI . 'assets/css/components.css',
        array( 'vk4wip-custom-properties' ),
        VK4WIP_THEME_VERSION
    );
    
    // Enqueue Footer Styles
    wp_enqueue_style(
        'vk4wip-footer',
        VK4WIP_THEME_URI . 'assets/css/footer.css',
        array( 'vk4wip-custom-properties' ),
        VK4WIP_THEME_VERSION
    );
    
    // Enqueue Responsive Styles
    wp_enqueue_style(
        'vk4wip-responsive',
        VK4WIP_THEME_URI . 'assets/css/responsive.css',
        array( 'vk4wip-components' ),
        VK4WIP_THEME_VERSION
    );
    
    // Enqueue Front Page Styles (only on homepage)
    if ( is_front_page() ) {
        wp_enqueue_style(
            'vk4wip-front-page',
            VK4WIP_THEME_URI . 'assets/css/front-page.css',
            array( 'vk4wip-components' ),
            VK4WIP_THEME_VERSION
        );
    }
    
    // Enqueue Main Theme Stylesheet (loads last)
    wp_enqueue_style(
        'vk4wip-main-style',
        get_stylesheet_uri(),
        array( 'vk4wip-responsive' ),
        VK4WIP_THEME_VERSION
    );
}
add_action( 'wp_enqueue_scripts', 'vk4wip_enqueue_styles' );

/**
 * Enqueue Theme Scripts
 */
function vk4wip_enqueue_scripts() {
    // Enqueue custom navigation script
    wp_enqueue_script(
        'vk4wip-navigation',
        VK4WIP_THEME_URI . 'assets/js/navigation.js',
        array( 'jquery' ),
        VK4WIP_THEME_VERSION,
        true
    );
    
    // Enqueue main theme script
    wp_enqueue_script(
        'vk4wip-theme',
        VK4WIP_THEME_URI . 'assets/js/theme.js',
        array( 'jquery' ),
        VK4WIP_THEME_VERSION,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'vk4wip_enqueue_scripts' );

/**
 * Theme Setup
 */
function vk4wip_theme_setup() {
    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 190,
        'width'       => 190,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    
    // Add image sizes for theme
    add_image_size( 'vk4wip-card-thumbnail', 400, 300, true );
    add_image_size( 'vk4wip-hero-image', 600, 400, true );
    add_image_size( 'vk4wip-featured', 1200, 600, true );
    
    // Register navigation menus
    register_nav_menus( array(
        'primary'     => esc_html__( 'Primary Menu', 'vk4wip-theme' ),
        'footer-menu' => esc_html__( 'Footer Menu', 'vk4wip-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'vk4wip_theme_setup' );

/**
 * Include Custom Files
 */
// Custom Post Types
require_once VK4WIP_THEME_DIR . 'inc/custom-post-types.php';

// Custom Fields (Meta Boxes)
require_once VK4WIP_THEME_DIR . 'inc/custom-fields.php';

// Customizer Settings
require_once VK4WIP_THEME_DIR . 'inc/customizer.php';

// Theme Helper Functions
require_once VK4WIP_THEME_DIR . 'inc/theme-functions.php';

/**
 * Add Elementor Support
 */
function vk4wip_elementor_support() {
    // Add Elementor locations support
    add_theme_support( 'elementor' );
}
add_action( 'after_setup_theme', 'vk4wip_elementor_support' );

/**
 * Modify excerpt length for cards
 */
function vk4wip_excerpt_length( $length ) {
    if ( is_front_page() ) {
        return 20;
    }
    return $length;
}
add_filter( 'excerpt_length', 'vk4wip_excerpt_length', 999 );

/**
 * Modify excerpt more text
 */
function vk4wip_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'vk4wip_excerpt_more' );

/**
 * Add body classes for custom styling
 */
function vk4wip_body_classes( $classes ) {
    // Add class for front page
    if ( is_front_page() ) {
        $classes[] = 'vk4wip-front-page';
    }
    
    // Add class for custom post types
    if ( is_singular( 'event' ) ) {
        $classes[] = 'single-event';
    }
    
    if ( is_singular( 'repeater' ) ) {
        $classes[] = 'single-repeater';
    }
    
    return $classes;
}
add_filter( 'body_class', 'vk4wip_body_classes' );

/**
 * Register Widget Areas
 */
function vk4wip_widgets_init() {
    // Footer Widget Area 1
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 1', 'vk4wip-theme' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here for footer column 1.', 'vk4wip-theme' ),
        'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    // Footer Widget Area 2
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 2', 'vk4wip-theme' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here for footer column 2.', 'vk4wip-theme' ),
        'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    // Footer Widget Area 3
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 3', 'vk4wip-theme' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here for footer column 3.', 'vk4wip-theme' ),
        'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'vk4wip_widgets_init' );

/**
 * Default menu fallback
 */
function vk4wip_default_menu() {
    echo '<ul class="menu">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'HOME', 'vk4wip-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/about' ) ) . '">' . esc_html__( 'ABOUT', 'vk4wip-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/meetings' ) ) . '">' . esc_html__( 'MEETINGS', 'vk4wip-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/calendar' ) ) . '">' . esc_html__( 'CALENDAR', 'vk4wip-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/social' ) ) . '">' . esc_html__( 'SOCIAL', 'vk4wip-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/on-air' ) ) . '">' . esc_html__( 'ON-AIR', 'vk4wip-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/training' ) ) . '">' . esc_html__( 'TRAINING', 'vk4wip-theme' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/members' ) ) . '">' . esc_html__( 'MEMBERS', 'vk4wip-theme' ) . '</a></li>';
    echo '</ul>';
}

/**
 * Footer menu fallback
 */
function vk4wip_footer_default_menu() {
    echo '<a href="' . esc_url( home_url( '/membership' ) ) . '">' . esc_html__( 'Membership', 'vk4wip-theme' ) . '</a>';
    echo '<a href="' . esc_url( home_url( '/contact' ) ) . '">' . esc_html__( 'Contact', 'vk4wip-theme' ) . '</a>';
    echo '<a href="' . esc_url( home_url( '/events' ) ) . '">' . esc_html__( 'Events', 'vk4wip-theme' ) . '</a>';
    echo '<a href="' . esc_url( home_url( '/privacy-policy' ) ) . '">' . esc_html__( 'Privacy', 'vk4wip-theme' ) . '</a>';
}

/**
 * ACF Compatibility - Check if ACF is active
 */
function vk4wip_check_acf() {
    if ( ! class_exists( 'ACF' ) ) {
        add_action( 'admin_notices', 'vk4wip_acf_notice' );
    }
}
add_action( 'after_setup_theme', 'vk4wip_check_acf' );

/**
 * Display admin notice if ACF is not installed
 */
function vk4wip_acf_notice() {
    ?>
    <div class="notice notice-warning is-dismissible">
        <p><?php esc_html_e( 'VK4WIP Theme: Advanced Custom Fields (ACF) plugin is recommended for managing event and repeater information.', 'vk4wip-theme' ); ?></p>
    </div>
    <?php
}
