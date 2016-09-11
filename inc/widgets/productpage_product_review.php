<?php
/**
 * ProductPage functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RainbowNews
 *
 * ProductPage Product Review Section
 */

add_action('widgets_init', 'productpage_product_review_register');

function productpage_product_review_register()
{
    register_widget("productpage_product_review");
}

class Productpage_Product_Review extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array(
            'classname'      => 'productpage_product_review',
            'description'    => esc_html__( ' Product Review ', 'productpage'));

        parent::__construct( 'productpage_product_review', '&nbsp;' . __('&spades; TS: Product Review ', 'productpage'), $widget_ops);
    }// end of construct.

    function form($instance)
    {
        $ts_defaults['title']             =  '';
        $ts_defaults['description']       =  '';
        $ts_defaults['image_url']         =  '';
        $ts_defaults['background_color']  =  '#222222';

        for ($i=0; $i<5; $i++) {
            $ts_defaults['page_' . $i]    = '';
        }

        $instance                         =  wp_parse_args((array)$instance, $ts_defaults);

        $ts_title                         =  $instance['title'];
        $ts_description                   =  $instance['description'];
        $ts_image_url                     =  'image_url';
        $ts_background_color              =  $instance['background_color'];
        ?>

        <label><?php esc_html_e('Lorem ipsm is the best text i have ever wrote man', 'productpage'); ?></label>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'productpage'); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($ts_title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php esc_html_e('Description', 'productpage'); ?></label>

            <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_textarea( $ts_description ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id($ts_image_url); ?>"> <?php esc_html_e('Background Image ', 'productpage'); ?></label>
            <?php
            if ($instance[$ts_image_url] != '') :
                echo '<img id="' . $this->get_field_id($instance[$ts_image_url] . 'preview') . '"src="' . $instance[$ts_image_url] . '"style="max-width:250px;" /><br />';
            endif;
            ?>
            <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id($ts_image_url); ?>" name="<?php echo $this->get_field_name($ts_image_url); ?>" value="<?php echo $instance[$ts_image_url]; ?>" style="margin-top:5px;"/>

            <input type="button" class="button button-primary custom_media_button widefat" id="custom_media_button" name="<?php echo $this->get_field_name($ts_image_url); ?>" value="<?php _e('Upload Image', 'productpage'); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id($ts_image_url); ?>' ); return false;"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'background_color' ); ?>" class="widefat"><?php esc_html_e('Background Color', 'productpage') ?></label><br></br>

            <input class="widefat my-color-picker" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo $ts_background_color; ?>" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php esc_html_e( 'Page', 'productpage' ); ?>:</label>
        <?php for ($i=0; $i<5; $i++) : ?>
            <?php
            $arg = array(
                'class'    => 'widefat',
                'name'     => $this->get_field_name('page_'.$i),
                'id'       => $this->get_field_id('page_'.$i),
                'selected' => absint( $instance['page_'.$i] )
            );
            wp_dropdown_pages( $arg );
            ?>
           <br> </br>
        <?php endfor; ?>
        </p>
        <?php
    }// end of form.

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $image_url                       =  'image_url';
        $instance['title']               =  sanitize_text_field($new_instance['title']);
        $instance[$image_url]            =  esc_url_raw($new_instance[$image_url]);
        $instance['background_color']    =  sanitize_hex_color($new_instance['background_color']);

        if ( current_user_can('unfiltered_html') )
            $instance[ 'description' ]   =  $new_instance[ 'description' ];
        else
            $instance[ 'description' ]   = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'description' ] ) ) );

        for( $i=0; $i<5; $i++ ) {
            $instance['page_'.$i]        = absint( $new_instance['page_'.$i] );
        }

        return $instance;
    }// end of update.

    function widget($args, $instance)
    {
        extract($args);
        extract($instance);

        global $post;

        $ts_title             =  isset($instance['title']) ? $instance['title'] : '';
        $ts_desc              =  isset($instance['description']) ? $instance['description'] : '';
        $ts_image_url         =  isset($instance['image_url']) ? $instance['image_url'] : '';
        $ts_background_color  =  isset($instance['background_color']) ? $instance['background_color'] : '';

        $page = array();
        for( $i=0; $i<5; $i++ ) {
            $pages[]          = isset( $instance['page_'.$i] ) ? $instance['page_'.$i] : '';
        }

        $ts_get_page = new WP_Query(array(
            'posts_per_page'  => 5,
            'post_type'       => array( 'page' ),
            'page_id'         => $page
        ));

        echo $before_widget; ?>

        <div data-stellar-background-ratio="0.5" class="ts-reviews" style="background-image: url(<?php echo $ts_image_url; ?>); background-color:<?php echo $ts_background_color; ?>; background-size:cover;background-repeat: no-repeat;">
            <div class="ts-container">
                <?php if($ts_title || $ts_desc): ?>
                    <div class="ts-title ts-title-white">
                        <?php
                        if($ts_title)
                            echo '<h2>'.esc_attr($ts_title). '</h2>';

                        if($ts_desc)
                            echo '<p>'.esc_textarea($ts_desc).' </p>';
                        ?>
                    </div>
                <?php endif; ?>

                <div class="ts-reviews-block">
                    <div class="ts-review-swiper swiper-container">
                        <div class="swiper-wrapper">

                            <?php  if ( $ts_get_page->have_posts() ) :
                            while ($ts_get_page->have_posts()) : $ts_get_page->the_post(); ?>
                                <div class="swiper-slide">
                                    <div class="ts-reviews-single">
                                        <p><?php the_excerpt(); ?></p>

                                    <?php if(has_post_thumbnail() ) : ?>
                                        <figure class="ts-review-img">
                                            <?php the_post_thumbnail('large'); ?>
                                        </figure>
                                     <?php endif; ?>

                                        <h4><?php the_title(); ?></h4>
                                    </div>
                                </div>
                            <?php endwhile;
                                wp_reset_postdata();
                            endif; ?>

                        </div>
                        <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
                        <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                    </div>
                </div>

            </div>
        </div>
        <?php echo $after_widget;
    }// end of widdget function.
}// end of apply for action widget.
