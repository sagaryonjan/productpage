<?php
/**
 * Template Name: HomePage
 * @package Spade Themes
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


    <!-- <div class="ts-video">
        <div class="bg-video">
           <video id="video_background" preload="auto" autoplay loop="loop" muted="muted">
               <source src="images/video-bg.mp4" type="video/mp4">
           </video>
       </div>
    </div> -->

    <!-- <div id="ts-video" class="ts-image">
        <a class="player" data-property="{videoURL:'NG2NNg2xGHU',containment:'#ts-video', autoPlay:true, loop:true, mute:true, opacity:1, quality:'default'}"></a>
        <div class="ts-video-text">
            <p>ACE Modern Product landing page.</p>
            <span><a href="#">Buy Now</a></span>
        </div>
    </div> -->

     <div class="ts-info">
        <div class="ts-container">
            <figure class="ts-info-img ts-left">
                <img src="images/p1.png">
            </figure>
            <div class="ts-info-desc ts-right">
                <div class="ts-title">
                    <h2>Info Title 1</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididuEst meis intellegat dissentiet ad, nec ei mundi semper graecis, sea nostro minimum maiestatisliquaeis intellegat dissentiet ad, nec ei mundi semper graecis, sea nostro minimum maiestatisliqua.</p>
                    <ul>
                        <li><i class="fa fa-circle-o-notch"></i> Lorem ipsum dolor sit amet, consecte</li>
                        <li><i class="fa fa-circle-o-notch"></i> Lorem ipsum dolor sit amet, consecte</li>
                        <li><i class="fa fa-circle-o-notch"></i> Lorem ipsum dolor sit amet, consecte</li>
                        <li><i class="fa fa-circle-o-notch"></i> Lorem ipsum dolor sit amet, consecte</li>
                    </ul>
                </div>
                <a href="#">Learn More</a>
            </div>
        </div>
    </div>

    <div class="ts-cta">
        <div class="ts-container">
            <p>Is ACE a good fit for you? Download it now on WordPress!</p>
            <span><a href="#">Download Theme</a></span>
        </div>
    </div>

    <div class="ts-info ts-info2">
        <div class="ts-container">
            <div class="ts-info-desc">
                <div class="ts-title">
                    <h2>Info Title 1</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididuEst meis intellegat dissentiet ad, nec ei mundi semper graecis, sea nostro minimum maiestatis cu. Ius cu veniam aperiam mnesarchum, aliquid argumentum sit at. Mei an harum tacimates, pro no fugit essent mandamus. Esse erat suscipiantur vis at. Detracto efficiantur signiferumque ea vix, alia erant ad vim. His diam sapientem no, has nonumy populo cu.Est meis intellegat dissentiet ad, nec ei mundi semper graecis, sea nostro minimum maiestatis cu.nt ut labore et dolsectetur adipisicing elit,ore magna aliqua.</p>
                </div>
                <a href="#">Learn More</a>
            </div>
            <figure class="ts-info-img">
                <img src="images/p1.png">
            </figure>
        </div>
    </div>

     


<?php

get_footer();

?>