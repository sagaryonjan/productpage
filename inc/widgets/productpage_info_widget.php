<?php
/**
 * ProductPage functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RainbowNews
 *
 * ProductPage Featured  Widget Section
 */


add_action('widgets_init', 'register_productpage_info_widget');

function register_productpage_info_widget()
{
    register_widget("productpage_info_widget");
}

class Productpage_info_widget extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array(
            'classname'      => 'productpage_info_widget',
            'description'    => esc_html__( ' Product Info ', 'productpage'));

        parent::__construct( 'productpage_info_widget', '&nbsp;' . __('&spades; TS: Product Info ', 'productpage'), $widget_ops);
    }// end of construct.

    function form($instance)
    {

        $ts_defaults['style']              =  'style1';
        $ts_defaults['page']               =  '';
        $ts_defaults['image_url']          =  '';
        $ts_defaults['background_color']   =  '#222222';
        $ts_defaults['description_limit']  =  400;
        $ts_defaults['button_text']        =  'Learn More';

        $instance                      =  wp_parse_args((array)$instance, $ts_defaults);


        $ts_style                         =  $instance['style'];
        $ts_image_url                     =  'image_url';
        $ts_background_color              =  $instance['background_color'];
        $ts_description_limit             =  esc_attr($instance['description_limit']);
        $ts_button_text                   =  esc_attr($instance['button_text']);

        ?>

        <label><?php esc_html_e('Lorem ipsm is the best text i have ever wrote man', 'productpage'); ?></label>
        <p>
            <input type="radio" <?php checked($ts_style, 'style1') ?> id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" value="style1"/><?php esc_html_e('Style 1', 'productpage'); ?><br/>

            <input type="radio" <?php checked($ts_style, 'style2') ?> id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" value="style2"/><?php esc_html_e('Style 2', 'productpage'); ?><br/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'background_color' ); ?>" class="widefat"><?php esc_html_e('Background Color', 'productpage') ?></label><br></br>

            <input class="widefat my-color-picker" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo $ts_background_color; ?>" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id($ts_image_url); ?>"> <?php esc_html_e('Background Image ', 'productpage'); ?></label>

            <?php
            if ($instance[$ts_image_url] != '') :
                echo '<img id="' . $this->get_field_id($instance[$ts_image_url] . 'preview') . '"src="' . $instance[$ts_image_url] . '"style="max-width:250px;" /><br />';
            endif;
            ?>

            <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id($ts_image_url); ?>" name="<?php echo $this->get_field_name($ts_image_url); ?>" value="<?php echo $instance[$ts_image_url]; ?>" style="margin-top:5px;"/>

            <input type="button" class="button button-primary custom_media_button widefat" id="custom_media_button" name="<?php echo $this->get_field_name($ts_image_url); ?>" value="<?php esc_html_e('Upload Image', 'productpage'); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id($ts_image_url); ?>' ); return false;"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php esc_html_e( 'Page', 'productpage' ); ?>:</label>
            <?php
            $arg = array(
                'class' => 'widefat',
                'name' => $this->get_field_name('page'),
                'id'   => $this->get_field_id('page'),
                'selected' => absint( $instance['page'] )
            );
            wp_dropdown_pages( $arg );
            ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description_limit' ); ?>"><?php esc_html_e( 'Description Limit Number:', 'productpage' ); ?></label>

            <input id="<?php echo $this->get_field_id( 'description_limit' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'description_limit' ); ?>" type="number" value="<?php echo $ts_description_limit; ?>" size="3" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php esc_html_e('Edit Button Text:', 'productpage'); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $ts_button_text; ?>"/>
        </p>

        <?php
    }// end of form.

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['style']             =  $new_instance['style'];
        $image_url                     =  'image_url';
        $instance[$image_url]          =  esc_url_raw($new_instance[$image_url]);
        $instance['background_color']  =  $new_instance['background_color'];
        $instance['page']              =  absint( $new_instance['page'] );
        $instance[ 'description_limit' ]     = absint( $new_instance[ 'description_limit' ] );
        $instance['button_text']     =  sanitize_text_field($new_instance['button_text']);

        return $instance;
    }// end of update.

    function widget($args, $instance)
    {
        extract($args);
        extract($instance);

        global $post;

        $ts_style    =  isset($instance['style']) ? $instance['style'] : '';
        $ts_image_url    =  isset($instance['image_url']) ? $instance['image_url'] : '';
        $ts_background_color     =  isset($instance['background_color']) ? $instance['background_color'] : '';
        $ts_desc_limit     =  isset($instance['description_limit']) ? $instance['description_limit'] : '';
        $ts_page =  isset($instance['page']) ? $instance['page'] : '';
        $ts_button_text    =  isset($instance['button_text']) ? $instance['button_text'] : '';

        $get_featured_posts = new WP_Query(array(
            'posts_per_page'      => 5,
            'post_type'           => array( 'page' ),
            'page_id'           => $ts_page
        ));

        echo $before_widget;

        ?>

        <div class="ts-info <?php echo $ts_style == 'style2'?'ts-info2':''; ?>" style="background-image: url(<?php echo $ts_image_url; ?>); background-color:<?php echo $ts_background_color; ?> ;  background-size:cover;background-repeat: no-repeat;">
        <?php
        if ( $get_featured_posts->have_posts() ) :
            while ($get_featured_posts->have_posts()) : $get_featured_posts->the_post(); ?>
            <div class="ts-container">

                <div class="ts-info-desc">

                    <div class="ts-title" style="color:#666">
                        <h2><?php echo the_title(); ?></h2>

                        <p style="color:#666"><?php echo productpage_excerpt(get_the_content(), $s_desc_limit); ?></p>
                    </div>
                    <a href="<?php the_permalink(); ?>"><?php echo $ts_button_text; ?></a>

                </div>

                <figure class="ts-info-img">
                    <?php the_post_thumbnail('large'); ?>
                </figure>

            </div>
            <?php endwhile;
            wp_reset_postdata();
        endif;
        ?>

        </div>

        <?php echo $after_widget;
    }// end of widdget function.
}// end of apply for action widget.



