<?php

/* Theme Init */
function setup() {

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

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
 * Enqueues scripts and styles for front end.
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
	wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/style.css', array(), '');
}
add_action( 'wp_enqueue_scripts', 'scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 */
function _wp_title( $title, $sep ) {
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
add_filter( 'wp_title', '_wp_title', 10, 2 );

/* Menu Walker */
class _walker_nav_menu extends Walker_Nav_Menu {
	var $current_menu_count = null;

	// add classes to ul sub-menus
	function start_lvl( &$output, $depth, $args ) {
	    // depth dependent classes
	    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
	    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
	    $classes = array(
	        'sub-menu',
	        ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
	        ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
	        'menu-depth-' . $display_depth
	        );
	    $class_names = implode( ' ', $classes );

	    // build html
	    //

	    $output .= "\n" . $indent . '<div class="b-sub-menu-layout"><ul class="' . $class_names . '">' . "\n";
	}

	function end_lvl(&$output, $depth=0, $args=array()) {
		// build html
	    	$output .= "</ul></div>\n";

    }

	function start_el(&$output, $item, $depth, $args)
	{
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  	. esc_attr( $item->attr_title 		) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' 	. esc_attr( $item->target     		) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    	. esc_attr( $item->xfn        		) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   	. esc_attr( $item->url        		) .'"' : '';

        $prepend = '';
        $append = '';

        if($depth != 0)
        {
        	$description = $append = $prepend = "";
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .' data-ajax="true">';
        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
        $item_output .= $description.$args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

}

/* replace cf7 form submit with button */
function _wpcf7_submit_button() {
    if(function_exists('wpcf7_remove_shortcode')) {
        wpcf7_remove_shortcode('submit');
        remove_action( 'admin_init', 'wpcf7_add_tag_generator_submit', 55 );
        $fowl_cf7_module = TEMPLATEPATH . '/cf7/submit-button.php';
        require_once $fowl_cf7_module;
        wpcf7_add_shortcode( 'submit', 'fowl_wpcf7_submit_shortcode_handler' );
    }
}

add_action('init','_wpcf7_submit_button');

/* Helper function is_blog() */
function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}