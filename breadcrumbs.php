<?php 
function the_breadcrumb() {
    global $post;
    $separator = ' / ';
    $home_title = 'Home';

    // Start the breadcrumb with a link to the homepage
    echo '<nav class="breadcrumbs"><ol>';
    echo '<li><a href="' . home_url() . '">' . $home_title . '</a></li>';

    if (is_category() || is_single()) {
        // Category or Single Post
        echo $separator;
        the_category(' </li><li> ');
        if (is_single()) {
            echo $separator . '<li class="current">' . get_the_title() . '</li>';
        }
    } elseif (is_page()) {
        // Static Page
        if ($post->post_parent) {
            $anc = get_post_ancestors($post->ID);
            $anc = array_reverse($anc);
            foreach ($anc as $ancestor) {
                echo $separator . '<li><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
            }
            echo $separator;
        }
        echo '<li class="current">' . get_the_title() . '</li>';
    } elseif (is_tag()) {
        // Tag Archive
        echo $separator . '<li class="current">' . single_tag_title('', false) . '</li>';
    } elseif (is_day()) {
        // Daily Archive
        echo $separator . '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
        echo $separator . '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
        echo $separator . '<li class="current">' . get_the_time('d') . '</li>';
    } elseif (is_month()) {
        // Monthly Archive
        echo $separator . '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
        echo $separator . '<li class="current">' . get_the_time('F') . '</li>';
    } elseif (is_year()) {
        // Yearly Archive
        echo $separator . '<li class="current">' . get_the_time('Y') . '</li>';
    } elseif (is_author()) {
        // Author Archive
        echo $separator . '<li class="current">' . get_the_author() . '</li>';
    } elseif (is_search()) {
        // Search Results
        echo $separator . '<li class="current">Search results for: ' . get_search_query() . '</li>';
    } elseif (is_404()) {
        // 404 Page
        echo $separator . '<li class="current">Error 404</li>';
    }

    echo '</ol></nav>';
}
