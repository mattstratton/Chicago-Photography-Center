<?php
load_theme_textdomain("notesblog");
$content_width = 580;

// smart jquery inclusion
if (!is_admin()) {
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false);
	wp_enqueue_script('jquery');
}

// widgets
	if ( function_exists('register_sidebar') )
	    register_sidebar(array('name'=>'Sidebar'));
	    register_sidebar(array('name'=>'left-sidebar'));
	    register_sidebar(array('name'=>'Footer B'));
	    register_sidebar(array('name'=>'Footer C'));
	    register_sidebar(array('name'=>'Footer D'));
	    register_sidebar(array(
			'name' => 'Submenu',
			'id' => 'submenu',
			'before_widget' => '<div id="submenu-nav">',
			'after_widget' => '</div>',
			'before_title' => false,
			'after_title' => false
		));
// ends ---


// Menu stuff
// Function for registering wp_nav_menu() in 3 locations

add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu' ),
			'secondary-menu' => __( 'Secondary Menu' ),
			'tertiary-menu' => __( 'Tertiary Menu' )
		)
	);
}

// Add support for Featured Images
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails', array( 'post', 'page' ) );
    add_image_size('index-categories', 150, 150, true);
    add_image_size('page-single', 333, 523, true);
}

?>