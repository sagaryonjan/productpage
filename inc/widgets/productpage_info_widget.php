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
            'description'    => esc_html__('Product info widget.', 'productpage'));

        parent::__construct( 'productpage_info_widget', '&nbsp;' . __('Info Widget ', 'productpage'), $widget_ops);
    }// end of construct.

    function form($instance)
    {
        $defaults['title']        =  '';
        $defaults['description']  =  '';
        $defaults['style']        =  'style1';

        $instance                 =  wp_parse_args((array)$instance, $defaults);

        $title                    =  esc_attr($instance['title']);
        $text                     =  esc_attr($instance['text']);
        $style                    =  $instance['style'];

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'productpage'); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', 'productpage'); ?></label>

            <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $text ); ?></textarea>
        </p>
        <p>
            <input type="radio" <?php checked($style, 'style1') ?> id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" value="style1"/><?php _e('Style 1', 'productpage'); ?><br/>

            <input type="radio" <?php checked($style, 'style2') ?> id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" value="style2"/><?php _e('Style 2', 'productpage'); ?><br/>
        </p>

        <?php
    }// end of form.

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title']     =  sanitize_text_field($new_instance['title']);
        $instance['style']    = $new_instance['style'];

        if ( current_user_can('unfiltered_html') )
            $instance[ 'text' ]     =  $new_instance[ 'text' ];
        else
            $instance[ 'text' ]     = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' ] ) ) );

        return $instance;
    }// end of update.

    function widget($args, $instance)
    {
        extract($args);
        extract($instance);

        global $post;

        $title    =  isset($instance['title']) ? $instance['title'] : '';
        $text     =  isset($instance['text']) ? $instance['text'] : '';
        $page =  isset($instance['page']) ? $instance['page'] : '';

        $get_featured_posts = new WP_Query(array(
            'posts_per_page'      => 5,
            'post_type'           => 'post',
            'page_id'           => $page
        ));

        echo $before_widget;

        ?>













        <?php echo $after_widget;
    }// end of widdget function.
}// end of apply for action widget.



