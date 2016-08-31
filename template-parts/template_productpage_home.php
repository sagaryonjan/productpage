<?php
/**
 * Template Name: HomePage
 * @package Spade Themes
 * @subpackage ProductPage
 */


?>

<?php  get_header(); ?>

<?php  productpage_front_banner(); ?>



<?php
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

    <div id="ts-video" class="ts-image">
        <a class="player" data-property="{videoURL:'NG2NNg2xGHU',containment:'#ts-video', autoPlay:true, loop:true, mute:true, opacity:1, quality:'default'}"></a>
        <div class="ts-video-text">
            <p>ACE Modern Product landing page.</p>
            <span><a href="#">Buy Now</a></span>
        </div>
    </div>

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

    <div data-stellar-background-ratio="0.5" class="ts-reviews" style="background-image: url(images/review-img.png);  background-size:cover;background-repeat: no-repeat;">
        <div class="ts-container">
            <div class="ts-title ts-title-white">
                <h2>Product Reviews</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolsectetur adipisicing elit,ore magna aliqua.</p>
            </div>
            <div class="ts-reviews-block">
                <div class="ts-review-swiper swiper-container2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="ts-reviews-single">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <figure class="ts-review-img">
                                    <img src="images/profile.png">
                                </figure>
                                <h4>Monkey D. Luffy</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Add Navigation -->
                    <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
                    <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="ts-faqs">
        <div class="ts-container">
            <div class="ts-title">
                <h2>FAQ's</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolsectetur adipisicing elit,ore magna aliqua.</p>
            </div>
        </div>
    </div>

    <div class="ts-social">
        <div class="ts-container">
            <div class="menu-social-menu-container"><ul id="social-menu" class="menu"><li id="menu-item-37" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-37"><a href="http://facebook.com/99colorthemes"><i class="fa fa-facebook"></i></a></li>
                    <li id="menu-item-38" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-38"><a href="http://twitter.com/99colorthemes"><i class="fa fa-twitter"></i></a></li>
                    <li id="menu-item-39" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39"><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                </ul></div>
        </div>
    </div>


<?php

get_footer();

?>