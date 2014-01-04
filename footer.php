<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package digistarter
 */
?>
		<?php tha_content_bottom(); ?>
		</div><!-- #content -->
		<?php tha_content_after(); ?>
   		<?php tha_footer_before(); ?>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php tha_footer_top(); ?>
			<?php wp_footer(); ?>
			<div class="site-info">
				<?php do_action( 'digistarter_credits' ); ?>
				<a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by <span class="genericon genericon-wordpress"></span> %s', 'digistarter' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'digistarter' ), 'Some Like it Neat, ', '<a href="http://alexhasnicehair.com" rel="designer">Alex Vasquez</a>' ); ?><br />

			</div><!-- .site-info -->
			<?php tha_footer_bottom(); ?>
		</footer><!-- #colophon -->

	</div><!-- .wrap --<
</div><!-- #page -->
<?php tha_footer_after(); ?>
<?php tha_body_bottom(); ?>


</body>
</html>