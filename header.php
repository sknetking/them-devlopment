<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="header" class="header d-flex align-items-center fixed-top bg-dark">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="<?php echo site_url();?>" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename"><?php echo get_bloginfo('name'); ?></h1> 
      </a>
        <nav id="navmenu" class="navmenu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'nav-menu',
                'container' => false,
                'walker' => new Custom_Walker_Nav_Menu()
            ));
            ?>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </header>
<main class="main">
<?php
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $li_attributes = '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = 'nav-item-' . $item->ID;
        if ($depth && $args->walker->has_children) {
            $classes[] = 'dropdown-submenu';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';
        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes .'>';

        $atts = array();
        $atts['title'] = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        $atts['rel'] = ! empty( $item->xfn ) ? $item->xfn : '';
        $atts['href'] = ! empty( $item->url ) ? $item->url : '';
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (! empty($value)) {
                $value = esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= ($args->walker->has_children) ? ' <i class="bi bi-chevron-down toggle-dropdown"></i></a>' : '</a>';
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
?>