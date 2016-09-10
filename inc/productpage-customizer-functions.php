<?php

//productpage front banner function
if (!function_exists('productpage_front_banner')) :

    function productpage_front_banner()
    {

        $productpage_banner_caption = get_theme_mod('productpage_product_banner_caption');
        $productpage_banner_detail_button = get_theme_mod('productpage_detail_button');
        $productpage_banner_buy_now_button = get_theme_mod('productpage_buy_now_button');



        $page_id = get_theme_mod('pageline_slide');

        $get_featured_posts = new WP_Query(
            array(
                'posts_per_page' => -1,
                'post_type' => array('page'),
                'post__in' => $page_id,
                'orderby' => 'post__in'
            ));


        if (get_theme_mod('productpage_product_banner_checkbox') == '1') : ?>

            <div class="ts-slider">

                <div data-stellar-background-ratio="0.5" class="ts-parallax-image"
                     style="background-image: url(<?php echo esc_url(get_theme_mod('productpage_product_banner')); ?>); background-size:cover; background-repeat: no-repeat;">
                    <div class="ts-container">
                        <div class="ts-desc">
                            <div class="ts-content">

                                <?php if (!empty($productpage_banner_caption)) : ?>
                                    <h3><?php echo esc_attr($productpage_banner_caption); ?></h3>
                                <?php endif; ?>

                                <?php
                                if ($get_featured_posts->have_posts()) :
                                    while ($get_featured_posts->have_posts()) : $get_featured_posts->the_post(); ?>
                                        <h2><?php the_title(); ?></h2>

                                        <div class="ts-dtl">
                                            <p><?php the_excerpt(); ?>.</p>
                                        </div>
                                    <?php endwhile;
                                    wp_reset_postdata();
                                endif;
                                ?>


                                <div class="ts-button">

                                    <?php if (!empty($productpage_banner_detail_button)) : ?>
                                        <span><a href="#"><?php echo esc_attr($productpage_banner_detail_button); ?></a></span>
                                    <?php endif; ?>

                                    <?php if (!empty($productpage_banner_buy_now_button)) : ?>
                                        <span class="active"><a
                                                href="#"><?php echo esc_attr($productpage_banner_buy_now_button); ?></a></span>
                                    <?php endif; ?>

                                </div>
                            </div>


                            <figure class="ts-product-img ts-right">

                                <?php if (get_theme_mod('productpage_banner_image')) : ?>
                                    <img src="<?php echo esc_url(get_theme_mod('productpage_banner_image')); ?>">
                                <?php endif; ?>

                            </figure>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif;

    }

endif;

