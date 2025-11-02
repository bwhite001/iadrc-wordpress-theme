<?php
/**
 * VK4WIP Theme - Helper Functions
 * Utility functions for theme functionality
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get upcoming events
 *
 * @param int $count Number of events to retrieve
 * @return WP_Query Query object with upcoming events
 */
function vk4wip_get_upcoming_events( $count = 5 ) {
    $args = array(
        'post_type'      => 'event',
        'posts_per_page' => $count,
        'meta_key'       => '_vk4wip_event_date',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'key'     => '_vk4wip_event_date',
                'value'   => date( 'Y-m-d' ),
                'compare' => '>=',
                'type'    => 'DATE',
            ),
        ),
    );
    
    return new WP_Query( $args );
}

/**
 * Get featured event for hero section
 *
 * @return WP_Post|null Featured event post or null
 */
function vk4wip_get_featured_event() {
    $args = array(
        'post_type'      => 'event',
        'posts_per_page' => 1,
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'     => '_vk4wip_event_featured',
                'value'   => '1',
                'compare' => '=',
            ),
            array(
                'key'     => '_vk4wip_event_date',
                'value'   => date( 'Y-m-d' ),
                'compare' => '>=',
                'type'    => 'DATE',
            ),
        ),
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_key'       => '_vk4wip_event_date',
    );
    
    $query = new WP_Query( $args );
    
    if ( $query->have_posts() ) {
        return $query->posts[0];
    }
    
    return null;
}

/**
 * Get latest news posts
 *
 * @param int $count Number of posts to retrieve
 * @return WP_Query Query object with latest posts
 */
function vk4wip_get_latest_news( $count = 3 ) {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    
    return new WP_Query( $args );
}

/**
 * Get repeaters for quick info display
 *
 * @param int $count Number of repeaters to retrieve
 * @return WP_Query Query object with repeaters
 */
function vk4wip_get_featured_repeaters( $count = 4 ) {
    $args = array(
        'post_type'      => 'repeater',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );
    
    return new WP_Query( $args );
}

/**
 * Get total repeater count
 *
 * @return int Number of published repeaters
 */
function vk4wip_get_repeater_count() {
    $count = wp_count_posts( 'repeater' );
    return isset( $count->publish ) ? $count->publish : 0;
}

/**
 * Format event date for display
 *
 * @param int    $post_id Post ID
 * @param string $format  Date format (default: 'F j, Y')
 * @return string Formatted date or empty string
 */
function vk4wip_format_event_date( $post_id, $format = 'F j, Y' ) {
    $date = get_post_meta( $post_id, '_vk4wip_event_date', true );
    
    if ( empty( $date ) ) {
        return '';
    }
    
    return date_i18n( $format, strtotime( $date ) );
}

/**
 * Format event time for display
 *
 * @param int    $post_id Post ID
 * @param string $format  Time format (default: 'g:i A')
 * @return string Formatted time or empty string
 */
function vk4wip_format_event_time( $post_id, $format = 'g:i A' ) {
    $time = get_post_meta( $post_id, '_vk4wip_event_time', true );
    
    if ( empty( $time ) ) {
        return '';
    }
    
    return date_i18n( $format, strtotime( $time ) );
}

/**
 * Get event location
 *
 * @param int $post_id Post ID
 * @return string Event location or empty string
 */
function vk4wip_get_event_location( $post_id ) {
    return get_post_meta( $post_id, '_vk4wip_event_location', true );
}

/**
 * Get full event date/time display
 *
 * @param int $post_id Post ID
 * @return string Formatted date and time
 */
function vk4wip_get_event_datetime( $post_id ) {
    $date = vk4wip_format_event_date( $post_id, 'l, F j, Y' );
    $time = vk4wip_format_event_time( $post_id );
    
    if ( empty( $date ) ) {
        return '';
    }
    
    $output = $date;
    
    if ( ! empty( $time ) ) {
        $output .= ' at ' . $time;
    }
    
    return $output;
}

/**
 * Get repeater frequency display
 *
 * @param int $post_id Post ID
 * @return string Formatted frequency information
 */
function vk4wip_get_repeater_info( $post_id ) {
    $callsign  = get_post_meta( $post_id, '_vk4wip_repeater_callsign', true );
    $frequency = get_post_meta( $post_id, '_vk4wip_repeater_frequency', true );
    $offset    = get_post_meta( $post_id, '_vk4wip_repeater_offset', true );
    $tone      = get_post_meta( $post_id, '_vk4wip_repeater_tone', true );
    
    $output = '';
    
    if ( ! empty( $callsign ) ) {
        $output .= '<strong>' . esc_html( $callsign ) . '</strong>';
    }
    
    if ( ! empty( $frequency ) ) {
        $output .= ( ! empty( $output ) ? ' · ' : '' ) . esc_html( $frequency ) . ' MHz';
    }
    
    if ( ! empty( $offset ) ) {
        $output .= ' (' . esc_html( $offset ) . ')';
    }
    
    if ( ! empty( $tone ) ) {
        $output .= ' · ' . esc_html( $tone ) . ' Hz';
    }
    
    return $output;
}

