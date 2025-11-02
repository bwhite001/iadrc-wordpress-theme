<?php
/**
 * Template Part: Hero Section
 * Display featured event or custom hero content
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

// Check if we should use featured event
$use_event = get_theme_mod( 'vk4wip_hero_use_event', true );
$featured_event = null;

if ( $use_event ) {
    $featured_event = vk4wip_get_featured_event();
}

// Get customizer settings
$hero_title = get_theme_mod( 'vk4wip_hero_title', __( 'Welcome to VK4WIP', 'vk4wip-theme' ) );
$hero_description = get_theme_mod( 'vk4wip_hero_description', __( 'Ipswich and District Amateur Radio Club - Using and promoting Amateur (HAM) Radio in the Ipswich and surrounding areas since 1962', 'vk4wip-theme' ) );
$hero_cta_text = get_theme_mod( 'vk4wip_hero_cta_text', __( 'Join Our Club', 'vk4wip-theme' ) );
$hero_cta_link = get_theme_mod( 'vk4wip_hero_cta_link', home_url( '/membership' ) );
$hero_bg_id = get_theme_mod( 'vk4wip_hero_background', '' );

// Determine background image
$hero_bg_url = '';
if ( $featured_event && has_post_thumbnail( $featured_event->ID ) ) {
    $hero_bg_url = get_the_post_thumbnail_url( $featured_event->ID, 'full' );
} elseif ( $hero_bg_id ) {
    $hero_bg_url = wp_get_attachment_image_url( $hero_bg_id, 'full' );
} else {
    // Default to clubhouse background
    $hero_bg_url = get_template_directory_uri() . '/assets/images/clubhouse_hero_bg.jpg';
}

// If we have a featured event, override hero content
if ( $featured_event ) {
    $hero_title = get_the_title( $featured_event->ID );
    $hero_description = get_the_excerpt( $featured_event->ID );
    $hero_cta_text = __( 'Learn More', 'vk4wip-theme' );
    $hero_cta_link = get_permalink( $featured_event->ID );
}
?>

<section class="hero-section" style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>');">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <?php if ( $featured_event ) : ?>
                <div class="hero-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span><?php echo esc_html( vk4wip_format_event_date( $featured_event->ID, 'F j, Y' ) ); ?></span>
                </div>
            <?php endif; ?>
            
            <h1 class="hero-title"><?php echo esc_html( $hero_title ); ?></h1>
            
            <p class="hero-description"><?php echo esc_html( $hero_description ); ?></p>
            
            <?php if ( $featured_event ) : ?>
                <div class="hero-meta">
                    <?php
                    $event_time = vk4wip_format_event_time( $featured_event->ID );
                    $event_location = vk4wip_get_event_location( $featured_event->ID );
                    ?>
                    <?php if ( $event_time ) : ?>
                        <span class="hero-meta-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <?php echo esc_html( $event_time ); ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ( $event_location ) : ?>
                        <span class="hero-meta-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <?php echo esc_html( $event_location ); ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <div class="hero-actions">
                <a href="<?php echo esc_url( $hero_cta_link ); ?>" class="btn btn-primary btn-large">
                    <?php echo esc_html( $hero_cta_text ); ?>
                </a>
                
                <?php if ( ! $featured_event ) : ?>
                    <a href="<?php echo esc_url( home_url( '/events' ) ); ?>" class="btn btn-secondary btn-large">
                        <?php esc_html_e( 'View Events', 'vk4wip-theme' ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
