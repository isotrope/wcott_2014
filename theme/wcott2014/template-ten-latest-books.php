<?php
/*
 * Template Name: 10 latest books
 * Description: Page template that displays the 10 newest books, by publication history
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <section class="page-main-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="inner">
                    <h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                    <div class="entry-content"><?php the_content(); ?></div>
                </div>

            <?php endwhile; // end of the loop. ?>
        </section><!-- .page-main-content -->
        <div class="bg-gray">
            <div class="demo-step-togglers inner">
                <a href="#" id="btn-add-step" class="btn">Toggle Step</a>
            </div>
            <?php
            // Prepare the arguments
            $args = array(
                'ignore_sticky_posts' => true, // If there are sticky posts, show them first
                'order' => 'DESC', // Which order should we use?
                'orderby' => 'date', // What are we ordering by?
                'posts_per_page' => 10, // How many posts do we want?
                'post_type' => 'post', // What type do we want? ('post', 'page', 'something_custom', ...)
                'post_status' => 'publish', // What status(es) are we ok with? (could be 'publish', 'pending', 'draft', ...)
            );

            // The Query
            $the_query = new WP_Query( $args );
            ?>

            <?php if ( $the_query->have_posts() ) : ?>
                <section class="section-ten-latest-books inner clear">

                    <!-- the loop -->
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <?php
                        $post_class = array( 'ten-latest-books' );
                        $post_thumbnail = get_the_post_thumbnail();

                        if ( $post_thumbnail ) {
                            array_push( $post_class, $post_thumbnail );
                        }
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
                            <?php echo $post_thumbnail; ?>
                            <header class="entry-header">
                                <h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

                                <div class="entry-meta">
                                    <?php wcott2014_posted_on(); ?>
                                </div><!-- .entry-meta -->
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                            </div><!-- .entry-content -->
                        </article><!-- #post-<?php the_ID(); ?> -->
                    <?php endwhile; ?>
                    <!-- end of the loop -->


                    <?php wp_reset_postdata(); ?>
                </section><!-- .section-ten-latest-posts -->

            <?php else: ?>
                <div class="inner">
                    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                </div>
            <?php endif; ?>
        </div><!-- .bg-gray -->


    </main><!-- #main -->
</div><!-- #primary -->

<?php // get_sidebar();  ?>
<?php get_footer(); ?>