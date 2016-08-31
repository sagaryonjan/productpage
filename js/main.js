

jQuery(document).ready(function($){

    $(window).scroll(function() {
        if ($(this).scrollTop() > 1){
            $('.site-header').addClass("ts-sticky");
        }
        else
        {
            $('.site-header').removeClass("ts-sticky");
        }});


    $('.ts-menu-icon').click(function() {
        $('.ts-main-navigation').toggleClass('visible');
        if($(this).children('.fa').hasClass('fa-navicon'))
        {
            $(this).children('.fa').removeClass('fa-navicon');
            $(this).children('.fa').addClass('fa-close');
        }
        else{
            $(this).children('.fa').removeClass('fa-close');
            $(this).children('.fa').addClass('fa-navicon');
        }
    });

    $('.player').mb_YTPlayer();

    $(window).stellar();

// Main-Slider
    var swiper1 = new Swiper('.swiper-container1', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: 3000,
        speed: 900,
    });

// Review-Slider
    var swiper = new Swiper('.swiper-container', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        speed: 900,
    });

// Top Scroll
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1){
            $('.ts-scroll-top').addClass("show");
        }
        else{
            $('.ts-scroll-top').removeClass("show");
        }
    });
    $(".ts-scroll-top").on("click", function() {
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });


// ScrollSpeed
//jQuery.scrollSpeed(120, 800);


});