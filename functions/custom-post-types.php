<?php

/*
add_action( 'init', 'create_post_type' );

function create_post_type() {

//Declare all your custom post types below

register_post_type( 'events',
    array(
      'labels' => array(
        'name' => __( 'Events' ),
        'singular_name' => __( 'Event' ),
		'add_new' => _x('Add New'),
		'add_new_item' => __('Add New Event'),
		'edit_item' => __('Edit Event'),
		'new_item' => __('New Event'),
		'view_item' => __('View Event'),
		'search_items' => __('Search Events'),
		'not_found' =>  __('No Events found'),
		'not_found_in_trash' => __('No Events found in Trash'), 
		'parent_item_colon' => ''
      ),
	  'menu_position' => 4,
	  'has_archive' => "event",
	  'rewrite' => array(
	  	"slug" => "event",
	  ),
	  'publicly_queryable' => true,
	  'exclude_from_search' => true,
	  'show_in_nav_menus' => false,
      'public' => true,
	  'description' => 'Events',
	  'hierarchical' => 'true',
	  'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes')
    )
  );
  
  //Add more custom post types here...


}
*/

?>