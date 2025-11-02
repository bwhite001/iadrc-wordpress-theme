<?php
/**
 * The footer for VK4WIP Theme
 *
 * This displays the custom footer with club information and links
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

    </div><!-- #content -->

    <!-- ======= FOOTER ======= -->
    <footer id="colophon" class="site-footer full-width">
        <div class="wrapper footer-inner">
            <div class="footer-brand">
                <?php
                // Display custom logo or default VK4WIP logo
                if ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    ?>
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/VK4WIP.png' ); ?>" 
                         alt="<?php bloginfo( 'name' ); ?>">
                    <?php
                }
                ?>
                
                <div class="footer-brand-content">
                    <div class="footer-brand-heading">
                        <?php
                        $footer_title = get_theme_mod( 'vk4wip_footer_title', 'Ipswich & District Radio Club · VK4WIP' );
                        echo esc_html( $footer_title );
                        ?>
                    </div>

                    <div class="footer-sub-text small">
                        <strong><?php esc_html_e( 'The Club House', 'vk4wip-theme' ); ?></strong>
                        <div><?php echo esc_html( get_theme_mod( 'vk4wip_address', '10 Deebing St, Ipswich QLD 4305' ) ); ?></div>
                        <div class="footer-parking">
                            <?php
                            $parking_text = get_theme_mod( 
                                'vk4wip_parking_info', 
                                'Free onsite parking available for members and visitors during club events, meetings, and training sessions.'
                            );
                            echo esc_html( $parking_text );
                            ?>
                        </div>
                    </div>

                    <?php
                    // Social media links
                    $facebook_url = get_theme_mod( 'vk4wip_facebook_url', 'https://www.facebook.com/vk4wip' );
                    $twitter_url = get_theme_mod( 'vk4wip_twitter_url', '' );
                    $youtube_url = get_theme_mod( 'vk4wip_youtube_url', '' );
                    
                    if ( $facebook_url || $twitter_url || $youtube_url ) :
                        ?>
                        <div class="footer-social">
                            <?php if ( $facebook_url ) : ?>
                                <a href="<?php echo esc_url( $facebook_url ); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   aria-label="<?php esc_attr_e( 'Facebook', 'vk4wip-theme' ); ?>">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" 
                                         alt="<?php esc_attr_e( 'Facebook', 'vk4wip-theme' ); ?>">
                                </a>
                            <?php endif; ?>
                            
                            <?php if ( $twitter_url ) : ?>
                                <a href="<?php echo esc_url( $twitter_url ); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   aria-label="<?php esc_attr_e( 'Twitter', 'vk4wip-theme' ); ?>">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6f/Logo_of_Twitter.svg" 
                                         alt="<?php esc_attr_e( 'Twitter', 'vk4wip-theme' ); ?>">
                                </a>
                            <?php endif; ?>
                            
                            <?php if ( $youtube_url ) : ?>
                                <a href="<?php echo esc_url( $youtube_url ); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   aria-label="<?php esc_attr_e( 'YouTube', 'vk4wip-theme' ); ?>">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/09/YouTube_full-color_icon_%282017%29.svg" 
                                         alt="<?php esc_attr_e( 'YouTube', 'vk4wip-theme' ); ?>">
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
            </div>

            <div class="footer-links-wrapper">
                <?php
                // Footer Widget Areas
                if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) :
                    ?>
                    <div class="footer-widgets">
                        <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-1' ); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-2' ); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                            <div class="footer-widget-area">
                                <?php dynamic_sidebar( 'footer-3' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                else :
                    // Default footer links if no widgets
                    ?>
                    <div class="footer-links">
                        <h3><?php esc_html_e( 'Quick Links', 'vk4wip-theme' ); ?></h3>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer-menu',
                                'menu_class'     => '',
                                'container'      => false,
                                'depth'          => 1,
                                'fallback_cb'    => 'vk4wip_footer_default_menu',
                            )
                        );
                        ?>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </div><!-- .footer-inner -->

        <hr class="foot">

        <div class="wrapper footbar">
            <div class="site-info">
                <?php
                $copyright_text = get_theme_mod( 
                    'vk4wip_copyright_text', 
                    '© 1962-' . date( 'Y' ) . ' Ipswich & District Radio Club, Inc'
                );
                echo esc_html( $copyright_text );
                ?>
            </div>
            <div>
                <?php
                $abn_text = get_theme_mod( 'vk4wip_abn', 'ABN: 31 147 734 363' );
                echo esc_html( $abn_text );
                ?>
            </div>
        </div><!-- .footbar -->
    </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
