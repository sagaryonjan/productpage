<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ProductPage
 */


get_header();
$sidebar_layout = get_post_meta($post->ID, 'productpage_page_specific_layout', true);
?>
	<div class="ts-breadcrumb-banner">

		<div data-stellar-background-ratio="0.5" class="ts-parallax-image" style="background-image: url(<?php echo esc_url(get_theme_mod('productpage_page_background_image'));?>);  background-size:cover; background-position: center center;">
			<div class="ts-container">

				<div id="productpage--breadcrumbs">
					<div class="ts-default-title"><?php the_title(); ?></div>

					<div class="ts-top-breadcrumbs">
						<?php productpage_breadcrumbs(); ?>
						<!--<a href="http://localhost/productpage" class="breadcrumb_home_text">Home</a>
						<span class="breadcrumb_separator"> / </span>
						<a href="http://localhost/productpage/category/business/">Business</a>-->
					</div>


				</div>

			</div>
		</div>
	</div>

	<div id="content" class="site-content">
	<div class="ts-container">

<?php if($sidebar_layout == 'left-sidebar'):

	?>
	<aside id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar('productpage_left_sidebar'); ?>
	</aside><!-- #secondary -->
	<?php
endif;
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php woocommerce_content(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if($sidebar_layout == 'right-sidebar'):
	get_sidebar();
endif;

echo " </div></div>";
get_footer();
