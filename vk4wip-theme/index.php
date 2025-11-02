<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="wrapper">
            <?php
            if ( have_posts() ) :

                if ( is_home() && ! is_front_page() ) :
                    ?>
                    <header class="page-header">
                        <h1 class="page-title"><?php single_post_title(); ?></h1>
                    </header>
                    <?php
                endif;

                // Start the Loop
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'content-card' ); ?>>
                        <?php
                        // Post thumbnail
                        if ( has_post_thumbnail() ) :
                            ?>
                            <div class="card-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'vk4wip-featured' ); ?>
                                </a>
                            </div>
                            <?php
                        endif;
                        ?>

                        <div class="card-content">
                            <header class="entry-header">
                                <?php
                                if ( is_singular() ) :
                                    the_title( '<h1 class="entry-title">', '</h1>' );
                                else :
                                    the_title( '<h2 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                endif;
                                ?>

                                <div class="post-meta">
                                    <span class="meta-item">
                                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                            <?php echo esc_html( get_the_date() ); ?>
                                        </time>
                                    </span>
                                    <span class="meta-item">
                                        <?php esc_html_e( 'by', 'vk4wip-theme' ); ?> 
                                        <?php the_author(); ?>
                                    </span>
                                    <?php if ( has_category() ) : ?>
                                        <span class="meta-item">
                                            <?php the_category( ', ' ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </header><!-- .entry-header -->

                            <div class="card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>

                            <?php if ( ! is_singular() ) : ?>
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    <?php esc_html_e( 'Read More', 'vk4wip-theme' ); ?>
                                </a>
                            <?php endif; ?>
                        </div><!-- .card-content -->
                    </article><!-- #post-<?php the_ID(); ?> -->
                    <?php
                endwhile;

                // Pagination
                the_posts_pagination(
                    array(
                        'mid_size'  => 2,
                        'prev_text' => __( '← Previous', 'vk4wip-theme' ),
                        'next_text' => __( 'Next →', 'vk4wip-theme' ),
                    )
                );

            else :
                ?>
                <div class="no-results">
                    <h1><?php esc_html_e( 'Nothing Found', 'vk4wip-theme' ); ?></h1>
                    <p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'vk4wip-theme' ); ?></p>
                    <?php get_search_form(); ?>
                </div>
                <?php
            endif;
            ?>
        </div><!-- .wrapper -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
