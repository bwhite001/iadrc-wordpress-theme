<?php
/**
 * VK4WIP Theme - Front Page Template
 * Custom homepage template for VK4WIP Amateur Radio Club
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main front-page">
    
    <?php
    /**
     * Hero Section
     * Display featured event or custom hero content
     */
    get_template_part( 'template-parts/hero', 'section' );
    ?>
    
    <?php
    /**
     * Latest News Section
     * Display recent blog posts in card layout
     */
    $news_count = get_theme_mod( 'vk4wip_news_count', 3 );
    if ( $news_count > 0 ) :
    ?>
        <section class="news-section section-padding">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title"><?php esc_html_e( 'Latest News', 'vk4wip-theme' ); ?></h2>
                    <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="section-link">
                        <?php esc_html_e( 'View All News', 'vk4wip-theme' ); ?>
                        <span class="arrow">→</span>
                    </a>
                </div>
                
                <?php get_template_part( 'template-parts/news', 'cards' ); ?>
            </div>
        </section>
    <?php endif; ?>
    
    <?php
    /**
     * Upcoming Events Section
     * Display next events from Events CPT
     */
    $events_count = get_theme_mod( 'vk4wip_events_count', 5 );
    if ( $events_count > 0 ) :
    ?>
        <section class="events-section section-padding bg-light">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title"><?php esc_html_e( 'Upcoming Events', 'vk4wip-theme' ); ?></h2>
                    <a href="<?php echo esc_url( home_url( '/events' ) ); ?>" class="section-link">
                        <?php esc_html_e( 'View Calendar', 'vk4wip-theme' ); ?>
                        <span class="arrow">→</span>
                    </a>
                </div>
                
                <?php get_template_part( 'template-parts/events', 'list' ); ?>
            </div>
        </section>
    <?php endif; ?>
    
    <?php
    /**
     * Explore More Section
     * Quick links to key pages
     */
    if ( get_theme_mod( 'vk4wip_show_explore', true ) ) :
    ?>
        <section class="explore-section section-padding">
            <div class="container">
                <div class="section-header centered">
                    <h2 class="section-title"><?php esc_html_e( 'Explore VK4WIP', 'vk4wip-theme' ); ?></h2>
                    <p class="section-description">
                        <?php esc_html_e( 'Discover what our club has to offer', 'vk4wip-theme' ); ?>
                    </p>
                </div>
                
                <?php get_template_part( 'template-parts/explore', 'cards' ); ?>
            </div>
        </section>
    <?php endif; ?>
    
    <?php
    /**
     * Repeaters Quick Info Section
     * Display key repeater information
     */
    if ( get_theme_mod( 'vk4wip_show_repeaters', true ) ) :
    ?>
        <section class="repeaters-section section-padding bg-dark">
            <div class="container">
                <div class="section-header centered light">
                    <h2 class="section-title"><?php esc_html_e( 'Our Repeaters', 'vk4wip-theme' ); ?></h2>
                    <p class="section-description">
                        <?php esc_html_e( 'Access our extensive repeater network across Southeast Queensland', 'vk4wip-theme' ); ?>
                    </p>
                </div>
                
                <?php get_template_part( 'template-parts/repeater', 'cards' ); ?>
                
                <div class="section-cta">
                    <a href="<?php echo esc_url( home_url( '/repeaters' ) ); ?>" class="btn btn-primary btn-large">
                        <?php esc_html_e( 'View Full Repeater Directory', 'vk4wip-theme' ); ?>
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>
    
    <?php
    /**
     * Meeting Schedule Section
     * Display recurring meeting information
     */
    ?>
    <section class="meetings-section section-padding">
        <div class="container">
            <div class="section-header centered">
                <h2 class="section-title"><?php esc_html_e( 'Regular Meetings', 'vk4wip-theme' ); ?></h2>
                <p class="section-description">
                    <?php esc_html_e( 'Join us at the clubhouse - 10 Deebing St, Ipswich QLD 4305', 'vk4wip-theme' ); ?>
                </p>
            </div>
            
            <div class="meetings-grid">
                <div class="meeting-card">
                    <div class="meeting-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <h3 class="meeting-title"><?php esc_html_e( 'Digital Interest Group', 'vk4wip-theme' ); ?></h3>
                    <p class="meeting-schedule">
                        <strong><?php esc_html_e( '1st Monday', 'vk4wip-theme' ); ?></strong><br>
                        <?php esc_html_e( '7:30 PM', 'vk4wip-theme' ); ?>
                    </p>
                    <p class="meeting-description">
                        <?php esc_html_e( 'Explore digital modes, D-Star, DMR, and more', 'vk4wip-theme' ); ?>
                    </p>
                </div>
                
                <div class="meeting-card">
                    <div class="meeting-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 class="meeting-title"><?php esc_html_e( 'Social Meeting', 'vk4wip-theme' ); ?></h3>
                    <p class="meeting-schedule">
                        <strong><?php esc_html_e( '2nd Monday', 'vk4wip-theme' ); ?></strong><br>
                        <?php esc_html_e( '7:30 PM', 'vk4wip-theme' ); ?>
                    </p>
                    <p class="meeting-description">
                        <?php esc_html_e( 'Casual gathering, presentations, and activities', 'vk4wip-theme' ); ?>
                    </p>
                </div>
                
                <div class="meeting-card">
                    <div class="meeting-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="meeting-title"><?php esc_html_e( 'Business Meeting', 'vk4wip-theme' ); ?></h3>
                    <p class="meeting-schedule">
                        <strong><?php esc_html_e( '4th Monday', 'vk4wip-theme' ); ?></strong><br>
                        <?php esc_html_e( '7:30 PM', 'vk4wip-theme' ); ?>
                    </p>
                    <p class="meeting-description">
                        <?php esc_html_e( 'Club business, planning, and member discussions', 'vk4wip-theme' ); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php
get_footer();
