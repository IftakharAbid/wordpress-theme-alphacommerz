<?php

function default_css_styles() {
	wp_enqueue_style('default-style', get_stylesheet_directory_uri() .'/inc/css/contactform.css');
	}
	add_action('wp_enqueue_scripts', 'default_css_styles');

function wpb_custom_new_menu() {
	register_nav_menu('my-custom-menu',__( 'My Custom Menu' ));
  }
  add_action( 'init', 'wpb_custom_new_menu' );


require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'mytheme_require_plugins' );
 
function mytheme_require_plugins() {
 
    $plugins = array( 
        array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
		),
		array(
			'name'        => 'Essential Addon Elementor',
			'slug'        => 'essential-addons-for-elementor-lite',
			'required'	  => true,
		),
		array(
			'name'        => 'Elementor',
			'slug'        => 'elementor',
			'required'	  => true,
		),
		array(
			'name'        => 'Header Footer',
			'slug'        => 'header-footer-elementor',
			'required'	  => true,
		),
		// A locally theme bundled plugin example.
		//The slug has to match the extracted folder from the zip.
		array(
			 
			 'name'     => 'Happy ELementor addons',
			 'slug'     => 'happy-elementor-addons',        
	
			 'required' => false,
		),

        array(
			'name'      => 'contact-form-7',
			'slug'      => 'contact-form-7',
			'required'  => true,
		),
		array(
			'name'               => 'One Click Demo Import',
			'slug'               => 'one-click-demo-import',
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
		),
    );
    $config = array(	'id'           => 'YoastSEO',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
);
 
    tgmpa( $plugins, $config );
 
}


function ocdi_import_files() {
	return array(
	  array(
		'import_file_name'             => 'Demo Import',
		'categories'                   => array( 'Category 1', 'Category 2' ),
		'local_import_file'            => trailingslashit( get_template_directory() ) . 'ocdi/test.WordPress.2022-08-31-1.xml',
		'import_preview_image_url'     => trailingslashit( get_template_directory() ) . 'screenshot.png',
		'preview_url'                  => 'http://www.mvpthemes.com/flexmag',
	  ),
	);
  }
  add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );


//   function ocdi_change_time_of_single_ajax_call() {
//     return 10;
// }
// add_filter( 'ocdi/time_for_one_ajax_call', 'ocdi_change_time_of_single_ajax_call' );

  function ocdi_after_import_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'main-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Demo Homepage' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'ocdi/after_import', 'ocdi_after_import_setup' );

if ( function_exists('register_sidebar') )
    register_sidebar();

   	
add_theme_support( 'post-thumbnails' );
function load_scripts() {
    wp_enqueue_style( 'stylecss', get_stylesheet_uri() );  
}

add_action('wp_enqueue_scripts', 'load_scripts' );


function add_google_fonts() {
	wp_enqueue_style( ' add_google_fonts ', 'https://fonts.googleapis.com/css?family=Space Grotesk', false );
	wp_enqueue_style( ' add_google_fonts ', 'https://fonts.googleapis.com/css?family=Inter', false );

}
	add_action( 'wp_enqueue_scripts', 'add_google_fonts' );
	function my_scripts_method() {
		wp_enqueue_script(
			  'custom-script',
			  get_stylesheet_directory_uri() . '/inc/js/script.js',
			  array( 'jquery' )
		);
   }
   
   add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
 add_theme_support('title-tag');
?>

