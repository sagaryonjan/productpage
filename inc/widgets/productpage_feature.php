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


add_action('widgets_init', 'productpage_featured_register');

function productpage_featured_register()
{
    register_widget("productpage_featured");
}

class Productpage_Featured extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array(
            'classname'      =>  'productpage_featured',
            'description'    =>  esc_html__('Display latest posts or posts of specific category.', 'productpage'));

        parent::__construct( 'productpage_featured', '&nbsp;' . __('&spades; TS: Our Feature ', 'productpage'), $widget_ops);
    }// end of construct.

    function form($instance)
    {
        $ts_defaults['title']        =  '';
        $ts_defaults['description']  =  '';
        $ts_defaults['desc_limit']   =  300;
        $ts_defaults['image_url']    =  '';

        for ($i=0; $i<5; $i++) {
            $ts_defaults['page_' . $i]  = '';
        }

        $instance                    =  wp_parse_args((array)$instance, $ts_defaults);

        $ts_title                    =  $instance['title'];
        $ts_text                     =  $instance['description'];
        $ts_desc_limit               =  $instance['desc_limit'];
        $ts_image_url                =  'image_url';

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title: ', 'productpage'); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $ts_title ); ?>"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id($ts_image_url); ?>"> <?php esc_html_e(' Image: ', 'productpage'); ?></label>

            <?php
            if ($instance[$ts_image_url] != '') :
                echo '<img id="' . $this->get_field_id($instance[$ts_image_url] . 'preview') . '"src="' . $instance[$ts_image_url] . '"style="max-width:250px;" /><br />';
            endif;
            ?>

            <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id($ts_image_url); ?>" name="<?php echo $this->get_field_name($ts_image_url); ?>" value="<?php echo $instance[$ts_image_url]; ?>" style="margin-top:5px;"/>

            <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name($ts_image_url); ?>" value="<?php esc_html_e('Upload Image', 'productpage'); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id($ts_image_url); ?>' ); return false;"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php esc_html_e('Description', 'productpage'); ?></label>

            <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_textarea( $ts_text ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'desc_limit' ); ?>"><?php esc_html_e( 'Description Limit Number:', 'productpage' ); ?></label>

            <input id="<?php echo $this->get_field_id( 'desc_limit' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'desc_limit' ); ?>" type="number" value="<?php echo $ts_desc_limit; ?>" size="3" />
        </p>

        <?php for ($i=0; $i<5; $i++) : ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php esc_html_e( 'Page', 'productpage' ); ?>:</label>
            <?php
            $arg  =  array (
                'class'      => 'widefat',
                'name'       => $this->get_field_name('page_'.$i),
                'id'         => $this->get_field_id('page_'.$i),
                'selected'   => absint( $instance['page_'.$i] )
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

        $instance['title']         =  sanitize_text_field($new_instance['title']);
        $instance[ 'desc_limit' ]  =  absint( $new_instance[ 'desc_limit' ] );
        $image_url              =  'image_url';

        $instance[$image_url]   =  esc_url_raw($new_instance[$image_url]);

        for( $i=0; $i<5; $i++ ) {
            $instance['page_'.$i]  = absint( $new_instance['page_'.$i] );
        }

        if ( current_user_can('unfiltered_html') )
            $instance[ 'description' ]    =  $new_instance[ 'description' ];
        else
            $instance[ 'description' ]    = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'description' ] ) ) );

        return $instance;
    }// end of update.

    function widget($args, $instance)
    {
        extract($args);
        extract($instance);

        global $post;

        $ts_title       =  isset($instance['title']) ? $instance['title'] : '';
        $ts_text        =  isset($instance['description']) ? $instance['description'] : '';
        $ts_desc_limit  =  isset($instance['desc_limit']) ? $instance['desc_limit'] : '';

        $pages       = array();

        for( $i=0; $i<5; $i++ ) {
            $pages[] = isset( $instance['page_'.$i] ) ? $instance['page_'.$i] : '';
        }

        $get_featured_posts = new WP_Query(array(
            'posts_per_page'      => 5,
            'post_type'           => array( 'page' ),
            'post__in'            => $pages,
            'orderby'             => 'post__in'
        ));

        echo $before_widget;

        ?>

        <div class="ts-features">
            <div class="ts-container">
                <?php if($ts_title || $ts_text): ?>

                <div class="ts-title">

                    <?php
                        if($ts_title)
                            echo '<h2> '. esc_html($ts_title) . '</h2>';

                        if($ts_text)
                            echo '<p>'.esc_textarea($ts_text).' </p>';
                    ?>

                </div>
        <?php endif; ?>

                <div class="ts-features-block ts-clearblock">
                    <?php
                    if ( $get_featured_posts->have_posts() ) :
                    while ($get_featured_posts->have_posts()) : $get_featured_posts->the_post(); ?>

                    <div class="ts-features-single">

                        <div class="ts-hex-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-size:cover; background-repeat: no-repeat;">
                            <span class="ts-top"></span>
                            <span class="ts-bottom"></span>
                        </div>

                        <h4> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a> </h4>

                        <?php the_excerpt(); ?>

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



