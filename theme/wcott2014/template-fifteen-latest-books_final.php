<?php
/*
 * Template Name: 15 latest books - with a twist
 * Description: Page template that displays the 15 newest books, by publication history with a slight effect added
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

            <?php
            // Prepare the arguments
            $args = array(
                'post_status' => 'publish',
                'post_type' => 'book',
                'offset' => 0,
                'posts_per_page' => 15,
                'orderby' => 'meta_value',
                'order' => 'DESC',
                'meta_key' => '_books_date_published'
            );

            // The Query
            $the_query = new WP_Query( $args );

            // A little counter for our IDs
            $book_counter = 1;
            ?>

            <?php if ( $the_query->have_posts() ) : ?>
                <section class="section-fifteen-latest-books-twist inner clear">
                    <ul id="bk-list" class="bk-list clearfix">
                        <!-- the loop -->
                        <?php
                        while ( $the_query->have_posts() ) {

                            //prep the_post()
                            $the_query->the_post();

                            //set aside the ID#
                            $post_id = get_the_ID();

                            //Fetch the book thumbnail if there is one
                            $book_thumb = get_the_post_thumbnail( $post_id, 'book-cover', array( 'itemprop' => 'image' ) );

                            //Fetch the Book's Author name
                            $author = get_post_meta( $post_id, '_books_author', true );

                            //Fetch the Book's Author Twitter handle
                            $author_twitter = get_post_meta( $post_id, '_books_author_twitter', true );

                            //Fetch the Book publisher's name
                            $publisher = get_post_meta( $post_id, '_books_publisher', true );

                            //Fetch the Book publisher's URL
                            $publisher_url = get_post_meta( $post_id, '_books_publisher_url', true );

                            //Fetch the publication date
                            $date_published = get_post_meta( $post_id, '_books_date_published', true );

                            //Also grab the Year out of the publication date
                            $date_published_year = date( 'Y', strtotime( $date_published ) );

                            //Prepare an iso-8601 formatted version of the publication date
                            $date_published_iso8601 = date( 'Y-m-d', strtotime( $date_published ) );

                            //Fetch the Colour for the cover
                            $cover_colour = get_post_meta( $post_id, '_books_cover_colour', true );

                            ?>


                            <li>
                                <div class="bk-book book-1<?php // echo $book_counter; ?> bk-bookdefault" itemscope itemtype="http://schema.org/Book" data-url="<?php the_permalink(); ?>" data-cover-colour="<?php echo $cover_colour; ?>">
                                    <div class="bk-front">
                                        <div class="bk-cover">
                                            <?php if ( $book_thumb ) { ?>
                                                <?php echo $book_thumb; ?>
                                            <?php } ?>

                                        </div>
                                        <div class="bk-cover-back"></div>
                                    </div>
                                    <div class="bk-page">
                                        <div class="bk-content bk-content-current">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                            <?php
                                            if ( $author ) {
                                                if ( $author_twitter ) {
                                                    ?>
                                                    <div class="book-author" itemprop="author"><?php _ex( 'by', 'Book page "by Author"', 'wcott2014' ); ?> <a href="https://twitter.com/<?php echo $author_twitter; ?>"><?php echo $author; ?></a></div>
                                                <?php } else { ?>
                                                    <div class="book-author" itemprop="author"><?php _ex( 'by', 'Book page "by Author"', 'wcott2014' ); ?> <?php echo $author; ?></div>
                                                <?php } ?>
                                            <?php } ?>
                                            <?php
                                            if ( $publisher ) {
                                                if ( $publisher_url ) {
                                                    ?>
                                                    <div class="book-publisher" itemprop="publisher"><a href="<?php echo $publisher_url; ?>"><?php echo $publisher; ?></a></div>
                                                <?php } else { ?>
                                                    <div class="book-publisher" itemprop="publisher"><?php echo $publisher; ?></div>
                                                <?php } ?>
                                            <?php } ?>

                                            <?php if ( $date_published ) { ?>
                                                <div class="book-year" itemprop="datePublished" content="<?php echo $date_published_iso8601; ?>"><?php echo $date_published; ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="bk-content">
                                            <div class="book-content" itemprop="description"><?php the_content(); ?></div>
                                        </div>
                                    </div>
                                    <div class="bk-back">
                                        <p>In this nightmare vision of cats in revolt, fifteen-year-old Alex and his friends set out on a diabolical orgy of robbery, rape, torture and murder. Alex is jailed for his teenage delinquency and the State tries to reform him - but at what cost?</p>
                                    </div>
                                    <div class="bk-right"></div>
                                    <div class="bk-left">
                                        <h2>
                                            <span><?php echo $author; ?></span>
                                            <span><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></span>
                                        </h2>
                                    </div>
                                    <div class="bk-top"></div>
                                    <div class="bk-bottom"></div>
                                </div>
                            </li>

                            <?php $book_counter++ ;?>
                        <?php } ?>
                        <!-- end of the loop -->
                    </ul>
                </section><!-- .section-ten-latest-posts -->

                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <div class="inner">
                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'wcott2014' ); ?></p>
                </div>
            <?php endif; ?>
        </div><!-- .bg-gray -->


    </main><!-- #main -->
</div><!-- #primary -->

<?php // get_sidebar();    ?>
<?php get_footer(); ?>