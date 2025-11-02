<?php
/**
 * VK4WIP Theme - Custom Post Types
 * Register Events and Repeaters custom post types
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Events Custom Post Type
 */
function vk4wip_register_events_post_type() {
    $labels = array(
        'name'                  => _x( 'Events', 'Post Type General Name', 'vk4wip-theme' ),
        'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'vk4wip-theme' ),
        'menu_name'             => __( 'Events', 'vk4wip-theme' ),
        'name_admin_bar'        => __( 'Event', 'vk4wip-theme' ),
        'archives'              => __( 'Event Archives', 'vk4wip-theme' ),
        'attributes'            => __( 'Event Attributes', 'vk4wip-theme' ),
        'parent_item_colon'     => __( 'Parent Event:', 'vk4wip-theme' ),
        'all_items'             => __( 'All Events', 'vk4wip-theme' ),
        'add_new_item'          => __( 'Add New Event', 'vk4wip-theme' ),
        'add_new'               => __( 'Add New', 'vk4wip-theme' ),
        'new_item'              => __( 'New Event', 'vk4wip-theme' ),
        'edit_item'             => __( 'Edit Event', 'vk4wip-theme' ),
        'update_item'           => __( 'Update Event', 'vk4wip-theme' ),
        'view_item'             => __( 'View Event', 'vk4wip-theme' ),
        'view_items'            => __( 'View Events', 'vk4wip-theme' ),
        'search_items'          => __( 'Search Event', 'vk4wip-theme' ),
        'not_found'             => __( 'Not found', 'vk4wip-theme' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'vk4wip-theme' ),
        'featured_image'        => __( 'Event Image', 'vk4wip-theme' ),
        'set_featured_image'    => __( 'Set event image', 'vk4wip-theme' ),
        'remove_featured_image' => __( 'Remove event image', 'vk4wip-theme' ),
        'use_featured_image'    => __( 'Use as event image', 'vk4wip-theme' ),
        'insert_into_item'      => __( 'Insert into event', 'vk4wip-theme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this event', 'vk4wip-theme' ),
        'items_list'            => __( 'Events list', 'vk4wip-theme' ),
        'items_list_navigation' => __( 'Events list navigation', 'vk4wip-theme' ),
        'filter_items_list'     => __( 'Filter events list', 'vk4wip-theme' ),
    );

    $args = array(
        'label'                 => __( 'Event', 'vk4wip-theme' ),
        'description'           => __( 'Club events, meetings, and activities', 'vk4wip-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
        'taxonomies'            => array( 'event_category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'events' ),
    );

    register_post_type( 'event', $args );
}
add_action( 'init', 'vk4wip_register_events_post_type', 0 );

/**
 * Register Event Categories Taxonomy
 */
function vk4wip_register_event_category_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Event Categories', 'Taxonomy General Name', 'vk4wip-theme' ),
        'singular_name'              => _x( 'Event Category', 'Taxonomy Singular Name', 'vk4wip-theme' ),
        'menu_name'                  => __( 'Event Categories', 'vk4wip-theme' ),
        'all_items'                  => __( 'All Categories', 'vk4wip-theme' ),
        'parent_item'                => __( 'Parent Category', 'vk4wip-theme' ),
        'parent_item_colon'          => __( 'Parent Category:', 'vk4wip-theme' ),
        'new_item_name'              => __( 'New Category Name', 'vk4wip-theme' ),
        'add_new_item'               => __( 'Add New Category', 'vk4wip-theme' ),
        'edit_item'                  => __( 'Edit Category', 'vk4wip-theme' ),
        'update_item'                => __( 'Update Category', 'vk4wip-theme' ),
        'view_item'                  => __( 'View Category', 'vk4wip-theme' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'vk4wip-theme' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'vk4wip-theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'vk4wip-theme' ),
        'popular_items'              => __( 'Popular Categories', 'vk4wip-theme' ),
        'search_items'               => __( 'Search Categories', 'vk4wip-theme' ),
        'not_found'                  => __( 'Not Found', 'vk4wip-theme' ),
        'no_terms'                   => __( 'No categories', 'vk4wip-theme' ),
        'items_list'                 => __( 'Categories list', 'vk4wip-theme' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'vk4wip-theme' ),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array( 'slug' => 'event-category' ),
    );

    register_taxonomy( 'event_category', array( 'event' ), $args );
}
add_action( 'init', 'vk4wip_register_event_category_taxonomy', 0 );

/**
 * Register Repeaters Custom Post Type
 */
function vk4wip_register_repeaters_post_type() {
    $labels = array(
        'name'                  => _x( 'Repeaters', 'Post Type General Name', 'vk4wip-theme' ),
        'singular_name'         => _x( 'Repeater', 'Post Type Singular Name', 'vk4wip-theme' ),
        'menu_name'             => __( 'Repeaters', 'vk4wip-theme' ),
        'name_admin_bar'        => __( 'Repeater', 'vk4wip-theme' ),
        'archives'              => __( 'Repeater Archives', 'vk4wip-theme' ),
        'attributes'            => __( 'Repeater Attributes', 'vk4wip-theme' ),
        'parent_item_colon'     => __( 'Parent Repeater:', 'vk4wip-theme' ),
        'all_items'             => __( 'All Repeaters', 'vk4wip-theme' ),
        'add_new_item'          => __( 'Add New Repeater', 'vk4wip-theme' ),
        'add_new'               => __( 'Add New', 'vk4wip-theme' ),
        'new_item'              => __( 'New Repeater', 'vk4wip-theme' ),
        'edit_item'             => __( 'Edit Repeater', 'vk4wip-theme' ),
        'update_item'           => __( 'Update Repeater', 'vk4wip-theme' ),
        'view_item'             => __( 'View Repeater', 'vk4wip-theme' ),
        'view_items'            => __( 'View Repeaters', 'vk4wip-theme' ),
        'search_items'          => __( 'Search Repeater', 'vk4wip-theme' ),
        'not_found'             => __( 'Not found', 'vk4wip-theme' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'vk4wip-theme' ),
        'featured_image'        => __( 'Repeater Image', 'vk4wip-theme' ),
        'set_featured_image'    => __( 'Set repeater image', 'vk4wip-theme' ),
        'remove_featured_image' => __( 'Remove repeater image', 'vk4wip-theme' ),
        'use_featured_image'    => __( 'Use as repeater image', 'vk4wip-theme' ),
        'insert_into_item'      => __( 'Insert into repeater', 'vk4wip-theme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this repeater', 'vk4wip-theme' ),
        'items_list'            => __( 'Repeaters list', 'vk4wip-theme' ),
        'items_list_navigation' => __( 'Repeaters list navigation', 'vk4wip-theme' ),
        'filter_items_list'     => __( 'Filter repeaters list', 'vk4wip-theme' ),
    );

    $args = array(
        'label'                 => __( 'Repeater', 'vk4wip-theme' ),
        'description'           => __( 'Amateur radio repeaters and technical information', 'vk4wip-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
        'taxonomies'            => array( 'repeater_band' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-radio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'repeaters' ),
    );

    register_post_type( 'repeater', $args );
}
add_action( 'init', 'vk4wip_register_repeaters_post_type', 0 );

/**
 * Register Repeater Band Taxonomy
 */
function vk4wip_register_repeater_band_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Bands', 'Taxonomy General Name', 'vk4wip-theme' ),
        'singular_name'              => _x( 'Band', 'Taxonomy Singular Name', 'vk4wip-theme' ),
        'menu_name'                  => __( 'Bands', 'vk4wip-theme' ),
        'all_items'                  => __( 'All Bands', 'vk4wip-theme' ),
        'parent_item'                => __( 'Parent Band', 'vk4wip-theme' ),
        'parent_item_colon'          => __( 'Parent Band:', 'vk4wip-theme' ),
        'new_item_name'              => __( 'New Band Name', 'vk4wip-theme' ),
        'add_new_item'               => __( 'Add New Band', 'vk4wip-theme' ),
        'edit_item'                  => __( 'Edit Band', 'vk4wip-theme' ),
        'update_item'                => __( 'Update Band', 'vk4wip-theme' ),
        'view_item'                  => __( 'View Band', 'vk4wip-theme' ),
        'separate_items_with_commas' => __( 'Separate bands with commas', 'vk4wip-theme' ),
        'add_or_remove_items'        => __( 'Add or remove bands', 'vk4wip-theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'vk4wip-theme' ),
        'popular_items'              => __( 'Popular Bands', 'vk4wip-theme' ),
        'search_items'               => __( 'Search Bands', 'vk4wip-theme' ),
        'not_found'                  => __( 'Not Found', 'vk4wip-theme' ),
        'no_terms'                   => __( 'No bands', 'vk4wip-theme' ),
        'items_list'                 => __( 'Bands list', 'vk4wip-theme' ),
        'items_list_navigation'      => __( 'Bands list navigation', 'vk4wip-theme' ),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array( 'slug' => 'band' ),
    );

    register_taxonomy( 'repeater_band', array( 'repeater' ), $args );
}
add_action( 'init', 'vk4wip_register_repeater_band_taxonomy', 0 );

/**
 * Flush rewrite rules on theme activation
 */
function vk4wip_rewrite_flush() {
    vk4wip_register_events_post_type();
    vk4wip_register_repeaters_post_type();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'vk4wip_rewrite_flush' );
