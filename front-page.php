<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ProductPage
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

get_footer();

?>