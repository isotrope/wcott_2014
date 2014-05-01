<?php
/*
 * Template Name: 15 latest books
 * Description: Page template that displays the 15 newest books, by publication history
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
//                'ignore_sticky_posts' => true, // If there are sticky posts, show them first
//                'order' => 'DESC', // Which order should we use?
//                'orderby' => 'date', // What are we ordering by?
//                'posts_per_page' => 10, // How many posts do we want?
//                'post_type' => 'post', // What type do we want? ('post', 'page', 'something_custom', ...)
//                'post_status' => 'publish', // What status(es) are we ok with? (could be 'publish', 'pending', 'draft', ...)

                'post_status' => 'publish',
                'post_type' => 'book',
                'offset' => 0,
                'posts_per_page' => 10,
                'orderby' => 'meta_value',
                'order' => 'DESC',
                'meta_key' => '_books_date_published'
            );

            // The Query
            $the_query = new WP_Query( $args );
            ?>

            <?php if ( $the_query->have_posts() ) : ?>
                <section class="section-ten-latest-books inner clear">

                    <!-- the loop -->
                    <?php
                    while ( $the_query->have_posts() ) {

                        $the_query->the_post();

                        $post_id = get_the_ID();

                        $book_thumb = get_the_post_thumbnail( $post_id, 'book-cover', array( 'itemprop' => 'image' ) );
                        $author = get_field( '_books_author' );
                        $art_director = get_field( '_books_art_director' );
                        $publisher = strip_tags( get_field( '_books_publisher' ), '<a>' );

                        $date_published = get_field( '_books_date_published' );
                        $date_published_year = date( 'Y', strtotime( $date_published ) );
                        $date_published_iso8601 = date( 'Y-m-d', strtotime( $date_published ) );
                        ?>
                        <article class="book" itemscope itemtype="http://schema.org/Book" data-url="<?php the_permalink(); ?>">
                            <?php if ( $book_thumb ) { ?>
                                <div class="book-thumbnail"><?php echo $book_thumb; ?></div>
        <?php } ?>

                            <div class="book-info">
                                <h2 class="book-title" itemprop="name"><?php the_title(); ?></h2>

                                <?php if ( $author ) { ?>
                                    <div class="book-author" itemprop="author"><?php echo $author; ?></div>
        <?php } ?>

                                <div class="book-content" itemprop="description"><?php the_content(); ?></div>


                                <?php if ( $publisher ) { ?>
                                    <div class="book-publisher" itemprop="publisher"><?php echo $publisher; ?></div>
                                <?php } ?>

                                <?php if ( $date_published ) { ?>
                                    <div class="book-year" itemprop="datePublished" content="<?php echo $date_published_iso8601; ?>"><?php echo $date_published_year; ?></div>
        <?php } ?>
                            </div>
                        </article>
    <?php } ?>
                    <!-- end of the loop -->


    <?php wp_reset_postdata(); ?>
                </section><!-- .section-ten-latest-posts -->

<?php else: ?>
                <div class="inner">
                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'wcott2014' ); ?></p>
                </div>
<?php endif; ?>
        </div><!-- .bg-gray -->


    </main><!-- #main -->
</div><!-- #primary -->

<?php // get_sidebar();  ?>
<?php get_footer(); ?>