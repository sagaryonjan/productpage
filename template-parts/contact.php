<?php
/**
 * Template Name: Contact Page
 * @package ThemeSpade
 * @subpackage ProductPage
 */

$ts_contact_title = get_theme_mod('productpage_contact_title');
$ts_contact_text = get_theme_mod('productpage_contact_text');
$ts_contact_map = get_theme_mod('productpage_contact_map');
$ts_contact_shortcode = get_theme_mod('productpage_contact_shortcode');

//productpage header funtion
get_header();
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
            <main id="main" class="site-main" role="main">
                <div class="ts-contact-info">
                    <?php if(! empty($ts_contact_title)): ?>
                    <h4><?php echo esc_attr($ts_contact_title); ?></h4>
                    <?php endif; ?>
                <?php if(! empty($ts_contact_text)): ?>
                    <p><?php echo esc_textarea($ts_contact_text); ?></p>
                <?php endif; ?>
                </div>
            </main>
            <!-- #main -->
        </div>
        <?php if(!empty($ts_contact_shortcode)): ?>
            <div class="ts-contact-form">
                <?php echo do_shortcode($ts_contact_shortcode );?>
            </div>
        <?php endif;
            ?>
        <?php if(!empty($ts_contact_map)): ?>
        <div class="ts-g-map">
            <?php echo $ts_contact_map; ?>
        </div>
    <?php endif; ?>

    </div>
<?php

get_footer();

?>