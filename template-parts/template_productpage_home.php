<?php
/**
 * Template Name: HomePage
 * @package  ThemeSpade
 * @subpackage ProductPage
 */

//productpage header funtion
get_header();

//productpage front banner funtion
productpage_front_banner();

//productpage front page
if (is_active_sidebar('productpage_front_page')) {

    if (!dynamic_sidebar('productpage_front_page')):
    endif;

}



?>


     <!--<div id="ts-video" class="ts-image">
        <a class="player" data-property="{videoURL:'NG2NNg2xGHU',containment:'#ts-video', autoPlay:true, loop:true, mute:true, opacity:1, quality:'default'}"></a>
        <div class="ts-video-text">
            <p>ACE Modern Product landing page.</p>
            <span><a href="#">Buy Now</a></span>
        </div>
    </div>-->










     


<?php

get_footer();

?>