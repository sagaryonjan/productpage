<?php
/**
 * ProductPage functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ProductPage
 *
 * ProductPage Video Section
 */

add_action('widgets_init', 'productpage_video_register');

function productpage_video_register()
{
    register_widget("productpage_video");
}

class Productpage_Video extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array(
            'classname'      => 'productpage_video',
            'description'    => esc_html__( ' Product Info ', 'productpage'));

        parent::__construct( 'productpage_video', '&nbsp;' . __('&spades; TS: Product Video ', 'productpage'), $widget_ops);
    }// end of construct.

    function form($instance)
    {
        $ts_defaults['title']        =  '';
        $ts_defaults['video']        =  '';
        $ts_defaults['button_text']  =  'Learn More';

        $instance                    =  wp_parse_args((array)$instance, $ts_defaults);

        $ts_title                    =  $instance['title'];
        $ts_video                    =  $instance['video'];
        $ts_button_text              =  $instance['button_text'];
        ?>

        <label><?php esc_html_e('Lorem ipsm is the best text i have ever wrote man', 'productpage'); ?></label>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'productpage'); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($ts_title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('video'); ?>"><?php esc_html_e('Video:', 'productpage'); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('video'); ?>" name="<?php echo $this->get_field_name('video'); ?>" type="text" value="<?php echo esc_attr($ts_video); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php esc_html_e('Edit Button Text:', 'productpage'); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo esc_attr($ts_button_text); ?>"/>
        </p>

        <?php
    }// end of form.

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title']        =  sanitize_text_field($new_instance['title']);
        $instance['video']        =  sanitize_text_field($new_instance['video']);
        $instance['button_text']  =  sanitize_text_field($new_instance['button_text']);

        return $instance;
    }// end of update.

    function widget($args, $instance)
    {
        extract($args);
        extract($instance);

        global $post;

        $ts_title       =  isset($instance['title']) ? $instance['title'] : '';
        $ts_video       =  isset($instance['video']) ? $instance['video'] : '';
        $button_text    =  isset($instance['button_text']) ? $instance['button_text'] : '';

        echo $before_widget; ?>

        <div id="ts-video" class="ts-image">
            <a class="player" data-property="{videoURL:'<?php echo esc_attr($ts_video); ?>',containment:'#ts-video', autoPlay:true, loop:true, mute:true, opacity:1, quality:'default'}"></a>
            <div class="ts-video-text">
              <?php if(!empty($ts_title) || !empty($button_text)): ?>

                <p><?php echo esc_attr($ts_title); ?></p>
                <span><a href="#"><?php echo esc_attr($button_text); ?></a></span>

              <?php endif; ?>
            </div>
        </div>

        <?php echo $after_widget;
    }// end of widdget function.
}// end of apply for action widget.
