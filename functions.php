<?php

if ( ! function_exists( 'foundation_setup' ) ) :

function foundation_setup() {

	// Content Width
	if ( ! isset( $content_width ) ) $content_width = 900;

	// Language Translations
	load_theme_textdomain( 'foundation', get_template_directory() . '/languages' );

	// Custom Editor Style Support
	add_editor_style();

	// Support for Featured Images
	add_theme_support( 'post-thumbnails' ); 

}

add_action( 'after_setup_theme', 'foundation_setup' );

endif;

/**
 * Enqueue jQuery
 */

if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://code.jquery.com/jquery-1.11.0.min.js", false, null);
   wp_enqueue_script('jquery');
}

/**
 * Enqueue Scripts and Styles for Front-End
 */

if ( ! function_exists( 'foundation_assets' ) ) :

function foundation_assets() {

	if (!is_admin()) {

		// Load JavaScripts
		wp_enqueue_script( 'foundation', get_template_directory_uri() . '/core/foundation/js/foundation.min.js', null, '5.3.0', true );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/core/slick/slick.min.js', null, '1.3.7', true );
		if ( is_singular() ) wp_enqueue_script( "comment-reply" );

		// Load Stylesheets
		wp_enqueue_style( 'normalize', get_template_directory_uri().'/core/foundation/css/normalize.css' );
		wp_enqueue_style( 'foundation', get_template_directory_uri().'/core/foundation/css/foundation.min.css' );
		wp_enqueue_style( 'slick', get_template_directory_uri().'/core/slick/slick.css' );
		wp_enqueue_style( 'custom', get_template_directory_uri().'/css/style.css' );

		// Load Google Fonts API
		wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300' );
	
	}

}

add_action( 'wp_enqueue_scripts', 'foundation_assets' );

endif;

/**
 * Initialise Foundation JS
 * @see: http://foundation.zurb.com/docs/javascript.html
 */

if ( ! function_exists( 'foundation_js_init' ) ) :

function foundation_js_init () {
    echo '<script>$(document).foundation();</script>';
}

add_action('wp_footer', 'foundation_js_init', 50);

endif;


/**
 * Register Navigation Menus
 */

if ( ! function_exists( 'foundation_menus' ) ) :

// Register wp_nav_menus
function foundation_menus() {

	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu', 'foundation' )
		)
	);
	
}

add_action( 'init', 'foundation_menus' );

endif;

if ( ! function_exists( 'foundation_page_menu' ) ) :

function foundation_page_menu() {

	$args = array(
	'sort_column' => 'menu_order, post_title',
	'menu_class'  => 'large-12 columns',
	'include'     => '',
	'exclude'     => '',
	'echo'        => true,
	'show_home'   => false,
	'link_before' => '',
	'link_after'  => ''
	);

	wp_page_menu($args);

}

endif;

/**
 * Navigation Menu Adjustments
 */

// Add class to navigation sub-menu
class foundation_navigation extends Walker_Nav_Menu {

function start_lvl(&$output, $depth) {
	$indent = str_repeat("\t", $depth);
	$output .= "\n$indent<ul class=\"dropdown\">\n";
}

function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
	$id_field = $this->db_fields['id'];
	if ( !empty( $children_elements[ $element->$id_field ] ) ) {
		$element->classes[] = 'has-dropdown';
	}
		Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

/**
 * Register Sidebars
 */

if ( ! function_exists( 'foundation_widgets' ) ) :

function foundation_widgets() {

	// Sidebar Right
	register_sidebar( array(
			'id' => 'sidebar_right',
			'name' => __( 'Sidebar Right', 'foundation' ),
			'description' => __( 'This sidebar is located on the right-hand side of each page.', 'foundation' ),
			'before_widget' => '<div>',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		) );

	// Sidebar Footer Column One
	register_sidebar( array(
			'id' => 'sidebar_footer',
			'name' => __( 'Footer', 'foundation' ),
			'description' => __( 'This widget area is located in column one of your theme footer.', 'foundation' ),
			'before_widget' => '<div class="large-3 columns">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		) );
}

add_action( 'widgets_init', 'foundation_widgets' );

endif;


function cases_tax_init() {
	register_taxonomy(
		'cases_tax',
		'case',
		array(
			'label' => __( 'Case categories' ),
			'rewrite' => array( 'slug' => 'cases' ),
			'hierarchical' => true
		)
	);
}
add_action( 'init', 'cases_tax_init' );


add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type('case', array(
        'labels' => array(
            'name' => 'Cases',
            'singular_name' => 'Case',
            'add_new' => 'New Case',
            'edit_item' => 'Edit case',
            'new_item' => 'New case',
            'view_item' => 'View case',
            'search_items' => 'Search cases',
            'not_found' => 'No cases found',
            'not_found_in_trash' => 'No cases found in trash'
        ),
        'public' => true,
        'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'thumbnail')
    ));
    register_post_type('slider', array(
        'labels' => array(
            'name' => 'Slider',
            'singular_name' => 'Slide',
            'add_new' => 'New slide',
            'edit_item' => 'Edit slide',
            'new_item' => 'New slide',
            'view_item' => 'View slide',
            'search_items' => 'Search slides',
            'not_found' => 'No slides found',
            'not_found_in_trash' => 'No slides found in trash'
        ),
        'public' => true,
        'hierarchical' => true,
        'supports' => array( 'title', 'thumbnail')
    ));
}

?>