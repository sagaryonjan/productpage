<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function productpage_widgets_init() {
    register_sidebar( array(
        'name'              => esc_html__( 'Right Sidebar', 'productpage' ),
        'id'                => 'sidebar-1',
        'description'       => esc_html__( 'Add widgets here.', 'productpage' ),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ) );

    register_sidebar( array(
        'name'              => esc_html__( 'Left Sidebar', 'productpage' ),
        'id'                => 'productpage_left_sidebar',
        'description'       => esc_html__( 'Add widgets here.', 'productpage' ),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ) );

    register_sidebar( array(
        'name'              => esc_html__('Front Page', 'productpage'),
        'id'                => 'productpage_front_page',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ) );

    register_sidebar( array(
        'name'              => esc_html__('Footer 1', 'productpage'),
        'id'                => 'productpage_footer1_area',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array(
        'name'              => esc_html__('Footer 2', 'productpage'),
        'id'                => 'productpage_footer2_area',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array(
        'name'              => esc_html__('Footer 3', 'productpage'),
        'id'                => 'productpage_footer3_area',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array(
        'name'              => esc_html__('Footer 4', 'productpage'),
        'id'                => 'productpage_footer4_area',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

}
add_action( 'widgets_init', 'productpage_widgets_init' );

// productpage Breadcrums function
if (!function_exists('productpage_breadcrumbs')) :

    function productpage_breadcrumbs($delimiter = '')
    {
        global $post;

        $productpage_et_to = get_theme_mod('productpage_breadcrumbs_activate', 1);

        if ($productpage_et_to == 1):
            $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

            if (isset($productpage_et_to['breadcrumb_separator'])) {
                $delimiter = '<span class="breadcrumb_separator">' . $productpage_et_to['breadcrumb_separator'] . '</span>';
            } else {
                $delimiter = '<span class="breadcrumb_separator"> / </span>'; // delimiter between crumbs
            }

            if (isset($productpage_et_to['breadcrumb_home_text'])) {
                $home = $productpage_et_to['breadcrumb_home_text'];
            } else {
                $home = 'Home'; // text for the 'Home' link
            }

            $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
            $before = '<a>'; // tag before the current crumb
            $after = '</a>'; // tag after the current crumb

            $homeLink = esc_url(home_url());

            if (is_home() || is_front_page()) {
                if ($showOnHome == 1) echo '<a href="' . $homeLink . '" class="breadcrumb_home_text">' . $home . '</a>';
            }
            else {
                echo '<a href="' . $homeLink . '" class="breadcrumb_home_text">' . $home . '</a>' . $delimiter . ' ';

                if (is_category()) {
                    $thisCat = get_category(get_query_var('cat'), false);
                    if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
                    echo $before . single_cat_title('', false) . $after;

                }
                elseif (is_search()) {
                    echo $before . 'Search results for "' . get_search_query() . '"' . $after;

                }
                elseif (is_day()) {

                    echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                    echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
                    echo $before . get_the_time('d') . $after;

                }
                elseif (is_month()) {

                    echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                    echo $before . get_the_time('F') . $after;

                }
                elseif (is_year()) {
                    echo $before . get_the_time('Y') . $after;

                }
                elseif (is_single() && !is_attachment()) {

                    if (get_post_type() != 'post') {
                        $post_type = get_post_type_object(get_post_type());
                        $slug = $post_type->rewrite;
                        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
                        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                    }
                    else {
                        $cat = get_the_category();
                        $cat = $cat[0];
                        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                        echo $cats;
                        if ($showCurrent == 1) echo $before . get_the_title() . $after;
                    }

                }
                elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                    $post_type = get_post_type_object(get_post_type());
                    echo $before . $post_type->labels->singular_name . $after;

                }
                elseif (is_attachment()) {

                    $parent = get_post($post->post_parent);
                    $cat = get_the_category($parent->ID);
                    $cat = $cat[0];
                    echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';

                    if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

                }
                elseif (is_page() && !$post->post_parent) {
                    if ($showCurrent == 1) echo $before . get_the_title() . $after;

                }
                elseif (is_page() && $post->post_parent) {

                    $parent_id = $post->post_parent;
                    $breadcrumbs = array();

                    while ($parent_id) {
                        $page = get_page($parent_id);
                        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                        $parent_id = $page->post_parent;
                    }

                    $breadcrumbs = array_reverse($breadcrumbs);

                    for ($i = 0; $i < count($breadcrumbs); $i++) {
                        echo $breadcrumbs[$i];
                        if ($i != count($breadcrumbs) - 1) echo ' ' . $delimiter . ' ';
                    }

                    if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

                }
                elseif (is_tag()) {
                    echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

                }
                elseif (is_author()) {
                    global $author;
                    $userdata = get_userdata($author);
                    echo $before . 'Articles posted by ' . $userdata->display_name . $after;

                }
                elseif (is_404()) {
                    echo $before . 'Error 404' . $after;
                }

                if (get_query_var('paged')) {
                    if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
                    echo __('Page', 'productpage') . ' ' . get_query_var('paged');
                    if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
                }
            }
        endif;
    }

endif;

//productpage footer count function
if (!function_exists('productpage_footer_count')) :

    function productpage_footer_count()
    {
        $productpage_count = 0;
        if (is_active_sidebar('productpage_footer1_area'))
            $productpage_count++;

        if (is_active_sidebar('productpage_footer2_area'))
            $productpage_count++;

        if (is_active_sidebar('productpage_footer3_area'))
            $productpage_count++;

        if (is_active_sidebar('productpage_footer4_area'))
            $productpage_count++;

        return $productpage_count;
    }

endif;

// productpage the custom logo fuction
if (!function_exists('productpage_the_custom_logo')) :

    function productpage_the_custom_logo()
    {
        if (function_exists('the_custom_logo')) {
            the_custom_logo();
        }
    }

endif;

// function to show the footer info, copyright information
if (!function_exists('productpage_footer_copyright_info')) :

    function productpage_footer_copyright_info()
    {
        $site_link = '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" >' . get_bloginfo('name', 'display') . '</a>';

        $wp_link = '<a href="' . esc_url('http://wordpress.org') . '" target="_blank" title="' . esc_attr__('WordPress', 'productpage') . '"><span>' . esc_html__('WordPress', 'productpage') . '</span></a>';

        $tm_link = '<a href="' . 'http://themespade.com/' . '" target="_blank" title="' . esc_attr__('themespade', 'productpage') . '" rel="designer"><span>' . esc_html__('ThemeSpade &spades; ', 'productpage') . '</span></a>';

        $default_footer_value = '<p class="ts-left">' . sprintf(esc_html__(' &copy; %1$s %2$s. All Right Reserved. ', 'productpage'), $site_link, date('Y')) . sprintf(esc_html__('| Powered by %s.', 'productpage'), $wp_link) . '</p><p class="ts-right">' . sprintf(esc_html__('Designed By %s.', 'productpage'), $tm_link) . '</p>';

        $productpage_footer_copyright = '<div class="ts-footer-bottom"><div class="ts-container">' . $default_footer_value . '</div></div>';
        echo $productpage_footer_copyright;
    }

    add_action('productpage_footer_copyright', 'productpage_footer_copyright_info', 10);

endif;
