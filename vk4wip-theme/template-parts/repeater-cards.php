<?php
/**
 * Template Part: Repeater Cards
 * Display featured repeaters for quick info
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

$repeaters_query = vk4wip_get_featured_repeaters( 4 );

if ( $repeaters_query->have_posts() ) :
?>
    <div class="repeater-cards-grid">
        <?php
        while ( $repeaters_query->have_posts() ) :
            $repeaters_query->the_post();
            
            $callsign = get_post_meta( get_the_ID(), '_vk4wip_repeater_callsign', true );
            $frequency = get_post_meta( get_the_ID(), '_vk4wip_repeater_frequency', true );
            $offset = get_post_meta( get_the_ID(), '_vk4wip_repeater_offset', true );
            $tone = get_post_meta( get_the_ID(), '_vk4wip_repeater_tone', true );
            $location = get_post_meta( get_the_ID(), '_vk4wip_repeater_location', true );
        ?>
            <div class="repeater-card">
                <div class="repeater-card-header">
                    <?php if ( $callsign ) : ?>
                        <h3 class="repeater-callsign"><?php echo esc_html( $callsign ); ?></h3>
                    <?php else : ?>
                        <h3 class="repeater-callsign"><?php the_title(); ?></h3>
                    <?php endif; ?>
                    
                    <?php if ( $location ) : ?>
                        <span class="repeater-location">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <?php echo esc_html( $location ); ?>
                        </span>
                    <?php endif; ?>
                </div>
                
                <div class="repeater-card-body">
                    <?php if ( $frequency ) : ?>
                        <div class="repeater-info-item">
                            <span class="repeater-info-label"><?php esc_html_e( 'Output', 'vk4wip-theme' ); ?></span>
                            <span class="repeater-info-value"><?php echo esc_html( $frequency ); ?> MHz</span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ( $offset ) : ?>
                        <div class="repeater-info-item">
                            <span class="repeater-info-label"><?php esc_html_e( 'Offset', 'vk4wip-theme' ); ?></span>
                            <span class="repeater-info-value"><?php echo esc_html( $offset ); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ( $tone ) : ?>
                        <div class="repeater-info-item">
                            <span class="repeater-info-label"><?php esc_html_e( 'CTCSS', 'vk4wip-theme' ); ?></span>
                            <span class="repeater-info-value"><?php echo esc_html( $tone ); ?> Hz</span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if ( has_excerpt() ) : ?>
                    <div class="repeater-card-footer">
                        <p><?php echo wp_trim_words( get_the_excerpt(), 10, '...' ); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
<?php
else :
    // If no repeaters exist, show placeholder cards with common repeater info
?>
    <div class="repeater-cards-grid">
        <div class="repeater-card">
            <div class="repeater-card-header">
                <h3 class="repeater-callsign">VK4RAI</h3>
                <span class="repeater-location">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    The Knobby
                </span>
            </div>
            <div class="repeater-card-body">
                <div class="repeater-info-item">
                    <span class="repeater-info-label"><?php esc_html_e( 'Output', 'vk4wip-theme' ); ?></span>
                    <span class="repeater-info-value">146.900 MHz</span>
                </div>
                <div class="repeater-info-item">
                    <span class="repeater-info-label"><?php esc_html_e( 'Offset', 'vk4wip-theme' ); ?></span>
                    <span class="repeater-info-value">-600 kHz</span>
                </div>
                <div class="repeater-info-item">
                    <span class="repeater-info-label"><?php esc_html_e( 'CTCSS', 'vk4wip-theme' ); ?></span>
                    <span class="repeater-info-value">91.5 Hz</span>
                </div>
            </div>
        </div>
        
        <div class="repeater-card">
            <div class="repeater-card-header">
                <h3 class="repeater-callsign">VK4RWM</h3>
                <span class="repeater-location">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    Raymonds Hill
                </span>
            </div>
            <div class="repeater-card-body">
                <div class="repeater-info-item">
                    <span class="repeater-info-label"><?php esc_html_e( 'Output', 'vk4wip-theme' ); ?></span>
                    <span class="repeater-info-value">438.375 MHz</span>
                </div>
                <div class="repeater-info-item">
                    <span class="repeater-info-label"><?php esc_html_e( 'Offset', 'vk4wip-theme' ); ?></span>
                    <span class="repeater-info-value">-5 MHz</span>
                </div>
                <div class="repeater-info-item">
                    <span class="repeater-info-label"><?php esc_html_e( 'CTCSS', 'vk4wip-theme' ); ?></span>
                    <span class="repeater-info-value">91.5 Hz</span>
                </div>
            </div>
        </div>
        
        <div class="repeater-card">
            <div class="repeater-card-header">
                <h3 class="repeater-callsign">VK4RBX</h3>
                <span class="repeater-location">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    Spring Mountain
                </span>
            </div>
            <div class="repeater-card-body">
                <div class="repeater-info-item">
                    <span class="repeater-info-label"><?php esc_html_e( 'Output', 'vk4wip-theme' ); ?></span>
                    <span class="repeater-info-value">439.975 MHz</span>
                </div>
                <div class="repeater-info-item">
                    <span class="repeater-info-label"><?php esc_html_e( 'Offset', 'vk4wip-theme' ); ?></span>
                    <span class="repeater-info-value">-5 MHz</span>
                </div>
                <div class="repeater-info-item">
                    <span class="repeater-info-label"><?php esc_html_e( 'CTCSS', 'vk4wip-theme' ); ?></span>
                    <span class="repeater-info-value">91.5 Hz</span>
                </div>
            </div>
        </div>
        
        <div class="repeater-card">
            <div class="repeater-card-header">
                <h3 class="repeater-callsign">VK4RIL</h3>
                <span class="repeater-location">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    Ipswich
                </span>
            </div>
            <div class="repeater-card-body">
                <div class="repeater-info-item">
                    <span class="repeater-info-label"><?php esc_html_e( 'Output', 'vk4wip-theme' ); ?></span>
                    <span class="repeater-info-value">53.850 MHz</span>
                </div>
                <div class="repeater-info-item">
                    <span class="repeater-info-label"><?php esc_html_e( 'Offset', 'vk4wip-theme' ); ?></span>
                    <span class="repeater-info-value">-1 MHz</span>
                </div>
                <div class="repeater-info-item">
                    <span class="repeater-info-label"><?php esc_html_e( 'CTCSS', 'vk4wip-theme' ); ?></span>
                    <span class="repeater-info-value">91.5 Hz</span>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
