<?php
/**
 * Include and setup custom metaboxes and fields.
 */

/*
add_filter( 'cmb_meta_boxes', 'custom_metaboxes' );


function custom_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_felix_';

	$meta_boxes[] = array(
		'id'         => 'section_info',
		'title'      => 'Section Info',
		'pages'      => array( 'pages', 'posts', 'unitedvoice', 'unitedinternet' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Custom Info',
				'desc' => 'The added info to be applied to this post or page',
				'id'   => $prefix . 'class',
				'type' => 'text',
			)
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}
*/

