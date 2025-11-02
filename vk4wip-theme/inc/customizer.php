<?php
/**
 * VK4WIP Theme - Customizer Settings
 * WordPress Customizer configuration for theme options
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Customizer Settings
 */
function vk4wip_customize_register( $wp_customize ) {
    
    // ========================================
    // SECTION: Hero Section Settings
    // ========================================
    $wp_customize->add_section( 'vk4wip_hero_section', array(
        'title'       => __( 'Hero Section', 'vk4wip-theme' ),
        'description' => __( 'Configure the homepage hero section', 'vk4wip-theme' ),
        'priority'    => 30,
    ) );
    
    // Hero Title
    $wp_customize->add_setting( 'vk4wip_hero_title', array(
        'default'           => __( 'Welcome to VK4WIP', 'vk4wip-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_hero_title', array(
        'label'       => __( 'Hero Title', 'vk4wip-theme' ),
        'description' => __( 'Main heading for the hero section', 'vk4wip-theme' ),
        'section'     => 'vk4wip_hero_section',
        'type'        => 'text',
    ) );
    
    // Hero Description
    $wp_customize->add_setting( 'vk4wip_hero_description', array(
        'default'           => __( 'Ipswich and District Amateur Radio Club - Using and promoting Amateur (HAM) Radio in the Ipswich and surrounding areas since 1962', 'vk4wip-theme' ),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_hero_description', array(
        'label'       => __( 'Hero Description', 'vk4wip-theme' ),
        'description' => __( 'Description text for the hero section', 'vk4wip-theme' ),
        'section'     => 'vk4wip_hero_section',
        'type'        => 'textarea',
    ) );
    
    // Hero CTA Text
    $wp_customize->add_setting( 'vk4wip_hero_cta_text', array(
        'default'           => __( 'Join Our Club', 'vk4wip-theme' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_hero_cta_text', array(
        'label'       => __( 'Hero CTA Button Text', 'vk4wip-theme' ),
        'description' => __( 'Text for the call-to-action button', 'vk4wip-theme' ),
        'section'     => 'vk4wip_hero_section',
        'type'        => 'text',
    ) );
    
    // Hero CTA Link
    $wp_customize->add_setting( 'vk4wip_hero_cta_link', array(
        'default'           => home_url( '/membership' ),
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_hero_cta_link', array(
        'label'       => __( 'Hero CTA Button Link', 'vk4wip-theme' ),
        'description' => __( 'URL for the call-to-action button', 'vk4wip-theme' ),
        'section'     => 'vk4wip_hero_section',
        'type'        => 'url',
    ) );
    
    // Hero Background Image
    $wp_customize->add_setting( 'vk4wip_hero_background', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'vk4wip_hero_background', array(
        'label'       => __( 'Hero Background Image', 'vk4wip-theme' ),
        'description' => __( 'Upload a background image for the hero section', 'vk4wip-theme' ),
        'section'     => 'vk4wip_hero_section',
        'mime_type'   => 'image',
    ) ) );
    
    // Use Featured Event as Hero
    $wp_customize->add_setting( 'vk4wip_hero_use_event', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_hero_use_event', array(
        'label'       => __( 'Use Featured Event in Hero', 'vk4wip-theme' ),
        'description' => __( 'Display the next featured event in the hero section', 'vk4wip-theme' ),
        'section'     => 'vk4wip_hero_section',
        'type'        => 'checkbox',
    ) );
    
    // ========================================
    // SECTION: Homepage Display Options
    // ========================================
    $wp_customize->add_section( 'vk4wip_homepage_section', array(
        'title'       => __( 'Homepage Display', 'vk4wip-theme' ),
        'description' => __( 'Configure homepage content display', 'vk4wip-theme' ),
        'priority'    => 31,
    ) );
    
    // Number of News Cards
    $wp_customize->add_setting( 'vk4wip_news_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_news_count', array(
        'label'       => __( 'Number of News Cards', 'vk4wip-theme' ),
        'description' => __( 'How many news posts to display on homepage', 'vk4wip-theme' ),
        'section'     => 'vk4wip_homepage_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 6,
            'step' => 1,
        ),
    ) );
    
    // Number of Events
    $wp_customize->add_setting( 'vk4wip_events_count', array(
        'default'           => 5,
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_events_count', array(
        'label'       => __( 'Number of Events', 'vk4wip-theme' ),
        'description' => __( 'How many upcoming events to display', 'vk4wip-theme' ),
        'section'     => 'vk4wip_homepage_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 10,
            'step' => 1,
        ),
    ) );
    
    // Show Explore Section
    $wp_customize->add_setting( 'vk4wip_show_explore', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_show_explore', array(
        'label'       => __( 'Show Explore Section', 'vk4wip-theme' ),
        'description' => __( 'Display the Explore More section on homepage', 'vk4wip-theme' ),
        'section'     => 'vk4wip_homepage_section',
        'type'        => 'checkbox',
    ) );
    
    // Show Repeaters Section
    $wp_customize->add_setting( 'vk4wip_show_repeaters', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_show_repeaters', array(
        'label'       => __( 'Show Repeaters Section', 'vk4wip-theme' ),
        'description' => __( 'Display the Repeaters Quick Info section', 'vk4wip-theme' ),
        'section'     => 'vk4wip_homepage_section',
        'type'        => 'checkbox',
    ) );
    
    // ========================================
    // SECTION: Contact Information
    // ========================================
    $wp_customize->add_section( 'vk4wip_contact_section', array(
        'title'       => __( 'Contact Information', 'vk4wip-theme' ),
        'description' => __( 'Club contact details', 'vk4wip-theme' ),
        'priority'    => 32,
    ) );
    
    // Club Phone
    $wp_customize->add_setting( 'vk4wip_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_phone', array(
        'label'       => __( 'Club Phone', 'vk4wip-theme' ),
        'description' => __( 'Main contact phone number', 'vk4wip-theme' ),
        'section'     => 'vk4wip_contact_section',
        'type'        => 'text',
    ) );
    
    // Club Email
    $wp_customize->add_setting( 'vk4wip_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_email', array(
        'label'       => __( 'Club Email', 'vk4wip-theme' ),
        'description' => __( 'Main contact email address', 'vk4wip-theme' ),
        'section'     => 'vk4wip_contact_section',
        'type'        => 'email',
    ) );
    
    // Club Address
    $wp_customize->add_setting( 'vk4wip_address', array(
        'default'           => '10 Deebing St, Ipswich QLD 4305',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_address', array(
        'label'       => __( 'Club Address', 'vk4wip-theme' ),
        'description' => __( 'Physical address of the club', 'vk4wip-theme' ),
        'section'     => 'vk4wip_contact_section',
        'type'        => 'textarea',
    ) );
    
    // Training Coordinator Name
    $wp_customize->add_setting( 'vk4wip_training_coordinator', array(
        'default'           => 'Greg Walker VK4GJW',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_training_coordinator', array(
        'label'       => __( 'Training Coordinator', 'vk4wip-theme' ),
        'description' => __( 'Name and callsign of training coordinator', 'vk4wip-theme' ),
        'section'     => 'vk4wip_contact_section',
        'type'        => 'text',
    ) );
    
    // Training Coordinator Phone
    $wp_customize->add_setting( 'vk4wip_training_phone', array(
        'default'           => '0428 999 640',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_training_phone', array(
        'label'       => __( 'Training Coordinator Phone', 'vk4wip-theme' ),
        'description' => __( 'Phone number for training inquiries', 'vk4wip-theme' ),
        'section'     => 'vk4wip_contact_section',
        'type'        => 'text',
    ) );
    
    // WICEN Coordinator Email
    $wp_customize->add_setting( 'vk4wip_wicen_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_wicen_email', array(
        'label'       => __( 'WICEN Coordinator Email', 'vk4wip-theme' ),
        'description' => __( 'Email for WICEN inquiries', 'vk4wip-theme' ),
        'section'     => 'vk4wip_contact_section',
        'type'        => 'email',
    ) );
    
    // ========================================
    // SECTION: Social Media Links
    // ========================================
    $wp_customize->add_section( 'vk4wip_social_section', array(
        'title'       => __( 'Social Media', 'vk4wip-theme' ),
        'description' => __( 'Social media profile links', 'vk4wip-theme' ),
        'priority'    => 33,
    ) );
    
    // Facebook URL
    $wp_customize->add_setting( 'vk4wip_facebook_url', array(
        'default'           => 'https://www.facebook.com/vk4wip',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_facebook_url', array(
        'label'       => __( 'Facebook URL', 'vk4wip-theme' ),
        'description' => __( 'Full URL to Facebook page', 'vk4wip-theme' ),
        'section'     => 'vk4wip_social_section',
        'type'        => 'url',
    ) );
    
    // Twitter URL
    $wp_customize->add_setting( 'vk4wip_twitter_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_twitter_url', array(
        'label'       => __( 'Twitter URL', 'vk4wip-theme' ),
        'description' => __( 'Full URL to Twitter profile', 'vk4wip-theme' ),
        'section'     => 'vk4wip_social_section',
        'type'        => 'url',
    ) );
    
    // YouTube URL
    $wp_customize->add_setting( 'vk4wip_youtube_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_youtube_url', array(
        'label'       => __( 'YouTube URL', 'vk4wip-theme' ),
        'description' => __( 'Full URL to YouTube channel', 'vk4wip-theme' ),
        'section'     => 'vk4wip_social_section',
        'type'        => 'url',
    ) );
    
    // Instagram URL
    $wp_customize->add_setting( 'vk4wip_instagram_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'vk4wip_instagram_url', array(
        'label'       => __( 'Instagram URL', 'vk4wip-theme' ),
        'description' => __( 'Full URL to Instagram profile', 'vk4wip-theme' ),
        'section'     => 'vk4wip_social_section',
        'type'        => 'url',
    ) );
}
add_action( 'customize_register', 'vk4wip_customize_register' );

/**
 * Sanitize checkbox values
 */
function vk4wip_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}
