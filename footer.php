<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ProductPage
 */

?>

	</div><!-- #content -->

		<footer class="ts-footer">
			<div class="ts-container">
				<?php if (is_active_sidebar('productpage_footer1_area') || is_active_sidebar('productpage_footer2_area') || is_active_sidebar('productpage_footer3_area') || is_active_sidebar('productpage_footer4_area')) : ?>
					<div class="ts-footer-block ts-clearblock ts-footer-column-<?php echo productpage_footer_count(); ?>">
						<?php if (is_active_sidebar('productpage_footer1_area')) { ?>
							<div class="ts-footer-single">
								<?php
								if (!dynamic_sidebar('productpage_footer1_area')):
								endif;
								?>
							</div>
						<?php } ?>

						<?php if (is_active_sidebar('productpage_footer2_area')) { ?>
							<div class="ts-footer-single">
								<?php
								if (!dynamic_sidebar('productpage_footer2_area')):
								endif;
								?>

							</div>
						<?php } ?>

						<?php if (is_active_sidebar('productpage_footer3_area')) { ?>
							<div class="ts-footer-single">
								<?php
								if (!dynamic_sidebar('productpage_footer3_area')):
								endif;
								?>
							</div>
						<?php } ?>
						<?php if (is_active_sidebar('productpage_footer4_area')) { ?>
							<div class="ts-footer-single">
								<?php
								if (!dynamic_sidebar('productpage_footer4_area')):
								endif;

								?>
							</div>
						<?php } ?>
					</div>
				<?php endif; ?>
	           <!-- <div class="menu-social-menu-container"><ul id="social-menu" class="menu"><li id="menu-item-37" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-37"><a href="http://facebook.com/99colorthemes"><i class="fa fa-facebook"></i></a></li>
				<li id="menu-item-38" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-38"><a href="http://twitter.com/99colorthemes"><i class="fa fa-twitter"></i></a></li>
				<li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39"><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li> 
				</ul>
				</div>  -->
			</div>       
		</footer>




		<div class="ts-bottom-footer">
			<div class="ts-container">
				<?php productpage_footer_copyright_info(); ?>
				<!--<p>&copy RainbowNews 2016, All Rights Reserved. Powered By WordPress.</p>
				<p>Designed By ThemeSpade &spades;</p>-->
			</div>
		</div>

		<div class="ts-scroll-top">
			<span class="ts-scroll-top-inner"><i class="fa fa-long-arrow-up"></i></span>
		</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'productpage' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'productpage' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'productpage' ), 'productpage', '<a href="http://themespade.com" rel="designer">themespade</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
