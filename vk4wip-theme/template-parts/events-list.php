<?php
/**
 * Template Part: Events List
 * Display upcoming events from Events CPT
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

$events_count = get_theme_mod( 'vk4wip_events_count', 5 );
$events_query = vk4wip_get_upcoming_events( $events_count );

if ( $events_query->have_posts() ) :
?>
    <div class="events-list">
        <?php
        while ( $events_query->have_posts() ) :
            $events_query->the_post();
            
            $event_date = vk4wip_format_event_date( get_the_ID(), 'M j' );
            $event_year = vk4wip_format_event_date( get_the_ID(), 'Y' );
            $event_time = vk4wip_format_event_time( get_the_ID() );
            $event_location = vk4wip_get_event_location( get_the_ID() );
        ?>
            <article id="event-<?php the_ID(); ?>" <?php post_class( 'event-item' ); ?>>
                <div class="event-date-badge">
                    <span class="event-date-day"><?php echo esc_html( $event_date ); ?></span>
                    <span class="event-date-year"><?php echo esc_html( $event_year ); ?></span>
                </div>
                
                <div class="event-content">
                    <h3 class="event-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    
                    <div class="event-meta">
                        <?php if ( $event_time ) : ?>
                            <span class="event-meta-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <?php echo esc_html( $event_time ); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ( $event_location ) : ?>
                            <span class="event-meta-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <?php echo esc_html( $event_location ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ( has_excerpt() ) : ?>
                        <div class="event-excerpt">
                            <?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
                        </div>
                    <?php endif; ?>
                    
                    <a href="<?php the_permalink(); ?>" class="event-link">
                        <?php esc_html_e( 'View Details', 'vk4wip-theme' ); ?>
                        <span class="arrow">→</span>
                    </a>
                </div>
            </article>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
<?php
else :
?>
    <div class="no-events">
        <div class="no-events-icon">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
        </div>
        <h3><?php esc_html_e( 'No Upcoming Events', 'vk4wip-theme' ); ?></h3>
        <p><?php esc_html_e( 'Check back soon for our next meeting or activity!', 'vk4wip-theme' ); ?></p>
    </div>
<?php
endif;
