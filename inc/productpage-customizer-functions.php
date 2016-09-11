<?php

//productpage front banner function
if (!function_exists('productpage_front_banner')) :

    function productpage_front_banner()
    {
        $productpage_banner_caption        =  get_theme_mod('productpage_product_banner_caption');
        $productpage_banner_buy_now_button =  get_theme_mod('productpage_buy_now_button');
        $productpage_category              =  get_theme_mod('productpage_products_category');

        $get_featured_posts   = new WP_Query( array(
            'post_type'       =>  'product',
            'posts_per_page'  => 1,
            'tax_query'       =>  array(
                array(
                  'taxonomy'  => 'product_cat',
                  'field'     => 'id',
                  'terms'     => $productpage_category
                ) )

        ) );

        if (get_theme_mod('productpage_product_banner_checkbox') == '1') : ?>

            <div class="ts-slider">
                <div data-stellar-background-ratio="0.5" class="ts-parallax-image" style="background-image: url(<?php echo esc_url(get_theme_mod('productpage_product_banner')); ?>); background-size:cover; background-repeat: no-repeat;">
                    <div class="ts-container">
                <?php
                while( $get_featured_posts->have_posts() ):
                    $get_featured_posts->the_post();
                        ?>

                        <div class="ts-desc">
                            <div class="ts-content">

                                <?php if (!empty($productpage_banner_caption)) : ?>
                                    <h3><?php echo esc_attr($productpage_banner_caption); ?></h3>
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                                <div class="ts-dtl">
                                    <p><?php the_excerpt(); ?></p>
                                </div>

                                <div class="ts-button">
                                    <?php if (!empty($productpage_banner_buy_now_button)) : ?>
                                        <span class="active"><a href="<?php the_permalink(); ?>"><?php echo esc_attr($productpage_banner_buy_now_button); ?></a></span>
                                    <?php endif; ?>
                                </div>

                            </div>

                            <figure class="ts-product-img ts-right">
                              <?php the_post_thumbnail(); ?>
                            </figure>

                        </div>

                        <?php
                endwhile;
                // Reset Post Data
                wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>

        <?php endif;
    }

endif;

if (!function_exists('productpage_map_allowed_tags')) :

function productpage_map_allowed_tags( $productpage_allowedposttags ) {

// Here add tags and attributes you want to allow
    $productpage_allowedposttags['iframe']=array(

        'align'        => true,
        'width'        => true,
        'height'       => true,
        'frameborder'  => true,
        'name'         => true,
        'src'          => true,
        'id'           => true,
        'class'        => true,
        'style'        => true,
        'scrolling'    => true,
        'marginwidth'  => true,
        'marginheight' => true,

    );
    return $productpage_allowedposttags;

}

endif;

