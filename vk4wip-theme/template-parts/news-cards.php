<?php
/**
 * Template Part: News Cards
 * Display latest blog posts in card layout
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

$news_count = get_theme_mod( 'vk4wip_news_count', 3 );
$news_query = vk4wip_get_latest_news( $news_count );

if ( $news_query->have_posts() ) :
?>
    <div class="news-cards-grid">
        <?php
        while ( $news_query->have_posts() ) :
            $news_query->the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'news-card' ); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="news-card-image">
                        <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail( 'vk4wip-card-thumbnail', array( 'alt' => get_the_title() ) ); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="news-card-content">
                    <div class="news-card-meta">
                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" class="news-card-date">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <?php echo esc_html( get_the_date() ); ?>
                        </time>
                        
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) :
                        ?>
                            <span class="news-card-category">
                                <?php echo esc_html( $categories[0]->name ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <h3 class="news-card-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    
                    <div class="news-card-excerpt">
                        <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                    </div>
                    
                    <a href="<?php the_permalink(); ?>" class="news-card-link">
                        <?php esc_html_e( 'Read More', 'vk4wip-theme' ); ?>
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
    <div class="no-news">
        <p><?php esc_html_e( 'No news posts found. Check back soon for updates!', 'vk4wip-theme' ); ?></p>
    </div>
<?php
endif;
