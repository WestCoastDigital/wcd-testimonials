<?php
if ( ! function_exists('wcd_testimonial_cpt') ) {

	// Register Custom Post Type
	function wcd_testimonial_cpt() {
	
		$labels = array(
			'name'                  => _x( 'Testimonials', 'Post Type General Name', 'translate' ),
			'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'translate' ),
			'menu_name'             => __( 'Testimonial', 'translate' ),
			'name_admin_bar'        => __( 'Testimonial', 'translate' ),
			'archives'              => __( 'Testimonials', 'translate' ),
			'attributes'            => __( 'Testimonial Attributes', 'translate' ),
			'parent_item_colon'     => __( 'Parent Testimonial:', 'translate' ),
			'all_items'             => __( 'All Testimonials', 'translate' ),
			'add_new_item'          => __( 'Add New Testimonial', 'translate' ),
			'add_new'               => __( 'Add Testimonial', 'translate' ),
			'new_item'              => __( 'New Testimonial', 'translate' ),
			'edit_item'             => __( 'Edit Testimonial', 'translate' ),
			'update_item'           => __( 'Update Testimonial', 'translate' ),
			'view_item'             => __( 'View Testimonial', 'translate' ),
			'view_items'            => __( 'View Testimonials', 'translate' ),
			'search_items'          => __( 'Search Testimonial', 'translate' ),
			'not_found'             => __( 'Not found', 'translate' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'translate' ),
			'featured_image'        => __( 'Authors Profile Image', 'translate' ),
			'set_featured_image'    => __( 'Set profile image', 'translate' ),
			'remove_featured_image' => __( 'Remove profile image', 'translate' ),
			'use_featured_image'    => __( 'Use as profile image', 'translate' ),
			'insert_into_item'      => __( 'Insert into testimonial', 'translate' ),
			'uploaded_to_this_item' => __( 'Uploaded to this testimonial', 'translate' ),
			'items_list'            => __( 'Testimonials list', 'translate' ),
			'items_list_navigation' => __( 'Testimonials list navigation', 'translate' ),
			'filter_items_list'     => __( 'Filter testimonials list', 'translate' ),
		);
		$args = array(
			'label'                 => __( 'Testimonial', 'translate' ),
			'description'           => __( 'Client Testimonials', 'translate' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies'            => array(),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-format-quote',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'testimonial', $args );
		flush_rewrite_rules();
	}
	add_action( 'init', 'wcd_testimonial_cpt', 0 );
	
	}

	function wcd_change_testimonia_title_text( $title ){
		$screen = get_current_screen();
	 
		if  ( 'testimonial' == $screen->post_type ) {
			 $title = __( 'Enter name of person providing testimonial', 'translate' );
		}
	 
		return $title;
   }
	 
   add_filter( 'enter_title_here', 'wcd_change_testimonia_title_text' );