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
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
        </div>
        <h3 class="explore-card-title"><?php esc_html_e( 'SILENT KEY MEMORIAL BOARD', 'vk4wip-theme' ); ?></h3>
        <p class="explore-card-description">
            <?php esc_html_e( 'Honouring members who became Silent Keys - remembering callsigns and stories', 'vk4wip-theme' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/silent-key' ) ); ?>" class="explore-card-link">
            <?php esc_html_e( 'Learn more', 'vk4wip-theme' ); ?>
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
        <h3 class="explore-card-title"><?php esc_html_e( 'CLUB HISTORY', 'vk4wip-theme' ); ?></h3>
        <p class="explore-card-description">
            <?php esc_html_e( 'From 1962 to today — photos, milestones and projects that shaped VK4WIP', 'vk4wip-theme' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/history' ) ); ?>" class="explore-card-link">
            <?php esc_html_e( 'Read the history', 'vk4wip-theme' ); ?>
            <span class="arrow">→</span>
        </a>
    </div>
    
    <div class="explore-card">
        <div class="explore-card-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </div>
        <h3 class="explore-card-title"><?php esc_html_e( 'MEMBERSHIP', 'vk4wip-theme' ); ?></h3>
        <p class="explore-card-description">
            <?php esc_html_e( 'Join the club, support our repeaters and take part in events and nets', 'vk4wip-theme' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/membership' ) ); ?>" class="explore-card-link">
            <?php esc_html_e( 'Join now', 'vk4wip-theme' ); ?>
            <span class="arrow">→</span>
        </a>
    </div>
    
    <div class="explore-card">
        <div class="explore-card-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
            </svg>
        </div>
        <h3 class="explore-card-title"><?php esc_html_e( 'EQUIPMENT LOAN SCHEME', 'vk4wip-theme' ); ?></h3>
        <p class="explore-card-description">
            <?php esc_html_e( 'Get on air with loan gear for training, club events and nets', 'vk4wip-theme' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/equipment-loan' ) ); ?>" class="explore-card-link">
            <?php esc_html_e( 'See how it works', 'vk4wip-theme' ); ?>
            <span class="arrow">→</span>
        </a>
    </div>
    
    <div class="explore-card">
        <div class="explore-card-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                <path d="M2 17l10 5 10-5"></path>
                <path d="M2 12l10 5 10-5"></path>
            </svg>
        </div>
        <h3 class="explore-card-title"><?php esc_html_e( 'CLUB SPONSORS', 'vk4wip-theme' ); ?></h3>
        <p class="explore-card-description">
            <?php esc_html_e( 'Thanks to sponsors who help keep the club and repeaters on air', 'vk4wip-theme' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/sponsors' ) ); ?>" class="explore-card-link">
            <?php esc_html_e( 'Meet our sponsors', 'vk4wip-theme' ); ?>
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
