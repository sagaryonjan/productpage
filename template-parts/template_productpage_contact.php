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

        <div class="ts-g-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d98820.84275835866!2d-76.69052566756989!3d39.28481834077323!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c803aed6f483b7%3A0x44896a84223e758!2sBaltimore%2C+MD%2C+USA!5e0!3m2!1sen!2snp!4v1473217524513" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
<?php

get_footer();

?>