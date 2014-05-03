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
            <?php while (have_posts()) : the_post(); ?>
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
                'post_status' => 'publish',
                'post_type' => 'book',
                'offset' => 0,
                'posts_per_page' => 15,
                'orderby' => 'meta_value',
                'order' => 'DESC',
                'meta_key' => '_books_date_published'
            );

            // The Query
            $the_query = new WP_Query($args);
            ?>

            <?php if ($the_query->have_posts()) : ?>
                <section class="section-fifteen-latest-books inner clear">

                    <!-- the loop -->
                    <?php
                    while ($the_query->have_posts()) {

                        //prep the_post()
                        $the_query->the_post();

                        //set aside the ID#
                        $post_id = get_the_ID();

                        //Fetch the book thumbnail if there is one
                        $book_thumb = get_the_post_thumbnail($post_id, 'book-cover', array('itemprop' => 'image'));

                        //Fetch the Book's Author name
                        $author = get_post_meta($post_id, '_books_author', true);

                        //Fetch the Book's Author Twitter handle
                        $author_twitter = get_post_meta($post_id, '_books_author_twitter', true);

                        //Fetch the Book publisher's name
                        $publisher = get_post_meta($post_id, '_books_publisher', true);

                        //Fetch the Book publisher's URL
                        $publisher_url = get_post_meta($post_id, '_books_publisher_url', true);

                        //Fetch the publication date
                        $date_published = get_post_meta($post_id, '_books_date_published', true);

                        //Also grab the Year out of the publication date
                        $date_published_year = date('Y', strtotime($date_published));

                        //Prepare an iso-8601 formatted version of the publication date
                        $date_published_iso8601 = date('Y-m-d', strtotime($date_published));
                        ?>
                        <article class="book" itemscope itemtype="http://schema.org/Book" data-url="<?php the_permalink(); ?>">
                            <?php if ($book_thumb) { ?>
                                <div class="book-thumbnail"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo $book_thumb; ?></a></div>
                            <?php } ?>

                            <div class="book-info">
                                <h2 class="book-title" itemprop="name"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

                                <?php if ($author) { ?>
                                    <div class="book-author" itemprop="author">
                                        <?php _ex('by', 'Book page "by Author"', 'wcott2014'); ?>
                                        <?php if ($author_twitter) { ?>
                                            <a href="https://twitter.com/<?php echo $author_twitter; ?>"><?php echo $author; ?></a>
                                        <?php } else { ?>
                                            <?php echo $author; ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                                <div class="book-content" itemprop="description"><?php the_content(); ?></div>



                                <?php
                                if ($publisher) {
                                    if ($publisher_url) {
                                        ?>
                                        <div class="book-publisher" itemprop="publisher"><a href="<?php echo $publisher_url; ?>"><?php echo $publisher; ?></a></div>
                                    <?php } else { ?>
                                        <div class="book-publisher" itemprop="publisher"><?php echo $publisher; ?></div>
                                    <?php } ?>
                                <?php } ?>

                                <?php if ($date_published) { ?>
                                    <div class="book-year" itemprop="datePublished" content="<?php echo $date_published_iso8601; ?>"><?php echo $date_published; ?></div>
                                <?php } ?>
                            </div>
                        </article>
                    <?php } ?>
                    <!-- end of the loop -->


                    <?php wp_reset_postdata(); ?>
                </section><!-- .section-ten-latest-posts -->

            <?php else: ?>
                <div class="inner">
                    <p><?php _e('Sorry, no posts matched your criteria.', 'wcott2014'); ?></p>
                </div>
            <?php endif; ?>
        </div><!-- .bg-gray -->


    </main><!-- #main -->
</div><!-- #primary -->

<?php // get_sidebar();    ?>
<?php get_footer(); ?>