<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function productpage_widgets_init() {
    register_sidebar( array(
        'name'              => esc_html__( 'Sidebar', 'productpage' ),
        'id'                => 'sidebar-1',
        'description'       => esc_html__( 'Add widgets here.', 'productpage' ),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ) );

    register_sidebar( array(
        'name'              => esc_html__('Front Page', 'productpage'),
        'id'                => 'productpage_front_page',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ) );

    register_sidebar( array(
        'name'              => esc_html__('Footer 1', 'productpage'),
        'id'                => 'productpage_footer1_area',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title"><span>',
        'after_title'       => '</span></h2>',
    ));

    register_sidebar( array(
        'name'              => esc_html__('Footer 2', 'productpage'),
        'id'                => 'productpage_footer2_area',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title"><span>',
        'after_title'       => '</span></h2>',
    ));

    register_sidebar( array(
        'name'              => esc_html__('Footer 3', 'productpage'),
        'id'                => 'productpage_footer3_area',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title"><span>',
        'after_title'       => '</span></h2>',
    ));

    register_sidebar( array(
        'name'              => esc_html__('Footer 4', 'productpage'),
        'id'                => 'productpage_footer4_area',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title"><span>',
        'after_title'       => '</span></h2>',
    ));

}
add_action( 'widgets_init', 'productpage_widgets_init' );


//productpage front banner function
if (!function_exists('productpage_front_banner')) :

    function productpage_front_banner(){

    $productpage_banner_caption = get_theme_mod( 'productpage_product_banner_caption' );
    $productpage_banner_title = get_theme_mod( 'productpage_product_banner_title' );
    $productpage_banner_detail_button = get_theme_mod( 'productpage_detail_button' );
    $productpage_banner_buy_now_button = get_theme_mod( 'productpage_buy_now_button' );


  if ( get_theme_mod( 'productpage_product_banner_checkbox' ) == '1' ) : ?>

    <div class="ts-slider">

        <div data-stellar-background-ratio="0.5" class="ts-parallax-image" style="background-image: url(<?php echo esc_url(get_theme_mod('productpage_product_banner')); ?>); background-size:cover; background-repeat: no-repeat;">
            <div class="ts-container">
                <div class="ts-desc">
                    <div class="ts-content">

                        <?php  if ( !empty($productpage_banner_caption) ) : ?>
                            <h3><?php echo esc_attr($productpage_banner_caption); ?></h3>
                        <?php endif; ?>

                        <?php  if ( !empty($productpage_banner_title) ) : ?>
                            <h2><?php echo esc_attr($productpage_banner_title); ?></h2>
                        <?php  endif; ?>

                        <div class="swiper-container1">
                            <div class="swiper-wrapper">

                                <?php
                                $text = 'productpage_slider_textarea';
                                $i = array(1,2,3);
                                foreach($i as $item) :
                                    $productpage_banner_description = get_theme_mod( $item.$text );
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="ts-dtl">
                                            <p><?php echo $productpage_banner_description; ?>.</p>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                <?php endforeach; ?>

                                <!-- Add Navigation -->

                            </div>
                        </div>

                        <div class="ts-button">

                            <?php  if ( !empty($productpage_banner_detail_button) ) : ?>
                                <span><a href="#"><?php echo esc_attr($productpage_banner_detail_button); ?></a></span>
                            <?php  endif; ?>

                            <?php  if ( !empty($productpage_banner_buy_now_button) ) : ?>
                                <span class="active"><a href="#"><?php echo esc_attr($productpage_banner_buy_now_button); ?></a></span>
                            <?php  endif; ?>

                        </div>
                    </div>



                    <figure class="ts-product-img ts-right">

                        <?php if ( get_theme_mod('productpage_banner_image')) : ?>
                            <img src="<?php echo esc_url(get_theme_mod('productpage_banner_image'));?>">
                        <?php endif; ?>

                    </figure>
                </div>
            </div>
        </div>
    </div>

<?php endif ;


    }
endif;


//productpage excerpt function
if (!function_exists('productpage_excerpt')) :

    function productpage_excerpt($productpage_content, $productpage_letter_count)
    {

        $productpage_letter_count = !empty($productpage_letter_count) ? $productpage_letter_count : 100;
        $productpage_striped_content = strip_shortcodes($productpage_content);
        $productpage_striped_content = strip_tags($productpage_striped_content);
        $productpage_excerpt = mb_substr($productpage_striped_content, 0, $productpage_letter_count);



        return $productpage_excerpt;

    }
endif;


// productpage the custom logo fuction
if (!function_exists('productpage_the_custom_logo')) :

    function productpage_the_custom_logo()
    {
        if (function_exists('the_custom_logo')) {
            the_custom_logo();
        }
    }

endif;

// function to show the footer info, copyright information
if (!function_exists('productpage_footer_copyright_info')) :

    function productpage_footer_copyright_info()
    {
        $site_link = '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" >' . get_bloginfo('name', 'display') . '</a>';

        $wp_link = '<a href="' . esc_url('http://wordpress.org') . '" target="_blank" title="' . esc_attr__('WordPress', 'productpage') . '"><span>' . esc_html__('WordPress', 'productpage') . '</span></a>';

        $tm_link = '<a href="' . 'http://themespade.com/' . '" target="_blank" title="' . esc_attr__('themespade', 'productpage') . '" rel="designer"><span>' . esc_html__('ThemeSpade &spades; ', 'productpage') . '</span></a>';

        $default_footer_value = '<p class="ts-left">' . sprintf(esc_html__(' &copy; %1$s %2$s. All Right Reserved. ', 'productpage'), $site_link, date('Y')) . sprintf(esc_html__('| Powered by %s.', 'productpage'), $wp_link) . '</p><p class="ts-right">' . sprintf(esc_html__('Designed By %s.', 'productpage'), $tm_link) . '</p>';

        $productpage_footer_copyright = '<div class="ts-footer-bottom"><div class="ts-container">' . $default_footer_value . '</div></div>';
        echo $productpage_footer_copyright;
    }

    add_action('productpage_footer_copyright', 'productpage_footer_copyright_info', 10);

endif;
