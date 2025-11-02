<?php
/**
 * Template Part: Explore Cards
 * Display quick links to key pages
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */
?>

<div class="explore-cards-grid">
    <div class="explore-card">
        <div class="explore-card-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </div>
        <h3 class="explore-card-title"><?php esc_html_e( 'Membership', 'vk4wip-theme' ); ?></h3>
        <p class="explore-card-description">
            <?php esc_html_e( 'Join our club and become part of the amateur radio community in Ipswich', 'vk4wip-theme' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/membership' ) ); ?>" class="explore-card-link">
            <?php esc_html_e( 'Learn More', 'vk4wip-theme' ); ?>
            <span class="arrow">→</span>
        </a>
    </div>
    
    <div class="explore-card">
        <div class="explore-card-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
            </svg>
        </div>
        <h3 class="explore-card-title"><?php esc_html_e( 'Training', 'vk4wip-theme' ); ?></h3>
        <p class="explore-card-description">
            <?php esc_html_e( 'Get your amateur radio license with our Foundation, Standard, and Advanced courses', 'vk4wip-theme' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/training' ) ); ?>" class="explore-card-link">
            <?php esc_html_e( 'View Courses', 'vk4wip-theme' ); ?>
            <span class="arrow">→</span>
        </a>
    </div>
    
    <div class="explore-card">
        <div class="explore-card-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="2" y1="12" x2="22" y2="12"></line>
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
            </svg>
        </div>
        <h3 class="explore-card-title"><?php esc_html_e( 'Repeaters', 'vk4wip-theme' ); ?></h3>
        <p class="explore-card-description">
            <?php esc_html_e( 'Access our extensive repeater network covering Southeast Queensland', 'vk4wip-theme' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/repeaters' ) ); ?>" class="explore-card-link">
            <?php esc_html_e( 'View Directory', 'vk4wip-theme' ); ?>
            <span class="arrow">→</span>
        </a>
    </div>
    
    <div class="explore-card">
        <div class="explore-card-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
        </div>
        <h3 class="explore-card-title"><?php esc_html_e( 'WICEN', 'vk4wip-theme' ); ?></h3>
        <p class="explore-card-description">
            <?php esc_html_e( 'Support emergency communications and community service events', 'vk4wip-theme' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/wicen' ) ); ?>" class="explore-card-link">
            <?php esc_html_e( 'Get Involved', 'vk4wip-theme' ); ?>
            <span class="arrow">→</span>
        </a>
    </div>
</div>