/**
 * Output social media icons
 *
 * @param string $class Additional CSS class
 * @return void
 */
function vk4wip_social_media_icons( $class = '' ) {
    $facebook  = get_theme_mod( 'vk4wip_facebook_url', 'https://www.facebook.com/vk4wip' );
    $twitter   = get_theme_mod( 'vk4wip_twitter_url', '' );
    $youtube   = get_theme_mod( 'vk4wip_youtube_url', '' );
    $instagram = get_theme_mod( 'vk4wip_instagram_url', '' );
    
    if ( empty( $facebook ) && empty( $twitter ) && empty( $youtube ) && empty( $instagram ) ) {
        return;
    }
    
    echo '<div class="social-media-icons ' . esc_attr( $class ) . '">';
    
    if ( ! empty( $facebook ) ) {
        echo '<a href="' . esc_url( $facebook ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr__( 'Facebook', 'vk4wip-theme' ) . '">';
        echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>';
        echo '</a>';
    }
    
    if ( ! empty( $twitter ) ) {
        echo '<a href="' . esc_url( $twitter ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr__( 'Twitter', 'vk4wip-theme' ) . '">';
        echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>';
        echo '</a>';
    }
    
    if ( ! empty( $youtube ) ) {
        echo '<a href="' . esc_url( $youtube ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr__( 'YouTube', 'vk4wip-theme' ) . '">';
        echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>';
        echo '</a>';
    }
    
    if ( ! empty( $instagram ) ) {
        echo '<a href="' . esc_url( $instagram ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr__( 'Instagram', 'vk4wip-theme' ) . '">';
        echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>';
        echo '</a>';
    }
    
    echo '</div>';
}

/**
 * Generate breadcrumbs
 *
 * @return void
 */
function vk4wip_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }
    
    echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'vk4wip-theme' ) . '">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'vk4wip-theme' ) . '</a>';
    
    if ( is_category() || is_single() ) {
        echo ' <span class="separator">/</span> ';
        the_category( ', ' );
        
        if ( is_single() ) {
            echo ' <span class="separator">/</span> ';
            the_title();
        }
    } elseif ( is_page() ) {
        echo ' <span class="separator">/</span> ';
        the_title();
    } elseif ( is_search() ) {
        echo ' <span class="separator">/</span> ';
        echo esc_html__( 'Search Results', 'vk4wip-theme' );
    } elseif ( is_404() ) {
        echo ' <span class="separator">/</span> ';
        echo esc_html__( 'Page Not Found', 'vk4wip-theme' );
    } elseif ( is_post_type_archive( 'event' ) ) {
        echo ' <span class="separator">/</span> ';
        echo esc_html__( 'Events', 'vk4wip-theme' );
    } elseif ( is_post_type_archive( 'repeater' ) ) {
        echo ' <span class="separator">/</span> ';
        echo esc_html__( 'Repeaters', 'vk4wip-theme' );
    }
    
    echo '</nav>';
}

/**
 * Get day of week suffix for meeting schedule
 *
 * @param int $week_number Week number (1-4)
 * @return string Ordinal suffix
 */
function vk4wip_get_week_suffix( $week_number ) {
    $suffixes = array(
        1 => 'st',
        2 => 'nd',
        3 => 'rd',
        4 => 'th',
    );
    
    return isset( $suffixes[ $week_number ] ) ? $suffixes[ $week_number ] : 'th';
}

/**
 * Check if current page is a VK4WIP custom post type
 *
 * @return bool True if custom post type
 */
function vk4wip_is_custom_post_type() {
    return is_singular( array( 'event', 'repeater' ) ) || is_post_type_archive( array( 'event', 'repeater' ) );
}

/**
 * Get placeholder image URL
 *
 * @return string URL to placeholder image
 */
function vk4wip_get_placeholder_image() {
    return get_template_directory_uri() . '/assets/images/placeholder.jpg';
}

/**
 * Check if post has valid featured image
 *
 * @param int $post_id Post ID
 * @return bool True if has featured image
 */
function vk4wip_has_post_thumbnail( $post_id = null ) {
    if ( null === $post_id ) {
        $post_id = get_the_ID();
    }
    
    return has_post_thumbnail( $post_id );
}
