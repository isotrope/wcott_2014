<?php
/**
 * wcott2014 functions and definitions
 *
 * @package wcott2014
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'wcott2014_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wcott2014_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wcott2014, use a find and replace
	 * to change 'wcott2014' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'wcott2014', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'wcott2014' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wcott2014_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );
}
endif; // wcott2014_setup
add_action( 'after_setup_theme', 'wcott2014_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function wcott2014_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wcott2014' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'wcott2014_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wcott2014_scripts() {
	wp_enqueue_style( 'wcott2014-style', get_stylesheet_uri() );

	wp_enqueue_script( 'wcott2014-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'wcott2014-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    // MB styles
    wp_enqueue_style('wcott2014-google-fonts', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Oswald:400,700');
    wp_enqueue_script('wcott2014-scripts', get_template_directory_uri() . '/js/wcott-scripts.js', array('jquery', 'jquery-masonry'));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wcott2014_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';




/*


       oy:                                                            :yo
       sNNNs:                                                      :sNNNs
       sNNNNNms:                                                :smNNNNNs
       sNNNNNNNNms-                                          -smNNNNNNNNs
       sNNNNNNNNNNNmo-                                    -omNNNNNNNNNNNs
       sNNNNNNNNNNNNNNdo.                              .odNNNNNNNNNNNNNNs
       sNNNNNNNNNNNNNNNNNd+.                        .+dNNNNNNNNNNNNNNNNNs
       sNNNNNNNNNNNNNNNNNNNNd+.                  .+dNNNNNNNNNNNNNNNNNNNNs
       sNNNNNNNNNNNNNNNNNNNNNNNh+`            `+hNNNNNNNNNNNNNNNNNNNNNNNs
       sNNNNNNNNNNNNNNNNNNNNNNNNNNh/`      `/hNNNNNNNNNNNNNNNNNNNNNNNNNNs
       sNNNNNNNNNNNNNNNNNNNNNNNNNNNNNy/``/yNNNNNNNNNNNNNNNNNNNNNNNNNNNNNs
       sNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNs
       sNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNs
       sNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNs
       sNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNs
       sNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNs
       sNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNs
       +NNNNNN-...................yNNNNNNNNNNy...................-NNNNNN+
       -NNNNNN+                   mNNNNNNNNNNm`                  +NNNNNN-
        hNNNNNN:                 yNNNNNNNNNNNNy                 :NNNNNNh
        `mNNNNNNs`             :dNNNNNNmmNNNNNNd:             `oNNNNNNm`
         `hNNNNNNNy/`       -+dNNNNNNNd`.dNNNNNNNd+-       `/yNNNNNNNh`
           +mNNNNNNNNNdhhddNNNNNNNNNN+    +NNNNNNNNNNmdhhdNNNNNNNNNm+
            `+dNNNNNNNNNNNNNNNNNNNd+`      `+dNNNNNNNNNNNNNNNNNNNd+`
               .+ymNNNNNNNNNNNmh+.            .+hmNNNNNNNNNNNmy+.
                   `-:/+++/:-`                    `-:/+++/:-`


*/

add_theme_support( 'post-thumbnails');

/**
 * Load our Book Custom Post Type funcitonality
 */
require get_template_directory() . '/inc/cpt-book.php';