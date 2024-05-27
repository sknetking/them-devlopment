<?php
/**
 * UpConstruction functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package UpConstruction
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
// Include the breadcrumbs file
require_once get_template_directory() .'/breadcrumbs.php';

function upconstruction_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on UpConstruction, use a find and replace
		* to change 'upconstruction' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'upconstruction', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.

		register_nav_menus(array(
			'primary' => __('Primary Menu', 'your-theme-name'),
		));
	
	
	

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'upconstruction_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'upconstruction_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function upconstruction_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'upconstruction_content_width', 640 );
}
add_action( 'after_setup_theme', 'upconstruction_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function upconstruction_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'upconstruction' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'upconstruction' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'upconstruction_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function upconstruction_scripts() {
	wp_enqueue_style( 'upconstruction-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'upconstruction-style', 'rtl', 'replace' );

	wp_enqueue_script( 'upconstruction-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'upconstruction_scripts' );

function my_theme_enqueue_styles() {
    // Enqueue Favicon and Apple Touch Icon
    echo '<link rel="icon" href="' . get_template_directory_uri() . '/assets/img/favicon.png">';
    echo '<link rel="apple-touch-icon" href="' . get_template_directory_uri() . '/assets/img/apple-touch-icon.png">';

    // Enqueue Vendor CSS Files
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css', array(), '5.1.3');
    wp_enqueue_style('bootstrap-icons', get_template_directory_uri() . '/assets/vendor/bootstrap-icons/bootstrap-icons.css', array(), '1.8.1');
    wp_enqueue_style('aos', get_template_directory_uri() . '/assets/vendor/aos/aos.css', array(), '2.3.1');
    wp_enqueue_style('glightbox', get_template_directory_uri() . '/assets/vendor/glightbox/css/glightbox.min.css', array(), '3.0.8');
    wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css', array(), '7.4.1');

    // Enqueue Main Stylesheet
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function my_theme_enqueue_scripts() {
    // Enqueue Vendor JS Files
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js', array('jquery'), '5.1.3', true);
    wp_enqueue_script('aos', get_template_directory_uri() . '/assets/vendor/aos/aos.js', array(), '2.3.1', true);
    wp_enqueue_script('glightbox', get_template_directory_uri() . '/assets/vendor/glightbox/js/glightbox.min.js', array(), '3.0.8', true);
    wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js', array(), '7.4.1', true);

    // Enqueue Custom JS
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

