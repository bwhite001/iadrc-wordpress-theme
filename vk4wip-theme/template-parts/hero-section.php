<?php
/**
 * Template Part: Hero Section
 * Display featured event or custom hero content
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

// Get background image
$hero_bg_url = get_template_directory_uri() . '/assets/images/clubhouse_hero_bg.jpg';
?>

<section class="hero-section" style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>');">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content-wrapper">
            <div class="hero-content">
                <h1 class="hero-title"><?php esc_html_e( 'WELCOME!', 'vk4wip-theme' ); ?></h1>
                
                <p class="hero-subtitle">
                    <?php esc_html_e( 'WE ARE A MEMBER RUN NOT-FOR-PROFIT ORGANISATION FOR USING AND PROMOTING AMATEUR (HAM) RADIO', 'vk4wip-theme' ); ?>
                </p>
                
                <p class="hero-tagline">
                    <?php esc_html_e( 'VK4WIP : Community : Learning : Radio [Since 1962]', 'vk4wip-theme' ); ?>
                </p>
                
                <div class="hero-actions">
                    <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn btn-gold btn-large">
                        <?php esc_html_e( 'ABOUT US', 'vk4wip-theme' ); ?>
                    </a>
                    
                    <a href="<?php echo esc_url( home_url( '/events' ) ); ?>" class="btn btn-red btn-large">
                        <?php esc_html_e( 'MEETINGS & EVENTS', 'vk4wip-theme' ); ?>
                    </a>
                    
                    <a href="<?php echo esc_url( home_url( '/training' ) ); ?>" class="btn btn-gold btn-large">
                        <?php esc_html_e( 'GET YOUR LICENSE', 'vk4wip-theme' ); ?>
                    </a>
                </div>
            </div>
            
            <div class="hero-callsign">
                <span class="callsign-text">VK4WIP</span>
            </div>
        </div>
    </div>
</section>
