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