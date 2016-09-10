<?php

//productpage header funtion
get_header();

//productpage front banner funtion
productpage_front_banner();

//productpage front page
if (is_active_sidebar('productpage_front_page')) {

    if (!dynamic_sidebar('productpage_front_page')):
    endif;
}

get_footer();

?>