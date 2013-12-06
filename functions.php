<?php
/**
 * Twenty Thirteen functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codrpt.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/**
 * Sets up the content width value based on the theme's design.
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function setup() {

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentythirteen' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'secondary', __( 'Secondary Menu', 'twentythirteen' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

    add_image_size( 'left-side-image', 592, 781, true );
    add_image_size( 'product-image', 581, 339, true );


	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'setup' );



function add_custom_posts_type() {
	register_post_type( 'homepage_section',
		array(
			'labels' => array(
				'name' => 'Homepage Sections',
				'singular_name' => 'Homepage Section'
			),
			'has_archive' => false,
			'public' => false,
			'show_ui' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
		)
	);

	register_post_type( 'beauty_section',
		array(
			'labels' => array(
				'name' => 'Beauty At Any Age Sections',
				'singular_name' => 'Beauty At Any Age Section'
			),
			'has_archive' => false,
			'public' => false,
			'show_ui' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
		)
	);

	register_post_type( 'service',
		array(
			'labels' => array(
				'name' => 'Services',
				'singular_name' => 'Service'
			),
			'has_archive' => false,
			'public' => true,
			'show_ui' => true,
			'rewrite' => array('slug' => 'services'),
			'taxanomies' => array('product_category'),
			'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
		)
	);

	register_post_type( 'product',
		array(
			'labels' => array(
				'name' => 'Products',
				'singular_name' => 'product'
			),
			'has_archive' => false,
			'public' => true,
			'show_ui' => true,
			'rewrite' => array('slug' => 'products'),
			'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
		)
	);

	register_post_type( 'team_member',
		array(
			'labels' => array(
				'name' => 'Team',
				'singular_name' => 'Team Member'
			),
			'has_archive' => false,
			'public' => false,
			'show_ui' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields'),
		)
	);

	register_post_type( 'special',
		array(
			'labels' => array(
				'name' => 'Specials',
				'singular_name' => 'Special'
			),
			'has_archive' => false,
			'public' => false,
			'show_ui' => true,
			'supports' => array('title', 'editor', 'page-attributes', 'custom-fields'),
		)
	);

	register_post_type( 'self_diagnosis',
		array(
			'labels' => array(
				'name' => 'Self Diagnosis',
				'singular_name' => 'Self Diagnosis'
			),
			'has_archive' => false,
			'public' => true,
			'show_ui' => true,
			'rewrite' => array('slug' => 'beauty-resources/self-diagnosis'),
			'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields'),
		)
	);

	register_taxonomy('service_category', array('service'), array(
        'hierarchical' => true, 
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true, 
        'label' => 'Services Categories'
        ) 
    );
}

add_action( 'init', 'add_custom_posts_type' );

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Oswald:300';

		if ( 'off' !== $bitter )
			$font_families[] = 'Libre+Baskerville:400,400italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Open+Sans:400,700,600';

		$query_args = array(
			'family' => implode( '|', $font_families ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}


/**
 * Enqueues scripts and styles for front end.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function scripts_styles() {
	wp_deregister_script( 'jquery' );
	//
 	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/vendor/jquery-1.10.2.min.js', array(), '', true );

	wp_enqueue_script( 'modernizer', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js', array(), '', false );

	//wp_enqueue_script( 'init', get_template_directory_uri() . '/js/init.js', array(), '', true );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array(), '', true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), '', true );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '' );
}
add_action( 'wp_enqueue_scripts', 'scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );

/**
 * Registers two widget areas.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_widgets_init() {
	register_sidebar( array(
		'name'          => 'Credits',
		'id'            => 'credits',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );

function new_excerpt_more( $more ) {
	return '[…] <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">More</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );