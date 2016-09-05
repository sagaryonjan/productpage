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


add_action('widgets_init', 'register_productpage_video');

function register_productpage_video()
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




        $defaults['title']        =  '';
        $defaults['video']        =  '';
        $defaults['button_text']        =  'Learn More';

        $instance                      =  wp_parse_args((array)$instance, $defaults);

        $title                   =  esc_attr($instance['title']);
        $video                   =  esc_attr($instance['video']);
        $button_text                   =  esc_attr($instance['button_text']);

        ?>

        <label><?php _e('Lorem ipsm is the best text i have ever wrote man', 'productpage'); ?></label>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'productpage'); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('video'); ?>"><?php _e('Video:', 'productpage'); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('video'); ?>" name="<?php echo $this->get_field_name('video'); ?>" type="text" value="<?php echo $video; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Edit Button Text:', 'productpage'); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>"/>
        </p>

        <?php
    }// end of form.

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title']     =  sanitize_text_field($new_instance['title']);
        $instance['video']     =  sanitize_text_field($new_instance['video']);
        $instance['button_text']     =  sanitize_text_field($new_instance['button_text']);

        return $instance;
    }// end of update.

    function widget($args, $instance)
    {
        extract($args);
        extract($instance);

        global $post;


        $title    =  isset($instance['title']) ? $instance['title'] : '';
        $video    =  isset($instance['video']) ? $instance['video'] : '';
        $button_text    =  isset($instance['button_text']) ? $instance['button_text'] : '';


        echo $before_widget;

        ?>
        <div id="ts-video" class="ts-image">
            <a class="player" data-property="{videoURL:'<?php echo $video; ?>',containment:'#ts-video', autoPlay:true, loop:true, mute:true, opacity:1, quality:'default'}"></a>
            <div class="ts-video-text">
                <p><?php echo $title; ?></p>
                <span><a href="#"><?php echo $button_text; ?></a></span>
            </div>
        </div>

        <?php echo $after_widget;
    }// end of widdget function.
}// end of apply for action widget.



