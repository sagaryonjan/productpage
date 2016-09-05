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


add_action('widgets_init', 'register_productpage_frequently_asked_question');

function register_productpage_frequently_asked_question()
{
    register_widget("productpage_frequently_asked_question");
}

class Productpage_Frequently_Asked_Question extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array(
            'classname'      => 'productpage_frequently_asked_question',
            'description'    => esc_html__( ' Product Info ', 'productpage'));

        parent::__construct( 'productpage_frequently_asked_question', '&nbsp;' . __('&spades; TS: Frequently Asked Questions ', 'productpage'), $widget_ops);
    }// end of construct.

    function form($instance)
    {

        $defaults['title']              =  '';
        $defaults['description']        =  '';
        $defaults['desc_limit']         =  75;
        $defaults['background_color']   =  '#222222';
        for ($i=0; $i<6; $i++) {
            $defaults['question'.$i]    =  '';
            $defaults['answer'. $i]     =  '';
        }

        $instance                      =  wp_parse_args((array)$instance, $defaults);

        $title                         =  esc_attr($instance['title']);
        $description                   =  esc_attr($instance['description']);
        $desc_limit                    =  esc_attr($instance['desc_limit']);
        $background_color              =  $instance['background_color'];

        ?>

        <label><?php _e('Lorem ipsm is the best text i have ever wrote man', 'productpage'); ?></label>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'productpage'); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', 'productpage'); ?></label>

            <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_textarea( $description ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'desc_limit' ); ?>"><?php esc_html_e( 'Description Limit Number:', 'productpage' ); ?></label>

            <input id="<?php echo $this->get_field_id( 'desc_limit' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'desc_limit' ); ?>" type="number" value="<?php echo $desc_limit; ?>" size="3" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'background_color' ); ?>" class="widefat"><?php _e('Background Color', 'productpage') ?></label><br></br>

            <input class="widefat my-color-picker" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo $background_color; ?>" type="text" />
        </p>
        <p>


            <?php for ($i=0; $i<6; $i++) : ?>
            <label for="<?php echo $this->get_field_id( 'question'.$i ); ?>"><?php esc_html_e( 'Question', 'productpage' ); ?>:</label>
            <textarea class="widefat" rows="2" cols="20" id="<?php echo $this->get_field_id( 'question'.$i ); ?>" name="<?php echo $this->get_field_name( 'question'.$i ); ?>"><?php echo esc_textarea( $instance['question'.$i] ); ?></textarea>

            <label for="<?php echo $this->get_field_id( 'answer'.$i ); ?>"><?php esc_html_e( 'Answer', 'productpage' ); ?>:</label>
            <textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id( 'answer'.$i ); ?>" name="<?php echo $this->get_field_name( 'answer'.$i ); ?>"><?php echo esc_textarea( $instance['answer'.$i] ); ?></textarea>
           <br> </br>
        <?php endfor; ?>
        </p>




        <?php
    }// end of form.

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title']               =  sanitize_text_field($new_instance['title']);
        $instance[ 'desc_limit' ]        = absint( $new_instance[ 'desc_limit' ] );
        $instance['background_color']    =  $new_instance['background_color'];

        if ( current_user_can('unfiltered_html') )
            $instance[ 'description' ]   =  $new_instance[ 'description' ];
        else
            $instance[ 'description' ]   = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'description' ] ) ) );


         for ($i=0; $i<6; $i++) {
             if (current_user_can('unfiltered_html'))
                 $instance['question'.$i] = $new_instance['question'.$i];
             else
                 $instance['question'.$i] = stripslashes(wp_filter_post_kses(addslashes($new_instance['question'.$i])));

             if (current_user_can('unfiltered_html'))
                 $instance['answer'.$i] = $new_instance['answer'.$i];
             else
                 $instance['answer'.$i] = stripslashes(wp_filter_post_kses(addslashes($new_instance['answer'.$i])));
         }

        return $instance;
    }// end of update.

    function widget($args, $instance)
    {
        extract($args);
        extract($instance);

        global $post;

        $title    =  isset($instance['title']) ? $instance['title'] : '';
        $description    =  isset($instance['description']) ? $instance['description'] : '';
        $desc_limit    =  isset($instance['desc_limit']) ? $instance['desc_limit'] : '';
        $background_color     =  isset($instance['background_color']) ? $instance['background_color'] : '';

        $data = array();
        for( $i=0; $i<6; $i++ ) {
            $data['question'.$i] = isset( $instance['question'.$i] ) ? $instance['question'.$i] : '';
            $data['answer'.$i] = isset( $instance['answer'.$i] ) ? $instance['answer'.$i] : '';
        }



        echo $before_widget;

        ?>



        <div class="ts-faqs">
            <div class="ts-container">
                <div class="ts-title">
                    <h2><?php echo $title; ?></h2>
                    <p><?php echo $description; ?></p>

                    <div class="faqs-list">


                    <?php for ($i = 0; $i<6; $i++) { ?>
                        <?php if(!empty($data['question'.$i] && !empty($data['answer'.$i]))): ?>
                        <div class="faqs-block">



                            <h4><i class="fa fa-angle-down"></i> <?php echo $data['question'.$i]; ?> </h4>

                            <p <?php echo $i == 0?'class="active"':'';  ?> > <?php echo $data['answer'.$i]; ?> </p>



                        </div>
                        <?php endif; ?>
                    <?php  }?>



                    </div>
                </div>
            </div>
        </div>




        <?php echo $after_widget;
    }// end of widdget function.
}// end of apply for action widget.



