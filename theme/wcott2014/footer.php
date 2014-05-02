<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package wcott2014
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info inner">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'wcott2014' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'wcott2014' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'wcott2014' ), 'wcott2014', '<a href="http://isotrope.net" rel="designer">Michal Bluma</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
