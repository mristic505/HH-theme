<?php

/*** Enqueue the child theme stylesheet ***/

function wp_qode_child_theme_enqueue_scripts() {
	wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
	wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'wp_qode_child_theme_enqueue_scripts', 11);

function register_my_menu() {
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'register_my_menu' );

function my_custom_post_product() {
  $labels = array(
    'name'               => _x( 'Products', 'post type general name' ),
    'singular_name'      => _x( 'Product', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Product' ),
    'edit_item'          => __( 'Edit Product' ),
    'new_item'           => __( 'New Product' ),
    'all_items'          => __( 'All Products' ),
    'view_item'          => __( 'View Product' ),
    'search_items'       => __( 'Search Products' ),
    'not_found'          => __( 'No products found' ),
    'not_found_in_trash' => __( 'No products found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Products'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our products and product specific data',
    'public'        => true,
    'menu_position' => 3,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => true,
  );
  register_post_type( 'product', $args ); 
}
add_action( 'init', 'my_custom_post_product' );

function my_taxonomies_product() {
  $labels = array(
    'name'              => _x( 'Product Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Product Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Product Categories' ),
    'all_items'         => __( 'All Product Categories' ),
    'parent_item'       => __( 'Parent Product Category' ),
    'parent_item_colon' => __( 'Parent Product Category:' ),
    'edit_item'         => __( 'Edit Product Category' ), 
    'update_item'       => __( 'Update Product Category' ),
    'add_new_item'      => __( 'Add New Product Category' ),
    'new_item_name'     => __( 'New Product Category' ),
    'menu_name'         => __( 'Product Categories' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'product_category', 'product', $args );
}
add_action( 'init', 'my_taxonomies_product', 0 );

add_action( 'wp_enqueue_scripts', 'register_jquery' );
function register_jquery() {
    if (!is_admin() && $GLOBALS['pagenow'] != 'wp-login.php') {
        // comment out the next two lines to load the local copy of jQuery
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js', false, '1.11.2');
        wp_enqueue_script('jquery');
    }
}

add_action( 'wp_enqueue_scripts', 'hh_header_scripts' );
function hh_header_scripts() {
    wp_register_script('hh_header_scripts', plugins_url().'/slick/slick.min.js', array('jquery'), '1.8.0'); // Custom scripts
    wp_enqueue_script('hh_header_scripts'); // Enqueue it!
}

add_action( 'wp_enqueue_scripts', 'hh_header_styles' );
function hh_header_styles() {
    wp_register_style('hh_header_styles', plugins_url().'/slick/slick.css', array(), '1.0', 'all');
    wp_enqueue_style('hh_header_styles'); // Enqueue it!
}

function my_custom_post_status(){

register_post_status( '<strong>pitch</strong>', array(

'label'                     => _x( '<strong>Pitch</strong>', 'post' ),

'public'                    => false,

'exclude_from_search'       => true,

'show_in_admin_all_list'    => true,

'show_in_admin_status_list' => true,

'label_count'               => _n_noop( '<strong>Pitch</strong> <span class="count">(%s)</span>', '<strong>Pitches</strong> <span class="count">(%s)</span>' ),

) );

}

add_action( 'init', 'my_custom_post_status' );