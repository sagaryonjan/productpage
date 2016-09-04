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


add_action('widgets_init', 'register_productpage_featured');

function register_productpage_featured()
{
    register_widget("productpage_featured");
}

class Productpage_Featured extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array(
            'classname'      => 'productpage_featured',
            'description'    => esc_html__('Display latest posts or posts of specific category.', 'productpage'));

        parent::__construct( 'productpage_featured', '&nbsp;' . __('&spades; TS: Our Feature ', 'productpage'), $widget_ops);
    }// end of construct.

    function form($instance)
    {
        $defaults['title']          =  '';
        $defaults['description']    =  '';
        $defaults['description_limit']    =  '';
        $defaults['image_url']  =  '';

        for ($i=0; $i<5; $i++) {
            $defaults['page_' . $i] = '';
        }

        $instance                   =  wp_parse_args((array)$instance, $defaults);

        $title                      =  esc_attr($instance['title']);
        $text                       =  esc_attr($instance['text']);
        $description_limit          =  esc_attr($instance['description_limit']);
        $image_url                   =  'image_url';



        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'productpage'); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id($image_url); ?>"> <?php _e('Advertisement Image ', 'productpage'); ?></label>

            <?php
            if ($instance[$image_url] != '') :
                echo '<img id="' . $this->get_field_id($instance[$image_url] . 'preview') . '"src="' . $instance[$image_url] . '"style="max-width:250px;" /><br />';
            endif;
            ?>

            <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id($image_url); ?>" name="<?php echo $this->get_field_name($image_url); ?>" value="<?php echo $instance[$image_url]; ?>" style="margin-top:5px;"/>

            <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name($image_url); ?>" value="<?php _e('Upload Image', 'productpage'); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id($image_url); ?>' ); return false;"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', 'productpage'); ?></label>

            <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $text ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description_limit' ); ?>"><?php esc_html_e( 'Description Limit Number:', 'productpage' ); ?></label>

            <input id="<?php echo $this->get_field_id( 'description_limit' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'description_limit' ); ?>" type="number" value="<?php echo $description_limit; ?>" size="3" />
        </p>



        <?php for ($i=0; $i<5; $i++) : ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php esc_html_e( 'Page', 'pageline' ); ?>:</label>
            <?php
            $arg = array(
                'class' => 'widefat',
                'show_option_none' =>' ',
                'name' => $this->get_field_name('page_'.$i),
                'id'   => $this->get_field_id('page_'.$i),
                'selected' => absint( $instance['page_'.$i] )
            );
            wp_dropdown_pages( $arg );
            ?>
        </p>
        <?php endfor; ?>

        <?php
    }// end of form.

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title']     =  sanitize_text_field($new_instance['title']);
        $instance[ 'description_limit' ]     = absint( $new_instance[ 'description_limit' ] );
        $image_url             =  'image_url';

        $instance[$image_url]  =  esc_url_raw($new_instance[$image_url]);
        for( $i=0; $i<5; $i++ ) {
            $instance['page_'.$i] = absint( $new_instance['page_'.$i] );
        }
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
        $desc_limit     =  isset($instance['description_limit']) ? $instance['description_limit'] : '';

        $pages = array();
        for( $i=0; $i<5; $i++ ) {
            $pages[] = isset( $instance['page_'.$i] ) ? $instance['page_'.$i] : '';
        }





        $get_featured_posts = new WP_Query(array(
            'posts_per_page'      => 5,
            'post_type'           => array( 'page' ),
            'page_id'           => $page
        ));

        echo $before_widget;

        ?>

        <div class="ts-features">
            <div class="ts-container">
                <?php if($title || $text): ?>

                <div class="ts-title">

                    <?php
                        if($title)
                            echo '<h2> '. esc_html($title) . '</h2>';

                        if($text)
                            echo '<p>'.esc_textarea($text).' </p>';
                    ?>

                </div>
        <?php endif; ?>

                <div class="ts-features-block ts-clearblock">
                    <?php
                    if ( $get_featured_posts->have_posts() ) :
                    while ($get_featured_posts->have_posts()) : $get_featured_posts->the_post(); ?>
                    <div class="ts-features-single">
                        <div class="ts-icon">
                            <i class="fa fa-magic"></i>
                        </div>
                        <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                        <p><?php echo productpage_excerpt(get_the_content(), $desc_limit); ?></p>
                    </div>
                    <?php endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>

                </div>


                <div class="featured-image">
                    <?php
                    $output = '';
                    if (!empty($image_url)) {

                        $output .= '<img src="' . $image_url . '" >';
                    }
                    echo $output;
                    ?>
                </div>
            </div>
        </div>

        <?php echo $after_widget;
    }// end of widdget function.
}// end of apply for action widget.



